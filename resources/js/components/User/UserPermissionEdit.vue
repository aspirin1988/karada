<template>
    <ul uk-accordion>
        <li>
            <span class="uk-accordion-title">Доступ</span>
            <div class="uk-accordion-content">
                <div>
                    <article class="uk-comment uk-textarea uk-padding-small">

                        <div class="uk-padding uk-padding-remove-bottom" v-for="(items,index) in permissions">
                            <div>{{index}}:</div>
                            <div v-for="(items,index_1) in items">
                                <div class="">
                                    <div class="uk-margin">
                                        <label class="uk-form-label">{{index_1}}:</label>
                                        <div class="uk-form-controls">
                                            <div class="onoffswitch-small">
                                                <input type="checkbox" class="onoffswitch-checkbox" @change="disable(index,index_1)" :id="index+'_'+index_1"
                                                       v-model="permissions[index][index_1]">
                                                <label class="onoffswitch-label" :for="index+'_'+index_1"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
                            <button @click="userSavePermission()" class="uk-button uk-button-primary" type="button">Сохранить доступ</button>
                        </div>
                    </article>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                permissions: {},
            }
        },
        mounted() {
            this.$http.get('/admin/user/get/permission/' + this.id).then(response => {
                this.permissions = response.data.permissions;

            });
        },
        methods: {
            onUpload: function (fields, e,) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('file', files[i]);
                }
                UIkit.notification({message: 'Подождите изображения загружаются!', status: 'success', timeout: 10000});
                axios.post('/admin/user/gallery/upload/' + this.id,
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

            disable:function(section,action){
                if(action === 'access' && !this.permissions[section][action]){
                    for(let i in this.permissions[section]){
                        this.permissions[section][i]=false;
                    }
                }
            },
            userSavePermission: function () {
                this.$http.post('/admin/user/save/permission/' + this.id, this.permissions).then(response => {
                    UIkit.notification({message: 'Доступ пользователя успешно сохранен!', status: 'success'});
                });
            },
        },
    }
</script>