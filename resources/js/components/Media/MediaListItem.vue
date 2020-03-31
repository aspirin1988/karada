<template>
    <div class="uk-card uk-card-default">
        <div class="uk-card-media-top" uk-lightbox="">
            <a :href="item.video || '#'" :data-caption="item.alt">
                <div class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                     :style="{backgroundImage: 'url('+item.image+')'}">
                    <p v-html="item.alt"></p>
                </div>
            </a>
        </div>
        <div class="uk-padding-small">
            <div class="uk-margin-small">
                <label :for="'url_'+item.id" class="uk-form-label">URL:</label><br>
                <div class="uk-inline">
                    <input :id="'url_'+item.id" class="uk-input uk-form-width-large" disabled="disabled" v-model="item.image" type="text">
                </div>
            </div>
            <div class="uk-margin-small">
                <label :for="'alt_'+item.id" class="uk-form-label">Подпись фото:</label><br>
                <div class="uk-inline">
                    <a href="#" uk-icon="icon: check" class="uk-form-icon uk-form-icon-flip uk-icon" @click="updateMedia(item.id,item)" onclick="return false;" ></a>
                    <input :id="'alt_'+item.id" class="uk-input uk-form-width-large" v-model="item.alt" type="text">
                </div>
            </div>
            <div class="uk-margin-small">
                <label :for="'video_'+item.id" class="uk-form-label">Видео:</label><br>
                <div class="uk-inline">
                    <a href="#" uk-icon="icon: check" class="uk-form-icon uk-form-icon-flip uk-icon" @click="updateMedia(item.id,item)" onclick="return false;" ></a>
                    <input :id="'video_'+item.id" class="uk-input uk-form-width-large" v-model="item.video" type="text">
                </div>
            </div>
            <button class="uk-button uk-button-default" @click="del()" ><i uk-icon="trash"></i></button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            item: {
                type: Object,
                required: true
            }
        },
        data() {
            return {}
        },
        computed: {
            classObject: function () {
                return {
                    'uk-status-unpublished': this.item.status == 'unpublished',
                    'uk-status-published': this.item.status == 'published',
                    'uk-status-ready': this.item.status == 'ready',
                    'uk-status-new': this.item.status == 'new',
                    'uk-status-editing': this.item.status == 'editing',
                    'uk-status-deleted': this.item.status == 'deleted',
                    'uk-status-hidden': this.item.status == 'hidden',
                    'uk-status-planned': this.item.status == 'planned'
                }
            }
        },
        methods: {
            updateMedia: function(id, item){
                this.$http.post('/admin/media/update/' + id, item).then(response => {
                    UIkit.notification({message: 'Медиа фаил успешно сохранен!', status: 'success'});
                    // this.getList()
                });
            },
			del:function () {
                this.$emit('Delete', this.item);
            }
        }
    }
</script>
