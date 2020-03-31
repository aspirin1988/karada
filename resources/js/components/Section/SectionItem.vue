<template>
    <div class="content-section-grid-item test">
        <div class="text-section">
            <div class="title"><strong>{{num}}{{(sub_num?'.'+sub_num:'')}}</strong> {{item.title}}</div>
            <ul class="uk-comment-meta uk-flex">
                <li class="uk-margin-right">ID: <strong>{{item.id}}</strong></li>
                <li class="uk-margin-right">Отредактировано: <strong>{{getDate(item.updated_at)}}</strong></li>
                <li class="uk-margin-right">Дата создания: <strong>{{getDate(item.created_at)}}</strong></li>
            </ul>
        </div>
        <div class="buttons-section">
            <a :href="'/admin/section/edit/'+item.id"
               class="uk-button uk-button-default uk-background-muted uk-button-small">
                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
            </a>
            <button class="uk-button uk-button-default uk-text-primary uk-button-small" @click="Up(item)">
                <span uk-icon="arrow-up"></span>
            </button>
            <button class="uk-button uk-button-default uk-text-primary uk-button-small" @click="Down(item)">
                <span uk-icon="arrow-down"></span>
            </button>
            <button class="uk-button uk-button-default uk-button-small" v-if="is_delete" @click="del(item)">
                <span uk-icon="trash" class="uk-icon"></span>
            </button>
        </div>
        <div class="content-section-child">
            <section-item-component v-for="(item_,key) in item.child" :is_delete="is_delete" :key="item_.id" :num="num" :sub_num="key+1" @Update="Update"
                                    :item="item_"></section-item-component>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['item', 'num', 'sub_num','is_delete'],
        data() {
            return {};
        },
        mounted() {
        },
        methods: {
            getDate:function(date){
                return date.substring(0, date.length - 9);
            },
            del:function(item){
                this.$emit('Delete',item);
            },
            Down: function (item) {
                this.$http.post('/admin/section/sort/down', item).then(response => {
                    let data = response.data;
                    if (data.result) {
                        this.$emit('Update', true);
                    }
                });
            },
            Up: function (item) {
                this.$http.post('/admin/section/sort/up', item).then(response => {
                    let data = response.data;
                    if (data.result) {
                        this.$emit('Update', true);
                    }
                });
            },
            Update: function () {
                this.$emit('Update');
            }
        },
    }
</script>
<style>
    .uk-button-small{
        padding: 0 5px;
    }
</style>
