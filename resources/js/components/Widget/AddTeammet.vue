<template>
    <div>
        <div class="block modal-body">
            <a href="#" class="modal-body-header">Добавить сотрудника:</a>
            <div class="form">
                <div class="row">
                    <label for="email">E-mail:</label>
                    <input id="email" type="email" v-model="add.email">
                    <span>
                    Именно на эту почту придут доступы к порталу.
                    <br>
                    Не ошибитесь!
                </span>
                </div>
                <div class="row">
                    <label for="first_name">Имя:</label>
                    <input id="first_name" type="text" v-model="add.first_name">
                </div>
                <div class="row">
                    <label for="last_name">Фамилия:</label>
                    <input id="last_name" type="text" v-model="add.last_name">
                </div>
                <div class="row">
                    <label for="phone">Телефон:</label>
                    <input id="phone" type="text" v-model="add.phone">
                </div>
                <p style="color: #ff0000;font-family: Montserrat;" v-if="message">{{message}}</p>
                <div class="row flex-center margin-top">
                    <a href="#" rel="send" @click="send" class="button round button-yellow-stroke">отправить</a>
                </div>
                <div class="row flex-center">
                    <a href="#" class="button round button-gray-stroke" @click="cancel"
                       rel="cancel">отменить</a>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                add: {
                    email: '',
                    first_name: '',
                    last_name: '',
                    phone: '',
                },
                message: '',
                add_teammate: null,
                modal: null,
                close: null,
            }
        },
        mounted() {
            this.add_teammate = document.querySelector('[rel="add_teammate"]');
            window.modal = document.querySelector('[rel="add_teammate_confirm"]');
            this.close = document.querySelector('#add_teammate_confirm_close');
            if (this.close) {
                this.close.addEventListener('click', function () {
                    window.modal.classList.remove('active');
                    location.reload();
                });
            }
        },
        methods: {
            send: function () {
                this.$http.put('/home/add/teammate', this.add).then(response => {
                    let data = response.data;
                    if (data.result) {
                        window.modal.classList.add('active');
                        this.add_teammate.classList.remove('active');
                        this.email = '';
                    } else {
                        this.message = data.message;
                    }
                },reject =>{
                    let data = reject.response.data;
                    this.message = data.message;
                    setTimeout(()=>{
                        this.add_teammate.classList.remove('active');
                    },10000);
                });
            },
            cancel: function () {
                window.modal.classList.remove('active');
                this.add_teammate.classList.remove('active');
                this.email = '';
            }
        }

    }
</script>
