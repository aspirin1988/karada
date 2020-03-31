<template>
    <input type="text" v-model="text" @keyup="setFormat" @keypress="Checked">
</template>

<script>
    export default {
        model: {
            prop: 'checked',
            event: 'change'
        },
        props: {
            checked: {},
            limit: {
                default: 15,
            },
        },
        data() {
            return {
                text: '',
            }
        },
        watch: {
            checked: function (i) {
                console.log(i);
                    this.text = this.checked.toString();
                    this.setFormat();

            },
        },
        mounted() {
        },
        methods: {
            Checked: function () {
                console.log(this.text.length);
                if (this.text.length >= this.limit) {
                    event.preventDefault();
                    return false;
                }
            },
            setFormat: function () {
                if (this.text) {
                    this.text = this.text.replace(/\s/g, '');
                    this.text = this.text.replace(/\B(?=(?:\d{3})+(?!\d))/g, ' ');

                    this.update();
                }
            },
            update: function () {
                let text = this.text.replace(/\s/g, '');

                this.$emit('change', text);
            },
        },


    }
</script>