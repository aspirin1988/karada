<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Новости
                    <button class="uk-button uk-button-primary uk-button-small uk-border-rounded" @click="AddNewNews"
                            type="button" uk-icon="plus">

                    </button>
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
                <div class="content-section-grid">
                    <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page" :path="'/admin/news/'"></widget-paginator-component>
                    <div class="content-section-grid-item" v-for="item in list">
                        <img class="thumbnail" :src="item.thumb">
                        <div class="text-section">
                            <div class="title">{{item.title}}</div>
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
                            <button class="uk-button uk-button-default uk-button-small" v-if="is_delete"
                                    @click="Delete(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </div>
                    </div>
                    <widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page" :path="'/admin/news/'"></widget-paginator-component>
                </div>
            </div>

            <!--            <div v-if="list.length">-->
<!--                            <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page" :path="'/admin/page/'"></widget-paginator-component>-->
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
        <div id="video" class="uk-flex-top" ref="video" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Заголовок:*</label>
                    <div class="uk-form-controls" style="position: relative;">
                        <textarea v-model="current_news.title" class="uk-textarea" rows="5" id="title" type="text"
                                  placeholder="Заголовок" autocomplete="off" @keyup="Checked">
                        </textarea>
                    </div>
                    <label>{{current_news.title.length}}/70</label>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Тип материала:*</label>
                    <div class="uk-form-controls">
                        <select v-model="current_news.type" class="uk-select uk-form-width-large" id="type"
                                placeholder="Название материала" autocomplete="off">
                            <option value="video">Video</option>
                            <option value="doc">Документ</option>
                        </select>
                    </div>
                </div>
                <div v-if="current_news.type==='video'">
                    <div class="uk-margin">
                        <label for="tag" class="uk-form-label">Видео:</label>
                        <div class="uk-form-controls">

                            <input type="text" id="tag"
                                   class="uk-input uk-form-width-large"
                                   placeholder="Название видео" v-model="video_name" @keyup="findVideo"
                                   autocomplete="off">
                            <ul class="uk-list uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                                <li v-for="item in video_list">
                                    <a class="uk-button uk-button-primary uk-width-1-2">{{item.title}}</a>
                                    <button type="button" class="uk-button uk-button-success"
                                            @click="addVideo(item)">
                                        <i uk-icon="plus"></i>
                                    </button>
                                </li>
                            </ul>
                            <div class="uk-margin-top uk-margin-bottom" id="tag_list">
                                <div v-if="current_news.video_id"
                                     class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                    {{current_news.video_title}}
                                    <a uk-icon="close"
                                       class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                       @click="removeVideo(current_news.video)"></a>
                                </div>
                            </div>
                            <div>
                                <video controls="controls" @click="PlayPause($event)" :src="current_news.video"></video>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="current_news.type==='doc'">
                    <div class="uk-margin">
                        <label for="tag" class="uk-form-label">Документы:</label>
                        <div class="uk-form-controls">
                            <input type="text" id="doc"
                                   class="uk-input uk-form-width-large"
                                   placeholder="Имя документа" v-model="doc_name" @keyup="findDoc" autocomplete="off">
                            <ul class="uk-list uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                                <li v-for="item in doc_list">
                                    <a class="uk-button uk-button-primary uk-width-1-2">{{item.name}}</a>
                                    <button type="button" class="uk-button uk-button-success"
                                            @click="addDoc(item)">
                                        <i uk-icon="plus"></i>
                                    </button>
                                </li>
                            </ul>
                            <div class="uk-margin-top uk-margin-bottom" id="tag_list">
                                <div v-if="current_news.doc_id"
                                     class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                    {{current_news.doc_title}}
                                    <a uk-icon="close"
                                       class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                       @click="removeDoc(current_news.video)"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-primary" @click="Save()" type="button">Сохранить</button>
                    <button class="uk-button uk-button-danger uk-modal-close" type="button">Закрыть</button>
                </p>
            </div>
        </div>
        <div id="video_new" class="uk-flex-top" ref="video_new" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Заголовок:*</label>
                    <div class="uk-form-controls" style="position: relative;">
                        <textarea v-model="new_news.title" class="uk-textarea" rows="5" id="title" type="text"
                                  placeholder="Заголовок" autocomplete="off" @keyup="CheckedNew">
                        </textarea>
                    </div>
                    <label>{{new_news.title.length}}/70</label>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="title">Тип материала:*</label>
                    <div class="uk-form-controls">
                        <select v-model="new_news.type" class="uk-select uk-form-width-large" id="type"
                                placeholder="Название материала" autocomplete="off">
                            <option value="video">Video</option>
                            <option value="doc">Документ</option>
                        </select>
                    </div>
                </div>
                <div v-if="new_news.type==='video'">
                    <div class="uk-margin">
                        <label for="tag" class="uk-form-label">Видео:</label>
                        <div class="uk-form-controls">

                            <input type="text" id="tag"
                                   class="uk-input uk-form-width-large"
                                   placeholder="Название видео" v-model="video_name" @keyup="findVideo"
                                   autocomplete="off">
                            <ul class="uk-list uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                                <li v-for="item in video_list">
                                    <a class="uk-button uk-button-primary uk-width-1-2">{{item.title}}</a>
                                    <button type="button" class="uk-button uk-button-success"
                                            @click="addVideoNew(item)">
                                        <i uk-icon="plus"></i>
                                    </button>
                                </li>
                            </ul>
                            <div class="uk-margin-top uk-margin-bottom" id="tag_list">
                                <div v-if="new_news.video_id"
                                     class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                    {{new_news.video_title}}
                                    <a uk-icon="close"
                                       class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                       @click="removeVideoNew(new_news.video)"></a>
                                </div>
                            </div>
                            <div>
                                <video controls="controls" @click="PlayPause($event)" :src="new_news.video"></video>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="new_news.type==='doc'">
                    <div class="uk-margin">
                        <label for="tag" class="uk-form-label">Документы:</label>
                        <div class="uk-form-controls">
                            <input type="text" id="doc"
                                   class="uk-input uk-form-width-large"
                                   placeholder="Имя документа" v-model="doc_name" @keyup="findDoc" autocomplete="off">
                            <ul class="uk-list uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                                <li v-for="item in doc_list">
                                    <a class="uk-button uk-button-primary uk-width-1-2">{{item.name}}</a>
                                    <button type="button" class="uk-button uk-button-success"
                                            @click="addDocNew(item)">
                                        <i uk-icon="plus"></i>
                                    </button>
                                </li>
                            </ul>
                            <div class="uk-margin-top uk-margin-bottom" id="doc_list">
                                <div v-for="item in list.docs"
                                     class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                    {{item.name}}
                                    <a uk-icon="close"
                                       class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                       @click="removeDocNew(item)"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-primary" @click="CreateVideo()" type="button">Сохранить</button>
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
                video_new_modal: false,
                path: window.location.pathname,
                current_news: {
                    title: '',
                    description: '',
                    type: '',
                    video_title: '',
                },
                new_news: {
                    title: '',
                    description: '',
                    type: '',
                    video_title: '',
                },
                video_name: '',
                doc_name: '',
                video_list: [],
                doc_list: [],
                types: {
                    'news': "Новость",
                    'motivation': "Мотивация",
                    'other': "Другое",
                },
                sort_field: 'created_at',
                sort_method: true,
            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];
            this.video_modal = this.$refs['video'];
            this.video_new_modal = this.$refs['video_new'];

            this.getList();
        },
        methods: {
            getDate:function(date){
                return date.substring(0, date.length - 9);
            },
            CreateVideo: function () {
                this.$http.post('/admin/news/create', this.new_news).then(
                    response => {
                        UIkit.modal(this.video_new_modal).hide();
                        this.new_news = {
                            title: '',
                            description: '',
                            type: '',
                            video_title: '',
                        };
                        this.getList();
                    }
                )
            },
            AddNewNews: function () {
                UIkit.modal(this.video_new_modal).show();
            },
            CheckedNew: function () {
                if (this.new_news.title.length >= 70) {
                    this.new_news.title = this.new_news.title.substr(0, 70);
                    event.preventDefault();
                    return false;
                }
            },
            Checked: function () {
                if (this.current_news.title.length >= 70) {
                    this.current_news.title = this.current_news.title.substr(0, 70);
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
                this.current_news.video_id = item.id;
                this.current_news.video_title = item.title;
                this.current_news.video = item.video;
                this.video_name = '';
                this.video_list = [];
            },
            addVideoNew: function (item) {
                console.log(this.new_news, item);
                this.new_news.video_id = item.id;
                this.new_news.video_title = item.title;
                this.new_news.video = item.video;
                this.video_name = '';
                this.video_list = [];
            },
            removeVideo: function () {
                this.current_news.video_id = 0;
                this.current_news.video = {};
            },
            removeVideoNew: function () {
                this.new_news.video_id = 0;
                this.new_news.video = {};
            },
            findDoc: function () {
                if (this.doc_name.length >= 2) {
                    this.$http.post('/admin/find/doc', {video: this.doc_name}).then(response => {
                        // if (response.data.length) {
                        this.doc_list = response.data;
                        // }
                    });
                } else {
                    this.doc_list = [];
                }
            },
            addDoc: function (item) {

                this.current_news.doc_id = item.id;
                this.current_news.doc_title = item.name;

                this.doc_name = '';
                this.doc_list = [];
            },
            removeDoc: function () {
                this.current_news.doc_id = 0;
            },
            addDocNew: function (item) {

                this.new_news.doc_id = item.id;

                this.doc_name = '';
                this.doc_list = [];
            },
            removeDocNew: function () {
                this.new_news.doc_id = 0;
            },
            Save: function () {
                this.$http.post('/admin/news/update', this.current_news).then(response => {
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
                this.current_news = item;
                UIkit.modal(this.video_modal).show();

            },
            onUpload: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                UIkit.notification({message: 'Подождите видео загружаются!', status: 'success', timeout: 10000});
                this.$http.post('/admin/video/upload/news',
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
                this.$http.post('/admin/news/get/' + this.method + '/' + this.current_page, pros).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.is_delete = response.data.delete;
                    this.load = true;
                });
            },
            Delete: function (item) {
                this.delete_item = item;
                this.deletePage();
            },
            Update: function (data) {
                this.list = data.list;
                this.page_list = data.page_list
            },
            deletePage: function (item) {
                this.$http.delete('/admin/news/delete/' + this.delete_item.id).then(response => {
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
