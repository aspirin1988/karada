<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Тестовый период и цена</h2>
            </div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <header class="uk-comment-header uk-flex-middle uk-padding-small">
                    <div class=" uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="trial">Тестовый период:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.limit" class="uk-input uk-form-width-large" id="trial" type="text"
                                       placeholder="Тестовый период" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="price">Цена за курс:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.price" class="uk-input uk-form-width-large" id="price" type="text"
                                       placeholder="Цена за курс" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="price">Старая цена за курс:*</label>
                            <div class="uk-form-controls">
                                <input v-model="list.price_old" class="uk-input uk-form-width-large" id="price_old" type="text"
                                       placeholder="Старая цена за курс" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="pageSave" class="uk-button uk-button-success" type="button">Сохранить
                            </button>
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
                video_list:[],
                video_name:'',
            }
        },
        mounted() {
            this.getList();
        },
        methods: {
            findVideo: function () {
                if (this.video_name.length >= 2) {
                    this.$http.post('/admin/find/video', {video: this.video_name}).then(response => {
                        // if (response.data.length) {
                        this.video_list = response.data;
                        // }
                    });
                } else {
                    this.video_list = [];
                }
            },
            addVideo: function (item) {
                this.list.video = item;
                this.video_list = [];
            },
            removeVideo: function (item) {
                this.list.video = {};
            },

            getList: function () {
                this.$http.get('/admin/trial/get').then(response => {
                    this.list = response.data;
                });
            },
            pageSave: function () {
                this.$http.post('/admin/trial/save',this.list).then(response => {
                    UIkit.notification({message: 'Данные успешно сохранены!', status: 'success'});

                    this.list = response.data;
                });
            }
        },
    }
</script>
