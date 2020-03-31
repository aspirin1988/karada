<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Помощь</h2>
            </div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class=" uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Название:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.title" class="uk-input uk-form-width-large" id="title" type="text"
                                       placeholder="Название материала" autocomplete="off">
                            </div>
                        </div>
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
                                    <div v-if="list.video_"
                                         class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                        {{list.video_.title}}
                                        <a uk-icon="close"
                                           class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                           @click="removeVideo(list.video_)"></a>
                                    </div>
                                </div>
                                <div v-if="list.video_">
                                    <video controls="controls" @click="PlayPause($event)" :src="list.video_.video"></video>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Описание:*</label>
                            <div class="uk-form-controls">
                                <html-editor-component v-model="list.description"></html-editor-component>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageSave" class="uk-button uk-button-success" type="button">Сохранить</button>
                        </div>
                    </div>
                </header>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                list: {},
                template: '',
                template_content: '',
                video_name: '',
                video_list: [],
            }
        },
        mounted() {

        },
        created() {
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
                this.list.video = item.id;
                this.list.video_ = item;
                this.video_name = '';
                this.video_list = [];
            },
            removeVideo: function () {
                this.list.video = 0;
                this.list.video = {};
            },
            sortedAttaches(array) {
                return array.sort((a, b) => a.sort > b.sort);
            },
            getList: function () {
                this.$http.get('/admin/help/get/edit/' + this.id).then(response => {
                    this.list = response.data;
                });
            },
            pageSave: function () {
                this.$http.post('/admin/help/update', this.list).then(response => {
                    UIkit.notification({message: 'Материал успешно сохранен!', status: 'success'});
                });
            },
        },
    }
</script>
