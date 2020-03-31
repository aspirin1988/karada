@extends('layouts.app')

{{--@section('title')--}}
{{--<title>{{$page->title}}</title>--}}
{{--@endsection--}}

@section('content')

{{--@php  $page->text @endphp--}}
    <section id="slider" class="slider">
        <div class="uk-auto-play uk-position-relative" uk-slideshow="animation: push;">
            <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin uk-position-bottom-center uk-position-z-index"></ul>
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                <ul class="uk-slideshow-items" uk-height-viewport="min-height: 300">
                    <li>
                        <img src="/images/layer_91.jpg" alt="" uk-cover>
                        <div
                            class="uk-flex uk-flex-center uk-flex-column uk-flex-middle uk-height-1-1 uk-overlay-primary uk-position-absolute uk-width-1-1">
                            <h2 class="uk-text-center uk-width-2-3@m" uk-slideshow-parallax="x: 100,-100">Помогаем
                                бизнесам
                                получать много клиентов малыми затратами</h2>
                            <p uk-slideshow-parallax="x: 200,-200">
                                <button class="uk-button uk-button-default uk-border-red">Подробнее</button>
                            </p>
                        </div>
                    </li>
                    <li>
                        <img src="/images/layer_91.jpg" alt="" uk-cover>
                        <div
                            class="uk-flex uk-flex-center uk-flex-column uk-flex-middle uk-height-1-1 uk-overlay-primary uk-position-absolute uk-width-1-1">
                            <h2 class="uk-text-center uk-width-2-3@m" uk-slideshow-parallax="x: 100,-100">Помогаем
                                бизнесам
                                получать много клиентов малыми затратами</h2>
                            <p uk-slideshow-parallax="x: 200,-200">
                                <button class="uk-button uk-button-default uk-border-red">Подробнее</button>
                            </p>
                        </div>
                    </li>
                    <li>
                        <img src="/images/layer_91.jpg" alt="" uk-cover>
                        <div
                            class="uk-flex uk-flex-center uk-flex-column uk-flex-middle uk-height-1-1 uk-overlay-primary uk-position-absolute uk-width-1-1">
                            <h2 class="uk-text-center uk-width-2-3@m" uk-slideshow-parallax="x: 100,-100">Помогаем
                                бизнесам
                                получать много клиентов малыми затратами</h2>
                            <p uk-slideshow-parallax="x: 200,-200">
                                <button class="uk-button uk-button-default uk-border-red">Подробнее</button>
                            </p>
                        </div>
                    </li>
                </ul>

                <a class="uk-position-center-left uk-position-small uk-border-solid-circle uk-visible@s" href="#"
                   uk-slideshow-item="previous" uk-icon="icon: arrow-left; ratio: 2"></a>
                <a class="uk-position-center-right uk-position-small uk-border-solid-circle uk-visible@s" href="#"
                   uk-slideshow-item="next"
                   uk-icon="icon: arrow-right; ratio: 2"></a>

            </div>
        </div>
    </section>
    <section class="services">
        <div class="uk-container uk-container-large uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Услуги для бизнеса:
            </h1>
            <div class="uk-my-grid-2">
                <div class="uk-position-relative uk-first">
                    <div>
                        <div class="uk-position-absolute uk-width-1-1 uk-height-1-1 uk-background-cover uk-background-top-center uk-panel uk-flex uk-flex-center uk-flex-middle"
                             style="background-image: url('/images/layer_77.png');" uk-over-container=""></div>
                        <div class="uk-height-1-1 uk-overlay-primary uk-position-top"></div>
                        <ul class="uk-list uk-position-bottom-left">
                            <li><span>Бизнес школа:</span></li>
                            <li uk-over="/images/layer_56.png"><a href="/book/">- Книга</a></li>
                            <li uk-over="/images/layer_77.png"><a href="/online_course/">- Онлайн курсы</a></li>
                            <li uk-over="/images/layer_77.png"><a href="/workshop/">- Бизнес практикум</a></li>
                            <li uk-over="/images/layer_77.png"><a href="/master_class/">- Мастер классы</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="uk-position-relative">
                        <div class="uk-background-cover uk-background-top-center  uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                             style="background-image: url('/images/layer_7.png');" uk-over-container=""></div>
                        <div class="uk-height-1-1 uk-overlay-primary uk-position-top"></div>
                        <a class="uk-position-bottom-left uk-padding uk-padding-remove-bottom uk-text-white uk-h3"
                           href="/consulting/">Услуги по консалтингу</a>
                    </div>
                    <div class="uk-margin-top uk-position-relative">
                        <div class="uk-background-cover uk-background-top-center  uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                             style="background-image: url('/images/layer_3.png');" uk-over-container=""></div>
                        <div class="uk-height-1-1 uk-overlay-primary uk-position-top"></div>
                        <a class="uk-position-bottom-left uk-padding uk-padding-remove-bottom uk-text-white uk-h3"
                           href="/speaker/">Спикер</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="clients">
        <div class="uk-container uk-container-large uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Наши клиенты:
            </h1>
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true; ">
                <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-5@s uk-child-width-1-5@m">
                    <li>
                        <img src="/images/layer_51.png" alt="">
                    </li>
                    <li>
                        <img src="/images/layer_52.png" alt="">
                    </li>
                    <li>
                        <img src="/images/layer_53.png" alt="">
                    </li>
                    <li>
                        <img src="/images/layer_54.png" alt="">
                    </li>
                    <li>
                        <img src="/images/layer_55.png" alt="">
                    </li>
                    <li>
                        <img src="/images/layer_51.png" alt="">
                    </li>
                    <li>
                        <img src="/images/layer_52.png" alt="">
                    </li>
                    <li>
                        <img src="/images/layer_53.png" alt="">
                    </li>
                    <li>
                        <img src="/images/layer_54.png" alt="">
                    </li>
                    <li>
                        <img src="/images/layer_55.png" alt="">
                    </li>


                </ul>

                <a class="uk-position-center-left uk-position-small uk-border-solid-circle uk-border-red uk-text-red uk-visible@s"
                   href="#"
                   uk-slider-item="previous" uk-icon="icon: arrow-left; ratio: 2"></a>
                <a class="uk-position-center-right uk-position-small uk-border-solid-circle uk-border-red uk-text-red uk-visible@s"
                   href="#"
                   uk-slider-item="next"
                   uk-icon="icon: arrow-right; ratio: 2"></a>

            </div>
        </div>
    </section>
    <section class="events">
        <div class="uk-container uk-container-large uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Мероприятия:
            </h1>
            <div uk-slider="">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                    <ul class="uk-slider-items uk-child-width-1-3@s uk-grid">
                        <li>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-media-top">
                                    <div class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                         style="background-image: url(/images/event_1.png);"></div>
                                </div>
                                <div class="uk-padding-small">
                                    <div class="uk-my-grid">
                                        <div class="uk-text-center">
                                            <h3 class="uk-card-title uk-text-red uk-text-bold">11</h3>
                                            <p class="uk-text-red">апреля</p>
                                        </div>
                                        <div>
                                            <h3 class="uk-card-title">Выступление в КБТУ</h3>
                                            <p>Разговор шел о малобюджетном маркетинге</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-media-top">
                                    <div class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                         style="background-image: url(/images/event_2.png);"></div>
                                </div>
                                <div class="uk-padding-small">
                                    <div class="uk-my-grid">
                                        <div class="uk-text-center">
                                            <h3 class="uk-card-title uk-text-red uk-text-bold ">11</h3>
                                            <p class="uk-text-red">апреля</p>
                                        </div>
                                        <div>
                                            <h3 class="uk-card-title">Выступление в КБТУ</h3>
                                            <p>Разговор шел о малобюджетном маркетинге</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-media-top">
                                    <div class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                         style="background-image: url(/images/event_3.jpg);"></div>
                                </div>
                                <div class="uk-padding-small">
                                    <div class="uk-my-grid">
                                        <div class="uk-text-center">
                                            <h3 class="uk-card-title uk-text-red uk-text-bold">11</h3>
                                            <p class="uk-text-red">апреля</p>
                                        </div>
                                        <div>
                                            <h3 class="uk-card-title">Выступление в КБТУ</h3>
                                            <p>Разговор шел о малобюджетном маркетинге</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-media-top">
                                    <div class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                         style="background-image: url(/images/event_1.png);"></div>
                                </div>
                                <div class="uk-padding-small">
                                    <div class="uk-my-grid">
                                        <div class="uk-text-center">
                                            <h3 class="uk-card-title uk-text-red uk-text-bold">11</h3>
                                            <p class="uk-text-red">апреля</p>
                                        </div>
                                        <div>
                                            <h3 class="uk-card-title">Выступление в КБТУ</h3>
                                            <p>Разговор шел о малобюджетном маркетинге</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-media-top">
                                    <div class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                         style="background-image: url(/images/event_2.png);"></div>
                                </div>
                                <div class="uk-padding-small">
                                    <div class="uk-my-grid">
                                        <div class="uk-text-center">
                                            <h3 class="uk-card-title uk-text-red uk-text-bold">11</h3>
                                            <p class="uk-text-red">апреля</p>
                                        </div>
                                        <div>
                                            <h3 class="uk-card-title">Выступление в КБТУ</h3>
                                            <p>Разговор шел о малобюджетном маркетинге</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-media-top">
                                    <div class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                         style="background-image: url(/images/event_3.jpg);"></div>
                                </div>
                                <div class="uk-padding-small">
                                    <div class="uk-my-grid">
                                        <div class="uk-text-center">
                                            <h3 class="uk-card-title uk-text-red uk-text-bold">11</h3>
                                            <p class="uk-text-red">апреля</p>
                                        </div>
                                        <div>
                                            <h3 class="uk-card-title">Выступление в КБТУ</h3>
                                            <p>Разговор шел о малобюджетном маркетинге</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <a class="uk-position-center-left uk-position-small uk-border-solid-circle uk-visible@s"
                       href="#"
                       uk-slider-item="previous" uk-icon="icon: arrow-left; ratio: 2"></a>
                    <a class="uk-position-center-right uk-position-small uk-border-solid-circle uk-visible@s"
                       href="#"
                       uk-slider-item="next"
                       uk-icon="icon: arrow-right; ratio: 2"></a>
                </div>
            </div>
            <div class="uk-text-center">
                <a class="uk-button uk-button-default uk-border-red" href="/events/">Все мероприятия</a>
            </div>
        </div>
    </section>
    <section class="subscription">
        <div class="uk-container uk-container-large uk-padding">
            <div class="uk-form">
                <div class="uk-child-width-expand@s uk-grid-collapse" uk-grid>
                    <div class="uk-grid-item-match">
                        <div class="uk-card uk-position-relative uk-height-medium">
                            <div class="uk-flex uk-flex-center uk-flex-column uk-flex-middle uk-height-1-1 uk-overlay-primary uk-width-1-1"></div>
                            <div class="uk-background-cover uk-background-top-center uk-height-1-1 uk-width-1-1 uk-position-top-left" style="background-image: url(/images/subscription_background.png); z-index: 0"></div>
                            <div class="uk-position-top-left uk-padding uk-text-center">
                                <h3 class="uk-text-white uk-h2 uk-text-bold">E-mail рассылка:</h3>
                                <p class="uk-text-white">Получай интересную информацию для повышения своих продаж.</p>
                                <div class="uk-margin" uk-margin>
                                    <div uk-form-custom="target: true">
                                        <input class="uk-input uk-form-width-medium uk-border-rounded uk-background-transparent uk-margin-right uk-placeholder-color-white uk-text-white" type="text" placeholder="Ваш e-mail">
                                    </div>
                                    <button class="uk-button uk-button-default uk-text-red uk-border-red">Подписатся</button>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="uk-visible@s">
                        <div class="uk-card uk-position-relative uk-height-medium">
                            <div class="uk-flex uk-flex-center uk-flex-column uk-flex-middle uk-height-1-1 uk-overlay-default uk-width-1-1"></div>
                            <div class="uk-background-cover uk-background-top-center uk-height-1-1 uk-width-1-1 uk-position-top-left" style="background-image: url(/images/layer_20.png); z-index: 0"></div>
                            <div class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                <span uk-icon="icon: play; ratio: 5" class="uk-text-white"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
