<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Уроки
                    <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small uk-border-rounded" type="button"
                                uk-icon="plus"></button>
                        <div uk-dropdown>
                            <ul class="uk-nav uk-nav-default">
                                <li class="">
                                    <a href="/admin/lesson/add" title="Урок">
                                        <i uk-icon="template"></i><span>Урок</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </h2>
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
                                            :path="'/admin/lessons/'"></widget-paginator-component>
                <div class="content-section-grid">
                    <div class="content-section-grid-item" v-for="item in list">
                        <img class="thumbnail" :src="item.image">
                        <div class="text-section">
                            <div class="title">{{item.title}}</div>
                            <ul class="uk-comment-meta uk-flex">
                                <li class="uk-margin-right">ID: <strong>{{item.id}}</strong></li>
                                <li class="uk-margin-right">Отредактировано: <strong>{{getDate(item.updated_at)}}</strong></li>
                                <li class="uk-margin-right">Дата создания: <strong>{{getDate(item.created_at)}}</strong></li>
                            </ul>
                        </div>
                        <div class="buttons-section">
                            <a :href="'/admin/lesson/edit/'+item.id"
                               class="uk-button uk-button-default uk-background-muted uk-button-small">
                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                            </a>
                            <button class="uk-button uk-button-default uk-button-small" v-if="is_delete"
                                    @click="Delete(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/lessons/'"></widget-paginator-component>
            </div>

            <!--            <div v-if="list.length">-->
            <!--                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"-->
            <!--                                            :path="'/admin/lesson/'"></widget-paginator-component>-->
            <!--                <ul class="uk-comment-list">-->
            <!--                    <li v-for="item in list">-->
            <!--                        <article class="uk-comment uk-textarea uk-position-relative">-->
            <!--                            <header class="uk-comment-header uk-question-grid">-->
            <!--                                <div>-->
            <!--                                    <h4 class="uk-comment-title uk-margin-remove">-->
            <!--                                        <a :href="'/admin/lesson/edit/'+item.id" class="uk-link-reset">{{item.title}}</a>-->
            <!--                                    </h4>-->
            <!--                                    <ul class="uk-comment-meta uk-list uk-child-padding-remove">-->
            <!--                                        <li>-->
            <!--                                            <a class="uk-link-muted" href="#">-->
            <!--                                                ID:<strong>{{item.id}}</strong>-->
            <!--                                            </a>-->
            <!--                                        </li>-->
            <!--                                        <li>-->
            <!--                                            <a class="uk-link-muted" href="#">-->
            <!--                                                <span>Отредактировано:</span>-->
            <!--                                                <strong>{{item.updated_at}}</strong>-->
            <!--                                            </a>-->
            <!--                                        </li>-->
            <!--                                    </ul>-->
            <!--                                </div>-->
            <!--                                <div class="uk-comment-footer uk-padding-small">-->
            <!--                                    <a class="uk-button uk-button-default uk-background-muted uk-button-secondary"-->
            <!--                                       :href="'/admin/lesson/edit/'+item.id">-->
            <!--                                        <span class="uk-text-success" uk-icon="file-edit"></span>-->
            <!--                                    </a>-->
            <!--                                    <button @click="del(item)" class="uk-button uk-button-danger">-->
            <!--                                        <span uk-icon="trash"></span>-->
            <!--                                    </button>-->
            <!--                                </div>-->
            <!--                            </header>-->
            <!--                            <div class="uk-comment-body uk-position-relative">-->
            <!--                                <p class="uk-padding-small uk-padding-remove-top" v-html="item.announce"></p>-->
            <!--                            </div>-->
            <!--                        </article>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--                <widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page"-->
            <!--                                            :path="'/admin/lesson/'"></widget-paginator-component>-->
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

    </div>

</template>

<script>
    export default {
        props: ['user_type', 'current_page'],
        data() {
            return {
                list: [],
                page_list: null,
                load: false,
                delete_item: {},
                delete_dialog: false,
                is_delete: false,
                sort_field: 'created_at',
                sort_method: false,
                path: window.location.pathname,
            };
        },
        mounted() {
            this.getList();
        },
        methods: {
            getDate:function(date){
                return date.substring(0, date.length - 9);
            },
            setFieldSort: function (field) {
                if (field === this.sort_field) {
                    this.sort_method = !this.sort_method;
                } else {
                    this.sort_field = field;
                }

                this.getList();
            },
            del: function () {
            },
            getList: function () {
                let pros = {
                    'sort_field': this.sort_field,
                    'sort_method': (this.sort_method ? 'asc' : 'desc'),
                };
                this.$http.post('/admin/lesson/get/' + this.current_page, pros).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.is_delete = response.data.delete;
                    this.load = true;
                });
            },
            Delete: function (item) {
                this.delete_item = item;
                this.$http.delete('/admin/lesson/delete/' + this.delete_item.id).then(response => {
                    this.getList();
                });
            },
            deletePage: function (item) {
                this.$http.delete('/admin/lesson/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            }
        },
    }
</script>
