<template>
	<article class="uk-comment uk-textarea uk-position-relative">
		<header class="uk-comment-header uk-news-grid">
			<div class="uk-img-container uk-width-auto uk-position-relative uk-background-secondary">
				<img class="uk-comment-avatar" :src="item.ava || '/img/empty.jpg'" alt="">
			</div>
			<div>
				<h4 class="uk-comment-title uk-margin-remove">
					<span class="uk-link-reset">{{item.first_name}}</span>
				</h4>
				<ul class="uk-comment-meta uk-list uk-child-padding-remove">
					<li>
						<span class="uk-link-muted">
							ID:<strong>{{item.id}}</strong>
						</span>
					</li>
					<li>
						<span class="uk-link-muted">
							Login:<strong>{{item.email}}</strong>
						</span>
					</li>
					<li>
						<span class="uk-link-muted">
							Фамилия:<strong>{{item.last_name}}</strong>
						</span>
					</li>
					<li>
						<span class="uk-link-muted">
							<span>Отредактировано:</span>
							<strong>{{item.updated_at}}</strong>
						</span>
					</li>
				</ul>
			</div>
			<div class="uk-comment-footer uk-padding-small" :class="classObject">
				<a class="uk-button uk-button-default uk-background-muted uk-button-secondary" :href="'/admin/user/edit/'+item.id">
					<span class="uk-text-success" uk-icon="file-edit"></span>
				</a>
				<button @click="del(item)" title="Удалить пользователя" class="uk-button uk-button-default">
					<span uk-icon="trash"></span>
				</button>
				<button @click="lock(item)" title="Блокировать пользователя" class="uk-button uk-button-secondary">
					<span uk-icon="lock"></span>
				</button>
				<button v-if="item.blocked" @click="unlock(item)" title="Разблокировать пользователя" class="uk-button uk-button-primary">
					<span uk-icon="unlock"></span>
				</button>
			</div>
		</header>
		<div class="uk-comment-body">
			<hr>
			<p class="uk-padding-small uk-padding-remove-top" v-html="item.announce"></p>
		</div>
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

            loginAs:function(user){
                this.$http.get('/admin/user/login/as/' + user.id).then(response => {
                    let data = response.data;
                    if(data.result){
                        location.href='/admin/';
					}
                });
			},
			lock:function (item) {
                this.$http.get('/admin/user/lock/' + item.id).then(response => {
                    let list = response.data;
                    if(list.result){
                        this.$emit('update');
                    }
                });
            },
			unlock:function (item) {
                this.$http.get('/admin/user/unlock/' + item.id).then(response => {
                    let list = response.data;
                    if(list.result){
                        this.$emit('update');
                    }
                });
            },
            del: function (item) {
                this.$http.post('/admin/user/delete', {id: item.id}).then(response => {
                    let list = response.data;
                    if(list.result){
                        this.$emit('update');
                    }
                });
            }
        }
    }
</script>
