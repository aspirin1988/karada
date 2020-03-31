<template>
	<div>
		<header class="uk-content-header uk-background-default">
			<div class="title"><h2>Страницы</h2></div>
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
							<label class="uk-form-label" for="slug">Ключевое слово:*</label>
							<div class="uk-form-controls">
								<input v-model="list.slug" class="uk-input uk-form-width-large" id="slug" type="text" placeholder="Ключевое слово" autocomplete="off">
							</div>
						</div>
						<!--<div class="uk-margin">-->
							<!--<label class="uk-form-label" for="text">Текст:</label>-->
							<!--<div class="uk-form-controls">-->
								<!--<html-editor-component :id="'d1'" v-model="list.text"></html-editor-component>-->
							<!--</div>-->
						<!--</div>-->
                        <!--<div class="uk-margin">-->
                            <!--<label class="uk-form-label" for="thumb">thumb:*</label>-->
                            <!--<div class="uk-form-controls">-->
                                <!--<input v-model="list.thumb" class="uk-input" id="thumb" type="text" placeholder="thumbnail" autocomplete="off">-->
                            <!--</div>-->
                        <!--</div>-->
						<!--<div class="uk-margin">-->
							<!--<label class="uk-form-label" for="status">Сменить статус:</label>-->
							<!--<div class="uk-form-controls">-->
								<!--<select class="uk-select uk-width-1-2@m" v-model="list.status" id="status">-->
									<!--<option>Не назначен</option>-->
									<!--<option value="0">Не опубликована</option>-->
									<!--<option value="1">Опубликована</option>-->
								<!--</select>-->
							<!--</div>-->
						<!--</div>-->
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
                    title: '',
                    slug: '',
                    status: '0',
                },
                rules: {
                    title: 'required',
                    slug: 'required',
                    // text: 'required',
                }
            }
        },
        mounted() {},
        methods: {
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {

                    this.$http.put('/admin/page/add/', this.list).then(response => {
                        let item  = response.data;
                        if(item.id) {
                            UIkit.notification({message: 'Страница успешно создана!', status: 'success'});
                            setTimeout(() => {
                                location.href = '/admin/page/edit/'+item.id;
                            }, 500);
                        }
                    });
                }
            },
        },
    }
</script>
