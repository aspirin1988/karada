<template>
    <div :style="{textAlign: 'center'}">
        <div class="error" v-html="error"></div>
        <label for="upload_backgroud" :style="{display: 'inline-flex'}" class="button round button-blue-stroke"
               :class="{'no-correct':nocorrect}">изменить фон</label>
        <input id="upload_backgroud" :style="{opacity:0, zIndex: 1, position:'absolute'}"
               class="uk-height-1-1 uk-position-top-left uk-width-1-1"
               type="file" @change="onUpload">
        <p style="color: #818181; font-family: Montserrat; font-size: 14px; font-weight: 400; line-height: 25px; padding: 15px 0 10px; display: block; text-align: center; max-width: 300px;">
            Фото не более 1 мб.
            <br>
            Фото будет автоматически отформатировано.
        </p>
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
                axios.post('/home/upload/background',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        setTimeout(() => {
                            location.reload();
                        }, 300);
                    } else {
                        this.error = response.data.message;
                    }
                })
                    .catch(function () {
                        setTimeout(() => {
                            location.reload();
                        }, 300);
                    });

            },

        }

    }
</script>
