<template>
    <div class="test_card">
        <button v-if="!test_run&&!showResult&&!show_form&&!form_send&&!repeat" class="uk-button uk-button-primary"
                v-on:click="testRun(false)">
            {{list.button || 'Начать'}}
        </button>
        <div v-if="repeat&&!test_run&&!showResult&&!show_form&&!form_send"
             style="flex-direction: column;justify-content: center;align-items: center;display: flex;">
            <div class="uk-flex uk-flex-center">
                <div class="uk-label">{{correct_answers}} из {{list.questions.length}}</div>
            </div>
            <img :src="Your_result.img" alt="">
            <p v-html="Your_result.text"></p>
            <button class="uk-button uk-button-primary"
                    v-on:click="testRun(true)">
                Попробуйте снова
            </button>
        </div>
        <div>
            <div v-if="test_run">
                <br>
                <div class="question-container block">
                    <div class="question-number">Вопрос {{current_number+1}}:</div>
                    <div class="question-text">{{current_question.question}}</div>
                </div>
                <ul class="answer-list">
                    <li v-for="(item,index) in current_question.answers" @click="SelectAnswer(index)">
                        <span class="number">{{alphabet[index]}}</span>
                        <span class="text" v-html="item.answer">Любое утверждение верно</span>
                    </li>
                    <!--                    <li><span class="number">b</span><span class="text">Все эти утверждения неверны</span></li>-->
                    <!--                    <li><span class="number">c</span><span class="text">Да пребудет с вами сила!</span></li>-->
                    <!--                    <li><span class="number">d</span><span class="text">Всё плохо</span></li>-->
                </ul>
                <a :href="back_url" ref="back-to-lesson" class="button round button-gray-stroke">Вернуться назад к
                    уроку</a>
                <br>
            </div>
            <div v-if="showResult">

                <div class="test-result block" v-if="correct_answers === list.questions.length">
                    <img src="/images/success_big.png" alt="">
                    <div class="test-result-test">Вы успешно прошли тест:
                    </div>
                    <a :href="next_url" class="button round button-blue-stroke "><span>К следующему уроку</span></a>
                </div>
                <div class="test-result block" v-else="">
                    <img src="/images/failed_big.png" alt="">
                    <div class="test-result-test">Вы не прошли тест:
                    </div>
                    <p class="description">Не отчаиваетесь! У вас всё получится! Просто вернитесь назад и еще раз
                        внимательно пройдите урок.</p>
                    <a :href="back_url" ref="back-to-lesson" class="button round button-blue-stroke ">Вернуться к
                        уроку</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id', 'lesson_id', 'back_url','next_url'],
        data() {
            return {
                url: location.href,
                showCorrect: false,
                showResult: false,
                test_run: true,
                repeat: false,
                correct_answers: 0,
                list: {questions: []},
                temp_list: null,
                current_number: 0,
                current_question: {},
                current_answer: false,
                correct_answer: false,
                show_form: false,
                form_send: false,
                Your_result: false,
                result: '',
                counts: 0,
                email: '',
                commands: [
                    'get_code',
                    'get_form',
                    'repeat_',
                ],
                alphabet: [
                    'a', 'b', 'c', 'd', 'e', 'f', 'g'
                ]
            }
        },
        mounted() {
            axios.get('/ajax/getTest/' + this.id + '/').then(response => {
                this.list = response.data;
                this.current_question = this.list.questions[this.current_number];
                this.temp_list = response.data;
            });
        },
        methods: {
            SendForm: function () {
                axios.post('/ajax/send/form/', {test_id: this.id, email: this.email}).then(response => {
                    this.show_form = false;
                    this.form_send = true;
                    this.result = response.data.result;
                });
            },
            nextQuestion: function () {
                this.current_number++;
                if (this.current_number === this.list.questions.length) {
                    this.test_run = false;
                    this.showResult = true;
                    if (this.correct_answers === this.list.questions.length) {
                        this.$http.post('/ajax/test_stat_set', {
                            'id': this.id,
                            'lesson_id': this.lesson_id,
                            'success': this.current_number === this.list.questions.length
                        }).then(response => {
                            console.log((response.data));
                        })
                    }
                } else {
                    this.current_answer = false;
                    this.correct_answer = false;
                    this.current_question = this.list.questions[this.current_number];
                    this.questions = [];
                }
            },
            testRun: function (repeat) {
                if (repeat) {
                    this.correct_answers = 0;
                    this.Your_result = false;
                }
                this.test_run = true;
                this.current_question = this.list.questions[this.current_number];
            },
            SelectAnswer: function (n) {

                if (this.current_answer === false) {

                    this.current_answer = n;

                    this.correct_answer = parseInt(this.current_question.correct);

                    if (this.current_answer !== this.correct_answer) {
                        this.showCorrect = true;
                    } else {
                        this.correct_answers++;
                    }

                    this.nextQuestion();
                }

            },
            get_code: function () {
                this.current_number = 0;
                axios.get('/ajax/getCode/' + this.id + '/').then(response => {
                    this.Your_result = response.data;
                });
            },
            get_form: function () {
                this.current_number = 0;
                this.show_form = true;
            },
            repeat_: function () {
                this.current_number = 0;
                this.current_answer = false;
                this.correct_answer = false;
                this.current_question = this.list.questions[this.current_number];
                this.questions = [];
                this.repeat = true;
            },
            classObject: function (index) {

                return {
                    'correct': ((this.correct_answer === this.current_answer && this.current_answer === index) || (this.showCorrect && this.correct_answer === index)),
                    'no-correct': (this.correct_answer !== this.current_answer && this.current_answer === index)
                }

            }
        },
        computed: {},
    }
</script>

<style>
    .test-result {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        align-content: center;
        padding: 30px;
    }

    .test-result > img {
        margin: 20px 0;
    }

    .test-result .test-result-test {
        text-align: center;
        max-width: 435px;
        color: #000000;
        font-family: Montserrat;
        font-size: 30px;
        font-weight: 700;
        line-height: 45px;
        margin-bottom: 40px;
    }

    @media (max-width: 640px) {
        .test-result .test-result-test {
            font-size: 20px;
            font-weight: 700;
            line-height: 25px;
        }
    }

    .test-result .button {
        height: 60px;
        color: #010101;
        font-family: Montserrat;
        font-size: 18px;
        font-weight: 700;
        line-height: 25px;
        text-transform: uppercase;
    }

    .description {
        margin: 0 0 30px;
        max-width: 450px;
        color: #000000;
        font-family: "Open Sans";
        font-size: 20px;
        font-weight: 400;
        line-height: 30px;
        text-align: center;
    }


</style>
