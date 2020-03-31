@extends('layouts.app')

@section('content')
    <section id="slider" class="slider">
        <div class="uk-height-viewport uk-overflow-hidden">
            <div
                class="uk-background-cover uk-background-top-center uk-background-muted uk-height-viewport uk-panel uk-flex uk-flex-center uk-flex-middle"
                style="background-image: url(/images/layer_91.jpg);"></div>
            <div
                class="uk-flex uk-flex-left uk-flex-middle uk-height-viewport uk-overlay-primary uk-position-top-left uk-width-1-1">
                <div class="uk-width-1-2 uk-margin-large-left uk-height-medium">
                    <h2 class="uk-article-title" uk-slideshow-parallax="x: 100,-100">
                        Уникальный бизнес
                        практикум
                        "Большие Продажи"
                    </h2>
                </div>
                <div class="uk-width-1-2 uk-margin-large-left uk-position-relative uk-height-medium">
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
                                    <h1 class="">Всего за 1 день вы получите:</h1>
                                    <h4 class="uk-text-uppercase">Пошаговый План По Раскрутке Своего Бизнеса:</h4>
                                    <ul class="uk-list uk-list-red uk-list-check">
                                        <li>малобюджетный маркетинг;</li>
                                        <li>реклама;</li>
                                        <li>продвижение;</li>
                                        <li>продажи;</li>
                                    </ul>
                                    <h4 class="uk-text-uppercase">100% Работающие инструменты для:</h4>
                                    <ul class="uk-list uk-list-red uk-list-check">
                                        <li>отстройки и отрыва от конкурентов;</li>
                                        <li>системного роста продаж;</li>
                                        <li>повышения лояльности клиентов;</li>
                                    </ul>
                                    <p>Практикум предназначен для всех предпринимателей, которые хотят <br>
                                        <b>много клиентов малыми затратами!</b></p>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-position-relative uk-first">
                    <div>
                        <div
                            class="uk-background-cover uk-background-top-center uk-height-1-1 uk-width-1-1 uk-position-top-left"
                            style="background-image: url(/images/layer_77.png); z-index: 0"></div>
                        <div
                            class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                            <span uk-icon="icon: play; ratio: 5" class="uk-text-white"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </section>
    <section class="program-speech">
        <div class="uk-container uk-container-small uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Программа:
            </h1>
            <ul uk-accordion>
                <li class="uk-open uk-card uk-card-default uk-card-body">
                    <a class="uk-accordion-title uk-margin-large-left" href="#">Блок 1: Маркетинг</a>
                    <div class="uk-accordion-content uk-flex uk-flex-center">
                        <div class="uk-margin-top">
                            <h4>Этот курс поможет Вам:</h4>
                            <ul class="uk-list uk-list-check">
                                <li>выгодно упаковать свой бизнес;</li>
                                <li>быстро оторваться от конкурентов малыми затратами;</li>
                                <li>оторваться от конкурентов;</li>
                                <li>увеличить лояльность клиентов;</li>
                                <li>системно увеличивать продажи.</li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="uk-card uk-card-default uk-card-body">
                    <a class="uk-accordion-title uk-margin-large-left" href="#">Блок 2: Реклама</a>
                    <div class="uk-accordion-content uk-flex uk-flex-center">
                        <div class="uk-margin-top uk-width-1-2@s">
                            <ul class="uk-list">
                                <li><span class="uk-text-red">1.</span> Стратегия малобюджетного инфошума</li>
                                <li><span class="uk-text-red">2.</span> Онлайн продвижение</li>
                                <li><span class="uk-text-red">3.</span> Офлайн продвижение</li>
                                <li><span class="uk-text-red">4.</span> Capaфанный маркетинг</li>
                                <li><span class="uk-text-red">5.</span> Партнерское продвижение</li>
                            </ul>
                            <p>Вы сформируете четкий план по малобюджетному продвижению, который принесет вам много
                                клиентов на системной основе!</p>
                        </div>
                    </div>
                </li>
                <li class="uk-card uk-card-default uk-card-body">
                    <a class="uk-accordion-title uk-margin-large-left" href="#">Блок 3: Продвижение</a>
                    <div class="uk-accordion-content">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur. Excepteur sint occaecat cupidatat proident.</p>
                    </div>
                </li>
                <li class="uk-card uk-card-default uk-card-body">
                    <a class="uk-accordion-title uk-margin-large-left" href="#">Блок 4: Продажи</a>
                    <div class="uk-accordion-content">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur. Excepteur sint occaecat cupidatat proident.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    @include('widgets.business-card')
    <section class="business-benefit">
        <div class="uk-container uk-container-small uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Что получает ваш бизнес:
            </h1>
            <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                <div class="uk-card-media-left uk-cover-container">
                    <img src="/images/business_workshop/business_workshop_1.png" alt="" uk-cover>
                    <canvas width="600" height="400"></canvas>
                </div>
                <div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">Результат</h3>
                        <p>Вы сформируете четкий пошаговый
                            план по маркетингу, рекламе,
                            продвижению и продажам на
                            следующий 12 месяцев.</p>
                    </div>
                </div>
            </div>
            <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                <div class="uk-flex-last@s uk-card-media-right uk-cover-container">
                    <img src="/images/business_workshop/business_workshop_2.png" alt="" uk-cover>
                    <canvas width="600" height="400"></canvas>
                </div>
                <div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">Выгода</h3>
                        <p>После практикума, вы не будете
                            нанимать дорогих консультантов по
                            составлению плана по маркетингу и
                            продвижение.</p>
                    </div>
                </div>
            </div>
            <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                <div class="uk-card-media-left uk-cover-container">
                    <img src="/images/business_workshop/business_workshop_3.png" alt="" uk-cover>
                    <canvas width="600" height="400"></canvas>
                </div>
                <div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">Польза</h3>
                        <p>Вы получите 100% работающием
                            проверенные инструменты, котори
                            уже помогли
                            предпринимателей
                            продажи! И сможете сразу
                            в свой бизнес</p>
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
    @include('widgets.reviews',['image'=>'/images/event_1.png'])
    <section class="price-course uk-margin">
        <div class="uk-container uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Стоимость:
            </h1>
            <div class="uk-child-width-1-2@s uk-grid" uk-grid="">
                <div class="uk-first-column">
                    <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-border uk-height-1-1">
                        <h3 class="uk-text-center uk-text-bold">Открытый практикум:</h3>
                        <ul class="uk-list uk-list-check">
                            <li>Участвуйте с другими предпринимателями.</li>
                            <li>Обучайтесь и создавайте деловые связи!</li>
                        </ul>
                        <p class="uk-text-center">
                            <span class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6 uk-text-gray">Старая цена:</span>
                            <span class="uk-h1 uk-text-gray uk-text-line-through">50 000 <span class="uk-display-inline-block uk-margin-right uk-text-left uk-text-small uk-width-1-6">тг</span></span>
                            <br>
                            <span class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6">Цена снгодня:</span>
                            <span class="uk-h1 uk-text-red">35 000 <span class="uk-display-inline-block uk-margin-right uk-text-left uk-text-small uk-width-1-6">тг</span></span>

                        </p>
                        <div class="uk-text-center uk-margin-bottom">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow">Оставить заявку</button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-border uk-height-1-1">
                        <h3 class="uk-text-center uk-text-bold">Закрытый практикум</h3>
                        <ul class="uk-list uk-list-check">
                            <li>Закажите обучение только для своих сотрудников</li>
                            <li>Разработайте пошаговый план развития бизнеса для своей организации и филиалов!</li>
                        </ul>
                        <p class="uk-text-center uk-text-red">
                            <span class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6">Цена от:</span>
                            <span class="uk-h1 uk-text-red">350 000</span>
                            <span class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6">тг и выше</span>
                        </p>
                        <div class="uk-text-center uk-margin-bottom">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow">Оставить заявку</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
