<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Коллекции видео файлов</h2>
            </div>
            <ul class="uk-subnav uk-subnav-pill" uk-margin>
                <li v-for="item in dir_list" :class="{'uk-active':item==current_dir}">
                    <a href="#" @click="setCurrentDir(item)">{{item}}</a>
                </li>
                <li class="uk-width-1-1">
                    <div>
                        <div class="uk-inline">
                            <a class="uk-form-icon" href="#" v-if="show_add_dir" @click="addDir()"
                               title="Добавить директорию">
                                <svg width="20" height="20" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="9" y="1" width="1" height="17"></rect>
                                    <rect x="1" y="9" width="17" height="1"></rect>
                                </svg>
                            </a>
                            <input :style="{textTransform:'none'}" type="text" class="uk-input uk-form-width-large"
                                   v-model="dir_name" v-if="show_add_dir">

                            <a :style="{padding:'0 9px'}" class="uk-button uk-button-default" href="#"
                               v-if="!show_add_dir" @click="showAddDir()"
                               title="Добавить директорию">
                                <svg width="20" height="20" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="9" y="1" width="1" height="17"></rect>
                                    <rect x="1" y="9" width="17" height="1"></rect>
                                </svg>
                            </a>

                            <a href="#" class="uk-form-icon uk-form-icon-flip" v-if="show_add_dir"
                               @click="closeAddDir()" title="Отмена">
                                <svg width="14" height="14" viewBox="0 0 14 14"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13"
                                          y2="13"></line>
                                    <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1"
                                          y2="13"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
                <input :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                       type="file" multiple="multiple" @change="onUpload">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">Перетащите файлы сюда или</span>
                <div uk-form-custom>
                    <span class="uk-link">загрузите вручную</span>
                </div>
            </div>
        </header>
        <div class="uk-margin-top">
            <div v-if="list.length" class="content-section">
                <div class="content-section-header">
                    <label>Сортировка:</label>
                    <label @click="setFieldSort('created_at')" :class="{'uk-active':sort_field ==='created_at'}"
                           class="sort-field">Дата
                        <i uk-icon="triangle-down" v-if="sort_method"></i>
                        <i uk-icon="triangle-up" v-if="!sort_method"></i>
                    </label>
                    <label @click="setFieldSort('title')" :class="{'uk-active':sort_field ==='title'}"
                           class="sort-field">имя
                        <i uk-icon="triangle-down" v-if="sort_method"></i>
                        <i uk-icon="triangle-up" v-if="!sort_method"></i>
                    </label>
                </div>
                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/video/'+method+'/'"></widget-paginator-component>
                <div class="content-section-grid">
                    <div class="content-section-grid-item" v-for="item in list">
                        <img class="thumbnail" :src="item.thumb">
                        <div class="text-section">
                            <div class="title">{{item.title}}</div>
                            <ul class="uk-comment-meta uk-flex">
                                <li class="uk-margin-right">ID: <strong>{{item.id}}</strong></li>
                                <li class="uk-margin-right">Отредактировано: <strong>{{item.updated_at}}</strong></li>
                                <li class="uk-margin-right">Дата создания: <strong>{{item.created_at}}</strong></li>
                            </ul>
                        </div>
                        <div class="buttons-section">
                            <button @click="showVideo(item)"
                                    class="uk-button uk-button-default uk-background-muted uk-button-small">
                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-button-small" v-if="is_delete"
                                    @click="Delete(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/video/'+method+'/'"></widget-paginator-component>
            </div>
            <!--            <div v-if="list.length">-->
            <!--                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"-->
            <!--                                            :path="'/admin/page/'"></widget-paginator-component>-->
            <!--                <div class="news-grid">-->
            <!--                    <div v-for="item in list" :data-video="item.video" class="news-grid-item block">-->
            <!--                        <div class="image"><img :src="item.thumb" @click="showVideo(item)"></div>-->
            <!--                        <div class="text red">-->
            <!--                            <div class="title">{{item.title}}</div>-->
            <!--&lt;!&ndash;                            <div class="sub-title">{{types[item.type]}}</div>&ndash;&gt;-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page"-->
            <!--                                            :path="'/admin/page/'"></widget-paginator-component>-->
            <!--            </div>-->
            <div v-else="" class="uk-margin-top">
                <widget-preloader-component :load="load"></widget-preloader-component>
            </div>
        </div>
        <div id="delete-save" class="uk-flex-top" ref="delete-save" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <h2 class="uk-modal-title uk-text-warning">Предупреждение!</h2>
                <p> Вы действительно хотите удалить материал?</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Нет</button>
                    <button class="uk-button uk-button-primary" @click="deletePage" type="button">ДА!</button>
                </p>
            </div>
        </div>
        <div id="video" ref="video" class="uk-flex-top" uk-modal="" @click="StopVideo($event)">
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Заголовок:*</label>
                    <div class="uk-form-controls">
                        <input v-model="current_video.title" class="uk-input uk-form-width-large" id="title" type="text"
                               placeholder="Заголовок" autocomplete="off">
                    </div>
                </div>
                <!--                <div class="uk-margin-small">-->
                <!--                    <label class="uk-form-label">Для руководителей:</label>-->
                <!--                    <div class="uk-form-controls">-->
                <!--                        <div class="onoffswitch-small">-->
                <!--                            <input type="checkbox" class="onoffswitch-checkbox" id="nofollow"-->
                <!--                                   v-model="current_video.to_top">-->
                <!--                            <label class="onoffswitch-label" for="nofollow"></label>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div>
                    <video ref="modal-video" controls="controls" :src="current_video.video"></video>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="description">Опсание:*</label>
                    <div class="uk-form-controls">
                        <textarea v-model="current_video.description" class="uk-textarea" rows="5" id="description"
                                  type="text"
                                  placeholder="Заголовок" autocomplete="off"></textarea>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-primary" @click="SaveVideo()" type="button">Сохранить</button>
                    <button class="uk-button uk-button-danger uk-modal-close" type="button">Закрыть</button>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['method', 'current_page', 'user_type'],
        data() {
            return {
                list: [],
                page_list: null,
                load: false,
                delete_item: {},
                delete_dialog: false,
                is_delete: false,
                video_modal: false,
                path: window.location.pathname,
                current_video: {},
                dir_list: [],
                sort_field: 'created_at',
                sort_method: false,
                current_dir: 'video',
                show_add_dir: false,
                dir_name: '',
                types: {
                    'news': "Новость",
                    'motivation': "Мотивация",
                    'other': "Другое",
                },
            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];
            this.video_modal = this.$refs['video'];
            this.getDirectories();

            this.getList();
        },
        methods: {
            closeAddDir: function () {
                this.show_add_dir = false;
                this.dir_name = '';
            },
            showAddDir: function () {
                this.show_add_dir = true;
            },
            addDir: function () {
                this.$http.post('/admin/video/add_dir', {'dir_name': this.dir_name}).then(response => {
                    this.dir_list = response.data;
                    this.dir_name = '';
                    this.show_add_dir = false;
                });
            },
            setCurrentDir: function (item) {
                this.current_dir = item;
                this.getList();
            },
            getDirectories: function () {
                this.$http.get('/admin/video/get/directories').then(response => {
                    this.dir_list = response.data;
                })
            },
            SaveVideo: function () {
                this.$http.post('/admin/video/update', this.current_video).then(response => {
                    if (response.data.result) {
                        UIkit.modal(this.video_modal).hide();
                        this.getList();
                    }
                });
            },
            StopVideo: function (e) {
                this.$refs['modal-video'].pause();
            },
            PlayPause: function (e) {
                if (!JSON.parse(e.target.getAttribute('play'))) {
                    e.target.setAttribute('play', true);
                    e.target.play();
                } else {
                    e.target.setAttribute('play', false);
                    e.target.pause();
                }
                console.log(e);
            },
            showVideo: function (item) {
                this.current_video = item;
                UIkit.modal(this.video_modal).show();

            },
            onUpload: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                formData.append('dir', this.current_dir);

                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                UIkit.notification({message: 'Подождите видео загружаются!', status: 'success', timeout: 10000});
                this.$http.post('/admin/video/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        UIkit.notification({message: 'Видео успешно загружены!', status: 'success'});
                        this.getList();
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки изображений произошла ошибка!', status: 'danger'});
                    });

            },
            setFieldSort: function (field) {
                if (field === this.sort_field) {
                    this.sort_method = !this.sort_method;
                } else {
                    this.sort_field = field;
                }

                this.getList();
            },
            getList: function () {
                let pros = {
                    'sort_field': this.sort_field,
                    'sort_method': (this.sort_method ? 'asc' : 'desc'),
                    'dir': this.current_dir
                };
                this.$http.post('/admin/video/get/' + this.method + '/' + this.current_page, pros).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.is_delete = response.data.delete;
                    this.load = true;
                });
            },
            Delete: function (item) {
                this.delete_item = item;
                this.deletePage();
                // UIkit.modal(this.delete_dialog).show();
            },
            Update: function (data) {
                this.list = data.list;
                this.page_list = data.page_list
            },
            deletePage: function (item) {
                this.$http.delete('/admin/video/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            }
        },
    }
</script>
<style>
    .news-grid {
        margin: 50px auto;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 20px;
    }

    .news-grid .news-grid-item {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        max-height: 280px;
        border: none;
        overflow: hidden;
    }

    .news-grid .news-grid-item img {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
    }

    .news-grid .news-grid-item .image {
        background: #000;
    }

    .news-grid .news-grid-item .text {
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: flex-start;
        align-items: flex-start;
        box-sizing: border-box;
        max-height: 280px;
    }

    .news-grid .news-grid-item .text .title {
        color: #000000;
        font-family: Montserrat;
        font-size: 20px;
        font-weight: 700;
        line-height: 30px;
        margin-bottom: 20px;
    }

    .news-grid .news-grid-item .text .sub-title {
        color: #000000;
        font-family: Montserrat;
        font-size: 14px;
        font-weight: 400;
        line-height: 21px;
    }

    .block {
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
        border: 1px solid #efefef;
        background-color: #ffffff;
    }
</style>
