
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueCodemirror from 'vue-codemirror';
import 'codemirror/lib/codemirror.css';
import 'codemirror/theme/base16-light.css';

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask);
Vue.use(VueCodemirror, /* {
  options: { theme: 'base16-dark', ... },
  events: ['scroll', ...]
} */);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('home_page-component', require('./components/Home/IndexPage.vue').default);
Vue.component('trial-component', require('./components/Home/Trial.vue').default);
Vue.component('config-component', require('./components/Home/Config.vue').default);

Vue.component('modal-consulting-component', require('./components/Consulting/ModalConsulting').default);

Vue.component('home_page_item-component', require('./components/Home/IndexPageItem.vue').default);

Vue.component('page_add-component', require('./components/Page/PageAdd.vue').default);
Vue.component('page_edit-component', require('./components/Page/PageEdit.vue').default);
Vue.component('page_list-component', require('./components/Page/PageList.vue').default);
Vue.component('page_list_item-component', require('./components/Page/PageListItem.vue').default);
Vue.component('page_single-component', require('./components/Page/PageSingle.vue').default);

Vue.component('media_collection_add-component', require('./components/Media/MediaCollectionAdd').default);
Vue.component('media_list-component', require('./components/Media/MediaList').default);
Vue.component('media_collection_list-component', require('./components/Media/MediaCollectionList').default);
Vue.component('media_collection_edit-component', require('./components/Media/MediaCollectionEdit').default);

Vue.component('media_list_item-component', require('./components/Media/MediaListItem').default);
Vue.component('media_collection_list_item-component', require('./components/Media/MediaCollectionListItem').default);

Vue.component('video_add-component', require('./components/Video/Add').default);
Vue.component('video_list-component', require('./components/Video/List').default);
Vue.component('video_edit-component', require('./components/Video/Edit').default);

Vue.component('course_bonus_add-component', require('./components/CourseBonus/Add').default);
Vue.component('course_bonus_list-component', require('./components/CourseBonus/List').default);
Vue.component('course_bonus_edit-component', require('./components/CourseBonus/Edit').default);

Vue.component('help_add-component', require('./components/Help/Add').default);
Vue.component('help_list-component', require('./components/Help/List').default);
Vue.component('help_edit-component', require('./components/Help/Edit').default);

Vue.component('doc_add-component', require('./components/Doc/Add').default);
Vue.component('doc_list-component', require('./components/Doc/List').default);
Vue.component('doc_edit-component', require('./components/Doc/Edit').default);

Vue.component('motivation_add-component', require('./components/Motivation/Add').default);
Vue.component('motivation_list-component', require('./components/Motivation/List').default);
Vue.component('motivation_edit-component', require('./components/Motivation/Edit').default);

Vue.component('executive_section_add-component', require('./components/ExecutiveSection/Add').default);
Vue.component('executive_section_list-component', require('./components/ExecutiveSection/List').default);
Vue.component('executive_section_edit-component', require('./components/ExecutiveSection/Edit').default);

Vue.component('company_add-component', require('./components/Company/Add').default);
Vue.component('company_list-component', require('./components/Company/List').default);
Vue.component('company_edit-component', require('./components/Company/Edit').default);
Vue.component('company-list-item-component', require('./components/Company/ListItem').default);


Vue.component('news_add-component', require('./components/News/Add').default);
Vue.component('news_list-component', require('./components/News/List').default);
Vue.component('news_edit-component', require('./components/News/Edit').default);

Vue.component('feedback_list-component', require('./components/Feedback/FeedbackList').default);
Vue.component('feedback_list_item-component', require('./components/Feedback/FeedbackListItem').default);
Vue.component('feedback_add-component', require('./components/Feedback/FeedbackAdd').default);
Vue.component('feedback_edit-component', require('./components/Feedback/FeedbackEdit').default);

Vue.component('courses-component', require('./components/Course/CourseList').default);
Vue.component('courses-add-component', require('./components/Course/CourseAdd.vue').default);
Vue.component('courses-edit-component', require('./components/Course/CourseEdit.vue').default);


Vue.component('section-component', require('./components/Section/SectionList').default);
Vue.component('section-add-component', require('./components/Section/SectionAdd.vue').default);
Vue.component('section-edit-component', require('./components/Section/SectionEdit.vue').default);
Vue.component('section-item-component', require('./components/Section/SectionItem.vue').default);

Vue.component('lesson-component', require('./components/Lesson/List').default);
Vue.component('lesson-add-component', require('./components/Lesson/Add.vue').default);
Vue.component('lesson-edit-component', require('./components/Lesson/Edit.vue').default);

Vue.component('promo_code_list-component', require('./components/PromoCode/List').default);

Vue.component('user_edit-component', require('./components/User/UserEdit.vue').default);
Vue.component('user_edit_admin-component', require('./components/User/UserEditAdmin.vue').default);
Vue.component('user_add-component', require('./components/User/UserAdd.vue').default);
Vue.component('user_add_company-component', require('./components/User/UserAddCompany.vue').default);
Vue.component('user_edit_permission-component', require('./components/User/UserPermissionEdit.vue').default);
Vue.component('user_profile_edit-component', require('./components/User/UserProfileEdit.vue').default);
Vue.component('user_list-component', require('./components/User/UserList.vue').default);
Vue.component('user_list_admin-component', require('./components/User/UserListAdmin.vue').default);
Vue.component('user_list_item-component', require('./components/User/UserListItem.vue').default);
Vue.component('test_question-component', require('./components/Test/TestQuestion.vue').default);


Vue.component('test_edit-component', require('./components/Test/Edit.vue').default);
Vue.component('test_add-component', require('./components/Test/Add.vue').default);
Vue.component('test_list-component', require('./components/Test/List.vue').default);
Vue.component('test_list_item-component', require('./components/Test/ListItem.vue').default);

Vue.component('certificate_list-component', require('./components/Certificate/List.vue').default);


Vue.component('widget-paginator-component', require('./components/Widget/Paginator.vue').default);
Vue.component('widget-sub_menu-component', require('./components/Widget/SubMenu.vue').default);
Vue.component('widget-preloader-component', require('./components/Widget/Preloader.vue').default);
Vue.component('single-item-component', require('./components/Widget/SingleItem.vue').default);
Vue.component('add-push-component', require('./components/Widget/AddPush.vue').default);
Vue.component('super-queue-component', require('./components/Widget/SuperQueue.vue').default);
Vue.component('html-editor-component', require('./components/Widget/HtmlEditor.vue').default);

Vue.component('crop-component', require('./components/Widget/Crop.vue').default);

Vue.prototype.$ru = {
    authors: "Авторы",
    name: "Имя",
    commentable: "Может комментироваться",
    header: "Заголовок",
    title: "Заголовок",
    rubric_id: "Рубрики",
    'super': "СУПЕР",
    text: "Текст",
    bio: "Текст",
    announce: "Анонс",
    top: "ТОП",
    author_promis: 'Кто обещал',
    complete: 'Статус обещания',
    date_end: 'Дата конца обещания',
    author_id: 'Автор',
    interviewees: 'ФИО выступающего',
    opponent1_name: 'ЗА - Имя',
    opponent1_opinion: 'ЗА - Мнение',
    opponent1_job: 'ЗА - Описание',
    opponent1_photo_main: 'Фото',
    opponent1_photo_inside: 'Фото',
    opponent2_name: 'ПРОТИВ - Имя',
    opponent2_opinion: 'ПРОТИВ - Мнение',
    opponent2_job: 'ПРОТИВ - Описание',
    opponent2_photo_main: 'Фото',
    opponent2_photo_inside: 'Фото',
    fio: 'ФИО',
    email: 'Email',
    years_life: 'Годы жизни',
    birth_place: 'Место рождения',
    army_type: 'Род войск',
    job_title: 'Название работы',
    description: 'Описание',
    date: 'Дата',
    mail: 'Email',
    position: 'Должность',
    phone: 'Телефон',
    videocode: 'Видео',
    keyword: 'Ключевое слово',
    slug: 'Ключевое слово',
    code:'Название',
    discount:'Скидка',
    count_use:'Количество',
};

Vue.prototype.$validator = {
    run: function (fields, rules) {
        let result = true;
        for (let field in rules) {
            let rule = rules[field];
            switch (rule) {
                case 'required':
                    switch (typeof fields[field]) {
                        case 'undefined':
                            result = false;
                            UIkit.notification({message: 'Поле <strong class="'+field+'" >' + Vue.prototype.$ru[field] + '</strong> не может быть пустым !', status: 'danger'});
                            break;
                        case 'object':
                            if (!fields[field].length) {
                                result = false;
                                UIkit.notification({message: 'Поле <strong>' + Vue.prototype.$ru[field] + '</strong> не может быть пустым !', status: 'danger'});
                            }
                            break;
                        case 'string':
                            if (!fields[field].length) {
                                result = false;
                                UIkit.notification({message: 'Поле <strong>' + Vue.prototype.$ru[field] + '</strong> не может быть пустым !', status: 'danger'});
                            }
                            break;
                    }
                    break;
            }
        }
        return result;
    }
};
Vue.prototype.$http = axios;

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
