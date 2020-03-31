<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Новость
                    <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small uk-border-rounded" type="button"
                                uk-icon="upload"></button>
                    </div>
                </h2>
            </div>
        </header>
        <div class="uk-margin-top">
            <article class="uk-comment uk-textarea uk-padding-small">
                <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
                    <input :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                           type="file" multiple="multiple" @change="onUpload">
                    <span uk-icon="icon: cloud-upload"></span>
                    <span class="uk-text-middle">Перетащите файлы сюда или</span>
                    <div uk-form-custom>
                        <span class="uk-link">загрузите вручную</span>
                    </div>
                </div>
                <div class="uk-child-width-1-2@m" uk-grid>
                    <div v-for="(item, key ) in list">
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-media-top" uk-lightbox="">
                                <a :href="item.data.video || '#'" :data-caption="item.data.alt">
                                    <div class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                         :style="{backgroundImage: 'url('+item.data.image+')'}">
                                        <p v-html="item.data.alt"></p>
                                    </div>
                                </a>
                            </div>
                            <div class="uk-padding-small">
                                <div class="uk-margin-small">
                                    <label :for="'alt_'+key" class="uk-form-label">Подпись фото:</label><br>
                                    <div class="uk-inline">
                                        <a href="#" uk-icon="icon: check" class="uk-form-icon uk-form-icon-flip uk-icon" @click="updateMedia(item.data.id,item.data)" onclick="return false;" ></a>
                                        <input :id="'alt_'+key" class="uk-input uk-form-width-large" v-model="item.data.alt" type="text">
                                    </div>
                                </div>
                                <div class="uk-margin-small">
                                    <label :for="'video_'+key" class="uk-form-label">Видео:</label><br>
                                    <div class="uk-inline">
                                        <a href="#" uk-icon="icon: check" class="uk-form-icon uk-form-icon-flip uk-icon" @click="updateMedia(item.data.id,item.data)" onclick="return false;" ></a>
                                        <input :id="'video_'+key" class="uk-input uk-form-width-large" v-model="item.data.video" type="text">
                                    </div>
                                </div>
                                <div class="uk-margin-small">
                                    <label :for="'sort_'+key" class="uk-form-label">Sort:</label><br>
                                    <div class="uk-inline">
                                        <input :id="'sort_'+key" class="uk-input uk-form-width-large" @change="updateSort(item.id, item.order_field)" v-model="item.order_field" type="number">
                                    </div>
                                </div>
                                <button class="uk-button uk-button-default" @click="deleteImage(item.id)" ><i uk-icon="trash"></i></button>
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
            sortedAttaches(array) {
                return array.sort((a, b) => a.sort > b.sort);
            },
            getList:function(){
                axios.get('/admin/media_collection/get_media/' + this.id).then(response => {
                    this.list = this.sortedAttaches(response.data);
                });
            },

            deleteImage:function(id){
                this.$http.delete('/admin/media_collection/image/delete/' + this.id+'/'+id).then(response => {
                    UIkit.notification({message: 'Медиа фаил успешно удален из коллекции!', status: 'success'});
                    this.getList();
                });
            },
            updateMedia: function(id, item){
                this.$http.post('/admin/media/update/' + id, item).then(response => {
                    UIkit.notification({message: 'Медиа фаил успешно сохранен!', status: 'success'});
                    this.getList()
                });
            },

            updateSort: function(id, sort){
                this.$http.post('/admin/media/update/sort/' + id, {sort}).then(response => {
                    UIkit.notification({message: 'Медиа фаил успешно сохранен!', status: 'success'});
                    this.getList();
                });
            },

            pageSave: function () {
                this.$http.post('/admin/page/save/' + this.id, this.list).then(response => {
                    UIkit.notification({message: 'Страница успешно сохранена!', status: 'success'});
                });
            },
            onUpload: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }

                UIkit.notification({message: 'Подождите изображения загружаются!', status: 'success', timeout: 10000});
                axios.post('/admin/media_collection/upload/' + this.id,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        UIkit.notification({message: 'Изображения успешно загружены!', status: 'success'});
                        this.getList();
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки изображений произошла ошибка!', status: 'danger'});
                    });

            },
        },
    }
</script>
