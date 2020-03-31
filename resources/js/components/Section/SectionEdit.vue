<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Раздел</h2></div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="type">Курс:*</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-form-width-large" v-model="list.course_id" id="type">
                                    <option value="" >Не назначен</option>
                                    <option v-for="item in courses_list" :value="item.id">{{item.title}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="type">Родительский раздел:*</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-form-width-large" v-model="list.parent_id" id="type">
                                    <option :value="0" >Не назначен</option>
                                    <option v-for="item in sections_list" v-if="item.id != id" :value="item.id">{{item.title}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Баннер:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.thumb" class="uk-input uk-hidden uk-form-width-large" id="thumb_section"
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
                            <label class="uk-form-label" for="title">В шапку:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.thumb_category" class="uk-input uk-hidden" id="thumb_category"
                                       type="text"
                                       placeholder="Thumb"
                                       autocomplete="off">
                                <div class="uk-my-fle uk-cursor-pointer uk-first-column">
                                    <img @click="imageGet('thumb_category')"
                                         :src=" list.thumb_category_url || '/img/empty.png' " alt=""
                                         style="width: 90px; height: auto;">
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
                            <label class="uk-form-label" for="title">Сертификат:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.certificats" class="uk-input uk-hidden uk-form-width-large" id="thumb_section"
                                       type="text"
                                       placeholder="Thumb"
                                       autocomplete="off">
                                <label style="position: relative" for="up_c" class="uk-my-fle uk-cursor-pointer uk-first-column">
                                    <img :src="list.certificats || '/img/empty.png' " alt=""
                                         style="width: 90px; height: auto;">
                                    <input id="up_c" :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                                           type="file" multiple="multiple" @change="onUploadC">
                                </label>
                            </div>
                        </div>
                        <div class="uk-margin" v-if="list.sections && list.sections.length">
<!--                            <button class="uk-button uk-button-small uk-button-primary"><i uk-icon="plus" ></i></button>-->
                            <div class="uk-form-controls">
                                <table class="uk-table">
                                    <caption>Подразделы курса</caption>
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in list.sections">
                                        <td>{{item.id}}</td>
                                        <td>{{item.title}}</td>
                                        <td>
                                            <a class="uk-button uk-button-default uk-background-muted uk-button-secondary"
                                               :href="'/admin/section/edit/'+item.id">
                                                <span class="uk-text-success" uk-icon="file-edit"></span>
                                            </a>
                                            <button class="uk-button uk-button-default"><span uk-icon="trash"></span></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="uk-margin" v-if="list.lessons && list.lessons.length">
<!--                            <button class="uk-button uk-button-small uk-button-primary"><i uk-icon="plus" ></i></button>-->
                            <div class="uk-form-controls">
                                <table class="uk-table">
                                    <caption>Уроки</caption>
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in list.lessons">
                                        <td>{{item.id}}</td>
                                        <td>{{item.title}}</td>
                                        <td>
                                            <a class="uk-button uk-button-default uk-background-muted uk-button-secondary"
                                               :href="'/admin/lesson/edit/'+item.id">
                                                <span class="uk-text-success" uk-icon="file-edit"></span>
                                            </a>
                                            <button class="uk-button uk-button-default" @click="DeleteLesson(item)" ><span uk-icon="trash"></span></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageSave(false)" class="uk-button uk-button-success" type="button">
                                Сохранить
                            </button>
                            <a :href="'/admin/sections/'" class="uk-button uk-button-danger" type="button">Отмена</a>
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
                    parent_id: null,
                    sections: [],
                    lessons: [],
                },
                dir_list: [],
                current_dir: 'image',
                show_add_dir: false,
                dir_name: '',
                sort_field: 'created_at',
                sort_method: true,
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
                courses_list:[],
                sections_list:[],
                gallery_list: {},
                current_thumb: null,
                current_image: null,
                delete_lesson: null,
            }
        },
        mounted() {
            this.$http.get('/admin/sections/list/').then(response =>{
                this.sections_list = response.data;
            });
            this.$http.get('/admin/courses/list/').then(response =>{
                this.courses_list = response.data;
            });
            this.getList();
            this.getArbitraryFields();
            this.getDirectories();
        },
        created() {
        },
        methods: {
            DeleteLesson: function (item) {
                this.delete_lesson = item;
                this.$http.delete('/admin/lesson/delete/' + this.delete_lesson.id).then(response => {
                    this.getList();
                });
            },
            getList:function(){
                this.$http.get('/admin/section/edit/get/' + this.id).then(response => {
                    let data = response.data;
                    this.list = data;
                    this.list.description = data.description || '<p>&nbsp;</p>';

                });
            },
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
                this.getGalleryList();
            },
            getDirectories: function () {
                this.$http.get('/admin/media/get/directories').then(response => {
                    this.dir_list = response.data;
                })
            },
            getName: function (name) {
                let arr = name.split('/');
                return arr[arr.length - 1];
            },
            setImage: function () {
                this.list[this.current_thumb] = this.current_image.id;
                this.list[this.current_thumb+'_url'] = this.current_image.image;
                UIkit.modal(this.$refs['modal-overflow']).hide();
                this.current_image = {};
                this.current_thumb = '';
            },
            SelectImage: function (item) {
                this.current_image = item;
            },
            onUploadC: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                formData.append('dir', this.current_dir);

                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
                UIkit.notification({message: 'Подождите сертификат загружаются!', status: 'success', timeout: 10000});
                axios.post('/admin/image/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    let data = response.data;
                    if (data.result) {
                        UIkit.notification({message: 'Сертификат успешно загружен!', status: 'success'});
                        this.list.certificats = data.media.image;
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки сертификата произошла ошибка!', status: 'danger'});
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
                let pros = {
                    'sort_field': this.sort_field,
                    'sort_method': (this.sort_method ? 'asc' : 'desc'),
                };
                this.$http.post('/admin/media/get_list/'+this.current_dir+'/all',pros).then(response => {
                    let data = response.data;
                    this.gallery_list = data.list;
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
                this.$http.get('/admin/get/arbitrary_fields/section/' + this.id).then(response => {
                    this.ArbitraryFields = response.data;
                })
            },
            saveArbitraryFields: function () {
                this.$http.post('/admin/save/arbitrary_fields/section/' + this.id, this.ArbitraryFields).then(response => {
                    UIkit.notification({message: 'Поля успешно сохранены!', status: 'success'});
                });
            },
            Lock: function () {
                this.$http.get('/admin/section/lock/' + this.id).then(response => {
                });
            },
            UnLock: function () {
                this.$http.get('/admin/section/unlock/' + this.id).then(response => {
                });
            },

            editPageTemplate: function (page) {
                this.template = page;
                this.$http.post('/admin/section/get_template/' + this.id, {'template': this.template}).then(response => {
                    UIkit.modal(this.$refs['modal-full']).show();
                    let data = response.data;
                    this.template_content = data.template;
                    console.log(data);
                });
            },

            pageSaveTemplate: function () {
                this.$http.post('/admin/section/save_template/' + this.id, {
                    'template': this.template,
                    'template_content': this.template_content
                }).then(response => {
                    UIkit.notification({message: 'Страница успешно сохранена!', status: 'success'});
                });
            },


            pageSave: function () {
                axios.post('/admin/section/save/' + this.id, this.list).then(response => {
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
