<template>
    <div>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Имя:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.first_name" class="uk-input uk-form-width-large" id="name"
                                       type="text"
                                       placeholder="Имя" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="last_name">Фамилия:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.last_name" class="uk-input uk-form-width-large" id="last_name"
                                       type="text"
                                       placeholder="Фамилия" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="login">Логин (Email) :*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.email" class="uk-input uk-form-width-large" id="login" type="text"
                                       placeholder="Логин"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="city">Город:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.city" class="uk-input uk-form-width-large" id="city" type="text"
                                       placeholder="Город"
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
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="userSave()" class="uk-button uk-button-success" type="button">Создать
                            </button>
                            <a :href="'/admin/user/'" class="uk-button uk-button-danger" type="button">Отмена</a>
                        </div>
                    </div>
                </header>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['company_id'],
        data() {
            return {
                list: {
                    type: 'user',
                    company_id:0,
                },
                users: {
                    admins: 'Моя команда',
                    solo: 'Соло',
                    rop: 'РОП',
                    all: 'Все',
                },
            }
        },
        mounted() {
            this.list.company_id = this.company_id;
            console.log(this.list);
            console.log(this.company_id);
        },
        methods: {
            userSave: function (exit) {

                this.$http.put('/admin/user/add/', this.list).then(response => {
                    UIkit.notification({message: 'Пользователь успешно создан!', status: 'success'});
                    setTimeout(() => {
                        location.href = '/admin/user/edit/' + response.data.id;
                    }, 500);

                }, reject => {
                    UIkit.notification({
                        message: 'При создании пользователя произошла ошибка (Возможно дублирование Email)!',
                        status: 'danger'
                    });
                });
            },
        },
    }
</script>
