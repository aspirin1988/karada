<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Бонусный материал</h2></div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class=" uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Название материала:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.title" class="uk-input uk-form-width-large" id="title" type="text"
                                       placeholder="Название материала" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Тип материала:*</label>
                            <div class="uk-form-controls">
                                <select v-model="list.type" class="uk-select uk-form-width-large" id="type" placeholder="Название материала" autocomplete="off">
                                    <option value="video">Video</option>
                                    <option value="doc">Документ</option>
                                </select>
                            </div>
                        </div>
                        <div v-if="list.type==='video'">
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
                                        <div v-if="list.video_id"
                                             class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                            {{list.video_title}}
                                            <a uk-icon="close"
                                               class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                               @click="removeVideo(list.video)"></a>
                                        </div>
                                    </div>
                                    <div v-if="list && list.video" >
                                        <video controls="controls" @click="PlayPause($event)" :src="list.video.video"></video>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="list.type==='doc'">
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
                                        <div v-if="list.doc_id"
                                             class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                            {{list.doc_title}}
                                            <a uk-icon="close"
                                               class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                               @click="removeDoc(list.video)"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageAdd" class="uk-button uk-button-success" type="button">Создать</button>
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
                list: {
                    title: '',
                    type:'video',
                },
                video_name: '',
                doc_name: '',
                video_list: [],
                doc_list: [],
                rules: {
                    title: 'required',
                }
            }
        },
        mounted() {
        },
        methods: {
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
                this.list.video_id = item.id;
                this.list.video_title = item.title;
                this.video_name = '';
                this.video_list = [];
            },
            removeVideo: function () {
                this.list.video_id = 0;
                this.list.video = {};
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

                this.list.doc_id = item.id;
                this.list.doc_title = item.name;

                this.doc_name = '';
                this.doc_list = [];
            },
            removeDoc: function () {
                this.list.doc_id = 0;
            },
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {

                    this.$http.put('/admin/course_bonus/add', this.list).then(response => {
                        let item = response.data;
                        if (item.id) {
                            UIkit.notification({message: 'Материал успешно создан!', status: 'success'});
                            setTimeout(() => {
                                location.href = '/admin/course_bonus';
                            }, 500);
                        }
                    });
                }
            },
        },
    }
</script>
