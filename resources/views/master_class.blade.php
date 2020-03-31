@extends('layouts.app')

@section('content')
    <section id="slider" class="slider">
        <div class="uk-height-viewport uk-overflow-hidden">
            <div
                class="uk-background-cover uk-background-top-center uk-background-muted uk-height-viewport uk-panel uk-flex uk-flex-center uk-flex-middle"
                style="background-image: url(/images/master_class/layer_41.png);"></div>
            <div
                class="uk-flex uk-flex-left uk-flex-middle uk-height-viewport uk-overlay-primary uk-position-top-left uk-width-1-1@s">
                <div class="uk-width-1-2@s uk-margin-large-left uk-height-medium">
                    <h2 class="uk-article-title" uk-slideshow-parallax="x: 100,-100">
                        Mactep Kласс: <br>
                        "Много клиентов малыми <br>
                        затратами"
                    </h2>
                </div>
                <div class="uk-width-1-2@s uk-margin-large-left uk-position-relative uk-height-medium uk-visible@s">
                    <div class="uk-position-top-right uk-margin-large-right">
                        <h2 class="uk-article-title uk-border-red uk-heading-divider uk-padding-remove-vertical"
                            uk-slideshow-parallax="x: 100,-100">
                            01.04.2018
                        </h2>
                        <p>г. Алматы ТРЦ "Мега Парк"</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-text-center uk-flex uk-flex-center uk-padding-small">
            <p class="uk-width-1-2@s uk-h3">
                Узнайте как быстро и малозатратно раскратить свой бизнес,
                оторваться от конкурентов и увеличить продажи!
            </p>
        </div>
    </section>
    <section class="marketing">
        <hr>
        <div class="uk-container uk-container-large uk-padding">
            <div class="uk-my-grid-2">
                <div>
                    <div>
                        <div class="uk-card uk-padding">
                            <div class="uk-card uk-margin-large-top">
                                <article class="uk-article">
                                    <h4 class="uk-text-uppercase">Узнаете:</h4>
                                    <ul class="uk-list uk-list-red uk-list-check">
                                        <li>Как оторваться от конкурентов;</li>
                                        <li>Как поднять лояльность клиентов;</li>
                                        <li>Как системно увеличивать продажи.</li>
                                    </ul>
                                    <h4 class="uk-text-uppercase">Вы получите 100% Работающие Инструменты:</h4>
                                    <ul class="uk-list uk-list-red uk-list-check">
                                        <li>Малобюджетного маркетинга;</li>
                                        <li>Эффективной рекламы;</li>
                                        <li>Результативного продвижения;</li>
                                        <li>Системных продаж.</li>
                                    </ul>
                                    <h4 class="uk-text-uppercase uk-text-red">Бонус - Разбор Бизнес Кейсов:</h4>
                                    <ul class="uk-list uk-list-red uk-list-check uk-text-red">
                                        <li>Разбор и помощь участникам в поиске эффективного решения
                                            проблем бизнеса;
                                        </li>
                                        <li>Экспертные ответы на все свои вопросы.</li>
                                    </ul>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-position-relative uk-first">
                    <div>
                        <div
                            class="uk-background-cover uk-background-top-center uk-height-1-1 uk-width-1-1 uk-position-top-left"
                            style="background-image: url(/images/master_class/layer_103.png); z-index: 0"></div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </section>
    <section class="events">
        <div class="uk-container uk-container-large uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Мастер-калассы:
            </h1>
            <div uk-slider="">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                    <ul class="uk-slider-items uk-child-width-1-3@s uk-grid">
                        <li>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-media-top">
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
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
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
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
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
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
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
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
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
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
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
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
                    <a class="uk-position-center-left uk-position-small uk-border-solid-circle uk-visible@s uk-text-red uk-border-red"
                       href="#"
                       uk-slider-item="previous" uk-icon="icon: arrow-left; ratio: 2"></a>
                    <a class="uk-position-center-right uk-position-small uk-border-solid-circle uk-visible@s uk-text-red uk-border-red"
                       href="#"
                       uk-slider-item="next"
                       uk-icon="icon: arrow-right; ratio: 2"></a>
                </div>
            </div>
        </div>
    </section>
    @include('widgets.business-card')
    @include('widgets.reviews',['image'=>'/images/event_1.png'])
    <section class="price-course uk-margin">
        <div class="uk-container uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Стоимость:
            </h1>
            <div class="uk-child-width-1-2@s uk-grid" uk-grid="">
                <div class="uk-first-column">
                    <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-border uk-height-1-1">
                        <h3 class="uk-text-center uk-text-bold">Живое участие:</h3>
                        <p class="uk-text-center">
                            Место и время: <b>Алматы, Балуан-шолак, 14:00</b><br>
                            Длительность: <b>2 часа</b>
                        </p>
                        <p class="uk-text-center">
                            <span
                                class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6">Цена:</span>
                            <span class="uk-h1 uk-text-red">5 000 <span
                                    class="uk-display-inline-block uk-margin-right uk-text-left uk-text-small uk-width-1-6">тг</span></span>
                        </p>
                        <p class="uk-text-center">Количество мест ограничено!</p>
                        <div class="uk-text-center uk-margin-bottom">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow">Оставить заявку
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-border uk-height-1-1">
                        <h3 class="uk-text-center uk-text-bold">Онлайн участие</h3>
                        <p class="uk-text-center">Время: <b>14:00</b><br>
                            Длительность: <b>2 часа</b>
                        </p>
                        <p class="uk-text-center uk-text-red">
                            <span
                                class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6">Цена:</span>
                            <span class="uk-h1 uk-text-red">2 000</span>
                            <span
                                class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6">тг</span>
                        </p>
                        <p class="uk-text-center">Участвуйте из любого города!</p>
                        <div class="uk-text-center uk-margin-bottom">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow">Оставить заявку
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
