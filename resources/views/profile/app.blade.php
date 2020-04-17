<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico" type="image/png">

    @hasSection('title')
        @yield('title')
    @else
        <title>Личный кабинет</title>
    @endif

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('styles')
        <link rel="stylesheet" href="/css/profile.css?v=144">
        <link rel="stylesheet" href="/js/owl.carousel.css?v=144">
        <link rel="stylesheet" href="/js/owl.theme.default.min.css?v=144">
    @show
    <link rel="stylesheet" href="/plyr/plyr.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/afterglow/latest/afterglow.min.js"></script>
    <script crossorigin="" src="/plyr/plyr.js"></script>
    <style>
        .pie {
            width: 200px;
            height: 200px;
        }

        .pie.big {
            width: 240px;
            height: 240px;
        }
        .owl-controls{
            display: none;
        }
    </style>
</head>
<body
    {!! (isset($background)? "style=\"background: url('".$background."') no-repeat center center/cover; background-attachment: fixed;\" ":"") !!} class="{{(Auth::check() && !Auth::user()->getAccess()?'no-pay':'')}}">
@include('profile.header')
<main id="app">
    @yield('content')
    <div class="offcanvas" rel="menu_modal">
        <div class="overlay"></div>
        <div class="offcanvas-container">
            <div class="close" rel="menu_modal_close">закрыть</div>
            @if(Auth::check())
                <div class="menu-ava">
                    <div class="ava">
                        <img src="{{Auth::check()?Auth::user()->getAva():'/img/empty.png'}}" alt="">
                        <a href="{{(Auth::check()? Auth::user()->getLasLesson():'#')}}"
                           class="button round button-blue-stroke " style="border: none;"><i class="icon play"></i>
                            продолжить урок
                        </a>
                    </div>
                </div>
            @endif
            <ul class="menu-list">
                <li><i class="icon copy"></i><a href="/home/course/1">Курс "Альфа Продавец"</a></li>
                <li><i class="icon user"></i><a href="/home">личный кабинет</a></li>
                <li class="visible-mobile" ><i class="icon lock"></i><a href="/home/password/update">сменить пароль</a></li>
                {{--                <li><i class="icon goals"></i><a href="/home/personal_goals">личные цели</a></li>--}}
                {{--                <li><i class="icon motivation_"></i><a href="/home/motivation">Мотивация</a></li>--}}
                {{--                <li><i class="icon medal"></i><a href="/home/rewards">Дипломы и сертификаты</a></li>--}}
                {{--                <li><i class="icon news"></i><a href="/home/news">Новости</a></li>--}}
                {{--                <li><i class="icon help"></i><a href="/home/help">помощь</a></li>--}}
                {{--                <li><i class="icon about"></i><a href="/home/about">об университете</a></li>--}}
                @if(Auth::check())
                    <li><i class="icon exit"></i><a href="/logout">выйти</a></li>
                @else
                    <li><i class="icon exit"></i><a href="/login">войти</a></li>
                @endif
                <li class="visible-mobile">
                    <div class="warning">
                        <strong>Внимание!</strong>
                        <p>Полный функционал портала доступен на компьютере / ноутбуке / планшете.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Auth::check())
        <timer-component :id="'{{\Illuminate\Support\Facades\Auth::id()}}'"></timer-component>
    @endif
</main>
<div class="offcanvas" rel="news-video">
    <div class="overlay"></div>
    <div class="center-center">
        <div class="block modal-body">
            <div class="close" rel="news-video_modal_close">закрыть</div>
            <div class="video-container">
                <video width="100%" controls="controls" controlsList="nodownload">
                    <source type="video/mp4" src=""/>
                    <source type="video/mp4" src="" data-quality="hd"/>
                </video>
            </div>
        </div>
    </div>
</div>

@include('profile.footer')
</body>
@section('script')
    <script src="/js/profile.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/owl.carousel.js"></script>
    <script>
        $.fn.andSelf = function() {
            return this.addBack.apply(this, arguments);
        };
        $(document).ready(function () {
            let owl_my_materials = $(".my_materials .owl-carousel").owlCarousel(
                {
                    loop: true,
                    margin: 10,
                    nav: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 2
                        }
                    }
                }
            );
            $('.my_materials .slider-arrow-container .slide-arrow-right').click(function () {
                owl_my_materials.trigger('next.owl.carousel');
            });

            $('.my_materials .slider-arrow-container .slide-arrow-left').click(function () {
                owl_my_materials.trigger('prev.owl.carousel', [300]);
            });

            let owl_personal_goals_modal = $('[rel="personal_goals_modal"] .owl-carousel').owlCarousel(
                {
                    loop: true,
                    margin: 10,
                    nav: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 2
                        }
                    }
                }
            );

            $('[rel="personal_goals_modal"] .slider-arrow-container .slide-arrow-right').click(function () {
                owl_personal_goals_modal.trigger('next.owl.carousel');
            });

            $('[rel="personal_goals_modal"] .slider-arrow-container .slide-arrow-left').click(function () {
                owl_personal_goals_modal.trigger('prev.owl.carousel', [300]);
            });

            let owl_news_block = $('.news_block .owl-carousel').owlCarousel(
                {
                    loop: true,
                    margin: 10,
                    nav: false,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 2
                        },
                        800: {
                            items: 3
                        }
                    }
                }
            );

            $('.news_block .slider-arrow-container .slide-arrow-right').click(function () {
                owl_news_block.trigger('next.owl.carousel');
            });

            $('.news_block .slider-arrow-container .slide-arrow-left').click(function () {
                owl_news_block.trigger('prev.owl.carousel', [300]);
            });

            let owl_personal_goals_chief = $(".personal_goals.chief .owl-carousel").owlCarousel(
                {
                    loop: true,
                    margin: 10,
                    nav: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        800: {
                            items: 3
                        }
                    }
                }
            );
            $('.personal_goals.chief .slider-arrow-container .slide-arrow-right').click(function () {
                owl_personal_goals_chief.trigger('next.owl.carousel');
            });
            $('.personal_goals.chief .slider-arrow-container .slide-arrow-left').click(function () {
                owl_personal_goals_chief.trigger('prev.owl.carousel', [300]);
            });

            $('.personal_goals.chief .slider-arrow-container .slide-arrow-right').click(function () {
                owl_personal_goals_chief.trigger('next.owl.carousel');
            });

            $('.personal_goals.chief .slider-arrow-container .slide-arrow-left').click(function () {
                owl_personal_goals_chief.trigger('prev.owl.carousel', [300]);
            });

            let owl_personal_goals = $(".personal_goals .owl-carousel").owlCarousel(
                {
                    loop: true,
                    margin: 10,
                    nav: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1
                        },
                        800: {
                            items: 2
                        }
                    }
                }
            );
            $('.personal_goals .slider-arrow-container .slide-arrow-right').click(function () {
                owl_personal_goals.trigger('next.owl.carousel');
            });

            $('.personal_goals .slider-arrow-container .slide-arrow-left').click(function () {
                owl_personal_goals.trigger('prev.owl.carousel', [300]);
            })
        });
    </script>

@show
</html>
