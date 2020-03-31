@extends('layouts.app')

@section('content')
    <section class="book_slider">
        <div class="uk-dark uk-padding uk-container uk-container-large uk-margin-large-top">
            <div class="uk-card uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                <div class="uk-flex-last@s uk-card-media-right uk-cover-container uk-margin-large-top">
                    <img src="/images/book/layer_94.png" alt="" uk-cover>
                    <canvas width="600" height="400"></canvas>
                </div>
                <div>
                    <div class="uk-card-body">
                        <h1 class="uk-h2 uk-text-turquoise uk-text-bold">Книга Юсупа Карада: <br>
                            <span class="uk-text-uppercase">"Прибыльный Маркетинг"</span></h1>
                        <p>Первая Казахстанская бизнес книга по маркатингу, созданная специально
                            для наших предпринимателей.</p>
                        <div>
                            <h4>Эта книга поможет Вам:</h4>
                            <ul class="uk-list uk-list-check">
                                <li>найти прибыльную нишу;</li>
                                <li>сформировать уникальность продукта,</li>
                                <li>оторваться от конкурентов;</li>
                                <li>увеличить лояльность клиентов;</li>
                                <li>результативно продвигать продукт;</li>
                                <li>эффективно рекламировать продукт;</li>
                                <li>внедрить системный маркетинг в бизнес;</li>
                                <li>сформировать малобюджетный маркетинговый план и стратегию;</li>
                                <li>системно повышать продажи.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-container">
            <div>
                <div class="uk-grid-collapse uk-child-width-expand@s uk-text-center" uk-grid>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-left uk-height-1-1">
                            <span class="uk-text-red uk-text-bold">более <span
                                    class="uk-text-large">70</span></span><br>
                            реальных Казахстанских
                            <b>бизнес примеров</b>. Нет
                            аналогов на рынке.
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-left uk-height-1-1">
                            <span class="uk-text-red uk-text-bold">более <span
                                    class="uk-text-large">150</span></span><br>
                            самых <b>эффективных
                                инструментов</b> маркетинга,
                            рекламы, продвижения и
                            продаж.
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-left uk-height-1-1">
                            <span class="uk-text-red uk-text-bold"><span class="uk-text-large">??????</span></span><br>
                            реальных Казахстанских
                            бизнес примеров. Нет
                            аналогов на рынке.
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-left uk-height-1-1">
                            <span class="uk-text-red uk-text-bold"><span class="uk-text-large">??????</span></span><br>
                            самых эффективных
                            инструментов маркетинга,
                            рекламы, продвижения и
                            продаж.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('widgets.business-card')

    <section class="show-book">
        <div class="uk-container uk-padding">
            <div class="uk-card uk-card-default uk-card-body uk-width-1-1">
                <div class="uk-child-width-1-2" uk-grid="">
                    <div class="uk-padding">
                        <h3 class="uk-h2">Вы можете ознакомиться с книйой
                            Бесплатно!</h3>
                        <p>
                            <button class="uk-button uk-button-default uk-border-red">Скачать</button>
                        </p>
                    </div>
                    <div class="uk-visible@s">
                        <img src="/images/book/book.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('widgets.reviews',['image'=>'/images/event_1.png'])

    <section class="price-book">
        <div class="uk-container uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Стоимость книги:
            </h1>
            <div class="uk-child-width-1-2@s" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-border uk-height-1-1">
                        <h3 class="uk-text-center uk-text-bold">Бумажная версия:</h3>
                        <p class="uk-text-center">Продается в сети магазинов "меломан":</p>
                        <p class="uk-text-center">
                            <span
                                class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6">Цена снгодня:</span>
                            <span class="uk-h1 uk-text-red">2 990</span>
                        </p>
                        <div class="uk-text-center uk-margin-bottom">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow"><i
                                    class="uk-icon-meloman"></i>Купить книгу
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-border uk-height-1-1">
                        <h3 class="uk-text-center uk-text-bold">Электронная версия:</h3>
                        <p class="uk-text-center">Читайте в удобном формате на своем любимом
                            гаджете</p>
                        <p class="uk-text-center">
                            <span
                                class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6">Цена снгодня:</span>
                            <span class="uk-h1 uk-text-red">1 990</span>
                        </p>
                        <div class="uk-text-center uk-margin-bottom uk-child-width-1-2" uk-grid="">
                            <div class="uk-text-right">
                                <a href="#">
                                    <img src="/images/icon/google_paly.png" style="height: 50px" alt="">
                                </a>
                            </div>
                            <div class="uk-text-left">
                                <a href="#">
                                    <img src="/images/icon/app_store.png" style="height: 50px" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
