<template>
    <tr>
        <td :class="getClass()">
            <span>{{item.type.tr}}</span>
            <br>
            <span>{{item.id}}</span>
        </td>
        <td><a class="uk-h4" :href="'/admin/'+item.type.or+'/single/'+item.id">{{item.title}}</a></td>
        <td>
            <a class="uk-link-muted uk-padding-small" :href="'/admin/'+item.type.or+'/edit/gallery/'+item.id">
            <img :src="item.url" alt="">
            </a>
        </td>
        <td>{{item.date}}</td>

        <td v-if="item.lock">
            <i uk-icon="icon: lock; ratio: 2" :title="item.lock.name + ' сейчас редактирует эту запись'"></i>
        </td>
        <td v-else="">
            <div class="uk-inline">
                <div class="uk-margin-right uk-cursor-pointer" type="button">
                    <span uk-icon="more-vertical"></span>
                </div>
                <div uk-dropdown="mode: click;">
                    <ul class="uk-nav uk-dropdown-nav">
                        <li><a :href="'/admin/'+item.type.or+'/edit/'+item.id"><span uk-icon="file-edit" class="uk-text-success"></span>Редактировать</a></li>
                        <li><a :href="'/admin/'+item.type.or+'/edit/gallery/'+item.id"><span uk-icon="image" class="uk-text-success"></span>Галерея</a></li>
                        <li class="uk-nav-divider"></li>
                        <li ><a href="#" @click="Delete(item)"><span uk-icon="trash" class="uk-text-danger"></span>Удалить</a></li>
                    </ul>
                </div>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['item'],
        data() {
            return {}
        },
        mounted() {

        },
        methods: {
            Delete:function(item){
                console.log(item);
            },
            getStatus: function () {
                return {

                }
            },
            getClass: function () {
                return {
                    'uk-type-news': this.item.type.or == 'news',
                    'uk-type-article': this.item.type.or == 'article',
                    'uk-type-gallery': this.item.type.or == 'gallery',
                    'uk-type-conference': this.item.type.or == 'conference',

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
        }
    }
</script>