<template>
    <div>
        <a href="#" class="button round button-yellow-stroke" @click="SendUpdate">подать заявку</a>
        <div ref="delete_teammate" class="offcanvas">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body" style="width: 350px;">
                    <a href="#" class="modal-body-header" style="color: #37a2e9;">Заявка отправлена!</a>
                    <div class="form">
                        <p>Заявка об изменении анкетных данных отправлена модератору сайта,
                        Мы свяжемся с вами и внесем изменения в самое ближайшее время!</p>
                        <div class="row flex-center">
                            <a href="#" class="button round button-yellow-stroke" @click="Cancel()">Ok</a>
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
                modal: null,
            }
        },
        mounted() {
            this.modal = this.$refs['delete_teammate'];
        },
        methods: {
            SendUpdate: function () {
                this.$http.get('/home/user/update/' + this.id).then(
                    response => {
                        this.modal.classList.add('active');
                    }
                )
            },
            Cancel:function () {
                this.modal.classList.remove('active');
            }
        },
        watch: {}

    }
</script>
