<template>
    <div class="pie" :class="{'big':big,'biggest':biggest,'small':small}" style="position: relative;">
        <canvas ref="canvas" ></canvas>
        <div class="center" style="color: rgb(0, 0, 0);font-family: Montserrat;font-size: 36px;font-weight: 400;line-height: 25px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">{{value}}%</div>
    </div>
</template>

<script>
    export default {
        props: ['value', 'big', 'biggest','small'],
        data() {
            return {
                data: [
                    {label: 'data', value: 0},
                    {label: 'empty', value: 100},
                ],
                colors: ['#ff2338', '#eeeeee'],
                canvas: null,
                value_: 0,
                width: 200,
                height: 200,
                center:60,
            }
        },
        mounted() {

            this.canvas = this.$refs['canvas'];
            // this.drawPieChart(this.data, this.colors);
            if (this.small) {
                this.width = 80;
                this.height = 80;
                this.center = 0;
            }
            if (this.big) {
                this.width = 240;
                this.height = 240;
                this.center = 75;
            }
            if (this.biggest) {
                this.width = 260;
                this.height = 260;
            }
            this.value_ = this.value;
        },
        methods: {
            drawPieChart: function (data, colors) {
                let canvas = this.canvas;
                this.canvas.width = this.width;
                this.canvas.height = this.height;
                let ctx = canvas.getContext('2d');
                ctx.width = this.width;
                ctx.height = this.height;
                let x = this.width / 2;
                let y = this.height / 2;
                let color,
                    startAngle,
                    endAngle,
                    total = this.getTotal(data);


                startAngle = this.calculateStart(data, 0, total) - 1.5707963267948966;
                endAngle = this.calculateEnd(data, 0, total) - 1.5707963267948966;
                ctx.beginPath();
                ctx.fillStyle = this.colors[0];
                ctx.moveTo(x, y);
                ctx.arc(x, y, y, startAngle, endAngle);
                ctx.fill();

                startAngle = this.calculateStart(data, 1, total) - 1.5707963267948966;
                endAngle = this.calculateEnd(data, 1, total) - 1.5707963267948966;

                ctx.beginPath();
                ctx.fillStyle = this.colors[1];
                ctx.moveTo(x, y);
                ctx.arc(x, y, y, startAngle, endAngle);
                ctx.fill();

                ctx.beginPath();
                ctx.fillStyle = '#ffff';
                ctx.moveTo(x, y);
                ctx.arc(x, y, this.center, 0, 2 * Math.PI);
                ctx.fill();
            },

            calculatePercent: function (value, total) {

                return (value / total * 100).toFixed(0);
            },

            getTotal: function (data) {
                let sum = 0;
                for (let i = 0; i < data.length; i++) {
                    sum += data[i].value;
                }

                return sum;
            },

            calculateStart: function (data, index, total) {
                if (index === 0) {
                    return 0;
                }

                return this.calculateEnd(data, index - 1, total);
            },

            calculateEndAngle: function (data, index, total) {
                let angle = data[index].value / total * 360;
                let inc = (index === 0) ? 0 : this.calculateEndAngle(data, index - 1, total);

                return (angle + inc);
            },

            calculateEnd: function (data, index, total) {

                return this.degreeToRadians(this.calculateEndAngle(data, index, total));
            },

            degreeToRadians: function (angle) {
                return angle * Math.PI / 180
            },


        },
        watch: {
            value_: function (i) {
                let value = parseInt(i);
                this.data[0].value = (value>100?100:value);
                this.data[1].value = (value>100?0:100 - value);

                if (i >= 0 && i < 33) {
                    this.colors[0] = '#ff2338';
                }

                if (i >= 33 && i < 66) {
                    this.colors[0] = '#ffcc00';
                }
                if (i >= 66) {
                    this.colors[0] = '#0aa540';
                }

                this.drawPieChart(this.data,);
            }
        }

    }
</script>
