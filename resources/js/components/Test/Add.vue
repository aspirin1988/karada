<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title"><h2>Тест</h2></div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class="uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Название:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.title" class="uk-input uk-form-width-large" id="name" type="text"
                                       placeholder="Название" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="userSave()" class="uk-button uk-button-success" type="button">Создать
                            </button>
                            <a :href="'/admin/tests/'" class="uk-button uk-button-danger" type="button">Отмена</a>
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
                list: {},
            }
        },
        mounted() {

        },
        methods: {
            userSave: function (exit) {
                this.$http.put('/admin/test/add/', this.list).then(response => {
                    UIkit.notification({message: 'Тест успешно создан!', status: 'success'});
                    setTimeout(() => {
                        location.href = '/admin/test/edit/' + response.data.id;
                    }, 500);

                });
            },
        },
    }
</script>
