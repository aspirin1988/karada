<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Компания</h2>
            </div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class=" uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Название компании:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.name" class="uk-input uk-form-width-large" id="title" type="text"
                                       placeholder="Название компании" autocomplete="off">
                            </div>
                        </div>
                        <div v-if="list.cheif" class="uk-margin">
                            <label class="uk-form-label" for="title">Количество сотрудников:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.company_limit"
                                       class="uk-input uk-form-width-large" id="company_limit" type="text"
                                       placeholder="Количество сотрудников" autocomplete="off">
                            </div>
                        </div>
                        <div v-if="list.cheif" class="uk-margin">
                            <label class="uk-form-label" for="job">Сфера деятельности:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.job" class="uk-input uk-form-width-large" id="job" type="text"
                                       placeholder="Сфера деятельности" autocomplete="off">
                            </div>
                        </div>
                        <div v-if="list.cheif" class="uk-margin">
                            <label class="uk-form-label" for="title">Город:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.city" class="uk-input uk-form-width-large" id="city"
                                       type="text"
                                       placeholder="Город" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div v-if="list.cheif" class="uk-margin">
                            <label class="uk-form-label" for="title">Логин (e-mail РОПа):</label>
                            <div class="uk-form-controls">
                                <input disabled v-model="list.cheif.email" class="uk-input uk-form-width-large"
                                       id="email" type="text"
                                       placeholder="Логин (e-mail РОПа)" autocomplete="off">
                            </div>
                        </div>
                        <div v-if="list.cheif" class="uk-margin">
                            <label class="uk-form-label" for="title">Имя РОПа:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.first_name" class="uk-input uk-form-width-large"
                                       id="first_name" type="text"
                                       placeholder="Имя РОПа" autocomplete="off">
                            </div>
                        </div>
                        <div v-if="list.cheif" class="uk-margin">
                            <label class="uk-form-label" for="title">Фамилия РОПа:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.last_name" class="uk-input uk-form-width-large"
                                       id="last_name" type="text"
                                       placeholder="Фамилия РОПа" autocomplete="off">
                            </div>
                        </div>
                        <div v-if="list.cheif" class="uk-margin">
                            <label class="uk-form-label" for="title">Телефон РОПа:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.phone" class="uk-input uk-form-width-large"
                                       id="phone" type="text"
                                       placeholder="Телефон РОПа" autocomplete="off">
                            </div>
                        </div>
                        <div v-if="list.cheif" class="uk-margin">
                            <div class="uk-form-controls">
                                <a :href="'/admin/user/edit/'+list.cheif.id" class="uk-button uk-button-success"
                                   type="button">редактировать доступ</a>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageSave" class="uk-button uk-button-success" type="button">Сохранить
                            </button>
                            <a :href="'/admin/company/'" class="uk-button uk-button-danger" type="button">Отмена</a>
                        </div>
                    </div>
                </header>
            </article>
        </div>
        <div class="uk-margin-top">
            <div class="content-section">
                <div class="content-section-header">
                    <label>Сотрудники {{list.commands.length+1}} / {{list.cheif.company_limit}}:</label>
                    <a :href="'/admin/user/company/add/'+this.id" class="uk-button uk-button-small uk-border-rounded uk-button-primary"><i
                        uk-icon="plus"></i></a>
                </div>
                <table v-if="(list.commands && list.commands.length)||(list.commands_del && list.commands_del.length) "  class="uk-table uk-table-divider">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Логин</td>
                        <td>Имя Фамилия</td>
                        <td>Телефон</td>
                        <td>Создан</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="uk-background-default" v-for="item in list.commands">
                        <td>{{item.id}}</td>
                        <td>{{item.email}}</td>
                        <td>{{item.first_name}}
                            <br>
                            {{item.last_name}}
                        </td>
                        <td>{{item.phone}}</td>
                        <td>{{item.created_at}}</td>
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
                            <button class="uk-button uk-button-default uk-button-small" @click="del(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr style="color: rgba(0, 0, 0, 0.3);" class="uk-background-default"
                        v-for="item in list.commands_del">
                        <td>{{item.id}}</td>
                        <td>{{item.email}}</td>
                        <td>{{item.first_name}}
                            <br>
                            {{item.last_name}}
                        </td>
                        <td>{{item.phone}}</td>
                        <td>{{item.created_at}}</td>
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
                            <button class="uk-button uk-button-default uk-button-small" @click="del(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                list: {},
                template: '',
                template_content: '',
            }
        },
        mounted() {

        },
        created() {
            this.getList();
        },
        methods: {
            del: function (item) {
                this.$http.post('/admin/user/delete', {id: item.id}).then(response => {
                    UIkit.notification({message: 'Пользователь успешно удален!', status: 'success'});
                    this.getList();
                });
            },
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
            getList: function () {
                this.$http.get('/admin/company/get/edit/' + this.id).then(response => {
                    this.list = response.data
                });
            },

            pageSave: function () {
                this.$http.post('/admin/company/save/' + this.id, this.list).then(response => {
                    UIkit.notification({message: 'Компания успешно сохранена!', status: 'success'});
                });
            },
        },
    }
</script>
