<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Страницы</h2></div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Thumb:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.thumb" class="uk-input uk-form-width-large" id="thumb" type="text" placeholder="Thumb"
                                       autocomplete="off">
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
                            <label class="uk-form-label" for="keyword">Ключевое слово:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.slug" class="uk-input uk-form-width-large" id="keyword" disabled="disabled" type="text"
                                       placeholder="Ключевое слово" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary uk-button-small"
                                    @click="editPageTemplate('header')"><span
                                    class="uk-icon" uk-icon="icon:file-edit;"></span>Шаблон заголовка
                            </button>
                            <button class="uk-button uk-button-primary uk-button-small"
                                    @click="editPageTemplate('index')"><span
                                    class="uk-icon" uk-icon="icon:file-edit;"></span>Шаблон контента
                            </button>
                            <button class="uk-button uk-button-primary uk-button-small"
                                    @click="editPageTemplate('footer')"><span
                                    class="uk-icon" uk-icon="icon:file-edit;"></span>Шаблон подвала
                            </button>
                            <button class="uk-button uk-button-primary uk-button-small"
                                    @click="editPageTemplate('css')"><span
                                    class="uk-icon" uk-icon="icon:file-edit;"></span>Стили
                            </button>
                            <button class="uk-button uk-button-primary uk-button-small"
                                    @click="editPageTemplate('script')"><span
                                    class="uk-icon" uk-icon="icon:file-edit;"></span>Скрипты
                            </button>
                            <button class="uk-button uk-button-primary uk-button-small"
                                    @click="editPageTemplate('layout')"><span
                                    class="uk-icon" uk-icon="icon:file-edit;"></span>Шаблон
                            </button>
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
                            <ul uk-accordion>
                                <li class="uk-open">
                                    <a class="uk-accordion-title" href="#">Произвольные поля</a>
                                    <div class="uk-accordion-content">
                                        <table class="uk-table uk-table-striped">
                                            <thead>
                                            <tr>
                                                <th>Алиас</th>
                                                <th>Значение</th>
                                                <th>
                                                    <button class="uk-button uk-button-success uk-button-small"
                                                            @click="addArbitraryFields()">
                                                        Добавить
                                                    </button>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="item in ArbitraryFields">
                                                <td><input class="uk-input uk-form-width-large" v-model="item.key"
                                                           type="text"></td>
                                                <td><input class="uk-input uk-form-width-large" v-model="item.value"
                                                           type="text"></td>
                                                <td>
                                                    <button class="uk-button uk-button-success uk-button-small"
                                                            @click="saveArbitraryFields()">
                                                        Сохранить
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageSave(false)" class="uk-button uk-button-success" type="button">
                                Сохранить
                            </button>
                            <a :href="'/admin/page/'" class="uk-button uk-button-danger" type="button">Отмена</a>
                        </div>
                    </div>
                    <div id="modal-full" ref="modal-full" class="uk-modal-container uk-modal-full uk-height-viewport uk-flex-top"
                         uk-modal>
                        <div class="uk-modal-dialog uk-height-viewport uk-margin-auto-vertical">
                            <button class="uk-modal-close-default" type="button" uk-close></button>
                            <div class="uk-modal-header">
                                <h2 class="uk-modal-title">Редактирование {{template}}</h2>
                            </div>
                            <div class="uk-modal-body">
                                <div class="uk-margin uk-hidden">
                                    <div class="uk-form-controls">
                                        <textarea class="uk-textarea uk-width-1-1@s uk-form-width-large"
                                                  id="form-h-textarea" rows="10" v-model="template_content"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <div class="uk-form-controls">
                                        <html-editor-component v-model="template_content" ></html-editor-component>
<!--                                        <codemirror v-model="template_content" :options="cmOptions"></codemirror>-->
                                    </div>
                                </div>
                            </div>
                            <div class="uk-modal-footer">
                                <p class="uk-text-right">
                                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel
                                    </button>
                                    <button class="uk-button uk-button-primary" @click="pageSaveTemplate()"
                                            type="button">Save
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </header>
            </article>
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
                list: {},
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
            }
        },
        mounted() {
            axios.get('/admin/page/edit/get/' + this.id).then(response => {
                this.list = response.data;
            });
            this.getArbitraryFields();
        },
        created() {
        },
        methods: {
            addArbitraryFields: function () {
                this.ArbitraryFields.push({key: '', value: ''});
            },
            getArbitraryFields: function () {
                this.$http.get('/admin/get/arbitrary_fields/page/' + this.id).then(response => {
                    this.ArbitraryFields = response.data;
                })
            },
            saveArbitraryFields: function () {
                this.$http.post('/admin/save/arbitrary_fields/page/' + this.id, this.ArbitraryFields).then(response => {
                    UIkit.notification({message: 'Поля успешно сохранены!', status: 'success'});
                });
            },
            Lock: function () {
                this.$http.get('/admin/page/lock/' + this.id).then(response => {
                });
            },
            UnLock: function () {
                this.$http.get('/admin/page/unlock/' + this.id).then(response => {
                });
            },

            editPageTemplate: function (page) {
                this.template = page;
                this.$http.post('/admin/page/get_template/' + this.id, {'template': this.template}).then(response => {
                    UIkit.modal(this.$refs['modal-full']).show();
                    let data = response.data;
                    this.template_content = data.template;
                    console.log(data);
                });
            },

            pageSaveTemplate: function () {
                this.$http.post('/admin/page/save_template/' + this.id, {
                    'template': this.template,
                    'template_content': this.template_content
                }).then(response => {
                    UIkit.notification({message: 'Страница успешно сохранена!', status: 'success'});
                });
            },


            pageSave: function () {
                axios.post('/admin/page/save/' + this.id, this.list).then(response => {
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
