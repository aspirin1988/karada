<template>
    <div class="sales_plan_header_buttons">
        <div class="sales_plan_header_progress">
            <div class="form">
                <input-money-component v-model="plan_to_years" ></input-money-component>
            </div>
        </div>
        <button @click="CreatePlan()" ref="sales_plan_edit" class="button round button-gray-stroke">{{title}}</button>
    </div>
</template>

<script>
    export default {
        props: ['user_id', 'title'],
        data() {
            return {
                plan_to_years: '',
                show_add: false,
            }
        },
        mounted() {
        },
        methods: {
            CreatePlan: function () {
                if (this.plan_to_years > 0) {
                    let obj = {};
                    obj.plan_to_years = this.plan_to_years.toString().replace(/\s/g, '');
                    if (this.user_id) {
                        obj.user_id = this.user_id;
                    }
                    this.$http.post('/home/sales_plan/create', obj).then(response => {
                        location.reload();
                    })
                }
            }
        }

    }
</script>
