<ul class="uk-nav uk-nav-side  uk-nav-parent-icon" data-uk-nav="{multiple:true}">
    @php $user = Auth::user(); @endphp
    @if($user->isRole('content manager') || $user->isRole('admin') || $user->isRole('super admin') )
        <li>
            <a href="/admin/media" title="Коллекция вижуалов">
                <i uk-icon="image"></i><span>Коллекция вижуалов</span>
            </a>
        </li>
        <li>
            <a href="/admin/video" title="Коллекция видео">
                <i uk-icon="video-camera"></i><span>Коллекция видео</span>
            </a>
        </li>
        <li>
            <a href="/admin/doc" title="Коллекция pdf">
                <i uk-icon="file"></i><span>Коллекция pdf</span>
            </a>
        </li>
        <li class="uk-nav-divider">
            <hr>
        </li>
    @endif
    @if($user->isRole('content manager') || $user->isRole('admin') || $user->isRole('super admin') )
        <li>
            <a href="/admin/courses" title="Курсы">
                <i uk-icon="copy"></i>
                <span>Курсы</span>
            </a>
        </li>
        <li class="">
            <a href="/admin/sections" title="Разделы">
                <i uk-icon="album" class="uk-icon"></i>
                <span>Разделы</span>
            </a>
        </li>
        <li class="">
            <a href="/admin/lessons" title="Уроки">
                <i uk-icon="newspaper" class="uk-icon"></i>
                <span>Уроки</span>
            </a>
        </li>
        <li class="">
            <a href="/admin/tests" title="Тесты">
                <i uk-icon="file-edit" class="uk-icon"></i>
                <span>Тесты</span>
            </a>
        </li>
        <li class="">
            <a href="/admin/course_bonus" title="Бонусы">
                <i uk-icon="star" class="uk-icon"></i>
                <span>Бонусные материалы</span>
            </a>
        </li>
        <li>
            <a href="/admin/motivation" title="Мотивация">
                <i uk-icon="comment"></i>
                <span>Мотивация</span>
            </a>
        </li>
{{--        <li>--}}
{{--            <a href="/admin/executive_section" title="для РОП">--}}
{{--                <i uk-icon="comment"></i>--}}
{{--                <span>для РОП</span>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li>
            <a href="/admin/news" title="Новости">
                <i uk-icon="bookmark"></i>
                <span>Новости</span>
            </a>
        </li>
        <li>
            <a href="/admin/help" title="Помощь">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                        <g>
                            <g>
                                <path stroke="#fff" fill="#222" d="M5 0h5v15H5z"/>
                            </g>
                            <g>
                                <path stroke="#fff" fill="#222" d="M0 5h15v5H0z"/>
                            </g>
                        </g>
                    </svg>
                </i>
                <span>Помощь</span>
            </a>
        </li>
        <li>
            <a href="/admin/config" title="Настройки">
                <i uk-icon="cog"></i><span>Настройки</span>
            </a>
        </li>
        <li class="uk-nav-divider">
            <hr>
        </li>
    @endif
    @if($user->isRole('account manager') || $user->isRole('admin') || $user->isRole('super admin') )
        <li>
            <a href="{{ route('admin_user_list',['solo']) }}" title="Пользователи">
                <i uk-icon="users"></i><span>СОЛО</span>
            </a>
        </li>
        <li>
            <a href="/admin/certificate" title="Сертификаты">
                <i class="uk-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 10c-3.865 0-7 3.134-7 7s3.135 7 7 7 7-3.134 7-7-3.135-7-7-7zm0 12c-2.762 0-5-2.239-5-5s2.238-5 5-5 5 2.239 5 5-2.238 5-5 5zm1.484-4.315l1.516-1.457-2.083-.287-.917-1.892-.917 1.892-2.083.287 1.516 1.457-.369 2.07 1.853-.992 1.854.992-.37-2.07zm1.62-9.822l-2.48-3.329 3.376-4.534h5l-5.896 7.863zm-2.974.137h1.828l-5.958-8h-1.869l5.999 8zm-7.249-8h-1.881l6 8h1.881l-6-8z"/>
                    </svg>
                </i><span>Сертификаты</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin_companies') }}" title="Компании">
                <i uk-icon="world"></i><span>Компании</span>
            </a>
        </li>
        @if($user->isRole('admin') || $user->isRole('super admin') )
        <li class="uk-nav-divider">
            <hr>
        </li>
        <li>
            <a href="/admin/promo_code" title="Промо-коды">
                <i class="uk-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <text stroke="#fff" x="10" y="15" stroke-width="1"
                              style="font-family: Montserrat; font-size: 15px; font-weight: 300; line-height: 18px;">%
                        </text>
                    </svg>
                </i>
                <span>Промо-коды</span>
            </a>
            <a href="/admin/trial" title="Тестовый период">
                <i uk-icon="clock"></i>
                <span>Тестовый период</span>
            </a>
        </li>
        @endif
        <li class="uk-nav-divider">
            <hr>
        </li>

    @endif
    @if($user->isRole('super admin') )
        <li>
            <a href="/admin/user/admins" title="Моя команда">
                <i uk-icon="users"></i>
                <span>Моя команда</span>
            </a>
        </li>
        <li class="uk-nav-divider">
            <hr>
        </li>
    @endif
    <li>
        <a href="/home">Выйти</a>
    </li>
    <li class="uk-nav-divider">
        <hr>
    </li>


    {{--    <li class="{{ in_array(Route::currentRouteName(),['admin']) ? 'uk-active' : '' }}">--}}
    {{--        <a href="/admin/" title="Главная страница">--}}
    {{--            <i class="uk-icon">--}}
    {{--                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">--}}
    {{--                    <polygon points="18.65 11.35 10 2.71 1.35 11.35 0.65 10.65 10 1.29 19.35 10.65"></polygon>--}}
    {{--                    <polygon points="15 4 18 4 18 7 17 7 17 5 15 5"></polygon>--}}
    {{--                    <polygon--}}
    {{--                            points="3 11 4 11 4 18 7 18 7 12 12 12 12 18 16 18 16 11 17 11 17 19 11 19 11 13 8 13 8 19 3 19"></polygon>--}}
    {{--                </svg>--}}
    {{--            </i>--}}
    {{--            <span>Главная страница</span>--}}
    {{--        </a>--}}
    {{--    </li>--}}
    {{--    <ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="{multiple:true}">--}}

    {{--        <li>--}}
    {{--            <a href="/admin/page" title="Страницы">--}}
    {{--                <i uk-icon="file"></i><span>Страницы</span></a>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <a href="/admin/media" title="Media">--}}
    {{--                <i uk-icon="image"></i><span>Media</span></a>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <a href="/admin/media_collection" title="Media collection">--}}
    {{--                <i uk-icon="image"></i><span>Media collection</span></a>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <a href="/admin/video" title="Video">--}}
    {{--                <i uk-icon="video-camera"></i><span>Video</span></a>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <a href="/admin/doc" title="Doc">--}}
    {{--                <i uk-icon="file"></i><span>Doc</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li class="">--}}
    {{--            <a href="/admin/feedback" title="Отзывы">--}}
    {{--                <i uk-icon="comment"></i><span>Отзывы</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <a href="/admin/motivation" title="Мотивация">--}}
    {{--                <i uk-icon="bookmark"></i>--}}
    {{--                <span>Мотивация</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <a href="/admin/news" title="Новости">--}}
    {{--                <i uk-icon="bookmark"></i>--}}
    {{--                <span>Новости</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <a href="/admin/courses" title="Курсы">--}}
    {{--                <i uk-icon="bookmark"></i>--}}
    {{--                <span>Курсы</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li class="">--}}
    {{--            <a href="/admin/sections" title="Разделы">--}}
    {{--                <i uk-icon="album" class="uk-icon"></i>--}}
    {{--                <span>Разделы</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li class="">--}}
    {{--            <a href="/admin/lessons" title="Уроки">--}}
    {{--                <i uk-icon="newspaper" class="uk-icon"></i>--}}
    {{--                <span>Уроки</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li class="">--}}
    {{--            <a href="/admin/tests" title="Тесты">--}}
    {{--                <i uk-icon="file-edit" class="uk-icon"></i>--}}
    {{--                <span>Тесты</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li class="">--}}
    {{--            <a href="/admin/course_bonus" title="Бонусные материалы">--}}
    {{--                <i uk-icon="file-edit" class="uk-icon"></i>--}}
    {{--                <span>Бонусные материалы</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <a href="{{ route('admin_user_list',['all']) }}" title="Пользователи">--}}
    {{--                <i uk-icon="users"></i><span>Пользователи</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <li>--}}
    {{--            <a href="{{ route('admin_companies') }}" title="Компании">--}}
    {{--                <i uk-icon="world"></i><span>Компании</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        --}}{{--<li class="">--}}
    {{--        --}}{{--<a href="/admin/special_widget/company" title="Спец. виджет">--}}
    {{--        --}}{{--<i uk-icon="banner"></i><span>Спец. виджет</span>--}}
    {{--        --}}{{--</a>--}}
    {{--        --}}{{--</li>--}}
    {{--        --}}{{--<li class="">--}}
    {{--        --}}{{--<a href="/admin/rubric" title="Рубрики">--}}
    {{--        --}}{{--<i uk-icon="folder"></i><span>Рубрики</span>--}}
    {{--        --}}{{--</a>--}}
    {{--        --}}{{--</li>--}}
    {{--        --}}{{--<li class="">--}}
    {{--        --}}{{--<a href="/admin/template" title="Шаблоны">--}}
    {{--        --}}{{--<i uk-icon="template"></i><span>Шаблоны</span>--}}
    {{--        --}}{{--</a>--}}
    {{--        --}}{{--</li>--}}
    {{--        --}}{{--<li class="">--}}
    {{--        --}}{{--<a href="/admin/author" title="Авторы">--}}
    {{--        --}}{{--<i uk-icon="users"></i><span>Авторы</span>--}}
    {{--        --}}{{--</a>--}}
    {{--        --}}{{--</li>--}}
    {{--        --}}{{--<li class="">--}}
    {{--        --}}{{--<a href="/admin/tag" title="Тэги">--}}
    {{--        --}}{{--<i uk-icon="tag"></i><span>Тэги</span>--}}
    {{--        --}}{{--</a>--}}
    {{--        --}}{{--</li>--}}

    {{--    </ul>--}}

    {{--@if ($user_->getPermissionSectionCreate())--}}
    {{--<li class="uk-parent {{(in_array(Route::currentRouteName(),$create)?'uk-open uk-active':'')}}">--}}
    {{--<a href="#" title="Содзать">--}}
    {{--<i uk-icon="plus-circle"></i>--}}
    {{--<span>Создать</span>--}}
    {{--</a>--}}
    {{--<ul class="uk-nav-sub" aria-hidden="true" hidden="">--}}
    {{--@if ($user_->getPermissionToSection('news','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$news_create) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_news_add') }}" title="Новости">--}}
    {{--<i uk-icon="newspaper" class="uk-icon"></i>--}}
    {{--<span>Новости</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('news','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$news_create_card) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_news_add_card',['true']) }}" title="Новости карточку">--}}
    {{--<i uk-icon="newspaper" class="uk-icon"></i>--}}
    {{--<span>Новости карточку</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('article','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$article_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_article_add') }}" title="Статьи">--}}
    {{--<i uk-icon="file-text-o" class="uk-icon"></i><span>Статьи</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('gallery','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$gallery_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_gallery_add') }}" title="Фоторепортажи">--}}
    {{--<i uk-icon="camera" class="uk-icon"></i>--}}
    {{--<span>Фоторепортажи</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('conference','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$conference_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_conference_add') }}" title="Интервью">--}}
    {{--<i uk-icon="microphone" class="uk-icon"></i><span>Интервью</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('opinion','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$opinion_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_opinion_add') }}" title="Мнения">--}}
    {{--<i uk-icon="file-edit" class="uk-icon"></i><span>Мнения</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('promise','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$promise_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_promise_add') }}" title="Обещания">--}}
    {{--<i uk-icon="hourglass" class="uk-icon"></i>--}}
    {{--<span>Обещания</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('battle_opinion','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$battle_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_battle_opinion_add') }}" title="Битва мнений">--}}
    {{--<i uk-icon="gavel" class="uk-icon"></i>--}}
    {{--<span>Битва мнений</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('pobediteli','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$pobediteli_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_pobediteli_add') }}" title="Победители">--}}
    {{--<i uk-icon="star" class="uk-icon"></i><span>Победители</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('pobediteli','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$pobediteli_competition_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_pobediteli_competition_add') }}" title="Конкурс победители">--}}
    {{--<i uk-icon="star"></i>--}}
    {{--<span>Конкурс победители</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('pobediteli_video','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$pobediteli_video_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_pobediteli_video_add') }}" title="Победители видео">--}}
    {{--<i uk-icon="star-video-camera" class="uk-icon"></i> <span>Победители видео</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('press_release','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$press_release_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_press_release_add') }}" title="Пресс-релизы">--}}
    {{--<i uk-icon="template" class="uk-icon"></i><span>Пресс-релизы</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('page','new_creating'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$page_add) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_page_add') }}" title="Страницы">--}}
    {{--<i uk-icon="template" class="uk-icon"></i><span>Страницы</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--</ul>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionSectionContent())--}}
    {{--<li class="uk-parent {{(in_array(Route::currentRouteName(),$content)?'uk-open uk-active':'')}}">--}}
    {{--<a href="#" title="Контент">--}}
    {{--<i class="uk-icon">--}}
    {{--<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">--}}
    {{--<rect x=".4" y="1" width="19.2" height="3"></rect>--}}
    {{--<rect x="3" y="5" width="1" height="1"></rect>--}}
    {{--<rect x="5" y="5" width="12.5" height="1"></rect>--}}
    {{--<rect x="3" y="8" width="1" height="1"></rect>--}}
    {{--<rect x="5" y="8" width="12.5" height="1"></rect>--}}
    {{--<rect x="3" y="11" width="1" height="1"></rect>--}}
    {{--<rect x="5" y="11" width="12.5" height="1"></rect>--}}
    {{--<rect x="3" y="14" width="1" height="1"></rect>--}}
    {{--<rect x="5" y="14" width="12.5" height="1"></rect>--}}
    {{--<rect fill="none" stroke="#000" stroke-width="1.3" x="1" y="3" width="18"--}}
    {{--height="14"></rect>--}}
    {{--</svg>--}}
    {{--</i>--}}
    {{--<span>Контент</span>--}}
    {{--</a>--}}
    {{--<ul class="uk-nav-sub">--}}
    {{--@if ($user_->getPermissionToSection('news','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$news) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_news_list',['index']) }}" title="Новости">--}}
    {{--<i uk-icon="newspaper"></i>--}}
    {{--<span>Новости</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('article','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$article) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_article_list',['all']) }}" title="Статьи">--}}
    {{--<i uk-icon="file-text-o"></i><span>Статьи</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('gallery','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$gallery) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_gallery_list',['all']) }}" title="Фоторепортажи">--}}
    {{--<i uk-icon="camera"></i>--}}
    {{--<span>Фоторепортажи</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('conference','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$conference) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_conference_list',['all']) }}" title="Интервью">--}}
    {{--<i uk-icon="microphone"></i><span>Интервью</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}

    {{--@if ($user_->getPermissionToSection('opinion','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$opinion) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_opinion_list',['all']) }}" title="Мнения">--}}
    {{--<i uk-icon="file-edit"></i><span>Мнения</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('promise','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$promise) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_promise_list',['index']) }}" title="Обещания">--}}
    {{--<i uk-icon="hourglass"></i>--}}
    {{--<span>Обещания</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('battle_opinion','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$battle_opinion) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_battle_opinion_list',['all']) }}" title="Битва мнений">--}}
    {{--<i uk-icon="gavel"></i>--}}
    {{--<span>Битва мнений</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('pobediteli','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$pobediteli) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_pobediteli_list',['all']) }}" title="Победители"><i--}}
    {{--uk-icon="star"></i><span>Победители</span></a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('pobediteli','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$pobediteli_competition) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_pobediteli_competition_list',['all']) }}" title="Конкурс победители"><i--}}
    {{--uk-icon="star"></i><span>Конкурс победители</span></a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('pobediteli_video','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$pobediteli_video) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_pobediteli_video_list',['all']) }}" title="Победители видео">--}}
    {{--<i uk-icon="star-video-camera"></i> <span>Победители видео</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('press_release','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$press_release) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_press_release_list',['all']) }}" title="Пресс-релизы">--}}
    {{--<i uk-icon="template"></i><span>Пресс-релизы</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--</ul>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionSectionEditing())--}}
    {{--<li class="uk-parent {{(in_array(Route::currentRouteName(),$editing)?'uk-open uk-active':'')}}">--}}
    {{--<a href="#" title="Редактирование"><i uk-icon="file-edit"></i><span>Редактирование</span></a>--}}
    {{--<ul class="uk-nav-sub">--}}
    {{--@if ($user_->getPermissionToSection('comment','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$comment) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_comment_list',['new']) }}" title="Комментарии">--}}
    {{--<i uk-icon="comment"></i><span>Комментарии</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('special_widget','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$special_widget) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_special_widget_list',['company']) }}" title="Спец. виджет">--}}
    {{--<i uk-icon="banner"></i><span>Спец. виджет</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('rubric','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$rubric) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_rubric_list') }}" title="Рубрики">--}}
    {{--<i uk-icon="folder"></i><span>Рубрики</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('templates','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$template) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_template_list') }}" title="Шаблоны">--}}
    {{--<i uk-icon="template"></i><span>Шаблоны</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('author','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$author) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_author_list') }}" title="Авторы">--}}
    {{--<i uk-icon="users"></i><span>Авторы</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('tag','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$tag) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_tag_list') }}" title="Тэги">--}}
    {{--<i uk-icon="tag"></i><span>Тэги</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('page','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$page) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_page_list') }}" title="Страницы">--}}
    {{--<i uk-icon="file"></i><span>Страницы</span></a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--</ul>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionSectionSetting())--}}
    {{--<li class="uk-parent {{(in_array(Route::currentRouteName(),$setting)?'uk-open uk-active':'')}}">--}}
    {{--<a href="#" title="Настройки">--}}
    {{--<i uk-icon="cog"></i><span>Настройки</span>--}}
    {{--</a>--}}
    {{--<ul class="uk-nav-sub">--}}
    {{--@if ($user_->getPermissionToSection('user','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$user) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_user_list',['all']) }}" title="Пользователи">--}}
    {{--<i uk-icon="users"></i><span>Пользователи</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('member','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$member) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_member_list',['all']) }}" title="Пользователи сайта">--}}
    {{--<i uk-icon="world"></i><span>Пользователи сайта</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('log','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$log) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_log_list',['all']) }}" title="Протокол"><i--}}
    {{--uk-icon="table"></i><span>Протокол</span></a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@if ($user_->getPermissionToSection('fees','access'))--}}
    {{--<li class="{{ in_array(Route::currentRouteName(),$fees) ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ route('admin_fees_list') }}" title="Статистика">--}}
    {{--<i uk-icon="eye"></i><span>Статистика</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{-- @if ($user_->getPermissionToSection('config','access'))--}}
    {{--<li><a href="#" title="Настройки"><i uk-icon="cog"></i>--}}
    {{--<span>Настройки</span></a>--}}
    {{--</li>--}}
    {{--@endif--}}

    {{--</ul>--}}
    {{--</li>--}}
    {{--@endif--}}
</ul>
