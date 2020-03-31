<template>
	<div>
		<header class="uk-content-header uk-background-default">
			<div class="title"><h2>Профиль</h2></div>
		</header>
		<div class="uk-margin-top">
			<article class="uk-comment uk-textarea uk-padding-small">
				<header class="uk-comment-header uk-flex-middle uk-padding-small">
					<div class="uk-margin-large">
						<div class="uk-margin">
							<label class="uk-form-label" for="name">Имя:*</label>
							<div class="uk-form-controls">
								<input v-model="list.name" class="uk-input uk-form-width-large" id="name" type="text" placeholder="Имя" disabled="disabled" autocomplete="off">
							</div>
						</div>
						<div class="uk-margin">
							<label class="uk-form-label" for="login">Логин :*</label>
							<div class="uk-form-controls">
								<input v-model="list.login" class="uk-input uk-form-width-large" id="login" type="text" placeholder="Логин" autocomplete="off" disabled="disabled">
							</div>
						</div>
						<div class="uk-margin">
							<label class="uk-form-label" for="password">Пароль:*</label>
							<div class="uk-form-controls">
								<input v-model="list.password" class="uk-input uk-form-width-large" id="password" type="text" placeholder="Пароль" autocomplete="off">
							</div>
						</div>
						<div class="uk-margin">
							<label for="status" class="uk-form-label">Статус пользователя:</label>
							<div class="uk-form-controls">
								<select class="uk-select uk-form-width-large" id="status" v-model="list.status" disabled="disabled">
									<option value="editor" selected="selected">Редактор</option>
									<option value="chief">Выпускающий</option>
									<option value="chief_extend">Выпускающий (расширеный)</option>
									<option value="admin">Администратор</option>
									<option value="limited">Корректор</option>
									<option value="onlycomments">Модератор комментариев</option>
								</select>
							</div>
						</div>
						<div class="uk-margin">
							<label class="uk-form-label" for="job">Должность:*</label>
							<div class="uk-form-controls">
								<input v-model="list.job" class="uk-input uk-form-width-large" id="job" type="text" placeholder="Должность" autocomplete="off" disabled="disabled">
							</div>
						</div>
						<div class="uk-margin">
							<label for="office" class="uk-form-label">Подразделение:</label>
							<div class="uk-form-controls">
								<select class="uk-select uk-form-width-large" id="office" v-model="list.office" disabled="disabled">
									<option value="editor" selected="selected">Служба информации</option>
									<option value="support">Технический департамент</option>
								</select>
							</div>
						</div>
						<div class="uk-margin">
							<label for="city" class="uk-form-label">Город:</label>
							<div class="uk-form-controls">
								<select class="uk-select uk-form-width-large" id="city" v-model="list.city" disabled="disabled">
									<option value="0">Выберите город</option>
									<option value="1" selected="selected">Алматы</option>
									<option value="2">Астана</option>
								</select>
							</div>
						</div>
						<div class="uk-margin">
							<label class="uk-form-label" for="link">Ссылка на профиль:*</label>
							<div class="uk-form-controls">
								<input v-model="list.link" class="uk-input uk-form-width-large" id="link" type="text" placeholder="Ссылка на профиль" autocomplete="off">
							</div>
						</div>
						<div class="uk-margin uk-margin-large-bottom">
							<label class="uk-form-label" for="photo_2">Фото:</label>
							<div class="uk-form-controls">
								<ul class="uk-list" uk-margin>
									<li class="uk-active"><span><img :src="list.photo" width="100" alt=""></span></li>
									<li><input v-model="list.photo" class="uk-input uk-form-width-large" id="photo_2" type="text" placeholder="Фото" autocomplete="off"></li>
									<li>
										<div class="js-upload uk-placeholder uk-text-center uk-position-relative">
											<input :style="{opacity:0, zIndex: 1}" class="uk-height-1-1 uk-position-top-left uk-width-1-1" type="file" multiple @change="onUpload(['photo'],$event)">
											<span uk-icon="icon: cloud-upload"></span>
											<span class="uk-text-middle">Перетащите файлы сюда или</span>
											<div uk-form-custom>
												<span class="uk-link">загрузите вручную</span>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<hr>
						<div class="uk-width-1-1 uk-text-center uk-margin-top uk-button-group uk-custom-grid@s">
							<button @click="userSave(false)" class="uk-button uk-button-success" type="button">Сохранить</button>
							<a :href="'/admin/user/'" class="uk-button uk-button-danger" type="button">Отмена</a>
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
            this.$http.get('/admin/profile/get').then(response => {
                this.list = response.data;
            });
        },
        methods: {
            onUpload: function (fields,e,) {
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
                    if(response.data.url) {
                        for (let i=0; i<fields.length; i++) {
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
                this.$http.post('/admin/profile/save', this.list).then(response => {
                    UIkit.notification({message: 'Пользователь успешно сохранен!', status: 'success'});
                    if (exit) {
                        setTimeout(() => {
                            location.href = '/admin/news/index';
                        }, 500);

                    }
                });
            },
        },
    }
</script>
