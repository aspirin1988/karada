<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>{{users[method]}}
                <a href="/admin/user/add" class="uk-button uk-button-primary uk-button-small uk-border-rounded"
                   type="button" uk-icon="plus"></a>
            </h2>
            </div>
            <widget-sub_menu-component v-if="method!=='solo'" :items="menu"></widget-sub_menu-component>
        </header>
        <div class="uk-margin-top">
            <div v-if="list.length" class="content-section">
                <table v-if="method!=='admins'" class="uk-table uk-table-divider">
                    <thead>
                    <tr>
                        <td @click="setFieldSort('id')" :class="{'uk-active':sort_field ==='id'}">ID</td>
                        <td @click="setFieldSort('email')" :class="{'uk-active':sort_field ==='email'}">Логин</td>
                        <td @click="setFieldSort('first_name')" :class="{'uk-active':sort_field ==='first_name'}">Имя
                            Фамилия
                        </td>
                        <td @click="setFieldSort('phone')" :class="{'uk-active':sort_field ==='phone'}">Телефон</td>
                        <td>Старт</td>
                        <td>Финиш</td>
                        <td @click="setFieldSort('city')" :class="{'uk-active':sort_field ==='city'}">Город</td>
                        <td @click="setFieldSort('job')" :class="{'uk-active':sort_field ==='job'}">Сфера деятельности
                        </td>
                        <td @click="setFieldSort('promo_code')" :class="{'uk-active':sort_field ==='promo_code'}">
                            Промокод
                        </td>
                        <td @click="setFieldSort('price')" :class="{'uk-active':sort_field ==='price'}">Цена</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="uk-background-default" v-for="item in list">
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
                        <td>{{item.price}}</td>
                        <td>
                            <a :href="'/admin/admin/edit/'+item.id"
                               class="uk-button uk-button-default uk-background-muted uk-button-small">
                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                            </a>
                            <button class="uk-button uk-button-default uk-button-small" disabled>
                                <span uk-icon="lock" class="uk-icon"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-button-small" @click="del(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table v-if="method==='admins'" class="uk-table uk-table-divider">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Логин</td>
                        <td>Имя Фамилия</td>
                        <td>Телефон</td>
                        <td>Роль</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="uk-background-default" v-for="item in list">
                        <td>{{item.id}}</td>
                        <td>{{item.email}}</td>
                        <td>{{item.first_name}}
                            <br>
                            {{item.last_name}}
                        </td>
                        <td>{{item.phone}}</td>
                        <td><strong>{{item.type}}</strong></td>
                        <td>
                            <a :href="'/admin/admin/edit/'+item.id"
                               class="uk-button uk-button-default uk-background-muted uk-button-small">
                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                            </a>
                            <button class="uk-button uk-button-default uk-button-small" disabled>
                                <span uk-icon="lock" class="uk-icon"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-button-small" @click="del(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
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
    </div>
</template>

<script>
    export default {
        props: ['method', 'current_page'],
        data() {
            return {
                list: [],
                page_list: null,
                path: window.location.pathname,
                load: false,
                sort_field: 'created_at',
                sort_method: true,
                menu: [
                    // {id: 1, url: '/admin/admin/all', text: "Все", alias: ['/admin/admin/all']},
                    // {id: 2, url: '/admin/admin/admins', text: "Администраторы", alias: ['/admin/admin/admins']},
                    // {id: 3, url: '/admin/admin/admins', text: "Пользователи", alias: ['/admin/admin/users']},
                ],
                users: {
                    admins: 'Моя команда',
                    solo: 'Соло',
                },

            }
        },
        mounted() {
            this.getList();
        },
        methods: {
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
                };
                this.$http.post('/admin/admin/get/' + this.method + '/' + this.current_page, pros).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.load = true;
                });
            },
            Update: function () {
                this.getList();
            }
        },
    }
</script>
