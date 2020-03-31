<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Главная страница</h2>
            </div>
        </header>
        <div class="uk-background-default uk-margin-top">
            <ul uk-accordion="multiple: true">
                <li class="uk-open" v-if="getLength(planned_list)">
                    <a class="uk-accordion-title uk-padding-small" href="#">Запланированные
                        ({{getLength(planned_list)}})</a>
                    <div class="uk-accordion-content">
                        <hr>
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-small uk-table-divider uk-table-hover">
                                <thead>
                                <tr>
                                    <th>Тип</th>
                                    <th>Заголовок</th>
                                    <th>Фото</th>
                                    <th>Дата</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <home_page_item-component v-for="item in planned_list" :item="item" :key="item.id"
                                                          @deleteNews="showDelDialog"></home_page_item-component>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
                <li class="uk-open" v-if="getLength(new_list)">
                    <a class="uk-accordion-title uk-padding-small" href="#">В работе ({{getLength(new_list)}})</a>
                    <div class="uk-accordion-content">
                        <hr>
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-small uk-table-divider uk-table-hover">
                                <thead>
                                <tr>
                                    <th>Тип</th>
                                    <th>Заголовок</th>
                                    <th>Фото</th>
                                    <th>Дата</th>
                                </tr>
                                </thead>
                                <tbody>
                                <home_page_item-component v-for="item in new_list" :item="item" :key="item.id"
                                                          @deleteNews="showDelDialog"></home_page_item-component>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
                <li class="uk-open" v-if="getLength(published_list)">
                    <a class="uk-accordion-title uk-padding-small" href="#">Опубликованные
                        ({{getLength(published_list)}})</a>
                    <div class="uk-accordion-content">
                        <hr>
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-small uk-table-divider uk-table-hover">
                                <thead>
                                <tr>
                                    <th>Тип</th>
                                    <th>Заголовок</th>
                                    <th>Фото</th>
                                    <th>Дата</th>
                                </tr>
                                </thead>
                                <tbody>
                                <home_page_item-component v-for="item in published_list" :item="item" :key="item.id"
                                                          @deleteNews="showDelDialog"></home_page_item-component>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['method', 'current_page', 'rubric_id'],
        data() {
            return {
                load: false,
                delete_dialog: null,
                delete_item: null,
                page_list: null,
                path: window.location.pathname,
                rubric_list: [],
                keyword: '',
                new_list: [],
                planned_list: [],
                published_list: [],
            }
        },
        mounted() {
            // this.delete_dialog = this.$refs['delete-save'];
            // this.getList();
        },
        methods: {
            getLength: function (arr) {
                return Object.keys(arr).length;
            },
            getPermission: function (section, action) {
                return this.$parent.getPermission(section, action);
            },
            getList: function () {

                this.$http.get('/admin/get/home_page').then(response => {
                    this.load = true;
                    this.published_list = response.data.published;
                    this.planned_list = response.data.planned;
                    this.new_list = response.data.new;
                });
            },
            showDelDialog: function (item) {
                this.delete_item = item;
                UIkit.modal(this.delete_dialog).show();
            },
            deleteNews: function () {
                this.$http.delete('/admin/news/delete/' + this.delete_item.id).then((response) => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                }, (error) => {
                    if (error.response.status === 405) {
                        UIkit.notification({message: 'У вас нет доступа!', status: 'danger'});
                        UIkit.modal(this.delete_dialog).hide();
                    } else {
                        UIkit.notification({message: 'При удалении произошла ошибка!', status: 'danger'});
                        UIkit.modal(this.delete_dialog).hide();

                    }
                });
            },
        },
    }
</script>

<style>

    .test-pr {
        background-color: #26a69a;
        position: relative;
        height: 10px;
        overflow: hidden;
    }

    .test-pr::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        will-change: left, right;
        background: #acece6;
        width: 25%;
        /*-webkit-animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;*/
        /*animation: indeterminate 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;*/
        animation: loader 2s infinite cubic-bezier(0, 0, 1, 1.01);
    }
</style>
