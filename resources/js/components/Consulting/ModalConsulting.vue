<template>
    <div class="uk-flex uk-flex-center">
        <div class="uk-width-1-1">
            <div class="uk-child-width-1-2@s" uk-grid="">
                <div class="uk-margin-small-top">
                    <span class="uk-display-block uk-form-label">Имя:</span>
                    <input class="uk-input uk-first-column uk-border-rounded" type="text"
                           v-model="form.name">
                </div>
                <div class="uk-margin-small-top">
                    <span class="uk-display-block uk-form-label">Телефон:</span>
                    <the-mask :mask="['+7(###) ### ## ##']" v-model="form.phone" class="uk-input uk-first-column uk-border-rounded" />
                </div>
            </div>
            <div class="uk-margin-small-top">
                <span class="uk-display-block uk-form-label">Краткое описание:</span>
                <textarea class="uk-textarea uk-width-1-1 uk-border-rounded uk-form-width-large"
                          v-model="form.description"
                          id="form-h-textarea" rows="5"></textarea>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['type'],
        data() {
            return {
                form: {
                    phone:'+7'
                },
            };
        },
        mounted() {

            let btns = document.querySelectorAll('.uk-send-'+this.type);
            let that = this;
            btns.forEach(function (btn) {
                if(btn.getAttribute('bind')!=='true') {
                    btn.setAttribute('bind','true');
                    btn.addEventListener('click', function () {
                        console.log(that);
                        that.SendForm(); // This doesn't work
                    });
                }
            });

        },
        methods: {
            SendForm: function () {
                this.form.type = this.type;

                if (!this.form.name) {
                    UIkit.notification({message: 'Поле <strong>Имя</strong> не может быть пустым !', status: 'danger'});
                    return false;
                }

                if (!this.form.phone) {
                    UIkit.notification({message: 'Поле <strong>Телефон</strong> не может быть пустым !', status: 'danger'});
                    return false;
                }


                this.$http.post('/consulting/order', this.form).then(response => {
                    let data = response.data;
                    if (data.result) {
                        let element = document.getElementById('modal-result');
                        this.form ={phone:'+7'};
                        this.form.type = this.type;
                        UIkit.modal(element).show();
                    }
                });
            },
        },
    }
</script>
