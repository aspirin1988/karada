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
                        <div class="uk-margin">
                            <test_question-component :id="id"></test_question-component>
                        </div>

                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="userSave(false)" class="uk-button uk-button-success" type="button">
                                Сохранить
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
        props: ['id'],
        data() {
            return {
                list: {},
            }
        },
        mounted() {
            this.$http.get('/admin/test/edit/get/' + this.id).then(response => {
                this.list = response.data;
            });
        },
        methods: {
            AddQuestion:function(){

            },
            ChangeType: function () {
                if (this.list.type == 'admin') {
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
                this.$http.post('/admin/test/gallery/upload/' + this.id,
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
                this.$http.post('/admin/test/save/' + this.id, this.list).then(response => {
                    UIkit.notification({message: 'Тест успешно сохранен!', status: 'success'});
                    if (exit) {
                        setTimeout(() => {
                            location.href = '/admin/tests';
                        }, 500);

                    }
                });
            },
        },
    }
</script>
