<!DOCTYPE html>
<html lang="ru">
<head>
    @section('title')
        <title>KARADA школа продаж</title>
        <meta name="description" content="KARADA школа продаж"/>
    @show
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-rim-auto-match" content="none">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"/>
    <meta name="it-rating" content="it-rat-24ca1971faadab1e67e8692cad77ab81"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/png">
    <link rel="stylesheet" href="/css/main-style.css?v=141" type="text/css"/>

    <link rel="icon" type="image/png" href="/img/favicon.jpg"/>
    <link rel="canonical" href=""/>

    <meta property="og:image" content="/img/logo.png"/>
    <meta property="og:title" content=""/>
    <meta property="og:description" content=""/>
    <meta property="image" content="/img/logo.png"/>
    <meta itemprop="image" content="/img/logo.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<header class="{{Route::currentRouteName()=='main_page'? 'hidden' :'' }}">
    <div class="container">
        <div class="hLogo">
            <a href="/"><img src="/img/logo-blue.png" alt="О нас"></a>
        </div>
        <div class="hNav">
            <ul>
                <li class="{{Route::currentRouteName()=='about'? 'active' :'' }}"><a href="/about/">О нас</a></li>
                <li style="display: none;" class="{{Route::currentRouteName()=='reviews'? 'active' :'' }}"><a href="/reviews/">Отзывы</a></li>
                <li><a href="#IndexPrice" class="open_popup">попробовать бесплатно</a></li>
                @if(Auth::check())
                    <li style="border-left: 1px solid #000; margin-left: 20px; padding-left: 20px;" ><a href="/logout/">Выйти</a></li>
                @else
                    <li style="border-left: 1px solid #000; margin-left: 20px; padding-left: 20px;" ><a href="/login" rel="show-login">Вход</a></li>
                @endif
            </ul>
        </div>
        <div class="hNavMob">
            <div class="hNavMobAcc">
                <ul>
                    <li class="{{Route::currentRouteName()=='about'? 'active' :'' }}"><a href="/about/">О нас</a></li>
                    <li class="{{Route::currentRouteName()=='reviews'? 'active' :'' }}" style="display: none;"><a href="/reviews/">Отзывы</a></li>
                    @if(Auth::check())
                        <li style="border-left: 1px solid #000; padding-left: 2vw;" ><a href="/logout/">Выйти</a></li>
                    @else
                        <li style="border-left: 1px solid #000; padding-left: 2vw;" ><a href="/login" rel="show-login">Вход</a></li>
                    @endif
                </ul>
            </div>
            {{--            <div class="hNavMobMenu">--}}
            {{--                <span class="open_mob_menu"></span>--}}
            {{--            </div>--}}
        </div>
    </div>
</header>
<main id="app">
    @yield('content')
    <div class="offcanvas" rel="login-modal">
        <div class="overlay"></div>
        <login-component></login-component>
    </div>
</main>
<footer>
    <div class="container">
        <div class="col col-logo">
            <a href="/"><img src="/img/logo.png" alt="О нас"></a>
        </div>
        <div class="col col-contact">
            <p><a href="tel:+77052711177" class="phone">+7 (705) 271 11 77</a></p>
            <p><a href="mailto:info@karada.kz">info@karada.kz</a></p>
        </div>

        <div class="col col-social">
            <div style="margin-bottom: 5px;">Мы в соцсетях:</div>
            <ul>
                <li><a target="_blank" href="https://www.youtube.com/channel/UCqaMMY7Jm497AQH_nAQNfow" class="yt"></a></li>
                <li><a target="_blank" href="https://www.instagram.com/yusup.karada/" class="ig"></a></li>
            </ul>
        </div>
        <div class="col col-policy">
            <p>© KARADA Школа Продаж, 2020 <br>Все права защищены</p>
        </div>
        <div class="col col-address">
            <p style="text-align: center;">г. Алматы, пр. Аль Фараби, 7</p>
        </div>
        <div class="col col-links">
            {{--            <p><a href="#">Политика конфиденциальности</a></p>--}}
{{--            <p><a href="#">Договор оферты</a></p>--}}
        </div>
    </div>
</footer>

<link rel="stylesheet" href="/js/animate.css?v=141" type="text/css"/>
<link
        href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet">

<aside class="MobMenu">
    <div class="MobMenuHeader">
        <div class="MobMenulogo">
            <a href="/"><img src="/img/logo-blue.png" alt="О нас"></a>
        </div>
        <div class="MobMenuClose">
            <span class="open_mob_menu"></span>
        </div>
    </div>
    <div class="MobMenuNav">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/about/">О нас</a></li>
            <li style="display: none;" ><a href="/reviews/">Отзывы</a></li>
            <li class="button"><a href="#IndexPrice">попробовать бесплатно</a></li>
        </ul>
    </div>
</aside>
@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        (function ($) {
            $(function () {
                $('.open_mob_menu').click(function () {
                    $('.MobMenu').toggleClass('open');
                });
            });
        })(jQuery);

    </script>

    <script>
        $(".open_popup").attr("href", "#IndexPrice")
    </script>

    <script>
        $(document).ready(function () {
            $('[rel="close-login"]').on('click', function (e) {
                $('[rel="login-modal"]').removeClass('active');
                $('body').css('overflow-y', 'auto');
                e.preventDefault();
            });

            $('[rel="show-login"]').on('click', function (e) {
                $('[rel="login-modal"]').addClass('active');
                $('body').css('overflow-y', 'hidden');
                e.preventDefault();
            });
        });
    </script>

@show
</body>
</html>
