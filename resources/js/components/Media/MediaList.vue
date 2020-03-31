<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Коллекция вижуалов</h2>
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
        </header>
        <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
            <input :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                   type="file" multiple="multiple" @change="onUpload">
            <span uk-icon="icon: cloud-upload"></span>
            <span class="uk-text-middle">Перетащите файлы сюда или</span>
            <div uk-form-custom>
                <span class="uk-link">загрузите вручную</span>
            </div>
        </div>
        <div class="uk-margin-top">
            <div v-if="list.length" class="content-section">
                <div class="content-section-header">
                    <label>Сортировка:</label>
                    <label @click="setFieldSort('created_at')" :class="{'uk-active':sort_field ==='created_at'}"
                           class="sort-field">Дата
                        <i uk-icon="triangle-down" v-if="sort_method"></i>
                        <i uk-icon="triangle-up" v-if="!sort_method"></i>
                    </label>
                    <label @click="setFieldSort('image')" :class="{'uk-active':sort_field ==='image'}"
                           class="sort-field">имя
                        <i uk-icon="triangle-down" v-if="sort_method"></i>
                        <i uk-icon="triangle-up" v-if="!sort_method"></i>
                    </label>
                </div>
                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/media/'+current_dir+'/'"></widget-paginator-component>
                <div class="content-section-grid">
                    <div class="content-section-grid-item" v-for="item in list">
                        <img class="thumbnail" :src="item.image">
                        <div class="text-section">
                            <div class="title">{{item.alt}}</div>
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
                                            :path="'/admin/media/'+current_dir+'/'"></widget-paginator-component>
            </div>
            <div v-else="" class="uk-margin-top">
                <widget-preloader-component :load="load"></widget-preloader-component>
            </div>
        </div>
        <div id="video" class="uk-flex-top" ref="video" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Заголовок:*</label>
                    <div class="uk-form-controls">
                        <input v-model="current_video.alt" class="uk-input uk-form-width-large" id="title" type="text"
                               placeholder="alt" autocomplete="off">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Url:*</label>
                    <div class="uk-form-controls">
                        <input v-model="current_video.image" class="uk-input uk-form-width-large" id="image" type="text"
                               placeholder="url" autocomplete="off">
                    </div>
                </div>
                <div>
                    <img :src="current_video.image" alt="">
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-primary" @click="SaveVideo()" type="button">Сохранить</button>
                    <button class="uk-button uk-button-danger uk-modal-close" type="button">Закрыть</button>
                </p>
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
    </div>
</template>

<script>
    import MediaListItem from "./MediaListItem";

    export default {
        components: {MediaListItem},
        props: ['current_dir', 'current_page', 'user_type'],
        data() {
            return {
                list: [],
                page_list: null,
                load: false,
                delete_item: {},
                delete_dialog: false,
                is_delete: false,
                path: window.location.pathname,
                current_video: {},
                video_modal: false,
                dir_list: [],
                // current_dir: 'image',
                show_add_dir: false,
                dir_name: '',
                sort_field: 'created_at',
                sort_method: true,


            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];

            this.getList();
            this.getDirectories();
            this.video_modal = this.$refs['video'];

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
                this.$http.post('/admin/image/add_dir', {'dir_name': this.dir_name}).then(response => {
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
                this.$http.get('/admin/media/get/directories').then(response => {
                    this.dir_list = response.data;
                })
            },
            SaveVideo: function () {
                this.$http.post('/admin/media/update/' + this.current_video.id, this.current_video).then(response => {
                    if (response.data.result) {
                        UIkit.modal(this.video_modal).hide();
                        this.getList();
                    }
                });
            },
            showVideo: function (item) {
                this.current_video = item;
                UIkit.modal(this.video_modal).show();

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
                };
                this.$http.post('/admin/media/get_list/' + this.current_dir + '/' + this.current_page, pros).then(response => {
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
            deleteImage: function (id) {
                this.$http.delete('/admin/media/image/delete/' + id).then(response => {
                    UIkit.notification({message: 'Медиа фаил успешно удален из коллекции!', status: 'success'});
                    this.getList();
                });
            },

            Update: function (data) {
                this.list = data.list;
                this.page_list = data.page_list
            },
            deletePage: function () {
                this.$http.delete('/admin/media/image/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            },
            onUpload: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                formData.append('dir', this.current_dir);

                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                UIkit.notification({message: 'Подождите изображения загружаются!', status: 'success', timeout: 10000});
                axios.post('/admin/media/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        UIkit.notification({message: 'Изображения успешно загружены!', status: 'success'});
                        this.getList();
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки изображений произошла ошибка!', status: 'danger'});
                    });

            },
        },
    }
</script>
