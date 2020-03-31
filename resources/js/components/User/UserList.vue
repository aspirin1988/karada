<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2 class="uk-inline">{{users[method]}}
                    <a :href="'/admin/user/'+method+'/add'"
                       class="uk-button uk-button-primary uk-button-small uk-border-rounded"
                       type="button" uk-icon="plus"></a>
                </h2>
                <div class="uk-inline uk-margin-small-top uk-float-right">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="search"></span>
                    <input class="uk-input" v-model="filter" @keyup="getList()" placeholder="Поиск по имени"
                           type="text">
                </div>
            </div>
            <!--            <widget-sub_menu-component :items="menu"></widget-sub_menu-component>-->
        </header>
        <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"
                                    :path="'/admin/user/'+method+'/'"></widget-paginator-component>
        <div class="uk-margin-top">
            <div v-if="list.length" class="content-section">
                <table v-if="method!=='admins'" class="uk-table uk-table-divider">
                    <thead>
                    <tr>
                        <td @click="setFieldSort('id')" :class="{'uk-text-bold':sort_field ==='id'}">ID
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='id'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='id'"></i>
                        </td>
                        <td @click="setFieldSort('email')" :class="{'uk-text-bold':sort_field ==='email'}">Логин
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='email'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='email'"></i>
                        </td>
                        <td @click="setFieldSort('first_name')" :class="{'uk-text-bold':sort_field ==='first_name'}">
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='first_name'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='first_name'"></i>
                            Имя Фамилия
                        </td>
                        <td @click="setFieldSort('phone')" :class="{'uk-text-bold':sort_field ==='phone'}">Телефон
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='phone'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='phone'"></i>
                        </td>
                        <td @click="setFieldSort('date_start')" :class="{'uk-text-bold':sort_field ==='date_start'}">
                            Старт
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='date_start'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='date_start'"></i>
                        </td>
                        <td @click="setFieldSort('date_end')" :class="{'uk-text-bold':sort_field ==='date_end'}">Финиш
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='date_end'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='date_end'"></i>
                        </td>
                        <td @click="setFieldSort('city')" :class="{'uk-text-bold':sort_field ==='city'}">Город
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='city'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='city'"></i>
                        </td>
                        <td @click="setFieldSort('job')" :class="{'uk-text-bold':sort_field ==='job'}">Сфера
                            деятельности
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='job'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='job'"></i>
                        </td>
                        <td @click="setFieldSort('promo_code')" :class="{'uk-text-bold':sort_field ==='promo_code'}">
                            Промокод
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='promo_code'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='promo_code'"></i>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="uk-background-default" v-for="item in list" :class="{'uk-text-danger':!item.active}">
                        <td>{{item.id}}</td>
                        <td>{{item.email}}</td>
                        <td>{{item.first_name}}
                            <br>
                            {{item.last_name}}
                        </td>
                        <td>{{item.phone}}</td>
                        <td v-if="item.access_start">{{item.access_start}}</td>
                        <td v-else>Не задан</td>
                        <td v-if="item.access_end">{{item.access_end}}</td>
                        <td v-else>Не задан</td>
                        <td v-if="item.city">{{item.city}}</td>
                        <td v-else>-</td>
                        <td v-if="item.job">{{item.job}}</td>
                        <td v-else>-</td>
                        <td v-if="item.promo_code">{{item.promo_code}}</td>
                        <td v-else>-</td>
                        <td>
                            <a :href="'/admin/user/edit/'+item.id"
                               class="uk-button uk-button-default uk-background-muted uk-button-small">
                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                            </a>
                            <button v-if="is_delete && item.active" class="uk-button uk-button-default uk-button-small"
                                    @click="UserLocked(item)">
                                <span uk-icon="lock" class="uk-icon"></span>
                            </button>
                            <button v-if="is_delete && !item.active" class="uk-button uk-button-danger uk-button-small"
                                    @click="UserUnLocked(item)">
                                <span uk-icon="unlock" class="uk-icon"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-button-small" v-if="is_delete"
                                    @click="Delete(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table v-if="method==='admins'" class="uk-table uk-table-divider">
                    <thead>
                    <tr>
                        <td @click="setFieldSort('id')" :class="{'uk-text-bold':sort_field ==='id'}">ID
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='id'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='id'"></i>
                        </td>
                        <td @click="setFieldSort('email')" :class="{'uk-text-bold':sort_field ==='email'}">Логин
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='email'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='email'"></i>
                        </td>
                        <td @click="setFieldSort('first_name')" :class="{'uk-text-bold':sort_field ==='first_name'}">
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='first_name'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='first_name'"></i>
                            Имя Фамилия
                        </td>
                        <td @click="setFieldSort('phone')" :class="{'uk-text-bold':sort_field ==='phone'}">Телефон
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='phone'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='phone'"></i>
                        </td>
                        <td @click="setFieldSort('type')" :class="{'uk-text-bold':sort_field ==='type'}">Роль
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='type'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='type'"></i>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="uk-background-default" v-for="item in list" :class="{'uk-text-danger':!item.active}">
                        <td>{{item.id}}</td>
                        <td>{{item.email}}</td>
                        <td>{{item.first_name}}
                            <br>
                            {{item.last_name}}
                        </td>
                        <td>{{item.phone}}</td>
                        <td><strong>{{item.type}}</strong></td>
                        <td>
                            <a :href="'/admin/user/edit/'+item.id"
                               class="uk-button uk-button-default uk-background-muted uk-button-small">
                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                            </a>
                            <button v-if="item.active" class="uk-button uk-button-default uk-button-small"
                                    @click="UserLocked(item)">
                                <span uk-icon="lock" class="uk-icon"></span>
                            </button>
                            <button v-if="!item.active" class="uk-button uk-button-danger uk-button-small"
                                    @click="UserUnLocked(item)">
                                <span uk-icon="unlock" class="uk-icon"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-button-small" v-if="is_delete"
                                    @click="Delete(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"
                                            :path="'/admin/user/'+method+'/'"></widget-paginator-component>
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
        <div ref="delete-save" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <h2 class="uk-modal-title uk-text-warning">Предупреждение!</h2>
                <p> Вы действительно хотите удалить Пользователя?</p>
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
        props: ['method', 'current_page', 'user_type'],
        data() {
            return {
                list: [],
                page_list: null,
                path: window.location.pathname,
                load: false,
                sort_field: 'id',
                sort_method: true,
                delete_dialog: true,
                filter: '',
                menu: [],
                is_delete:false,
                users: {
                    admins: 'Моя команда',
                    solo: 'Соло',
                    rop: 'РОП',
                    all: 'Все',
                },

            }
        },
        mounted() {
            if (this.user_type === 'super admin') {
                this.menu = [
                    {id: 3, url: '/admin/user/solo', text: "СОЛО", alias: ['/admin/user/solo']},
                    {id: 4, url: '/admin/user/rop', text: "РОП", alias: ['/admin/user/rop']},
                    {id: 2, url: '/admin/user/admins', text: "Администраторы", alias: ['/admin/user/admins']},
                    {id: 1, url: '/admin/user/all', text: "Все", alias: ['/admin/user/all']},
                ];
            } else {
                this.menu = [
                    {id: 3, url: '/admin/user/solo', text: "СОЛО", alias: ['/admin/user/solo']},
                    {id: 4, url: '/admin/user/rop', text: "РОП", alias: ['/admin/user/rop']},
                ];
            }
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
                this.$http.post('/admin/user/get/' + this.method + '/' + this.current_page, pros).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.is_delete = response.data.delete;
                    this.load = true;
                });
            },
            Update: function () {
                this.getList();
            },
            Delete: function (item) {
                this.delete_item = item;
                UIkit.modal(this.delete_dialog).show();
            },
            deletePage: function (item) {
                this.$http.post('/admin/user/delete', {id: this.delete_item.id}).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList()
                });
            }
        },
    }
</script>
