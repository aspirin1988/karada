<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Компанию</h2></div>
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
                        <div class="uk-margin">
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
                                <input v-model="list.cheif.job" class="uk-input uk-form-width-large" id="job"
                                       type="text"
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
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Логин (e-mail РОПа):</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.email" class="uk-input uk-form-width-large"
                                       id="email" type="text"
                                       placeholder="Логин (e-mail РОПа)" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Имя РОПа:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.first_name" class="uk-input uk-form-width-large"
                                       id="first_name" type="text"
                                       placeholder="Имя РОПа" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Фамилия РОПа:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.last_name" class="uk-input uk-form-width-large"
                                       id="last_name" type="text"
                                       placeholder="Фамилия РОПа" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Телефон РОПа:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.cheif.phone" class="uk-input uk-form-width-large"
                                       id="phone" type="text"
                                       placeholder="Телефон РОПа" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="date_end_">Доступ:
                            </label>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="date_end">Доступ до:*</label>
                                <div class="uk-form-controls">
                                    <input v-model="list.cheif.date_end" class="uk-input uk-form-width-large"
                                           id="date_end" type="date"
                                           placeholder="Дата" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageAdd" class="uk-button uk-button-success" type="button">Создать</button>
                        </div>
                    </div>
                </header>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                list: {
                    cheif: {
                        company_limit: 0,
                        city: '',
                        email: '',
                        phone: '',
                        first_name: '',
                        last_name: '',
                    },
                },
                rules: {
                    name: 'required',
                }
            }
        },
        mounted() {
        },
        methods: {
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {

                    this.$http.put('/admin/company/add', this.list).then(response => {
                            let item = response.data;
                            if (item.id) {
                                UIkit.notification({message: 'Компания успешно создана!', status: 'success'});
                                setTimeout(() => {
                                    location.href = '/admin/company/edit/' + item.id;
                                }, 500);
                            }
                        }, reject => {

                            let data = reject.response.data;

                            UIkit.notification({
                                message: "При создании компании произошла ошибка! \n" + data.message,
                                status: 'danger'
                            });
                        }
                    );
                }
            },
        },
    }
</script>
