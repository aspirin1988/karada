<template>
	<div>
		<header class="uk-content-header uk-background-default">
			<div class="title"><h2>Отзыв</h2></div>
		</header>
		<div class="uk-margin-top">
			<article class="uk-comment uk-textarea uk-padding-small">
				<header class="uk-comment-header uk-flex-middle uk-padding-small">
					<div class=" uk-margin-large">
						<div class="uk-margin">
							<label class="uk-form-label" for="title">Заголовок:*</label>
							<div class="uk-form-controls">
								<input v-model="list.title" class="uk-input uk-form-width-large" id="title" type="text" placeholder="Заголовок" autocomplete="off">
							</div>
						</div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="type">Тип:*</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-form-width-large" v-model="list.type" id="type">
                                    <option value="" >Не назначен</option>
                                    <option value="book">О книге</option>
                                    <option value="course">О курсе</option>
                                    <option value="about">О Юсупе</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Имя:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.name" class="uk-input uk-form-width-large" id="name" type="text" placeholder="Имя" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="position">Должность:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.position" class="uk-input uk-form-width-large" id="position" type="text" placeholder="Должность" autocomplete="off">
                            </div>
                        </div>
						<div class="uk-margin">
							<label class="uk-form-label" for="text">Текст:*</label>
							<div class="uk-form-controls">
                                <textarea v-model="list.text" class="uk-textarea uk-form-width-large" rows="8" id="text" placeholder="Текст" autocomplete="off"></textarea>
							</div>
						</div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="video">Видео:</label>
                            <div class="uk-form-controls">
                                <input v-model="list.video" class="uk-input uk-form-width-large" id="video" type="text" placeholder="Видео" autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="image">Аватвр:</label>
                            <div class="uk-form-controls">
                                <img :src="list.image" width="90px" alt="">
                                <input v-model="list.image" class="uk-input uk-form-width-large" id="image" type="text" placeholder="Документ" autocomplete="off">
                            </div>
                            <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
                                <input :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                                       type="file" @change="onUploadImg">
                                <span uk-icon="icon: cloud-upload"></span>
                                <span class="uk-text-middle">Перетащите файлы сюда или</span>
                                <div uk-form-custom>
                                    <span class="uk-link">загрузите вручную</span>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="image">Документ:</label>
                            <div class="uk-form-controls">
                                <img :src="list.document" width="90px" alt="">
                                <input v-model="list.document" class="uk-input uk-form-width-large" id="document" type="text" placeholder="Документ" autocomplete="off">
                            </div>
                            <div class="js-upload uk-placeholder uk-text-center uk-position-relative">
                                <input :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                                       type="file" @change="onUploadDoc">
                                <span uk-icon="icon: cloud-upload"></span>
                                <span class="uk-text-middle">Перетащите файлы сюда или</span>
                                <div uk-form-custom>
                                    <span class="uk-link">загрузите вручную</span>
                                </div>
                            </div>
                        </div>
						 <hr>
						<div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
							<button @click="pageAdd" class="uk-button uk-button-success" type="button">Создать</button>
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
                list: {
                    type: '',
                    image: '',
                    document: '',
                },
                rules: {
                    name: 'required',
                    text: 'required',

                }
            }
        },
        mounted() {},
        methods: {
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {

                    this.$http.put('/admin/feedback/add/', this.list).then(response => {
                        let item  = response.data;
                        if(item.id) {
                            UIkit.notification({message: 'Отзыв успешно создан!', status: 'success'});
                            setTimeout(() => {
                                location.href = '/admin/feedback/edit/'+item.id;
                            }, 500);
                        }
                    });
                }
            },
            onUploadImg: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('file', files[i]);
                }
                axios.post('/admin/feedback/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        this.list.image = response.data.image;
                        UIkit.notification({message: 'Изображение успешно загружено!', status: 'success'});
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки изображения произошла ошибка!', status: 'danger'});
                    });

            },
            onUploadDoc: function (e) {
                let files = e.target.files;
                let formData = new FormData();

                for (let i = 0; i < files.length; i++) {
                    formData.append('file', files[i]);
                }
                axios.post('/admin/feedback/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if (response.data.result) {
                        this.list.document = response.data.image;
                        UIkit.notification({message: 'Изображение успешно загружено!', status: 'success'});
                    }
                })
                    .catch(function () {
                        UIkit.notification({message: 'При загрузки изображения произошла ошибка!', status: 'danger'});
                    });

            },
        },
    }
</script>
