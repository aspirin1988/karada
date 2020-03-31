@extends('layouts.app')

@section('content')
    <section id="slider" class="slider">
        <div class="uk-height-viewport uk-overflow-hidden">
            <div
                class="uk-background-cover uk-background-top-center uk-background-muted uk-height-viewport uk-panel uk-flex uk-flex-center uk-flex-middle"
                style="background-image: url(/images/speaker/layer_84.png);"></div>
            <div
                class="uk-flex uk-flex-left uk-flex-middle uk-height-viewport uk-overlay-primary uk-position-top-left uk-width-1-1@s">
                <div class="uk-width-1-2@s uk-margin-large-left uk-height-medium">
                    <h2 class="uk-article-title" uk-slideshow-parallax="x: 100,-100">
                        Юсуп Карада <br>
                    </h2>
                    <p class="uk-h3 uk-margin-remove-top uk-padding-remove-top">Харизматичный спикер дающий 100% <br>
                        полезный и интересный контент <br>
                        слушателям!</p>
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
    @include('widgets.business-card')
    <section class="events_">
        <div class="uk-container uk-container-large uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Мероприятия:
            </h1>
            <ul class="uk-child-width-1-3@s" uk-grid="">
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
        </div>
    </section>
    <section class="marketing">
        <div class="uk-container uk-container-large uk-padding uk-margin-auto uk-flex uk-flex-center">
            <ul class="uk-list uk-list-red uk-list-check uk-width-2-3@s">
                <li>Выступления Юсупа всегда дают большой заряд позитивной энергетики и
                    огромную пользу для предпринимателей, бизнесменов, сотрудников компаний,
                    чиновников и студентов!
                </li>
                <li>Ваше мероприятие станет еще интереснее, ятче и полезнее!</li>
            </ul>
        </div>
        <hr>
    </section>
    <section class="marketing">
        <div class="uk-container uk-container-large uk-padding uk-margin-auto uk-flex uk-flex-center">
            <div class="uk-form uk-width-2-3@s">
                <div class="uk-margin uk-text-center uk-child-width-1-3@s uk-grid-match" uk-grid="">
                    <div>
                        <span class="uk-display-block uk-form-label">Имя</span>
                        <input class="uk-input uk-first-column uk-border-rounded" type="text"
                               placeholder="Имя">
                    </div>
                    <div>
                        <span class="uk-display-block uk-form-label">Телефон</span>
                        <input class="uk-input uk-first-column uk-border-rounded" type="text"
                               placeholder="+7 (___) _______">
                    </div>
                    <div>

                        <span style="visibility: hidden" class="uk-display-block uk-form-label">&nbsp;</span>
                        <button class="uk-button uk-button-default uk-border-yellow">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
