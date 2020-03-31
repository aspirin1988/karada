<template>
	<div>
		<div class="title"><span>Вопросы</span>
			<span v-if="!showAdd" class="uk-button  uk-button-primary" v-on:click="ShowAddQuestion" uk-icon="plus" ></span>
			<span v-if="showAdd"  class="uk-button uk-button-default" v-on:click="HideAddQuestion" uk-icon="trash" ></span>
		</div>
		<div v-if="showAdd" class="uk-form">
			<div class="uk-margin">
				<label class="uk-form-label" for="question">Вопрос:*</label>
				<div class="uk-form-controls">
					<input v-model="NewQuestion.question" class="uk-input uk-form-width-large" id="question" type="text"
						   placeholder="Вопрос" autocomplete="off">
				</div>
			</div>
			<div class="uk-margin">
				<label for="name">Варианты ответа*:</label>
			</div>
			<div class="uk-margin">
				<div class="uk-form-controls question-grid " v-for="(item, index) in NewQuestion.answers">
					<label>
						<input class="uk-radio" type="radio" name="answers[correct]" :value="index" v-model="NewQuestion.correct"> Ответ №{{index + 1}}
						<br>
						<button class="uk-button uk-button-default uk-button-small" @click="DelNew(index)">
							<span uk-icon="trash" class="uk-icon"></span>
						</button>
					</label>
					<div class="input-group">
						<input type="text" class="uk-input uk-form-width-large" :placeholder="'Ответ №'+(index+1)" v-model="NewQuestion.answers[index].answer" autocomplete="off" required>
						<textarea class="uk-textarea" placeholder="Description" v-model="NewQuestion.answers[index].description"></textarea>
					</div>
				</div>
			</div>
			<div class="uk-margin">
				<span class="uk-button uk-button-primary" v-on:click="AddAnswer"> Добавить ответ</span>
			</div>
			<div class="uk-margin">
				<div class="uk-button-group">
				<span v-on:click="AddQuestion" class="uk-button uk-button-primary"><span>Создать вопрос</span></span>
				<span v-on:click="HideAddQuestion" class="uk-button uk-button-danger"><span>Отмена</span></span>
				</div>
			</div>
		</div>
		<table class="uk-table uk-table-divider">
			<thead>
			<tr>
				<th>id</th>
				<th>Question</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<tr v-for="item in questions">
				<td>{{item.id}}</td>
				<td>{{item.question}}</td>
				<td>
					<ul class="uk-list">
						<li><span @click="ShowEditQuestion(item.id)" title="Редактировать" class="uk-button uk-button-small uk-button-primary"><span uk-icon="file-edit"> </span></span></li>
<!--						<li><span title="Поднять" @click="Up(item.id)" class="up">Поднять</span></li>-->
<!--						<li><span title="Опустить" @click="Down(item.id)" class="down">Опустить</span></li>-->
						<li><span title="Удалить" @click="Delete(item.id)"  class="uk-button uk-button-small uk-button-default"><span uk-icon="trash"></span></span></li>
					</ul>
				</td>
			</tr>
			</tbody>
		</table>
		<div class="uk-modal uk-flex-top"   uk-modal ref="showEdit">
			<div class="overlay"></div>
			<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
				<div class="modal-header">Радактироватние вопроса</div>
				<div class="modal-body">
					<div class="mainwrap">
						<div class="uk-form">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="question">Вопрос:*</label>
                                <div class="uk-form-controls">
                                    <input v-model="editQuestion.question" class="uk-input uk-form-width-large" type="text" placeholder="Вопрос" autocomplete="off">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label for="name">Варианты ответа*:</label>
                            </div>
                            <div class="uk-margin">
                                <div class="uk-form-controls question-grid " v-for="(item, index) in editQuestion.answers">
                                    <label>
										<input class="uk-radio" type="radio" name="answers[correct]" :value="index" v-model="editQuestion.correct"> Ответ №{{index + 1}}
										<br>
										<button class="uk-button uk-button-default uk-button-small" @click="DelEdit(index)">
											<span uk-icon="trash" class="uk-icon"></span>
										</button>
									</label>
                                    <div class="input-group">
                                        <input type="text" class="uk-input uk-form-width-large" :placeholder="'Ответ №'+(index+1)" v-model="editQuestion.answers[index].answer" autocomplete="off" required>
                                        <textarea class="uk-textarea" placeholder="Description" v-model="editQuestion.answers[index].description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <div class="uk-button-group">
                                    <span v-on:click="editAddAnswer" class="uk-button uk-button-primary"><span uk-icon="plus"></span></span>
                                </div>
                            </div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" @click="SaveQuestion" class="uk-button uk-button-small uk-button-primary">Сохранить</button>
					<button type="button" class="uk-button uk-button-small uk-button-danger" @click="HideEditQuestion">Отмена</button>
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
                showAdd: false,
                showEdit: false,
                questions: [],
                NewQuestion: {question: '', correct: false, answers: [{}, {}, {}]},
                editQuestion: {},
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
			DelEdit:function(index){
				this.editQuestion.answers.splice(index,1);
			},
			DelNew:function(index){
				this.NewQuestion.answers.splice(index,1);
			},

        	getData:function(){
				axios.get('/admin/test/get/questions/' + this.id+'/').then(response => {
					this.questions = response.data;
				});
			},
            Delete:function(id){
                axios.get('/admin/test/delete/questions/' + id+'/').then(response => {
                    if(response.data.result){
                        axios.get('/admin/test/get/questions/' + this.id+'/').then(response => {
                            this.questions = response.data;
                        });
					}
                });
			},
            AddQuestion: function () {
                if (this.NewQuestion.correct !== false && this.NewQuestion.question) {
                    console.log(this.NewQuestion);
                    axios.post('/admin/test/add/questions/' + this.id, this.NewQuestion).then(response => {
                        console.log(response.data);
                        this.HideAddQuestion();
                        this.questions = response.data;
                    });
                }
            },
            SaveQuestion: function () {
                console.log(this.editQuestion);
                axios.post('/admin/test/save/question/' + this.editQuestion.id, this.editQuestion).then(response => {
                    console.log(response.data);
                    this.HideEditQuestion();
					this.getData();
				});
            },
            ShowAddQuestion: function () {
                this.showAdd = true;
            },
            HideAddQuestion: function () {
                this.NewQuestion = {question: '', correct: false, answers: [{}, {}, {}]};
                this.showAdd = false;
            },
            AddAnswer: function () {
                this.NewQuestion.answers.push({});
            },
            editAddAnswer: function () {
                this.editQuestion.answers.push({});
            },
            ShowEditQuestion: function (id) {
                axios.get('/admin/test/get/question/' + id +'/').then(response => {
                    UIkit.modal(this.$refs['showEdit']).show();
                    this.editQuestion = response.data;
                });
            },
            HideEditQuestion: function () {
				UIkit.modal(this.$refs['showEdit']).hide();
                this.editQuestion = {};
            },
            SaveTest: function () {
                axios.post('/admin/test/save/' + this.id, this.test).then(response => {
                    console.log(response.data);
                });
            },
            Up: function (id) {
                console.log(id);
                axios.get('/admin/test/set_up/question/' + id).then(response => {
                    this.questions = response.data;
                });
            },
            Down: function (id) {
                console.log(id);
                axios.get('/admin/test/set_down/question/' + id).then(response => {
                    this.questions = response.data;
                });
            }
        },
    }
</script>
<style>
    .question-grid{
        display: grid;
        grid-template-columns: 115px auto;
        margin-bottom: 20px;
    }
</style>
