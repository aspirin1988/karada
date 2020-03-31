<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Урок</h2></div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-margin-large">
                        <div class="uk-margin">
                            <label for="section" class="uk-form-label">Раздел:*</label>
                            <div class="uk-form-controls">
                                <input type="text" id="section"
                                       class="uk-input uk-form-width-large"
                                       placehoТестlder="Название раздела" v-model="section_name" @keyup="findSection" autocomplete="off">
                                <ul class="uk-list uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                                    <li v-for="item in section_list">
                                        <a class="uk-button uk-button-primary uk-width-1-2">{{item.title}}</a>
                                        <button type="button" class="uk-button uk-button-success"
                                                @click="addSection(item)">
                                            <i uk-icon="plus"></i>
                                        </button>
                                    </li>
                                </ul>
                                <div v-if="list.section_" class="uk-margin-top uk-margin-bottom" id="section_list">
                                    <div class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                        {{list.section_.title}}
                                        <a uk-icon="close"
                                           class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                           @click="removeSection(list.section_)"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">thumb:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.thumb" class="uk-input uk-hidden" id="thumb_section"
                                       type="text"
                                       placeholder="Thumb"
                                       autocomplete="off">
                                <div class="uk-my-fle uk-cursor-pointer uk-first-column">
                                    <img @click="imageGet('thumb')"
                                         :src=" list.thumb_url || '/img/empty.png' " alt=""
                                         style="width: 90px; height: auto;">
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label for="tag" class="uk-form-label">Видео:</label>
                            <div class="uk-form-controls">
                                <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
                                    <input :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                                           type="file" multiple="multiple" @change="onUploadVideo">
                                    <span uk-icon="icon: cloud-upload"></span>
                                    <span class="uk-text-middle">Перетащите файлы сюда или</span>
                                    <div uk-form-custom>
                                        <span class="uk-link">загрузите вручную</span>
                                    </div>
                                </div>
                            </div>
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
                                <div class="uk-margin-top uk-margin-bottom" id="tag_list">
                                    <div v-for="item in list.videos"
                                         class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                        {{item.title}}
                                        <a uk-icon="close"
                                           class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                           @click="removeVideo(item)"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <div class="uk-margin-top uk-margin-bottom" id="doc_list">
                                    <div v-for="item in list.docs"
                                         class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                        {{item.name}}
                                        <a uk-icon="close"
                                           class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                           @click="removeDoc(item)"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Заголовок:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.title" class="uk-input uk-form-width-large" id="title" type="text"
                                       placeholder="Заголовок" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-margin uk-hidden">
                                <div class="uk-form-controls">
                                        <textarea class="uk-textarea uk-width-1-1@s uk-form-width-large"
                                                  id="form-h-textarea" rows="10" v-model="list.description"
                                                  placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <div class="uk-form-controls">
                                    <html-editor-component v-model="list.description" ></html-editor-component>
<!--                                    <codemirror v-model="list.description" :options="cmOptions"></codemirror>-->
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="status">Сменить статус:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-form-width-large" v-model="list.status" id="status">
                                    <option>Не назначен</option>
                                    <option value="0">Не опубликована</option>
                                    <option value="1">Опубликована</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label for="test" class="uk-form-label">Тест:*</label>
                            <div class="uk-form-controls">
                                <input type="text" id="test"
                                       class="uk-input uk-form-width-large"
                                       placeholder="Название теста" v-model="test_name" @keyup="findTest" autocomplete="off">
                                <ul class="uk-list uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-2">
                                    <li v-for="item in test_list">
                                        <a class="uk-button uk-button-primary uk-width-1-2">{{item.title}}</a>
                                        <button type="button" class="uk-button uk-button-success"
                                                @click="addTest(item)">
                                            <i uk-icon="plus"></i>
                                        </button>
                                    </li>
                                </ul>
                                <div v-if="list.test_" class="uk-margin-top uk-margin-bottom" id="test_list">
                                    <div class="uk-badge uk-margin-small-right uk-margin-small-bottom">
                                        {{list.test_.title}}
                                        <a uk-icon="close"
                                           class="uk-button-danger uk-border-rounded uk-margin-small-left"
                                           @click="removeTest(list.test_)"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <div class="uk-margin">-->
<!--                            <label class="uk-form-label" for="type">Тест:*</label>-->
<!--                            <div class="uk-form-controls">-->
<!--                                <select class="uk-select uk-width-1-2@m" v-model="list.test_id" id="type">-->
<!--                                    <option value="">Не назначен</option>-->
<!--                                    <option v-for="item in test_list" :value="item.id">{{item.title}}</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageSave(false)" class="uk-button uk-button-success" type="button">
                                Сохранить
                            </button>
                            <a :href="'/admin/lessons/'" class="uk-button uk-button-danger" type="button">Отмена</a>
                        </div>
                    </div>
                </header>
            </article>
        </div>
        <div id="modal-overflow" ref="modal-overflow" class="uk-modal-container uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Галерея</h2>
                    <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
                        <input :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                               type="file" multiple="multiple" @change="onUpload">
                        <span uk-icon="icon: cloud-upload"></span>
                        <span class="uk-text-middle">Перетащите файлы сюда или</span>
                        <div uk-form-custom>
                            <span class="uk-link">загрузите вручную</span>
                        </div>
                    </div>
                </div>

                <div class="uk-modal-body" uk-overflow-auto>
                    <div class="uk-child-width-1-4@m  uk-image-list" uk-grid="">
                        <div v-for="item in gallery_list">
                            <span class="uk-cursor-pointer" :class="{'uk-active':current_image == item}">
                                <img @click="SelectImage(item)" :src="item.image" alt="">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Закрыть</button>
                    <button class="uk-button uk-button-primary" @click="setImage()" type="button">Применить</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    // merge js
    import 'codemirror/mode/htmlmixed/htmlmixed.js'
    // merge css
    import 'codemirror/addon/merge/merge.css'
    // google DiffMatchPatch
    import DiffMatchPatch from 'diff-match-patch'
    // DiffMatchPatch config with global
    window.diff_match_patch = DiffMatchPatch;
    window.DIFF_DELETE = -1;
    window.DIFF_INSERT = 1;
    window.DIFF_EQUAL = 0;
    export default {
        props: ['id'],
        data() {
            return {
                list: {
                    description: '<p>&nbsp;</p>',
                    test_id: '',
                },
                template: '',
                template_content: '',
                cmOptions: {
                    value: '<p>hello</p>',
                    origLeft: null,
                    orig: '<p>hello world</p>',
                    connect: 'align',
                    mode: 'text/html',
                    lineNumbers: true,
                    collapseIdentical: false,
                    highlightDifferences: true
                },
                ArbitraryFields: [],
                sections_list: [],
                gallery_list: {},
                current_thumb: null,
                current_image: null,
                video_name: '',
                video_list: [],
                doc_name: '',
                doc_list: [],
                test_name: '',
                test_list: [],
                section_name: '',
                section_list: [],
            }
        },
        mounted() {
            this.$http.get('/admin/sections/list/').then(response => {
                this.sections_list = response.data;
            });
            // this.$http.get('/admin/test/list/').then(response => {
            //     this.test_list = response.data;
            // });
            axios.get('/admin/lesson/edit/get/' + this.id).then(response => {
                let data = response.data;
                this.list = data;
                this.list.description = data.description || '<p>&nbsp;</p>';

            });
            this.getArbitraryFields();
        },
        created() {
        },
        methods: {
            getName: function (name) {
                let arr = name.split('/');
                return arr[arr.length - 1];
            },
            setImage: function () {
                this.list[this.current_thumb] = this.current_image.id;
                this.list[this.current_thumb + '_url'] = this.current_image.image;
                UIkit.modal(this.$refs['modal-overflow']).hide();
                this.current_image = {};
                this.current_thumb = '';
            },
            SelectImage: function (item) {
                this.current_image = item;
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

                this.list.videos = this.list.videos || [];

                this.list.videos.push(item);

                console.log(this.list.videos);
                this.video_name = '';
                this.video_list = [];
            },
            removeVideo: function (item) {
                for (let i = 0; i < this.list.videos.length; i++) {
                    if (this.list.videos[i] === item) {
                        this.list.videos.splice(i, 1);
                    }
                }

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

                this.list.docs = this.list.docs || [];

                this.list.docs.push(item);

                this.doc_name = '';
                this.doc_list = [];
            },
            removeDoc: function (item) {
                for (let i = 0; i < this.list.docs.length; i++) {
                    if (this.list.docs[i] === item) {
                        this.list.docs.splice(i, 1);
                    }
                }

            },

            findTest: function () {
                if (this.test_name.length >= 2) {
                    this.$http.post('/admin/find/test', {test: this.test_name}).then(response => {
                        // if (response.data.length) {
                        this.test_list = response.data;
                        // }
                    });
                } else {
                    this.test_list = [];
                }
            },
            addTest: function (item) {

                this.list.test_id = item.id;
                this.list.test_ = item;

                this.test_name = '';
                this.test_list = [];
            },
            removeTest: function (item) {
                this.list.test_id = 0;
                this.list.test_ = {};
            },

            findSection: function () {
                if (this.section_name.length >= 2) {
                    this.$http.post('/admin/find/section', {section: this.section_name}).then(response => {
                        // if (response.data.length) {
                        this.section_list = response.data;
                        // }
                    });
                } else {
                    this.section_list = [];
                }
            },
            addSection: function (item) {

                this.list.section_id = item.id;
                this.list.section_ = item;

                this.section_name = '';
                this.section_list = [];
            },
            removeSection: function (item) {
                this.list.section_id = 0;
                this.list.section_ = {};
            },

            onUploadVideo: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                this.$http.post('/admin/video/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data) {
                        let item = response.data.video;
                        UIkit.notification({message: 'Видео успешно загружены!', status: 'success'});
                        this.list.videos.push(item);
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки видео произошла ошибка!', status: 'danger'});
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
                axios.post('/admin/image/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        UIkit.notification({message: 'Изображения успешно загружены!', status: 'success'});
                        this.getGalleryList();
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки изображений произошла ошибка!', status: 'danger'});
                    });

            },
            getGalleryList: function () {
                this.$http.get('/admin/image/get_media').then(response => {
                    let data = response.data;
                    this.gallery_list = data.images;
                });
            },
            imageGet: function (thumb) {
                this.current_thumb = thumb;
                this.getGalleryList();
                UIkit.modal(this.$refs['modal-overflow']).show();
            },
            addArbitraryFields: function () {
                this.ArbitraryFields.push({key: '', value: ''});
            },
            getArbitraryFields: function () {
                this.$http.get('/admin/get/arbitrary_fields/lesson/' + this.id).then(response => {
                    this.ArbitraryFields = response.data;
                })
            },
            saveArbitraryFields: function () {
                this.$http.post('/admin/save/arbitrary_fields/lesson/' + this.id, this.ArbitraryFields).then(response => {
                    UIkit.notification({message: 'Поля успешно сохранены!', status: 'success'});
                });
            },
            Lock: function () {
                this.$http.get('/admin/lesson/lock/' + this.id).then(response => {
                });
            },
            UnLock: function () {
                this.$http.get('/admin/lesson/unlock/' + this.id).then(response => {
                });
            },

            editPageTemplate: function (page) {
                this.template = page;
                this.$http.post('/admin/lesson/get_template/' + this.id, {'template': this.template}).then(response => {
                    UIkit.modal(this.$refs['modal-full']).show();
                    let data = response.data;
                    this.template_content = data.template;
                    console.log(data);
                });
            },

            pageSaveTemplate: function () {
                this.$http.post('/admin/lesson/save_template/' + this.id, {
                    'template': this.template,
                    'template_content': this.template_content
                }).then(response => {
                    UIkit.notification({message: 'Страница успешно сохранена!', status: 'success'});
                });
            },


            pageSave: function () {
                axios.post('/admin/lesson/save/' + this.id, this.list).then(response => {
                    UIkit.notification({message: 'Страница успешно сохранена!', status: 'success'});
                });
            },
        },
    }
</script>

<style>
    /*

    Name:       Base16 Default Light
    Author:     Chris Kempson (http://chriskempson.com)

    CodeMirror template by Jan T. Sott (https://github.com/idleberg/base16-codemirror)
    Original Base16 color scheme by Chris Kempson (https://github.com/chriskempson/base16)

*/

    .cm-s-base16-light.CodeMirror {
        background: #f5f5f5;
        color: #202020;
    }

    .cm-s-base16-light div.CodeMirror-selected {
        background: #e0e0e0;
    }

    .cm-s-base16-light .CodeMirror-line::selection, .cm-s-base16-light .CodeMirror-line > span::selection, .cm-s-base16-light .CodeMirror-line > span > span::selection {
        background: #e0e0e0;
    }

    .cm-s-base16-light .CodeMirror-line::-moz-selection, .cm-s-base16-light .CodeMirror-line > span::-moz-selection, .cm-s-base16-light .CodeMirror-line > span > span::-moz-selection {
        background: #e0e0e0;
    }

    .cm-s-base16-light .CodeMirror-gutters {
        background: #f5f5f5;
        border-right: 0px;
    }

    .cm-s-base16-light .CodeMirror-guttermarker {
        color: #ac4142;
    }

    .cm-s-base16-light .CodeMirror-guttermarker-subtle {
        color: #b0b0b0;
    }

    .cm-s-base16-light .CodeMirror-linenumber {
        color: #b0b0b0;
    }

    .cm-s-base16-light .CodeMirror-cursor {
        border-left: 1px solid #505050;
    }

    .cm-s-base16-light span.cm-comment {
        color: #8f5536;
    }

    .cm-s-base16-light span.cm-atom {
        color: #aa759f;
    }

    .cm-s-base16-light span.cm-number {
        color: #aa759f;
    }

    .cm-s-base16-light span.cm-property, .cm-s-base16-light span.cm-attribute {
        color: #90a959;
    }

    .cm-s-base16-light span.cm-keyword {
        color: #ac4142;
    }

    .cm-s-base16-light span.cm-string {
        color: #f4bf75;
    }

    .cm-s-base16-light span.cm-variable {
        color: #90a959;
    }

    .cm-s-base16-light span.cm-variable-2 {
        color: #6a9fb5;
    }

    .cm-s-base16-light span.cm-def {
        color: #d28445;
    }

    .cm-s-base16-light span.cm-bracket {
        color: #202020;
    }

    .cm-s-base16-light span.cm-tag {
        color: #ac4142;
    }

    .cm-s-base16-light span.cm-link {
        color: #aa759f;
    }

    .cm-s-base16-light span.cm-error {
        background: #ac4142;
        color: #505050;
    }

    .cm-s-base16-light .CodeMirror-activeline-background {
        background: #DDDCDC;
    }

    .cm-s-base16-light .CodeMirror-matchingbracket {
        color: #f5f5f5 !important;
        background-color: #6A9FB5 !important
    }

</style>
