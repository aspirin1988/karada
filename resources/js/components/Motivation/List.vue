<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Мотивации <button @click="ShowAdd()" class="uk-button uk-button-small uk-button-primary" >
                    <span uk-icon="plus"></span></button>
                </h2>
            </div>
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
                    <label @click="setFieldSort('day')" :class="{'uk-active':sort_field ==='day'}"
                           class="sort-field">День
                        <i uk-icon="triangle-down" v-if="sort_method"></i>
                        <i uk-icon="triangle-up" v-if="!sort_method"></i>
                    </label>
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
                                            :path="'/admin/motivation/'"></widget-paginator-component>
                <div class="content-section-grid">
                    <div class="content-section-grid-item test" v-for="item in list">
<!--                        <img class="thumbnail" :src="item.image">-->
                        <div class="text-section">
                            <div class="title"><strong>День {{item.day}}:</strong> {{item.title}}</div>
                            <ul class="uk-comment-meta uk-flex">
                                <li class="uk-margin-right">ID: <strong>{{item.id}}</strong></li>
                                <li class="uk-margin-right">Отредактировано: <strong>{{getDate(item.updated_at)}}</strong></li>
                                <li class="uk-margin-right">Дата создания: <strong>{{getDate(item.created_at)}}</strong></li>
                            </ul>
                        </div>
                        <div class="buttons-section">
                            <a :href="'#'" @click="showVideo(item)"
                               class="uk-button uk-button-default uk-background-muted uk-button-small">
                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                            </a>
                            <button class="uk-button uk-button-default uk-text-primary uk-button-small"
                                    @click="clone(item)">
                                <span uk-icon="copy"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-text-primary uk-button-small"
                                    @click="Up(item)">
                                <span uk-icon="arrow-up"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-text-primary uk-button-small"
                                    @click="Down(item)">
                                <span uk-icon="arrow-down"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-button-small" v-if="is_delete" @click="Delete(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/motivation/'"></widget-paginator-component>
            </div>
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
        <div id="video" class="uk-flex-top" ref="video" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Заголовок:*</label>
                    <div class="uk-form-controls">
                        <input v-model="current_motivation.title" class="uk-input uk-form-width-large" id="title" type="text"
                               placeholder="Заголовок" autocomplete="off" @keypress="Checked" >
                        <label>{{current_motivation.title.length}}/70</label>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="day">День:*</label>
                    <div class="uk-form-controls">
                        <input v-model="current_motivation.day" class="uk-input uk-form-width-large" id="day" type="text"
                               placeholder="Заголовок" autocomplete="off">
                    </div>
                </div>
                <div class="uk-margin">
                    <label for="tag" class="uk-form-label">Видео:</label>
                    <div class="uk-form-controls">
                        <input type="text" id="tag"
                               class="uk-input uk-form-width-large"
                               placeholder="Название видео" v-model="video_name" @keyup="findVideo" autocomplete="off">
                        <ul class="uk-list uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                            <li v-for="item in video_list">
                                <a class="uk-button uk-button-primary uk-width-1-2">{{item.title}}</a>
                                <button type="button" class="uk-button uk-button-success"
                                        @click="addVideo(item)">
                                    <i uk-icon="plus"></i>
                                </button>
                            </li>
                        </ul>
                        <div class="uk-margin-top uk-margin-bottom" id="tag_list" v-if="current_motivation.video_">
                            <div class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                {{current_motivation.video_.title}}
                                <a uk-icon="close"
                                   class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                   @click="removeVideo(item)"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <video controls="controls" @click="PlayPause($event)" :src="current_motivation.video"></video>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="description">Опсание:*</label>
                    <div class="uk-form-controls">
                        <textarea v-model="current_motivation.description" class="uk-textarea" rows="5" id="description"
                                  type="text"
                                  placeholder="Заголовок" autocomplete="off"></textarea>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-primary" @click="Save()" type="button">Сохранить</button>
                    <button class="uk-button uk-button-danger uk-modal-close" type="button">Закрыть</button>
                </p>
            </div>
        </div>
        <div id="add" class="uk-flex-top" ref="add" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Заголовок:*</label>
                    <div class="uk-form-controls">
                        <input v-model="new_motivation.title" class="uk-input uk-form-width-large" id="title" type="text"
                               placeholder="Заголовок" autocomplete="off" @keypress="CheckedNew" >
                        <br>
                        <label>{{new_motivation.title.length}}/70</label>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="day">День:*</label>
                    <div class="uk-form-controls">
                        <input v-model="new_motivation.day" class="uk-input uk-form-width-large" id="day" type="text"
                               placeholder="День" autocomplete="off">
                    </div>
                </div>
                <div class="uk-margin">
                    <label for="tag" class="uk-form-label">Видео:</label>
                    <div class="uk-form-controls">
                        <input type="text" id="tag"
                               class="uk-input uk-form-width-large"
                               placeholder="Название видео" v-model="video_name" @keyup="findVideo" autocomplete="off">
                        <ul class="uk-list uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                            <li v-for="item in video_list">
                                <a class="uk-button uk-button-primary uk-width-1-2">{{item.title}}</a>
                                <button type="button" class="uk-button uk-button-success"
                                        @click="addVideoNew(item)">
                                    <i uk-icon="plus"></i>
                                </button>
                            </li>
                        </ul>
                        <div class="uk-margin-top uk-margin-bottom" id="tag_list" v-if="new_motivation.video_">
                            <div class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                {{new_motivation.video_.title}}
                                <a uk-icon="close"
                                   class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                   @click="removeVideoNew(item)"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <video controls="controls" @click="PlayPause($event)" :src="new_motivation.video"></video>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="description">Опсание:*</label>
                    <div class="uk-form-controls">
                        <textarea v-model="new_motivation.description" class="uk-textarea" rows="5" id="description"
                                  type="text"
                                  placeholder="Опсание" autocomplete="off"></textarea>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-primary" @click="CreateNew()" type="button">Создать</button>
                    <button class="uk-button uk-button-danger uk-modal-close" type="button">Закрыть</button>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['method', 'current_page','user_type'],
        data() {
            return {
                list: [],
                page_list: null,
                load: false,
                delete_item: {},
                delete_dialog: false,
                video_modal: false,
                add_modal: false,
                is_delete: false,
                path: window.location.pathname,
                current_motivation: {
                    title:'',
                },
                new_motivation: {
                    title:'',
                },
                types: {
                    'news': "Новость",
                    'motivation': "Мотивация",
                    'other': "Другое",
                },
                video_name: '',
                video_list: [],
                sort_field: 'day',
                sort_method: true,
            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];
            this.video_modal = this.$refs['video'];
            this.add_modal = this.$refs['add'];

            this.getList();
        },
        methods: {
            ShowAdd:function(){
                UIkit.modal(this.add_modal).show();
            },
            CreateNew:function(){
                console.log(this.new_motivation);
            },
            getDate:function(date){
                return date.substring(0, date.length - 9);
            },
            Checked: function () {
                if (this.current_motivation.title.length >= 70) {
                    event.preventDefault();
                    return false;
                }
            },
            CheckedNew: function () {
                if (this.new_motivation.title.length >= 70) {
                    event.preventDefault();
                    return false;
                }
            },
            setFieldSort: function (field) {
                if (field === this.sort_field) {
                    this.sort_method = !this.sort_method;
                } else {
                    this.sort_field = field;
                }

                this.getList();
            },
            findVideo: function () {
                if (this.video_name.length >= 2) {
                    this.$http.post('/admin/find/video', {video: this.video_name}).then(response => {
                        // if (response.data.length) {
                        this.video_list = response.data;
                        // }
                    });
                } else {
                    this.video_list = [];
                }
            },
            addVideo: function (item) {

                this.current_motivation.video_id = item.id;
                this.current_motivation.video = item.video;
                this.current_motivation.video_ = item;

                this.video_name = '';
                this.video_list = [];
            },
            addVideoNew: function (item) {

                this.new_motivation.video_id = item.id;
                this.new_motivation.video = item.video;
                this.new_motivation.video_ = item;

                this.video_name = '';
                this.video_list = [];
            },
            removeVideo: function (item) {
                this.current_motivation.video = 0;
                this.current_motivation.video_ = {};

            },
            removeVideoNew: function (item) {
                this.new_motivation.video = 0;
                this.new_motivation.video_ = {};

            },
            clone: function (item) {
                this.$http.post('/admin/motivation/clone', item).then(response => {
                    UIkit.notification({message: 'Мотивация успешно создана!', status: 'success'});
                    this.getList();
                });
            },
            Up:function(item){
                item.day--;
                this.current_motivation = item;
                this.Save();
            },
            Down:function(item){
                item.day++;
                this.current_motivation = item;
                this.Save();
            },
            Save: function () {
                this.$http.post('/admin/motivation/update', this.current_motivation).then(response => {
                    if (response.data.result) {
                        UIkit.modal(this.video_modal).hide();
                        this.getList();
                    }
                });
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
                this.current_motivation = item;
                UIkit.modal(this.video_modal).show();

            },
            onUpload: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                UIkit.notification({message: 'Подождите видео загружаются!', status: 'success', timeout: 10000});
                this.$http.post('/admin/video/upload/motivation',
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

            getList: function () {
                let pros = {
                    'sort_field': this.sort_field,
                    'sort_method': (this.sort_method ? 'asc' : 'desc'),
                };
                this.$http.post('/admin/motivation/get/' + this.current_page,pros).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.is_delete = response.data.delete;
                    this.load = true;
                });
            },
            Delete: function (item) {
                this.delete_item = item;
                UIkit.modal(this.delete_dialog).show();
            },
            Update: function (data) {
                this.list = data.list;
                this.page_list = data.page_list
            },
            deletePage: function (item) {
                this.$http.delete('/admin/motivation/delete/' + this.delete_item.id).then(response => {
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
