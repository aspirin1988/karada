<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Урок</h2></div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class=" uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="type">Раздел:*</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-form-width-large" v-model="list.section_id" id="type">
                                    <option value="">Не назначен</option>
                                    <option v-for="item in sections_list" :value="item.id">{{item.title}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title">Название:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.title" class="uk-input uk-form-width-large" id="title" type="text"
                                       placeholder="Название" autocomplete="off">
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
                    title: '',
                    section_id: '',
                },
                send: false,
                sections_list: [],
                rules: {
                    title: 'required',
                    section_id: 'required',
                }
            }
        },
        mounted() {
            this.$http.get('/admin/sections/list/').then(response => {
                this.sections_list = response.data;
            });
        },
        methods: {
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {
                    if (!this.send) {
                        this.send = true;
                        this.$http.put('/admin/lesson/add/', this.list).then(response => {
                            let item = response.data;
                            if (item.id) {
                                UIkit.notification({message: 'Страница успешно создана!', status: 'success'});
                                setTimeout(() => {
                                    this.send = false;
                                    location.href = '/admin/lesson/edit/' + item.id;
                                }, 500);
                            }
                        });
                    }
                }
            },
        },
    }
</script>
