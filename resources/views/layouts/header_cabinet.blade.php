@php
    $main_page=['main_page'];
    $about=['about'];
    $book=['book'];
    $school=['school'];
    $workshop=['workshop'];
    $consulting=['consulting'];
    $events=['events'];
    $master_class=['master_class'];
    $online_course=['online_course'];
    $partnership=['partnership'];
    $reviews=['reviews'];
    $speaker=['speaker'];
    $clients=['clients'];
    $business=[array_merge($book,$online_course,$master_class,$workshop)];
    $class =[
     'book'=>'book',
     'main_page'=>'',
     'about'=>'',
     'school'=>'',
     'workshop'=>'',
     'consulting'=>'',
     'events'=>'',
     'master_class'=>'',
     'online_course'=>'book',
     'partnership'=>'',
     'reviews'=>'',
     'speaker'=>'',
     'clients'=>'',
     'login'=>'book',
     'register'=>'book',
     'home'=>'book',
     'home_course'=>'book',
     'home_video'=>'book',
     'password.update'=>'book',
     'password.request'=>'book',
     'user.password.change'=>'book',
     'home_partnership'=>'book',
     'home_life_hack'=>'book',
     'home_test'=>'book',
     'home_test_run'=>'book',
     'home_test_result'=>'book',
    ];



@endphp
<header class="{{$class[Route::currentRouteName()]}}">
    <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
        <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="#">KARADA</a>
        </div>
        <div class="uk-navbar-right uk-margin-right">
            <ul class="uk-navbar-nav uk-visible@m">
                <li>
                    <a href="{{route('home_life_hack')}}" title="Полезные материалы">
                        <img src="/images/svg/image2vector (6).svg" width="30">
                    </a>
                </li>
                <li>
                    <a href="{{route('home_test')}}" title="Тестирование">
                        <img src="/images/svg/image2vector (7).svg" width="30" alt="">
                    </a>
                </li>
                <li>
                    <a href="{{route('home_test_result')}}" title="Мои результаты">
                        <img src="/images/svg/image2vector (8).svg" width="30" alt="">
                    </a>
                </li>
                <li>
                    <a href="#" uk-icon="triangle-down">{{ Auth::user()->name }}</a>
                    <div class="uk-navbar-dropdown uk-navbar-dropdow uk-padding-remove"
                         uk-drop="mode:click; boundary: !.uk-navbar-nav; boundary-align: true; pos: bottom-justify;">
                        <ul class="uk-nav uk-navbar-dropdown-nav uk-navbar-nav" style="z-index: 980;">
                            <li><a href="{{ route('home') }}">Личный кабинет</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="uk-navbar-nav uk-visible@m">
                <li>
                    <div class="">
                        <a href="tel:+77052711177" class="uk-button uk-button-text uk-text-bold">+7(705) 271 11 77</a>
                        <br>
                        <a href="mailto:info@karada.kz" class="uk-button uk-button-text uk-text-bold">info@karada.kz</a>
                    </div>
                </li>
            </ul>
            <a uk-navbar-toggle-icon="" href="#offcanvas" uk-toggle=""
               class="uk-navbar-toggle uk-hidden@m uk-navbar-toggle-icon uk-icon"></a>
        </div>
    </nav>
    <div id="offcanvas" uk-offcanvas="mode: push; overlay: true" class="uk-offcanvas uk-offcanvas-overlay">
        <div class="uk-offcanvas-bar uk-offcanvas-bar-animation uk-offcanvas-push">
            <div class="uk-panel">
                <a class="uk-navbar-item uk-logo" href="/">KARADA</a>
                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                    <li class="{{ in_array(Route::currentRouteName(),$main_page) ? 'uk-active' : '' }}"><a
                            href="{{ route('main_page') }}">Главная</a></li>
                    <li class="uk-parent {{ in_array(Route::currentRouteName(),['book','online_course','workshop','master_class']) ? 'uk-active uk-open' : '' }}">
                        <a href="#">Бизнес школа</a>
                        <ul class="uk-nav-sub">
                            <li class="{{ in_array(Route::currentRouteName(),$book) ? 'uk-active' : '' }}"><a
                                    href="{{ route('book') }}">Книга</a></li>
                            <li class="{{ in_array(Route::currentRouteName(),$online_course) ? 'uk-active' : '' }}"><a
                                    href="{{ route('online_course') }}">Онлайн курс</a></li>
                            <li class="{{ in_array(Route::currentRouteName(),$workshop) ? 'uk-active' : '' }}"><a
                                    href="{{ route('workshop') }}">Бизнес практикум</a></li>
                            <li class="{{ in_array(Route::currentRouteName(),$master_class) ? 'uk-active' : '' }}"><a
                                    href="{{ route('master_class') }}">Мастер классы</a></li>
                        </ul>
                    </li>
                    <li class="{{ in_array(Route::currentRouteName(),$consulting) ? 'uk-active' : '' }}"><a
                            href="/consulting">Консалтинг</a></li>
                    <li class="{{ in_array(Route::currentRouteName(),$speaker) ? 'uk-active' : '' }}"><a
                            href="{{ route('speaker') }}">Спикер</a></li>
                    <li class="{{ in_array(Route::currentRouteName(),$about) ? 'uk-active' : '' }}"><a
                            href="{{ route('about') }}">О нас</a></li>
                    {{--                <li class="{{ in_array(Route::currentRouteName(),$clients) ? 'uk-active' : '' }}"><a href="{{ route('clients') }}">Клиенты</a></li>--}}
                    <li class="{{ in_array(Route::currentRouteName(),$reviews) ? 'uk-active' : '' }}"><a
                            href="{{ route('reviews') }}">Отзывы</a></li>
                    <li class="{{ in_array(Route::currentRouteName(),$events) ? 'uk-active' : '' }}"><a
                            href="{{ route('events') }}">Мероприятия</a></li>
                    <li class="{{ in_array(Route::currentRouteName(),$partnership) ? 'uk-active' : '' }}"><a
                            href="{{ route('partnership') }}">Партнёрство</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
