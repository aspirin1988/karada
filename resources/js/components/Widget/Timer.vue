<template>
    <div></div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {}
        },
        mounted() {
            this.setTimer();
        },
        methods: {
            setTimer: function () {
                setInterval(() => {
                    this.$http.put('/home/user/time/inc', {user_id: this.id}).then(
                        response => {
                        },
                    )
                }, 10000);
            },
        }

    }
</script>
