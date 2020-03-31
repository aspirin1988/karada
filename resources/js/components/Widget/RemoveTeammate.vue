<template>
    <div>
        <a href="#" class="button round button-gray-stroke" @click="DeleteTeammate">удалить cотрудника</a>
        <div ref="delete_teammate" class="offcanvas">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body" style="width: 312px;">
                    <a href="#" class="modal-body-header" style="color: #37a2e9;">УДАЛИТЬ</a>
                    <div class="form">
                        <p style="font-family: Montserrat; font-size: 18px;" >Вы уверены, что хотите удалить этого сотрудника? </p>
                        <div class="row flex-center">
                            <button class="button round button-blue-stroke" @click="Confirm()">Удалить</button>
                        </div>
                        <div class="row flex-center">
                            <a href="#" class="button round button-gray-stroke" @click="Cancel()">отменить</a>
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
            DeleteTeammate: function () {
                this.modal.classList.add('active');
            },
            Cancel: function () {
                this.modal.classList.remove('active');
            },
            Confirm: function () {
                this.$http.delete('/home/remove/teammate/' + this.id).then(
                    response => {
                        let data = response.data;
                        if(data.result){
                            location.reload();
                        }
                    },
                );
            }
        },
        watch: {
            month: function () {
                this.getMonth();
            },
            year: function () {
                this.getMonth();
            }
        }

    }
</script>
