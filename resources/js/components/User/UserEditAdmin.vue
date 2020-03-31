<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Пользователь</h2></div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Имя:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.first_name" class="uk-input uk-form-width-large" id="name" type="text"
                                       placeholder="Имя" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="last_name">Фамилия:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.last_name" class="uk-input uk-form-width-large" id="last_name" type="text"
                                       placeholder="Фамилия" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin" v-if="list.type !=='user'">
                            <label for="type" class="uk-form-label">Компания:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-form-width-large" id="company" v-model="list.company_id">
                                    <option :value="0">Не назначена</option>
                                    <option v-for="company in company_list" :value="company.id">{{company.name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin" v-if="list.type !=='user'">
                            <label for="type" class="uk-form-label">Пользователей:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.company_limit" class="uk-input uk-form-width-large" id="company_limit" type="text"
                                       placeholder="Пользователей"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="login">Логин (Email) :*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.email" class="uk-input uk-form-width-large" id="login" type="text" placeholder="Логин"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="password">Пароль:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.password" class="uk-input uk-form-width-large" id="password" type="text"
                                       placeholder="Пароль" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin" v-if="list.type ==='user'">
                            <label class="uk-form-label" for="job">Сфера деятельности:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.job" class="uk-input uk-form-width-large" id="job" type="text"
                                       placeholder="Сфера деятельности" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin" v-if="list.type !=='user'">
                            <label for="type" class="uk-form-label">Тип пользователя:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-form-width-large" id="type" v-model="list.type"
                                        @change="ChangeType">
                                    <option value="admin">Администратор</option>
                                    <option value="super admin">Супер Администратор</option>
                                    <option value="content manager">Контент менеджер</option>
                                    <option value="account manager">Менеджер по работе с клиентами</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="city">Город:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.city" class="uk-input uk-form-width-large" id="city" type="text" placeholder="Город"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="city">Телефон:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.phone" class="uk-input uk-form-width-large" id="phone" type="text"
                                       placeholder="Телефон" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="created_at">Старт:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.created_at" class="uk-input uk-form-width-large" id="created_at" type="text"
                                       placeholder="Старт" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin" v-if="!list.accsess_">
                            <label class="uk-form-label" for="city">Доступ:
                                <span class="uk-label uk-label-danger">Доступ закончился</span>
                            </label>
                            <div class="uk-form-controls uk-margin-small-top">
                                <button class="uk-button uk-button-primary" @click="show_add">Добавить доступ
                                    <i uk-icon="plus"></i></button>
                                <div class="uk-margin" v-if="show">
                                    <label class="uk-form-label" for="date_end">Доступ до:*</label>
                                    <div class="uk-form-controls">
                                        <input v-model="date_end" class="uk-input uk-form-width-large" id="date_end" type="date"
                                               placeholder="Дата" autocomplete="off">
                                    </div>
                                    <button class="uk-button uk-button-primary" @click="AddAccess()">Добавить</button>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin" v-else="">
                            <label class="uk-form-label" for="date_end_">Доступ:
                                <span class="uk-label uk-label-success">Активен</span>
                            </label>
                            <button class="uk-button uk-button-primary" @click="show_add">Изменить доступ
                                <i uk-icon="plus"></i></button>
                            <div class="uk-margin" v-if="show">
                                <label class="uk-form-label" for="date_end">Доступ до:*</label>
                                <div class="uk-form-controls">
                                    <input v-model="date_end" class="uk-input uk-form-width-large" id="date_end" type="date"
                                           placeholder="Дата" autocomplete="off">
                                </div>
                                <button class="uk-button uk-button-primary" @click="AddAccess()">Изменить</button>
                            </div>
                            <div class="uk-form-controls uk-margin-small-top">
                                <div class="uk-form-controls">
                                    <input v-if="list.accsess" v-model="list.accsess.date_end" class="uk-input uk-form-width-large"
                                           id="date_end_" type="text" disabled="disabled"
                                           placeholder="Дата" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="userSave(false)" class="uk-button uk-button-success" type="button">
                                Сохранить
                            </button>
                            <a :href="'/admin/user/'" class="uk-button uk-button-danger" type="button">Отмена</a>
                        </div>
                    </div>
                </header>
                <div v-if="certificate_list.length" class="content-section">
                    <div class="content-section-grid">
                        <div class="content-section-grid-item" v-for="item in certificate_list" >
                            <img class="thumbnail" :src="item.image">
                            <div class="text-section">
                                <div class="title">{{item.title}}</div>
                                <ul class="uk-comment-meta uk-flex">
                                    <li class="uk-margin-right">ID: <strong>{{item.id}}</strong></li>
                                    <li class="uk-margin-right">Отредактировано: <strong>{{item.updated_at}}</strong>
                                    </li>
                                    <li class="uk-margin-right">Дата создания: <strong>{{item.created_at}}</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                show: false,
                date_end: null,
                list: {},
                company_list: [],
                certificate_list: [],
            }
        },
        mounted() {
            this.$http.get('/admin/user/edit/get/' + this.id).then(response => {
                this.list = response.data;
            });
            this.$http.get('/admin/company/get/').then(response => {
                this.company_list = response.data.list;
            });
            this.$http.get('/admin/user/get/certificate/' + this.id).then(response => {
                this.certificate_list = response.data;
            });
        },
        methods: {
            AddAccess: function () {
                this.$http.post('/admin/user/add/access/' + this.id, {date_end: this.date_end}
                ).then(response => {
                    this.$http.get('/admin/user/edit/get/' + this.id).then(response => {
                        this.list = response.data;
                    });
                });
            },
            show_add: function () {
                this.show = true;
            },
            ChangeType: function () {
                if ( this.list.type == 'super admin' || this.list.type == 'admin' || this.list.type == 'content manager' || this.list.type == 'account manager') {
                    this.list.is_admin = true;
                } else {
                    this.list.is_admin = false;
                }
            },
            onUpload: function (fields, e,) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('file', files[i]);
                }
                UIkit.notification({message: 'Подождите изображения загружаются!', status: 'success', timeout: 10000});
                this.$http.post('/admin/user/gallery/upload/' + this.id,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.url) {
                        for (let i = 0; i < fields.length; i++) {
                            this.list[fields[i]] = response.data.url;
                        }
                        UIkit.notification({message: 'Изображение успешно загружено!', status: 'success'});
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки изображения произошла ошибка!', status: 'danger'});
                    });

            },

            userSave: function (exit) {
                this.$http.post('/admin/user/save/' + this.id, this.list).then(response => {
                    UIkit.notification({message: 'Пользователь успешно сохранен!', status: 'success'});
                    if (exit) {
                        setTimeout(() => {
                            location.href = '/admin/user/all';
                        }, 500);

                    }
                });
            },
        },
    }
</script>
