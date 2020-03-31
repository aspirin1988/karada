<template>
    <div>
        <div class="block password_update">
            <div class="form">
                <div class="row">
                    <label for="name">Старый пароль:</label>
                    <input v-model="obj.password" type="password" :class="{'no-correct':message}">
                    <label style=" font-weight: 700; color: #ff0000;" v-if="message">{{message}}</label>
                </div>
                <div class="row">
                    <label for="name">Новый пароль:</label>
                    <input v-model="obj.password_new" @keyup="valid()" :class="{'no-correct':is_valid===2}"
                           type="password">
                </div>
                <div class="row">
                    <label for="name">Повтор нового пароля:</label>
                    <input v-model="obj.password_new_c" @keyup="valid()" :class="{'no-correct':is_valid===2}"
                           type="password">
                    <label style=" font-weight: 700; color: #ff0000;" v-if="message_">{{message_}}</label>

                </div>

                <div class="row"><a href="#" @click="send" class="button round button-yellow-stroke ">сохранить</a>
                </div>
            </div>
        </div>
        <div class="offcanvas" ref="password_update_modal" rel="password_update_modal">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body">
                    <div class="sales_program">
                        <a href="#" style="color: #37a2e9; margin: 0" class="sales_program_title">Пароль изменен!</a>
                    </div>
                    <p style="color: #010101; font-family: Montserrat; font-size: 18px; font-weight: 400; line-height: 27px;">
                        Данные были изменены.
                        <br>
                        Используйте новый пароль для входа на сайт.
                    </p>
                    <div class="modal-body-sub-header">

                    </div>
                    <a style="width: 201px; height: 50px;" href="/" rel="sales_program_modal_close"
                       class="button round button-yellow-stroke">Ok</a>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                is_valid: 0,
                obj: {},
                message: null,
                message_: null,
                modal: null,
            }
        },
        mounted() {
            this.modal = this.$refs['password_update_modal'];
        },
        methods: {
            valid: function () {

                if (this.obj.password_new === this.obj.password_new_c) {
                    this.is_valid = 1;
                    this.message_ = null;
                } else {
                    this.is_valid = 2;
                    this.message_ = 'Пароли не совпадают';
                }
            },
            showMessage: function () {
                setTimeout(() => {
                    this.message = null;
                }, 5000);
            },
            send: function (e) {
                axios.post('/home/password/update', this.obj).then(response => {
                    if (response.data.result) {
                        // UIkit.notification({message: 'Пароль успешно обнавлен!', status: 'success'});
                        // location.href = '/home';
                        this.modal.classList.add('active');
                    } else {
                        this.message = 'Неверный пароль';
                        this.showMessage();
                    }
                })
                    .catch(function () {
                        // UIkit.notification({message: 'При обнавлении пароля произошла ошибка!', status: 'danger'});
                    });

            },

        }

    }
</script>
<style>
    .no-correct {
        border: 1px solid #ff2338 !important;
    }

    .block.password_update input {
        width: 100%;
    }
</style>
