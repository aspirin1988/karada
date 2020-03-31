<template>
    <div class="center-center">
        <div class="block modal-body" v-if="!reset">
            <div class="close" rel="close-login"></div>
            <a href="#" style="display: inline-block; border-radius: 23px; background-color: rgb(255, 204, 0); padding: 10px 30px;" class="modal-body-header">Вход</a>
            <div class="form">
                <div class="row">
                    <label for="name">E-mail:</label>
                    <input type="email" v-model="email" name="email">
                </div>
                <div class="row">
                    <label for="name">Пароль:</label>
                    <input type="password" v-model="password" name="password">
                </div>
                <div class="row">
                    <button @click="Send" class="button-yellow-stroke">Войти</button>
                </div>
                <div class="error" v-html="messages"></div>
                <div class="">
                    <label class="label-checkbox">
                        <a href="#" @click="ResetPassword" >Забыли пароль?</a>
                    </label>
                </div>
            </div>
        </div>
        <div class="block modal-body" v-if="reset && !show_message">
<!--            <div class="close" rel="close-login"></div>-->
            <a href="#" style="display: inline-block; border-radius: 23px; background-color: rgb(255, 204, 0); padding: 10px 30px;" class="modal-body-header">Востановление пароля</a>
            <div class="form">
                <div class="row">
                    <label for="name">E-mail:</label>
                    <input type="email" v-model="email" name="email">
                </div>
                <div class="row">
                    <button style="margin-top: 15px;" @click="SendRequest" class="button-yellow-stroke">Отправить запрос</button>
                    <button style="margin-top: 15px; background: #ff0000" @click="ResetCancel" class="button-yellow-stroke">Отмена</button>
                </div>
            </div>
        </div>
        <div class="block modal-body" v-if="reset && show_message">
<!--            <div class="close" rel="close-login"></div>-->
            <a href="#" style="display: inline-block; border-radius: 23px; background-color: rgb(255, 204, 0); padding: 10px 30px;" class="modal-body-header">Пароль изменен!</a>
            <p style="color: #031a29; font-family: Montserrat; font-size: 20px; font-weight: 400; line-height: 30px; width: 236px; margin: 15px auto; ">
                Новый пароль выслан на Ваш e-mail
            </p>
            <button style="margin-top: 15px;" @click="Ok" class="button-yellow-stroke">Ok</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: "",
                password: "",
                messages: "",
                reset: false,
                show_message: false,
            }
        },
        mounted() {
        },
        methods: {
            Ok:function(){
                this.reset = false;
                this.show_message = false;
                $('[rel="login-modal"]').removeClass('active');
                $('body').css('overflow-y', 'auto');
            },
            ResetPassword:function(){
                this.reset = true;
            },
            ResetCancel:function(){
                this.reset = false;
            },
            SendRequest:function(){
                let obj = {
                    email: this.email,
                };

                this.$http.post('/password/email', obj).then(response => {
                    this.show_message = true;
                }).catch(error => {
                });
            },
            Send: function () {
                let obj = {
                    email: this.email,
                    password: this.password,
                };

                this.$http.post('/login', obj).then(response => {
                    location.href = '/home';
                }).catch(error => {
                    this.messages = '';
                    let data = error.response.data;
                    if (data.errors) {
                        for (let item in data.errors) {
                            for (let item_ in data.errors[item]) {
                                this.messages += '<p>' + data.errors[item][item_] + '</p>';
                            }
                        }
                    }
                });

                console.log(obj);
            }

        },
        watch: {}

    }
</script>
