<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Настройки сайта</h2>
            </div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class=" uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="price">Заголовок для Видео "МОИ ЛИЧНЫЕ ЦЕЛИ"</label>
                            <div class="uk-form-controls">
                                <input v-model="list.video_title" class="uk-input uk-form-width-large" id="video_title" type="text"
                                       placeholder="Заголовок для Видео" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label for="tag" class="uk-form-label">Видео для "МОИ ЛИЧНЫЕ ЦЕЛИ":</label>
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
                                <div class="uk-margin-top uk-margin-bottom" id="tag_list" v-if="list.video">
                                    <div class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                        {{list.video.title}}
                                        <a uk-icon="close"
                                           class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                           @click="removeVideo(item)"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageSave" class="uk-button uk-button-success" type="button">Сохранить
                            </button>
                        </div>
                    </div>
                </header>
            </article>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                list: {},
                video_list:[],
                video_name:'',
            }
        },
        mounted() {
            this.getList();
        },
        methods: {
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
                this.list.video = item;
                this.video_list = [];
                this.video_name = '';
            },
            removeVideo: function (item) {
                this.list.video = {};
            },

            getList: function () {
                this.$http.get('/admin/config/get').then(response => {
                    this.list = response.data;
                });
            },
            pageSave: function () {
                this.$http.post('/admin/config/save',this.list).then(response => {
                    UIkit.notification({message: 'Данные успешно сохранены!', status: 'success'});

                    this.list = response.data;
                });
            }
        },
    }
</script>
