<template>
    <div class="center-center">
        <div class="block modal-body">
            <a href="#" class="modal-body-header">Добавить цель:</a>
            <label for="upload_goals" style="position: relative; display: inline-block;">
                <img class="add-photo" ref="add-photo" src="/images/add-photo.png" alt="">
                <input id="upload_goals"
                       style="opacity: 0;z-index: 1;position: absolute;width: 100%;height: 100%;left: 0;top: 0;"
                       accept=".jpg,.png,.jpeg"
                       class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                       type="file" @change="onUpload" @mouseover="setPlus()" @mouseout="unsetPlus()">
            </label>
            <div style="text-align: center;" class="error" v-html="error"></div>
            <p style="color: #37a2e9; font-family: Montserrat; font-size: 13px; font-weight: 400; line-height: 18px;">
                Фото будет обработано под наш формат.</p>
            <div class="form">
                <div class="row" style="position: relative;">
                    <label for="">Описание:</label>
                    <textarea v-model="description" @keyup="Checked" @keypress="Checked" @change="Checked"
                              style="border: none;color: #010101;font-family: Montserrat;font-size: 14px;padding: 5px;box-sizing: border-box;"></textarea>
                    <label
                        style="display: inline-block;position: absolute;right: 25px;bottom: -5px; color: #b3b3b3; font-family: Montserrat; font-size: 12px;">{{description.length}}/30</label>
                </div>
                <div class="row">
                    <label for="">Дата выполнения:</label>
                    <select v-model="day">
                        <option :value="item" v-for="(item, key  ) in day_list">{{item}}</option>
                    </select>
                    <select v-model="month">
                        <option :value="key" v-for="(item, key  ) in month_list">{{item}}</option>
                    </select>
                    <select v-model="year">
                        <option :value="item" v-for="(item, key  ) in year_list">{{item}}</option>
                    </select>
                </div>
                <div class="" v-if="message">
                    <p class="error" v-html="message"></p>
                </div>
                <div class="row flex-center">
                    <button @click="Create()" class="button round button-yellow-stroke">сохранить</button>
                </div>
                <div class="row flex-center">
                    <a href="#" @click="Clear" class="button round button-gray-stroke">отменить</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                description: '',
                year: 0,
                month: 1,
                day: 1,
                file: null,
                day_list: [],
                message: '',
                error: '',
                month_list: {
                    1: 'Январь',
                    2: 'Февраль',
                    3: 'Март',
                    4: 'Апрель',
                    5: 'Май',
                    6: 'Июнь',
                    7: 'Июль',
                    8: 'Август',
                    9: 'Сентябрь',
                    10: 'Октябрь',
                    11: 'Ноябрь',
                    12: 'Декабрь',
                },
                year_list: [
                    2019,
                    2020,
                    2021,
                    2022,
                    2023,
                    2024,
                    2025,
                ]

            }
        },
        mounted() {
            let date = new Date();

            this.year = date.getFullYear();
            this.month = date.getMonth() + 1;
            this.day = date.getDate();
        },
        methods: {
            Clear: function () {
                this.description = '';
                this.file = null;
                this.$refs['add-photo'].setAttribute('src', '/images/add-photo.png');
            },
            Checked: function () {
                if (this.description.length >= 30) {
                    this.description = this.description.substr(0, 30);
                    event.preventDefault();
                    return false;
                }
            },
            setPlus: function () {
                if (this.$refs['add-photo'].getAttribute('src') === '/images/add-photo.png') {
                    this.$refs['add-photo'].setAttribute('src', '/images/add-photo_blue.png')
                }
            },
            unsetPlus: function () {
                if (this.$refs['add-photo'].getAttribute('src') === '/images/add-photo_blue.png') {
                    this.$refs['add-photo'].setAttribute('src', '/images/add-photo.png')
                }
            },
            onUpload: function (e) {

                let files = e.target.files;
                this.file = files[0];

                let type = this.file.type;
                let mime = type.split('/');
                mime = mime[0];
                console.log(type);

                if (mime === 'image') {
                    this.error = '';
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        console.log(this.$refs['add-photo']);
                        this.$refs['add-photo'].setAttribute('src', e.target.result);
                    };

                    reader.readAsDataURL(this.file);

                    // axios.post('/home/upload/background',
                    //     formData,
                    //     {
                    //         headers: {
                    //             'Content-Type': 'multipart/form-data'
                    //         }
                    //     }
                    // ).then(response => {
                    //     if (response.data.result) {
                    //         location.reload();
                    //         UIkit.notification({message: 'Изображения успешно загружено!', status: 'success'});
                    //         this.getGalleryList();
                    //     }
                    // })
                    //     .catch(function () {
                    //         UIkit.notification({message: 'При загрузки изображений произошла ошибка!', status: 'danger'});
                    //     });
                } else {
                    this.error = 'Данный тип файла запрещен для загрузки!';
                }

            },

            getMonth: function () {
                // let days = new Date(this.year, (this.month - 1), 0).getDate();
                let date = this.year + '-' + this.month + '-01';
                let days = this.$moment(date, 'YYYY-MM-DD').daysInMonth();
                this.day_list = [];
                for (let i = 1; i <= days; i++) {
                    this.day_list.push(i);
                }
            },
            Create: function () {

                if (!this.error) {

                    let formData = new FormData();
                    let date = this.year + '-' + this.month + '-' + this.day;
                    formData.append('file[]', this.file);
                    formData.append('description', this.description);
                    formData.append('date_end', date);

                    if (!this.file) {
                        this.message = 'Поле "Фото" не может быть пустым';
                        return false;
                    }
                    if (!this.description) {
                        this.message = 'Поле "Описание" не может быть пустым';
                        return false;
                    }

                    if (!date) {
                        this.message = 'Поле "Дата выполнения" не может быть пустым';
                        return false;
                    }

                    this.$http.post('/home/personal_goals/add', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }).then(response => {
                        if (response.data.result) {
                            location.reload();
                        }
                    });
                }
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
