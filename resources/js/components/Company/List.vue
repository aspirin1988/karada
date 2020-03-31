<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2 class="uk-inline">Компании
                    <div class="uk-inline">
                        <a href="/admin/company/add"
                           class="uk-button uk-button-primary uk-button-small uk-border-rounded" type="button"
                           uk-icon="plus"></a>
                    </div>
                </h2>
                <div class="uk-inline uk-margin-small-top uk-float-right">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="search"></span>
                    <input class="uk-input" v-model="filter" @keyup="getList()" placeholder="Поиск по названию" type="text">
                </div>
            </div>

        </header>
        <div class="uk-margin-top">
            <div class="uk-overflow-auto" v-if="list.length">
                <div class="content-section">
                    <div class="uk-company uk-table-divider">
                        <div class="uk-company-header">
                            <div @click="setFieldSort('id')" :class="{'uk-text-bold':sort_field ==='id'}">ID
                                <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='id'"></i>
                                <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='id'"></i>
                            </div>
                            <div @click="setFieldSort('name')" :class="{'uk-text-bold':sort_field ==='name'}">Название
                                <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='name'"></i>
                                <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='name'"></i>
                            </div>
                            <div class="no-sort">Старт</div>
                            <div class="no-sort">Финиш</div>
                            <div class="no-sort">Команда</div>
                            <div class="no-sort">Сфера деятельности</div>
                            <div class="no-sort">Город</div>
                            <div></div>

                        </div>
                        <div class="uk-company-body">
                            <div class="uk-background-default uk-box-shadow" v-for="item in list">
                                <div class="border-bottom border-right background-yellow">{{item.id}}</div>
                                <div class="border-bottom border-right">{{item.name}}</div>
                                <div class="border-bottom border-right" v-if="item.cheif">{{item.cheif.access_start}}
                                </div>
                                <div class="border-bottom border-right" v-else>Не задан</div>
                                <div class="border-bottom border-right" v-if="item.cheif">{{item.cheif.access_end}}
                                </div>
                                <div class="border-bottom border-right" v-else>Не задан</div>
                                <div class="border-bottom border-right" v-if="item.cheif">{{item.cheif.command_limit}}
                                </div>
                                <div class="border-bottom border-right" v-else>Не задан</div>
                                <div class="border-bottom border-right" v-if="item.cheif">{{item.cheif.job}}</div>
                                <div class="border-bottom border-right" v-else>Не задан</div>
                                <div class="border-bottom border-right" v-if="item.cheif">{{item.cheif.city}}</div>
                                <div class="border-bottom border-right" v-else>Не задан</div>
                                <div class="border-bottom">
                                    <a :href="'/admin/company/edit/'+item.id"
                                       class="uk-button uk-button-default uk-background-muted uk-button-small">
                                        <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                                    </a>
                                    <button class="uk-button uk-button-default uk-button-small"
                                            v-if="is_delete"
                                            @click="Delete(item)">
                                        <span uk-icon="trash" class="uk-icon"></span>
                                    </button>
                                </div>
                                <div class="collapse-grid" v-if="item.cheif">
                                    <div>
                                        <div class="border-bottom">РОП</div>
                                        <div class="border-bottom">{{item.cheif.first_name}} {{item.cheif.last_name}}
                                        </div>
                                        <div class="border-bottom">{{item.cheif.email}}</div>
                                        <div class="border-bottom">{{item.cheif.phone}}</div>
                                        <div class="border-bottom">
                                            <a :href="'/admin/user/edit/'+item.cheif.id"
                                               class="uk-button uk-button-default uk-background-muted uk-button-small">
                                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                                            </a>
                                            <button v-if="is_delete && item.cheif.active"
                                                    class="uk-button uk-button-default uk-button-small"
                                                    @click="UserLocked(item.cheif)">
                                                <span uk-icon="lock" class="uk-icon"></span>
                                            </button>
                                            <button v-if="is_delete && !item.cheif.active"
                                                    class="uk-button uk-button-danger uk-button-small"
                                                    @click="UserUnLocked(item.cheif)">
                                                <span uk-icon="unlock" class="uk-icon"></span>
                                            </button>
                                        </div>
                                        <div class="collapse-grid-commands" v-if="item.cheif.commands.length">
                                            <div class="border-bottom border-right fill-grid">Сотрудники</div>
                                            <div class="grid-commands">
                                                <div v-for="item_  in item.cheif.commands">
                                                    <div class="border-bottom border-right">{{item_.first_name}}
                                                        {{item_.last_name}}
                                                    </div>
                                                    <div class="border-bottom border-right">{{item_.email}}</div>
                                                    <div class="border-bottom border-right">{{item_.phone}}</div>
                                                    <div class="border-bottom ">
                                                        <a :href="'/admin/user/edit/'+item_.id"
                                                           class="uk-button uk-button-default uk-background-muted uk-button-small">
                                                            <span uk-icon="file-edit"
                                                                  class="uk-text-success uk-icon"></span>
                                                        </a>
                                                        <button v-if="is_delete && item_.active"
                                                                class="uk-button uk-button-default uk-button-small"
                                                                @click="UserLocked(item_)">
                                                            <span uk-icon="lock" class="uk-icon"></span>
                                                        </button>
                                                        <button v-if="is_delete && !item_.active"
                                                                class="uk-button uk-button-danger uk-button-small"
                                                                @click="UserUnLocked(item_)">
                                                            <span uk-icon="unlock" class="uk-icon"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/company/'"></widget-paginator-component>
            </div>
            <div v-else="" class="uk-margin-top">
                <widget-preloader-component :load="load"></widget-preloader-component>
            </div>
        </div>
        <div id="delete-save" class="uk-flex-top" ref="delete-save" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <h2 class="uk-modal-title uk-text-warning">Предупреждение!</h2>
                <p> Вы действительно хотите удалить компанию?</p>
                <p class="uk-text-danger" >( При удалении компании пользователи будут удалены )</p>
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
        props: ['current_page', 'user_type'],
        data() {
            return {
                list: [],
                page_list: null,
                load: false,
                delete_item: {},
                filter: '',
                delete_dialog: false,
                is_delete: false,
                path: window.location.pathname,
                sort_field: 'id',
                sort_method: true,
            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];
            this.getList();
        },
        methods: {
            UserLocked: function (item) {
                this.$http.post('/admin/user/lock', {id: item.id}).then(response => {
                    UIkit.notification({message: 'Пользователь успешно заблокирован!', status: 'success'});
                    this.getList();
                });
            },
            UserUnLocked: function (item) {
                this.$http.post('/admin/user/unlock', {id: item.id}).then(response => {
                    UIkit.notification({message: 'Пользователь успешно разблокирован!', status: 'success'});
                    this.getList();
                });
            },
            setFieldSort: function (field) {
                if (field === this.sort_field) {
                    this.sort_method = !this.sort_method;
                } else {
                    this.sort_field = field;
                }

                this.getList();
            },
            getList: function () {
                let pros = {
                    'sort_field': this.sort_field,
                    'sort_method': (this.sort_method ? 'asc' : 'desc'),
                    'filter': this.filter,
                };
                this.$http.post('/admin/company/get/' + this.current_page, pros).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.is_delete = response.data.delete;
                    this.load = true;
                });
            },
            Delete: function (item) {
                this.delete_item = item;
                UIkit.modal(this.delete_dialog).show();
            },
            Update: function (data) {
                this.list = data.list;
                this.page_list = data.page_list
            },
            deletePage: function (item) {
                this.$http.delete('/admin/company/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            }
        },
    }
</script>
<style>
    .uk-box-shadow {
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    }

    .uk-company {
        width: 1105px;
    }

    .uk-company.uk-table-divider tbody tr:nth-child(even) {
        background-color: #f9fcff;
    }

    .uk-company td {
        border-right: 1px solid #e5e5e5;
    }

    .uk-company-header {
        display: grid;
        grid-template-columns: repeat(8, 1fr)
    }

    .uk-company-header > div {
        padding: 10px 10px;
        vertical-align: top;
        font-size: 12px;
    }

    .uk-company-body > div {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        margin-bottom: 15px;
        border: 1px solid #e5e5e5;
    }

    .uk-company-body > div:nth-child(even) {
        background-color: #f9fcff;
    }

    .uk-company-body > div > div {
        padding: 10px 10px;
        vertical-align: top;
        font-size: 12px;
        color: #000000;
        font-family: Montserrat;
        font-size: 12px;
        font-weight: 400;
        line-height: 18px;
    }

    .uk-company-body > div > div.no-border {
        border: none;
    }

    .collapse-grid {
        grid-column-start: 1;
        grid-column-end: 8;
        display: flex;
        justify-content: center;
        align-content: center;
        padding: 15px 50px !important;
        border: none;
    }

    .collapse-grid > div {
        width: 100%;
        grid-template-columns: 180px 180px 250px 180px 180px;
        display: grid;
        padding: 0 !important;
        margin-left: -1px;
    }

    .collapse-grid > div > div {
        border-right: 1px solid #e5e5e5;
        padding: 10px 10px;
        border-top: 1px solid #e5e5e5;
        word-break: break-all;
    }

    .collapse-grid > div > div:first-child {
        border-left: 1px solid #e5e5e5;
    }

    .collapse-grid-commands {
        grid-column-start: 1;
        grid-column-end: 6;
        padding: 0 !important;
        margin-top: 15px;
        display: flex;
        border-top: 1px solid #e5e5e5;
        border-left: 1px solid #e5e5e5;
    }

    .collapse-grid-commands .grid-commands > div {

        grid-template-columns: 180px 250px 180px 180px;
        display: grid;
        border-left: 1px solid #e5e5e5;
        padding: 0 !important;
        margin-left: -1px;
    }

    .collapse-grid-commands .grid-commands > div > div {
        /*border-right: 1px solid #e5e5e5;*/
        padding: 10px 10px;
        word-break: break-all;
    }

    .border-bottom {
        border-bottom: 1px solid #e5e5e5;
    }

    .border-right {
        border-right: 1px solid #e5e5e5;
    }

    .fill-grid {
        display: block !important;
        width: 158px;
        padding: 10px;
    }

    .no-sort {

    }
    .background-yellow{
        background: #fad204;
    }
</style>
