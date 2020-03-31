<template>
	<div>
		<header class="uk-content-header uk-background-default">
			<div class="title"><h2>Курс</h2></div>
		</header>
		<div class="uk-margin-top">
			<article class="uk-comment uk-textarea uk-padding-small">
				<header class="uk-comment-header uk-flex-middle uk-padding-small">
					<div class=" uk-margin-large">
						<div class="uk-margin">
							<label class="uk-form-label" for="title">Название:*</label>
							<div class="uk-form-controls">
								<input v-model="list.title" class="uk-input uk-form-width-large" id="title" type="text" placeholder="Название" autocomplete="off">
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
                    title: '',
                },
                rules: {
                    title: 'required',
                }
            }
        },
        mounted() {},
        methods: {
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {

                    this.$http.put('/admin/course/add/', this.list).then(response => {
                        let item  = response.data;
                        if(item.id) {
                            UIkit.notification({message: 'Страница успешно создана!', status: 'success'});
                            setTimeout(() => {
                                location.href = '/admin/course/edit/'+item.id;
                            }, 500);
                        }
                    });
                }
            },
        },
    }
</script>
