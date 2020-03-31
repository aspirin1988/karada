<template>
    <div>
        <div class="sales_plan_body_grid">
            <div class="sales_plan_body_item block" v-for="item in list">
                <a href="#" class="sales_plan_body_item_title">{{month[item.month]}}:</a>
                <span class="plan">{{new Intl.NumberFormat('ru-RU').format(item.fact.toString().replace(/\s/g, ''))}}</span>
                <pie-component v-if="item" :value="getPercent(item)"></pie-component>
            </div>
        </div>
        <div class="offcanvas" ref="sales_plan_month_modal" rel="sales_plan_month_modal">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body">
                    <a href="#" class="modal-body-header">Продажи за месяц:</a>
                    <p style=" max-width: 250px; margin:20px auto 0 auto; color: #8d8d8d; font-family: Montserrat; font-size: 14px; font-style: italic; line-height: 21px;" >
                        Выполненные продажи за данный месяц
                    </p>
                    <div class="form">
                        <div class="row" v-if="current_plan" >
                            <label for="name">Сумма:</label>
                            <input type="text" v-model="current_plan.fact" @keyup="setFormat" @keypress="Checked">
                        </div>
                        <div class="row flex-center">
                            <button @click="save()" ref="motivation_modal_close"
                                    class="button round button-yellow-stroke">сохранить
                            </button>
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
                list: [],
                current_plan: {},
                month: {
                    1: 'Январь',
                    2: 'Февраль',
                    3: 'Март',
                    4: 'Апрель',
                    5: 'Май',
                    6: 'Июнь',
                    7: 'Июль',
                    8: 'Август',
                    9: 'Сентябрь',
                    10: 'Октябрь',
                    11: 'Ноябрь',
                    12: 'Декабрь',
                }
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            Checked: function () {
                console.log(this.current_plan.fact.length);
                if (this.current_plan.fact.length >= 15) {
                    event.preventDefault();
                    return false;
                }
            },
            setFormat: function () {
                this.current_plan.fact = this.current_plan.fact.replace(/\s/g, '');
                this.current_plan.fact = this.current_plan.fact.replace(/\B(?=(?:\d{3})+(?!\d))/g, ' ');
            },
            getPercent:function(item){
                let percent = Math.ceil((parseInt(item.fact.toString().replace(/\s/g, ''))/parseInt(item.plan))*100);

                if(percent>100){
                    return percent;
                }

                if(percent<0){
                    return 0;
                }

                return  percent;

            },
            getClass:function(item){
                let percent = this.getPercent(item);

                if (percent >= 0 && percent < 33) {
                    return {'gr_1':true}
                }
                if (percent >= 33 && percent < 66) {
                    return {'gr_2':true}
                }
                if (percent >= 66) {
                    return {'gr_3':true}
                }
            },
            getData: function () {
                this.$http.get('/home/plan/list/get/' + this.id).then(response => {
                    this.list = response.data;
                });
            },
            save: function () {
                this.$http.put('/home/plan/save/' + this.current_plan.id, this.current_plan).then(response => {
                    this.list = response.data;
                    this.hiddenEdit();
                    location.reload();
                });
            },
            ShowEdit: function (item) {
                this.current_plan = item;
                this.$refs['sales_plan_month_modal'].classList.add('active');
            },
            hiddenEdit: function () {
                this.$refs['sales_plan_month_modal'].classList.remove('active');
                this.current_plan = null;

            },
        }

    }
</script>
