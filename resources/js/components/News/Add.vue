<template>
	<div>
		<header class="uk-content-header uk-background-default">
			<div class="title"><h2>Новость</h2></div>
		</header>
		<div class="uk-margin-top">
			<article class="uk-comment uk-textarea uk-padding-small">
				<header class="uk-comment-header uk-flex-middle uk-padding-small">
					<div class=" uk-margin-large">
						<div class="uk-margin">
							<label class="uk-form-label" for="title">Название коллекции:*</label>
							<div class="uk-form-controls">
								<input v-model="list.name" class="uk-input uk-form-width-large" id="title" type="text" placeholder="Название коллекции" autocomplete="off">
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
                    slug: '',
                    status: '0',
                },
                rules: {
                    name: 'required',
                }
            }
        },
        mounted() {},
        methods: {
            pageAdd: function () {
                if (this.$validator.run(this.list, this.rules)) {

                    this.$http.put('/admin/media_collection/add', this.list).then(response => {
                        let item  = response.data;
                        if(item.id) {
                            UIkit.notification({message: 'Коллекция успешно создана!', status: 'success'});
                            setTimeout(() => {
                                location.href = '/admin/media_collection/edit/'+item.id;
                            }, 500);
                        }
                    });
                }
            },
        },
    }
</script>
