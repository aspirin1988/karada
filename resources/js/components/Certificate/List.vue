<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2 class="uk-inline">Сертификакты
                </h2>
                <div>
                    <div class="uk-inline uk-margin-small-top">
                        <select class="uk-select" @change="getList()" v-model="filter">
                            <option :value="99999">Все</option>
                            <option v-for="item in sections" :value="item.id">{{item.title}}</option>
                            <option :value="0">Дипломы</option>
                        </select>
                    </div>
                    <div class="uk-inline uk-margin-small-top uk-float-right">
                        <span class="uk-form-icon uk-form-icon-flip" uk-icon="search"></span>
                        <input class="uk-input" v-model="filter_name" @keyup="getList()" placeholder="Поиск по имени"
                               type="text">
                    </div>
                </div>
            </div>
        </header>
        <div class="uk-margin-top">
            <div v-if="list.length" class="content-section">
                <table class="uk-table uk-table-divider">
                    <thead>
                    <tr>
                        <td @click="setFieldSort('id')" :class="{'uk-text-bold':sort_field ==='id'}">ID
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='id'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='id'"></i>
                        </td>
                        <td @click="setFieldSort('section_title')"
                            :class="{'uk-text-bold':sort_field ==='section_title'}">Раздел
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='section_title'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='section_title'"></i>
                        </td>
                        <td @click="setFieldSort('created_at')" :class="{'uk-text-bold':sort_field ==='created_at'}">
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='created_at'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='created_at'"></i>
                            Дата
                        </td>
                        <td @click="setFieldSort('user_name')" :class="{'uk-text-bold':sort_field ==='user_name'}">ФИО
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='user_name'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='user_name'"></i>
                        </td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="uk-background-default" v-for="item in list" :class="{'uk-text-danger':!item.active}">
                        <td>{{item.section}}{{(10000+item.id).toString().slice(1)}}</td>
                        <td>{{item.section_title}}</td>
                        <td>{{getDate(item.created_at)}}</td>
                        <td><strong>{{item.user_name}}</strong></td>
                        <td>
                            <a download="" :href="item.image">
                                Скачать
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/certificate/'"></widget-paginator-component>
                <!--                <div class="content-section-grid">-->
                <!--                    <div class="content-section-grid-item" v-for="item in list">-->
                <!--                        <img class="thumbnail" :src="item.image">-->
                <!--                        <div class="text-section">-->
                <!--                            <div class="title">{{item.name}}</div>-->
                <!--                            <ul class="uk-comment-meta uk-flex">-->
                <!--                                <li class="uk-margin-right">ID: <strong>{{item.id}}</strong></li>-->
                <!--                                <li class="uk-margin-right">Отредактировано: <strong>{{item.updated_at}}</strong></li>-->
                <!--                                <li class="uk-margin-right">Дата создания: <strong>{{item.created_at}}</strong></li>-->
                <!--                            </ul>-->
                <!--                        </div>-->
                <!--                        <div class="buttons-section">-->
                <!--                            <a :href="'/admin/company/edit/'+item.id"-->
                <!--                               class="uk-button uk-button-default uk-background-muted uk-button-small">-->
                <!--                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>-->
                <!--                            </a>-->
                <!--                            <button class="uk-button uk-button-default uk-button-small" disabled>-->
                <!--                                <span uk-icon="lock" class="uk-icon"></span>-->
                <!--                            </button>-->
                <!--                            <button class="uk-button uk-button-danger uk-button-small" @click="del(item)">-->
                <!--                                <span uk-icon="trash" class="uk-icon"></span>-->
                <!--                            </button>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
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
        props: ['current_page'],
        data() {
            return {
                list: [],
                page_list: null,
                load: false,
                delete_item: {},
                delete_dialog: false,
                path: window.location.pathname,
                sort_field: 'id',
                sort_method: true,
                sections: [],
                filter: 99999,
                filter_name: '',
            };
        },
        mounted() {
            this.getSections();
            this.getList();
        },
        methods: {
            getDate: function (date) {
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
            deletePage: function () {

            },
            getList: function () {
                let pros = {
                    'filter_name': this.filter_name,
                    'sort_field': this.sort_field,
                    'sort_method': (this.sort_method ? 'asc' : 'desc'),
                    'filter': this.filter,
                };
                this.$http.post('/admin/certificate/get/' + this.current_page, pros).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.load = true;
                });
            },
            getSections: function () {
                this.$http.get('/admin/sections/list_parent').then(response => {
                    this.sections = response.data;
                });
            },
        },
    }
</script>
