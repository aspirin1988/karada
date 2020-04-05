<template>
    <div>
        <button style="width: 50px;padding: 10px; margin-left: 10px;" class="button round button-blue-stroke"
                @click="Edit">
            <i style="margin:0;" class="icon config"></i>
        </button>
        <div ref="delete_teammate" class="offcanvas">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body" style="width: 445px;">
                    <a href="#" class="modal-body-header">Изменить цель:</a>
                    <div style="position: relative">
                        <label for="upload_goals">
                            <img style="width: 160px; height: 160px; object-fit: cover;" class="add-photo"
                                 @mouseover="setPlus()" @mouseout="unsetPlus()" ref="add-photo"
                                 :src="list.image||'/images/add-photo.png'" alt="">
                        </label>
                        <label for="upload_goals" style="width: 190px;margin: 10px auto;height: 40px;"
                               class="button round button-blue-stroke">заменить фото</label>
                        <input id="upload_goals"
                               style="opacity: 0;z-index: 1;position: absolute;width: 100%;height: 160px;;left: 0;top: 0;"
                               class="uk-height-1-1 uk-position-top-left uk-width-1-1"
                               accept=".jpg,.png,.jpeg"
                               type="file" @change="onUpload" @mouseover="setPlus()" @mouseout="unsetPlus()">
                    </div>
                    <div class="form">
                        <div class="row" style="position: relative;">
                            <label for="">Описание:</label>
                            <textarea v-model="list.description" @keyup="Checked" @keypress="Checked" @change="Checked"
                                      style="border: none;color: #010101;font-family: Montserrat;font-size: 14px;padding: 5px;box-sizing: border-box;"></textarea>
                            <label
                                style="display: inline-block;position: absolute;right: 25px;bottom: -5px; color: #b3b3b3; font-family: Montserrat; font-size: 12px;">{{list.description.length}}/30</label>
                        </div>
                        <div class="row">
                            <label for="">Дата выполнения::</label>
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
                        <div class="row flex-center" style="margin-top: 15px;">
                            <button style="width: 250px; height: 50px; padding: 10px 15px; font-size: 18px;"
                                    @click="Save()" class="button round button-yellow-stroke">сохранить
                            </button>
                        </div>
                        <div class="row flex-center" style="margin-top: 15px;">
                            <a href="#" style="width: 200px; height: 50px; padding: 10px 15px; font-size: 18px;"
                               class="button round button-gray-stroke" @click="Cancel">отменить</a>
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
                list: {
                    description: '',
                },
                year: 0,
                month: 1,
                day: 1,
                modal: null,
                day_list: [],
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
            this.modal = this.$refs['delete_teammate'];
        },
        methods: {
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

                    let reader = new FileReader();

                    reader.onload = (e) => {
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
                }else {
                    this.error = 'Данный тип файла запрещен для загрузки!';
                }

            },
            Checked: function () {
                if (this.list.description.length >= 30) {
                    this.list.description = this.list.description.substr(0, 30);
                    event.preventDefault();
                    return false;
                }
            },
            getData: function () {
                this.$http.get('/home/personal_goals/get/' + this.id).then(
                    response => {
                        this.list = response.data;
                        let arr = this.list.date_end.split('-');
                        console.log(arr);
                        this.year = parseInt(arr[0]);
                        this.month = parseInt(arr[1]);
                        this.getMonth();
                        setTimeout(() => {
                            this.day = parseInt(arr[2]);
                            console.log(this.day);
                        }, 300);
                    }
                )
            },
            Save: function () {

                this.list.date_end = this.year + '-' + this.month + '-' + this.day;

                let formData = new FormData();

                formData.append('file[]', this.file);
                formData.append('description', this.list.description);
                formData.append('date_end', this.list.date_end);

                this.$http.post('/home/personal_goals/update/' + this.id, formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(
                    response => {
                        let data = response.data;

                        if (data.result) {
                            location.reload();
                        }
                    }
                );

            },
            Edit: function () {
                this.modal.classList.add('active');
                this.getData();
            },
            Cancel: function () {
                this.modal.classList.remove('active');
            },
            Confirm: function () {
                this.$http.get('/home/personal_goals/approve/' + this.id).then(response => {
                    this.modal.classList.remove('active');
                    if (response.data.result) {
                        location.reload();
                    }
                });
            },
            getMonth: function () {
                let days = new Date(this.year, this.month - 1, 0).getDate();
                this.day_list = [];
                for (let i = 1; i <= days; i++) {
                    this.day_list.push(i);
                }
            },

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
