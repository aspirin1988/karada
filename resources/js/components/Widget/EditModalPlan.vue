<template>
    <div>
        <div class="offcanvas" ref="sales_plan_month_modal" rel="sales_plan_month_modal">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body" style="width: 420px;  max-height: 410px;">
                    <a href="#" class="modal-body-header">План продаж на год:</a>
                    <p style=" max-width: 250px; margin:20px auto 0 auto; color: #8d8d8d; font-family: Montserrat; font-size: 14px; font-style: italic; line-height: 21px;">
                        Данная сумму будет равномерно распределена на 12 месяцев.
                    </p>
                    <div class="form">
                        <div class="row">
                            <label for="name">Сумма:</label>
                            <input-money-component v-model="plan_to_years" ></input-money-component>
                        </div>
                        <div class="row flex-center">
                            <a href="#" ref="motivation_modal_close" @click="saveData()"
                               class="button round button-yellow-stroke">сохранить</a>
                        </div>
                        <div class="row flex-center">
                            <a href="#" class="button round button-gray-stroke"
                               ref="sales_plan_month_modal_close" @click="hiddenEdit()">отменить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                plan_to_years: 0,
                show_add: false,
                list: {},
                modal: null,
            }
        },
        mounted() {
            this.getData();
            this.modal = document.querySelector('[rel="sales_plan_edit_modal"]');
        },
        methods: {
            Checked: function () {
                console.log(this.plan_to_years.length);
                if (this.plan_to_years.length >= 15) {
                    event.preventDefault();
                    return false;
                }
            },
            setFormat: function () {
                this.plan_to_years = this.plan_to_years.replace(/\s/g, '');
                this.plan_to_years = this.plan_to_years.replace(/\B(?=(?:\d{3})+(?!\d))/g, ' ');
            },

            getData: function () {
                this.$http.get('/home/get/user/plan/' + this.id).then(response => {
                    this.plan_to_years = response.data;
                    this.setFormat();
                });
            },
            hiddenEdit: function () {
                this.modal.classList.remove('active');
            },
            saveData: function () {
                let plan_to_years = this.plan_to_years.replace(/\s/g, '');
                this.$http.post('/home/sales_plan/update/' + this.id, {'plan_to_years': plan_to_years}).then(response => {
                    // this.plan_to_years = response.data;
                    this.modal.classList.remove('active');
                    location.reload();
                });
            }

        },
        watch: {
            getSalesPlanId: function (i) {
                console.log(i);
            },
        }

    }
</script>
