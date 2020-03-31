<template>
    <div class="my_team_body sales_plan_body">
        <div class="accordion" v-for="(year, key) in list">
            <div class="accordion-header block">
                {{(key-1)+'/'+key}}
                <div class="accordion-sub-header">
                    Продаж за год: <span>{{plan_to_years}}</span>
                </div>
                <div class="accordion-button"></div>
            </div>
            <div class="accordion-content-open sales_plan_body_grid">
                <div v-for="(quarter,key_ ) in year" class="sales_plan_body_item block"
                     :class="{'blure':!quarter.count}">
                    <a href="#" class="sales_plan_body_item_title">{{key_}} квартал:</a>
                    <span class="plan">{{quarter.plan || 0}}</span>
                    <pie-component :value="getPercent(quarter)"></pie-component>
                    <div class="pie gradient gr_1"
                         :style="{'--p':getPercent(quarter)}">
                        <div class="center"></div>
                    </div>
                    <a href="#" class="sales_plan_body_item_sub_title">Продажи</a>
                    <span class="plan">{{quarter.fact || 0}}</span>
                    <button @click="EditQuarter(key,key_)" class="button round button-gray-stroke">редактировать
                    </button>
                    <ul class="quarter_list">
                        <li class="header">По месяцам:</li>
                        <li v-for="(item,key__) in quarter.item" :class="{'blure':!item}">
                            <pie-component v-if="item" :value="getPercent(quarter)" :small="true"></pie-component>
                            <div v-if="item" class="quarter_list_data">
                                <span class="month">{{month[item.month]}}</span>
                                <span class="percent">{{getPercent(item)}}%</span>
                                <span class="fact">{{item.fact}}</span>
                            </div>
                            <pie-component v-if="item" :value="getPercent(quarter)" :small="true"></pie-component>
                            <div v-if="!item" class="quarter_list_data">
                                <span class="month">{{month[key__]}}</span>
                                <span class="percent">0%</span>
                                <span class="fact">0</span>
                            </div>
                        </li>
                    </ul>
                </div>

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
                        <div class="row" v-if="current_plan">
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

        <div class="offcanvas" ref="sales_quarter_modal" rel="sales_plan_month_modal">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body">
                    <a href="#" class="modal-body-header">Продажи за квартал:</a>
                    <div class="form">
                        <div class="row" v-if="current_plan">
                            <label for="name">Сумма:</label>
                            <input id="name" type="text" v-model="current_plan.plan">
                        </div>
                        <div class="row flex-center">
                            <button @click="saveEditQuarter()" ref="motivation_modal_close"
                                    class="button round button-yellow-stroke">сохранить
                            </button>
                        </div>
                        <div class="row flex-center">
                            <a href="#" class="button round button-gray-stroke"
                               ref="sales_plan_month_modal_close" @click="hiddenEditQuarter()">отменить</a>
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
                current_plan: {
                    fact:0,
                },
                year_edit: null,
                quarter_edit: null,
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
            saveEditQuarter: function () {
                console.log(this.year_edit, this.quarter_edit, this.current_plan.plan);
                let obj = {
                    id: this.id,
                    year: this.year_edit,
                    quarter: this.quarter_edit,
                    plan: this.current_plan.plan
                };
                this.$http.post('/home/plan/quarter/update', obj).then(
                    response => {
                        console.log(response.data);
                        this.getData();
                        this.$refs['sales_quarter_modal'].classList.remove('active');
                    }
                )

            },
            hiddenEditQuarter: function () {
                this.current_plan = {};
                this.$refs['sales_quarter_modal'].classList.remove('active');

            },
            EditQuarter: function (year, quarter) {
                this.year_edit = year;
                this.quarter_edit = quarter;
                console.log(year, quarter, this.list[year][quarter]);
                this.current_plan = this.list[year][quarter];
                this.$refs['sales_quarter_modal'].classList.add('active');

            },
            getPercent: function (item) {
                if (item.plan > 0) {
                    let percent = Math.ceil((item.fact / item.plan) * 100);

                    if (percent > 100) {
                        return 100;
                    }

                    if (percent < 0) {
                        return 0;
                    }
                    return percent;
                }

                return 0;

            },
            getClass: function (item) {
                let percent = this.getPercent(item);

                if (percent >= 0 && percent < 33) {
                    return {'gr_1': true}
                }
                if (percent >= 33 && percent < 66) {
                    return {'gr_2': true}
                }
                if (percent >= 66) {
                    return {'gr_3': true}
                }
            },
            getData: function () {
                this.$http.get('/home/get/my-team/plan/' + this.id).then(response => {
                    this.list = response.data.list;
                    this.plan_to_years = response.data.plan_to_years;
                });
            },
            save: function () {
                this.$http.put('/home/plan/save/' + this.current_plan.id, this.current_plan).then(response => {
                    this.list = response.data;
                    this.hiddenEdit();
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
<style>
    .blure {
        filter: grayscale(100%);
    }
</style>
