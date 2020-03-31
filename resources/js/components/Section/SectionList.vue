<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Разделы
                    <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small uk-border-rounded" type="button"
                                uk-icon="plus"></button>
                        <div uk-dropdown>
                            <ul class="uk-nav uk-nav-default">
                                <li class="">
                                    <a href="/admin/section/add" title="Курс">
                                        <i uk-icon="template"></i><span>Раздел</span>
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
                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/section/'"></widget-paginator-component>
                <div class="content-section-grid">
                    <div class="content-section-grid-item test">
                        <div class="text-section">
                            <div class="title"><strong>{{1}}</strong> {{'Введение'}}</div>
                            <ul class="uk-comment-meta uk-flex">
                            </ul>
                        </div>
                        <div class="buttons-section">
                            <a :href="'/admin/course/edit/'+current_menu.id"
                               class="uk-button uk-button-default uk-background-muted uk-button-small">
                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                            </a>
                            <button class="uk-button uk-button-default uk-text-primary uk-button-small">
                                <span uk-icon="arrow-up"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-text-primary uk-button-small">
                                <span uk-icon="arrow-down"></span>
                            </button>
                        </div>
                    </div>

                    <section-item-component v-for="(item,key) in list" v-if="current_menu.id" :key="item.id" :num="key+2"
                                            @Update="Update" @Delete="Delete" :item="item" :is_delete="is_delete" ></section-item-component>
                </div>
                <widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/section/'"></widget-paginator-component>
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

    </div>

</template>

<script>
    export default {
        props:['user_type'],
        data() {
            return {
                list: [],
                course_list: [],
                page_list: null,
                current_page: 0,
                load: false,
                is_delete: false,
                delete_item: {},
                current_menu: {id: 0},
                delete_dialog: false,
                path: window.location.pathname,
            };
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];
            this.getListCourse();
        },
        methods: {
            Update: function () {
                this.getList();
            },
            Delete: function (item) {
                this.delete_item = item;
                UIkit.modal(this.delete_dialog).show();
            },
            setActiveMenu: function (item) {
                this.current_menu = item;
                this.getList()
            },
            del: function () {
            },
            deletePage: function (item) {
                this.$http.delete('/admin/section/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            },
            getList: function () {
                this.$http.get('/admin/section/get/' + this.current_menu.id).then(response => {
                    this.list = response.data.list;
                    this.is_delete = response.data.delete;
                    this.page_list = response.data.page_list;
                    this.load = true;
                });
            },
            getListCourse: function () {
                this.$http.get('/admin/course/get/all').then(response => {
                    this.course_list = response.data.list;
                    this.current_menu = this.course_list[0] || {id: 0};
                    this.getList()
                });
            },
        },
    }
</script>
