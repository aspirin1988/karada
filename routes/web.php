<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/blob/{video_id}/{video_size?}', 'SiteController@urlVideo')->name('url_video');

Route::get('/logout', 'Auth\LogoutController@logout')->name('main_page');
Route::get('/password_reseted', 'SiteController@youRegistered')->name('home');

Route::get('/', 'SiteController@index')->name('main_page');
Route::get('/book', 'SiteController@book')->name('book');
Route::get('/online_course', 'SiteController@onlineCourse')->name('online_course');
Route::get('/workshop', 'SiteController@workshop')->name('workshop');
//Route::get('/consulting', 'SiteController@consulting')->name('consulting');
Route::post('/consulting/order', 'SiteController@orderForm')->name('consulting_form');
Route::get('/master_class', 'SiteController@masterClass')->name('master_class');
Route::get('/speaker', 'SiteController@speaker')->name('speaker');
Route::get('/about', 'SiteController@about')->name('about');
Route::get('/clients', 'SiteController@clients')->name('clients');
Route::get('/reviews/{method?}', 'SiteController@reviews')->name('reviews');
Route::get('/events', 'SiteController@events')->name('events');
Route::get('/partnership', 'SiteController@partnership')->name('partnership');
Route::post('/application_registration', 'SiteController@applicationRegistration');


Auth::routes();

Route::get('/login', function () {
    return redirect('/');
});
Route::get('/register', function () {
    return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/edit', 'HomeController@edit')->name('home_course');

Route::get('/home/plan', 'HomeController@plan')->name('home_course');
Route::get('home/plan/list/get/{id}', 'HomeController@getPlanList')->name('home_course');

Route::get('/home/personal_goals/{method?}', 'HomeController@personalGoals')->name('home_course');
Route::get('/home/motivation', 'HomeController@motivation')->name('home_course');

Route::get('/home/news', 'HomeController@news')->name('home_news');
Route::get('/home/video_chief', 'HomeController@newsChief')->name('home_news');
Route::get('/home/rewards/{id?}', 'HomeController@rewards')->name('home_rewards');
Route::get('/home/help', 'HomeController@help')->name('home_rewards');
Route::post('/help/get/price', 'SiteController@getPrice')->name('home_rewards');

Route::get('/home/personal_goals/approve/{is}', 'HomeController@personalGoalsApprove')->name('home_course');
Route::post('/home/personal_goals/add', 'HomeController@personalGoalsAdd')->name('home_course');
Route::get('/home/personal_goals/get/{id}', 'HomeController@personalGoalsGet');
Route::post('/home/personal_goals/update/{id}', 'HomeController@personalGoalsUpdate');
Route::post('/home/sales_plan/create', 'HomeController@planCreate')->name('home_course');
Route::post('/home/sales_plan/update/{id}', 'HomeController@planUpdate')->name('home_course');
Route::put('/home/plan/save/{id}', 'HomeController@planSave')->name('home_course');
Route::post('/home/plan/quarter/update', 'HomeController@updatePlan')->name('home_course');
Route::get('/home/get/user/plan/{id}', 'HomeController@getUserPlan')->name('home_course');

Route::post('/home/set/see', 'HomeController@see')->name('home_course');
Route::get('/home/course', 'HomeController@course')->name('home_course');
Route::get('/home/course/{id}', 'HomeController@courseSingle')->name('home_course');
Route::get('/home/course/{id}/intro', 'HomeController@couseIntro');
Route::get('/home/course/{id}/pdf', 'HomeController@cousePDF');
Route::get('/home/course/{id}/{section_id}', 'HomeController@sectionSingle')->where(['id' => '[0-9]+'])->name('home_course');
//Route::get('/home/course/{id}/{section_id}/', 'HomeController@sectionSingle')->name('home_course');
Route::get('/home/course/{id}/{section_id}/{lesson_id}', 'HomeController@lessonSingle')->name('home_course');
Route::get('/home/course/set_stat/{id}', 'HomeController@lessonSingleSetStat');
Route::get('/home/course/{id}/{section_id}/{lesson_id}/{test_id}', 'HomeController@testSingle')->name('home_video');
//Route::get('/home/partnership', 'HomeController@partnership')->name('home_partnership');
//Route::get('/home/life_hack', 'HomeController@lifeHack')->name('home_life_hack');
Route::get('/home/course/test', 'HomeController@test')->name('home_test');
Route::get('/home/course/result', 'HomeController@testResult')->name('home_test_result');
Route::get('/home/course/test/run', 'HomeController@testRun')->name('home_test_run');
Route::get('/home/course/video', 'HomeController@video')->name('home_video');
Route::get('/home/course_bonus', 'HomeController@courseBonus')->name('home_video');

Route::get('/home/my-team', 'HomeController@myTeam')->name('home_my_team');
Route::get('/home/my-team/{id}', 'HomeController@myTeamSingle')->name('home_my_team');
Route::get('/home/get/my-team/plan/{id}', 'HomeController@myTeamPlan')->name('home_my_team');
Route::put('/home/add/teammate', 'HomeController@addTeammate')->name('home_my_team');
Route::delete('/home/remove/teammate/{id}', 'HomeController@removeTeammate')->name('home_my_team');

Route::get('/home/password/change', 'AdminController@reset')->name('user.password.change');
Route::get('/home/password/update', 'HomeController@password')->name('user.password.update');
Route::post('/home/password/update', 'HomeController@updatePassword')->name('user.password.update');

Route::get('/home/user/update/{id}', 'HomeController@updateUser');
Route::put('/home/user/time/inc', 'HomeController@incTime');
Route::post('/home/upload/ava', 'HomeController@uploadAva');
Route::post('/home/upload/background', 'HomeController@uploadBackground');
Route::get('/ajax/getTest/{id}', 'TestController@ajaxTest');
Route::post('/ajax/test_stat_set', 'TestController@ajaxTestSet');

Route::middleware(['admin', 'active'])->group(function () {

    Route::get('/admin', 'AdminController@index')->name('user.password.update');
    Route::get('/admin/trial', 'AdminController@trial');
    Route::get('/admin/trial/get', 'AdminController@getTrial');
    Route::post('/admin/trial/save', 'AdminController@setTrial');

    Route::get('/admin/config', 'AdminController@config');
    Route::get('/admin/config/get', 'AdminController@getConfig');
    Route::post('/admin/config/save', 'AdminController@setConfig');

    Route::get('/admin/my-command', 'AdminController@myCommand');

    Route::put('/admin/page/add', 'AdminPageController@addPage')->name('admin_page_create');
    Route::get('/admin/page/add', 'AdminPageController@add')->name('admin_page_add');

    Route::get('/admin/promo_code', 'PromoCodeController@index');
    Route::put('/admin/promo_code/create', 'PromoCodeController@create');
    Route::put('/admin/promo_code/update', 'PromoCodeController@update');
    Route::post('/admin/promo_code/get/{page?}', 'PromoCodeController@getList');
    Route::delete('/admin/promo_code/delete/{id}', 'PromoCodeController@delete');

    Route::post('/admin/page/save/{id}', 'AdminPageController@save')->name('admin_page_save');
    Route::post('/admin/page/save_template/{id}', 'AdminPageController@saveTemplate')->name('admin_page_save_template');
    Route::get('/admin/page/edit/get/{id}', 'AdminPageController@getEdit')->name('admin_page_get_edit');
    Route::post('/admin/page/get_template/{id}', 'AdminPageController@getEditTemplate')->name('admin_page_get_template_edit');
    Route::get('/admin/page/edit/{id}', 'AdminPageController@edit')->name('admin_page_edit');

    Route::get('/admin/page/{page?}', 'AdminPageController@page_list')->name('admin.page.list');
    Route::get('/admin/page/get/{page?}', 'AdminPageController@page_list_get')->name('admin.page.list_get');

    Route::post('/admin/media/get_list/{dir}/all', 'MediaController@getMediaListAll');
    Route::post('/admin/media/get_list/{dir}/{page}', 'MediaController@getMediaList');

    Route::get('/admin/media/get/directories', 'MediaController@getDirectories');
    Route::get('/admin/video/get/directories', 'MediaController@getDirectoriesVideo');
    Route::get('/admin/media_collection/get/{page}', 'MediaController@getCollection');
    Route::get('/admin/media_collection/get_media/{id}', 'MediaController@getMedia');
    Route::post('/admin/media_collection/upload/{id}', 'MediaController@uploadMedia');
    Route::post('/admin/media/upload', 'MediaController@upload');
    Route::get('/admin/media_collection/add', 'MediaController@add');
    Route::put('/admin/media_collection/add', 'MediaController@addCollection');
    Route::get('/admin/media_collection/edit/{id}', 'MediaController@edit_collection');
    Route::delete('/admin/media_collection/image/delete/{c_id}/{i_id}', 'MediaController@delete_image');
    Route::delete('/admin/media/image/delete/{i_id}', 'MediaController@deleteImage');
    Route::delete('/admin/video/delete/{id}', 'MediaController@deleteVideo');
    Route::delete('/admin/doc/delete/{id}', 'AdminDocController@deleteDoc');

    Route::get('/admin/image/get_media', 'MediaController@getAll');
    Route::post('/admin/image/add_dir', 'MediaController@addDir');
    Route::post('/admin/video/add_dir', 'MediaController@addDirVideo');

    Route::get('/admin/media_collection/{page?}', 'MediaController@index_collection');

    Route::post('/admin/image/upload', 'MediaController@upload');
    Route::post('/admin/media/update/{id}', 'MediaController@mediaUpdate');
    Route::post('/admin/media/update/sort/{id}', 'MediaController@updateSort');
    Route::post('/admin/video/update', 'MediaController@updateVideo');
    Route::post('/admin/video/upload', 'MediaController@uploadVideo');
    Route::post('/admin/find/video', 'MediaController@findVideo');
    Route::post('/admin/video/get/{method?}/{page?}', 'MediaController@getVideoList');
    Route::get('/admin/video/{method?}/{page?}', 'MediaController@video');

    Route::get('/admin/media/{dir?}/{page?}', 'MediaController@index');


    Route::get('/admin/doc/get/directories', 'AdminDocController@getDirectories');
    Route::post('/admin/doc/add_dir', 'AdminDocController@addDir');
    Route::post('/admin/doc/update', 'AdminDocController@update');
    Route::post('/admin/doc/upload', 'AdminDocController@upload');
    Route::post('/admin/find/doc', 'AdminDocController@find');
    Route::post('/admin/doc/get/{page?}', 'AdminDocController@getList');
    Route::get('/admin/doc/{page?}', 'AdminDocController@index');

    Route::post('/admin/motivation/clone', 'AdminMotivationController@clone');
    Route::post('/admin/motivation/update', 'AdminMotivationController@update');
    Route::post('/admin/video/upload/motivation', 'AdminMotivationController@uploadVideo');
    Route::post('/admin/motivation/get/{page?}', 'AdminMotivationController@getList');
    Route::get('/admin/motivation/{page?}', 'AdminMotivationController@index');
    Route::delete('/admin/motivation/delete/{id}', 'AdminMotivationController@delete');

    Route::post('/admin/executive_section/clone', 'AdminExecutiveSectionController@clone');
    Route::post('/admin/executive_section/update', 'AdminExecutiveSectionController@update');
    Route::post('/admin/video/upload/executive_section', 'AdminExecutiveSectionController@uploadVideo');
    Route::get('/admin/executive_section/get/{method?}/{page?}', 'AdminExecutiveSectionController@getList');
    Route::get('/admin/executive_section/{method?}/{page?}', 'AdminExecutiveSectionController@index');

    Route::post('/admin/news/create', 'AdminNewsController@create');
    Route::post('/admin/news/update', 'AdminNewsController@update');
    Route::delete('/admin/news/delete/{id}', 'AdminNewsController@delete');
    Route::post('/admin/video/upload/news', 'AdminNewsController@uploadVideo');
    Route::post('/admin/news/get/{method?}/{page?}', 'AdminNewsController@getList');
    Route::get('/admin/news/{page?}', 'AdminNewsController@index');


    Route::post('/admin/feedback/upload/', 'AdminFeedbackController@upload');
    Route::get('/admin/feedback/add', 'AdminFeedbackController@add');
    Route::put('/admin/feedback/add', 'AdminFeedbackController@addFeedback');
    Route::get('/admin/feedback/edit/{id}', 'AdminFeedbackController@edit');
    Route::get('/admin/feedback/{page?}', 'AdminFeedbackController@index');
    Route::get('/admin/feedback/get/{id}', 'AdminFeedbackController@getEdit');
    Route::get('/admin/feedback/get_list/{page?}', 'AdminFeedbackController@getList');
    Route::post('/admin/feedback/save/{id}', 'AdminFeedbackController@save');

    Route::get('/admin/get/arbitrary_fields/{type}/{id}', 'ArbitraryFieldsController@getFields');
    Route::post('/admin/save/arbitrary_fields/{type}/{id}', 'ArbitraryFieldsController@saveFields');

    Route::get('/admin/course/add', 'CourseController@add');
    Route::put('/admin/course/add', 'CourseController@crate');
    Route::get('/admin/course/edit/{id}', 'CourseController@edit');
    Route::get('/admin/course/edit/get/{id}', 'CourseController@getEdit');
    Route::post('/admin/course/save/{id}', 'CourseController@save');
    Route::get('/admin/courses/list', 'CourseController@list');
    Route::get('/admin/courses', 'CourseController@index');
    Route::get('/admin/course/get/all', 'CourseController@getCourseAllList');
    Route::post('/admin/course/get/{page?}', 'CourseController@getCourseList');

    Route::post('/admin/course_bonus/get/{page?}', 'AdminCourseBonusController@getList');
    Route::get('/admin/course_bonus/add', 'AdminCourseBonusController@add');
    Route::put('/admin/course_bonus/add', 'AdminCourseBonusController@create');
    Route::post('/admin/course_bonus/update', 'AdminCourseBonusController@update');
    Route::delete('/admin/course_bonus/delete/{id}', 'AdminCourseBonusController@delete');
    Route::get('/admin/course_bonus/{page?}', 'AdminCourseBonusController@index');


    Route::get('/admin/help', 'AdminHelpController@index');
    Route::get('/admin/help/edit/{id}', 'AdminHelpController@edit');
    Route::get('/admin/help/get/edit/{id}', 'AdminHelpController@getEdit');
    Route::get('/admin/help/get', 'AdminHelpController@getList');
    Route::get('/admin/help/add', 'AdminHelpController@add');
    Route::put('/admin/help/add', 'AdminHelpController@create');
    Route::post('/admin/help/update', 'AdminHelpController@update');


    Route::get('/admin/company/edit/{id}', 'CompanyController@edit');
    Route::get('/admin/company/get/edit/{id}', 'CompanyController@getEdit');
    Route::post('/admin/company/save/{id}', 'CompanyController@save');
    Route::post('/admin/company/get/{page?}', 'CompanyController@list');
    Route::get('/admin/company/get/all', 'CompanyController@listAll');
    Route::get('/admin/company/add', 'CompanyController@add');
    Route::put('/admin/company/add', 'CompanyController@create');
    Route::delete('/admin/company/delete/{id}', 'CompanyController@delete');
    Route::get('/admin/company/{page?}', 'CompanyController@index')->name('admin_companies');


    Route::get('/admin/section/add', 'SectionController@add');
    Route::put('/admin/section/add', 'SectionController@crate');
    Route::get('/admin/section/edit/{id}', 'SectionController@edit');
    Route::get('/admin/section/edit/get/{id}', 'SectionController@getEdit');
    Route::post('/admin/section/save/{id}', 'SectionController@save');
    Route::post('/admin/section/sort/{method}', 'SectionController@updateSort');
    Route::post('/admin/find/section', 'SectionController@find');
    Route::get('/admin/sections/list', 'SectionController@list');
    Route::get('/admin/sections/list_parent', 'SectionController@listParent');
    Route::get('/admin/sections', 'SectionController@index');
    Route::get('/admin/section/get/{course_id}', 'SectionController@getSectionList');

    Route::get('/admin/lesson/add', 'LessonController@add');
    Route::put('/admin/lesson/add', 'LessonController@crate');
    Route::get('/admin/lesson/edit/{id}', 'LessonController@edit');
    Route::get('/admin/lesson/edit/get/{id}', 'LessonController@getEdit');
    Route::post('/admin/lesson/save/{id}', 'LessonController@save');
    Route::delete('/admin/lesson/delete/{id}', 'LessonController@delete');

    Route::get('/admin/certificate/{page?}', 'CertificatController@index');
    Route::post('/admin/certificate/get/{page?}', 'CertificatController@getList');

    Route::get('/admin/lessons/{page?}', 'LessonController@index');
    Route::post('/admin/lesson/get/{page?}', 'LessonController@getLessonList');

    Route::get('/admin/test/list', 'TestController@getList');
    Route::get('/admin/tests/{page?}', 'TestController@index');
    Route::post('/admin/test/get/{page}', 'TestController@getList_');
    Route::get('/admin/test/get/questions/{id}', 'TestController@getQuestions');
    Route::get('/admin/test/get/question/{id}', 'TestController@getQuestion');
    Route::post('/admin/find/test', 'TestController@find');
    Route::post('admin/test/save/question/{id}', 'TestController@saveQuestion');
    Route::get('/admin/test/edit/get/{id}', 'TestController@getEdit');
    Route::post('/admin/test/add/questions/{id}', 'TestController@addQuestion');
    Route::post('admin/test/save/{id}', 'TestController@save');

    Route::get('/admin/test/add', 'TestController@add')->name('admin_test_add');
    Route::get('/admin/test/edit/{id}', 'TestController@edit')->name('admin_test_edit');
    Route::delete('/admin/test/delete/{id}', 'TestController@delete')->name('admin_test_delete');
    Route::put('/admin/test/add', 'TestController@addTest')->name('admin_test_create');


        Route::get('/admin/user/{method}/add', 'AdminUsersController@add')->name('admin_user_add');
        Route::get('/admin/user/company/add/{id}', 'AdminUsersController@addCompany');
        Route::put('/admin/user/company/add/{id}', 'AdminUsersController@createCompany');
        Route::put('/admin/user/add', 'AdminUsersController@addUser')->name('admin_user_create');
        Route::post('/admin/user/lock', 'AdminUsersController@lockUser');
        Route::post('/admin/user/unlock', 'AdminUsersController@unlockUser');
        Route::post('/admin/user/delete', 'AdminUsersController@delete');
        Route::get('/admin/user/edit/get/{id}', 'AdminUsersController@getEdit')->name('admin_user_get_edit');
        Route::get('/admin/user/edit/{id}', 'AdminUsersController@edit')->name('admin_user_edit');
        Route::post('/admin/user/add/access/{id}', 'AdminUsersController@addUserAccess')->name('admin_user_access');
        Route::get('/admin/user/{method?}/{page?}', 'AdminUsersController@index')->name('admin_user_list');
        Route::get('/admin/user/get/certificate/{id}', 'AdminUsersController@getListCertificate')->name('admin_user_get_list');
        Route::post('/admin/user/get/{method}/{page}', 'AdminUsersController@getList')->name('admin_user_get_list');
        Route::post('/admin/user/save/{id}', 'AdminUsersController@save')->name('admin_user_save');

    Route::delete('/admin/course/delete/{id}', 'CourseController@delete');
    Route::delete('/admin/section/delete/{id}', 'SectionController@delete');

});


Route::get('/{slug}', 'PageController@page')->name('page');


