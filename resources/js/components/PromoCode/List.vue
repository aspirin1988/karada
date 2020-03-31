<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Промокоды
                    <div class="uk-inline">
                        <button @click="ShowAdd" class="uk-button uk-button-primary uk-button-small uk-border-rounded"
                                type="button"
                                uk-icon="plus"></button>
                    </div>
                </h2>
            </div>
        </header>
        <div class="uk-margin-top">
            <div v-if="list.length" class="content-section">
                <table class="uk-table uk-table-divider">
                    <thead>
                    <tr>
                        <td @click="setFieldSort('id')" :class="{'uk-text-bold':sort_field ==='id'}">ID
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='id'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='id'"></i>
                        </td>
                        <td @click="setFieldSort('code')" :class="{'uk-text-bold':sort_field ==='code'}">Название
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='code'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='code'"></i>
                        </td>
                        <td @click="setFieldSort('date_end')" :class="{'uk-text-bold':sort_field ==='date_end'}">Финиш
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='date_end'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='date_end'"></i>
                        </td>
                        <td @click="setFieldSort('discount')" :class="{'uk-text-bold':sort_field ==='discount'}">Сидка,
                            %
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='discount'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='discount'"></i>
                        </td>
                        <td @click="setFieldSort('count_use')" :class="{'uk-text-bold':sort_field ==='count_use'}">
                            Количество
                            <i uk-icon="triangle-down" v-if="sort_method && sort_field ==='count_use'"></i>
                            <i uk-icon="triangle-up" v-if="!sort_method && sort_field ==='count_use'"></i>
                        </td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="uk-background-default" v-for="item in list">
                        <td>{{item.id}}</td>
                        <td>{{item.code}}</td>
                        <td>{{item.date_end}}</td>
                        <td>{{item.discount}}</td>
                        <td>{{item.use}}/{{item.count_use}}</td>
                        <td>
                            <button @click="Edit(item)"
                                    class="uk-button uk-button-default uk-background-muted uk-button-small">
                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-button-small" disabled>
                                <span uk-icon="lock" class="uk-icon"></span>
                            </button>
                            <button class="uk-button uk-button-default uk-button-small" v-if="user_type==='super admin'"
                                    @click="Delete(item)">
                                <span uk-icon="trash" class="uk-icon"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--                <div class="content-section-grid">-->
                <!--                    <div class="content-section-grid-item" v-for="item in list">-->
                <!--                        <img class="thumbnail" :src="item.image">-->
                <!--                        <div class="text-section">-->
                <!--                            <div class="title">{{item.name}}</div>-->
                <!--                            <ul class="uk-comment-meta uk-flex">-->
                <!--                                <li class="uk-margin-right">ID: <strong>{{item.id}}</strong></li>-->
                <!--                                <li class="uk-margin-right">Отредактировано: <strong>{{item.updated_at}}</strong></li>-->
                <!--                                <li class="uk-margin-right">Дата создания: <strong>{{item.created_at}}</strong></li>-->
                <!--                            </ul>-->
                <!--                        </div>-->
                <!--                        <div class="buttons-section">-->
                <!--                            <a :href="'/admin/company/edit/'+item.id"-->
                <!--                               class="uk-button uk-button-default uk-background-muted uk-button-small">-->
                <!--                                <span uk-icon="file-edit" class="uk-text-success uk-icon"></span>-->
                <!--                            </a>-->
                <!--                            <button class="uk-button uk-button-default uk-button-small" disabled>-->
                <!--                                <span uk-icon="lock" class="uk-icon"></span>-->
                <!--                            </button>-->
                <!--                            <button class="uk-button uk-button-danger uk-button-small" @click="del(item)">-->
                <!--                                <span uk-icon="trash" class="uk-icon"></span>-->
                <!--                            </button>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>

            <!--            <div v-if="list.length">-->
            <!--                <widget-paginator-component :key="'upp'" :list="page_list" :current_page="current_page"-->
            <!--                                            :path="'/admin/company/'"></widget-paginator-component>-->
            <!--                <ul class="uk-comment-list">-->
            <!--                    <li v-for="item in list">-->
            <!--                        <company-list-item-component :item="item" :key="item.id" @Delete="Delete"></company-list-item-component>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--                <widget-paginator-component :key="'down'" :list="page_list" :current_page="current_page"-->
            <!--                                            :path="'/admin/company/'"></widget-paginator-component>-->
            <!--            </div>-->
            <div v-else="" class="uk-margin-top">
                <widget-preloader-component :load="load"></widget-preloader-component>
            </div>
        </div>
        <div ref="add-modal" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <div class="uk-margin">
                    <label class="uk-form-label" for="code">Название:*</label>
                    <div class="uk-form-controls">
                        <input v-model="new_promocode.code" class="uk-input uk-form-width-large" id="code" type="text"
                               placeholder="Название" autocomplete="off">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="discount">Скидка:*</label>
                    <div class="uk-form-controls">
                        <input v-model="new_promocode.discount" class="uk-input uk-form-width-large" id="discount"
                               type="text"
                               placeholder="Скидка" autocomplete="off">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="count_use">Количество:</label>
                    <div class="uk-form-controls">
                        <input v-model="new_promocode.count_use" class="uk-input uk-form-width-large" id="count_use"
                               type="text"
                               placeholder="Количество" autocomplete="off">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="count_use">Финиш:</label>
                    <div class="uk-form-controls">
                        <input v-model="new_promocode.date_end" class="uk-input uk-form-width-large" id="date_end"
                               type="date"
                               placeholder="Финиш" autocomplete="off">
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-primary" @click="AddNew()" type="button">Сохранить</button>
                    <button class="uk-button uk-button-danger uk-modal-close" type="button">Закрыть</button>
                </p>
            </div>
        </div>
        <div ref="edit-modal" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <div class="uk-margin">
                    <label class="uk-form-label" for="code">Название:*</label>
                    <div class="uk-form-controls">
                        <input v-model="current_promocode.code" class="uk-input uk-form-width-large" id="code"
                               type="text"
                               placeholder="Название" autocomplete="off">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="discount">Скидка:*</label>
                    <div class="uk-form-controls">
                        <input v-model="current_promocode.discount" class="uk-input uk-form-width-large" id="discount"
                               type="text"
                               placeholder="Скидка" autocomplete="off">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="count_use">Количество:</label>
                    <div class="uk-form-controls">
                        <input v-model="current_promocode.count_use" class="uk-input uk-form-width-large" id="count_use"
                               type="text"
                               placeholder="Количество" autocomplete="off">
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="count_use">Финиш:</label>
                    <div class="uk-form-controls">
                        <input v-model="current_promocode.date_end" class="uk-input uk-form-width-large" id="date_end"
                               type="date"
                               placeholder="Финиш" autocomplete="off">
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-primary" @click="Save()" type="button">Сохранить</button>
                    <button class="uk-button uk-button-danger uk-modal-close" type="button">Закрыть</button>
                </p>
            </div>
        </div>
        <div ref="delete-save" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <h2 class="uk-modal-title uk-text-warning">Предупреждение!</h2>
                <p> Вы действительно хотите удалить Промокод?</p>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Нет</button>
                    <button class="uk-button uk-button-primary" @click="deletePage" type="button">ДА!</button>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['current_page', 'user_type'],
        data() {
            return {
                list: [],
                rules: {
                    code: 'required',
                    discount: 'required',
                    count_use: 'required',
                    date_end: 'required',
                },
                page_list: null,
                load: false,
                delete_item: {},
                delete_dialog: false,
                add_modal: false,
                edit_modal: false,
                path: window.location.pathname,
                new_promocode: {},
                current_promocode: {},
                sort_field: 'id',
                sort_method: true,
            }
        },
        mounted() {
            this.delete_dialog = this.$refs['delete-save'];
            this.add_modal = this.$refs['add-modal'];
            this.edit_modal = this.$refs['edit-modal'];

            this.getList();
        },
        methods: {
            setFieldSort: function (field) {
                if (field === this.sort_field) {
                    this.sort_method = !this.sort_method;
                } else {
                    this.sort_field = field;
                }

                this.getList();
            },
            Edit: function (item) {
                this.current_promocode = item;
                UIkit.modal(this.edit_modal).show();
            },

            AddNew: function () {
                if (this.$validator.run(this.new_promocode, this.rules)) {
                    this.$http.put('/admin/promo_code/create', this.new_promocode).then(response => {
                        UIkit.modal(this.add_modal).hide();
                        this.getList();
                    });
                }
            },

            Save: function () {

                this.$http.put('/admin/promo_code/update', this.current_promocode).then(response => {
                    UIkit.modal(this.edit_modal).hide();
                    this.getList();
                });
            },

            ShowAdd: function () {
                console.log(this.add_modal);
                UIkit.modal(this.add_modal).show();

            },

            getList: function () {
                let pros = {
                    'sort_field': this.sort_field,
                    'sort_method': (this.sort_method ? 'asc' : 'desc'),
                };
                this.$http.post('/admin/promo_code/get/' + this.current_page, pros).then(response => {
                    this.list = response.data.list;
                    this.page_list = response.data.page_list;
                    this.load = true;
                });
            },
            Delete: function (item) {
                this.delete_item = item;
                UIkit.modal(this.delete_dialog).show();
            },
            Update: function (data) {
                this.list = data.list;
                this.page_list = data.page_list
            },
            deletePage: function (item) {
                this.$http.delete('/admin/promo_code/delete/' + this.delete_item.id).then(response => {
                    UIkit.modal(this.delete_dialog).hide();
                    this.getList();
                });
            }
        },
    }
</script>
<style>
    .uk-table.uk-table-divider tbody tr:nth-child(even) {
        background-color: #f9fcff;
    }
</style>
