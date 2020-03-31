<template>
	<article class="uk-comment uk-textarea uk-position-relative">
		<header class="uk-comment-header uk-news-grid">
			<div class="uk-img-container uk-width-auto uk-position-relative uk-background-secondary">
			</div>
			<div>
				<h4 class="uk-comment-title uk-margin-remove">
					<span class="uk-link-reset">{{item.title}}</span>
				</h4>
				<ul class="uk-comment-meta uk-list uk-child-padding-remove">
					<li>
						<span class="uk-link-muted">
							<span>Отредактировано:</span>
							<strong>{{item.updated_at}}</strong>
						</span>
					</li>
				</ul>
			</div>
			<div class="uk-comment-footer uk-padding-small" :class="classObject">
				<a class="uk-button uk-button-default uk-background-muted uk-button-secondary" :href="'/admin/test/edit/'+item.id">
					<span class="uk-text-success" uk-icon="file-edit"></span>
				</a>
				<button @click="del(item)" title="Удалить тест" class="uk-button uk-button-default">
					<span uk-icon="trash"></span>
				</button>
			</div>
		</header>
	</article>
</template>

<script>
    export default {
        props: {
            item: {
                type: Object,
                required: true
            }
        },
        data() {
            return {}
        },
        computed: {
            classObject: function () {
                return {
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
        },
        methods: {
            Update: function (data) {
                this.$emit('update', data);
            },

            del: function (item) {
                this.$http.delete('/admin/test/delete/' + item.id).then(response => {
                    let list = response.data;
                    if(list.result){
                        this.$emit('update');
					}
                });
            }
        }
    }
</script>
