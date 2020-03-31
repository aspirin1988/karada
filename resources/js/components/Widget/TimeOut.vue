<template>
    <div></div>
</template>

<script>
    export default {
        props: ['url'],
        data() {
            return {}
        },
        mounted() {
            this.setTimer();
        },
        methods: {
            setTimer: function () {
                setTimeout(() => {
                    this.$http.get(this.url).then(
                        response => {
                        },
                    )
                }, 10000);
            },
        }

    }
</script>
