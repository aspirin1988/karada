<template>
    <div :style="{textAlign: 'center'}">
        <div class="error" v-html="error"></div>
        <label for="upload_ava" :style="{display: 'inline-flex'}" class="button round button-blue-stroke " :class="{'no-correct':nocorrect}">изменить фото</label>
        <input id="upload_ava" :style="{opacity:0, zIndex: 1,position:'absolute'}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
               type="file" @change="onUpload">
    </div>
</template>

<script>
    export default {
        data() {
            return {
                nocorrect: false,
                error: '',
            }
        },
        mounted() {
        },
        methods: {
            onUpload: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    if (files[i].size <= 1024000) {
                        this.error = '';
                        this.nocorrect = false;
                        formData.append('file[]', files[i]);
                    } else {
                        this.error = 'Размер файла больше 1 мб.';
                        this.nocorrect = true;
                        return false;
                    }
                }
                axios.post('/home/upload/ava',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        console.log(response.data);
                        location.reload();
                        UIkit.notification({message: 'Изображения успешно загружено!', status: 'success'});
                        this.getGalleryList();
                    }else{
                        this.error = response.data.message;
                        this.nocorrect = true;
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки изображений произошла ошибка!', status: 'danger'});
                    });

            },

        }

    }
</script>
