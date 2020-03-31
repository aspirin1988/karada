@extends('layouts.app')

@section('content')
    <section class="book_slider">
        <div class="uk-dark uk-padding uk-container uk-container-large uk-margin-large-top">
            <div class="uk-card uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                <div class="uk-flex-last@s uk-card-media-right uk-cover-container">
                    <img src="/images/online_course/layer_129.png" alt="" uk-cover>
                    <canvas width="600" height="400"></canvas>
                </div>
                <div class="uk-margin-small-top">
                    <div class="uk-card-body">
                        <div class="uk-text-right">
                            <a class="uk-button uk-button-default uk-border-red" href="{{ route('login') }}">Войти в личный кабинет</a>
                        </div>
                        <h1 class="uk-h2 uk-text-turquoise uk-text-bold">Онлайн курс <br> "Малобюджетный маркетинг
                            продажи"</h1>
                        <p>Научитесь получать Много малыми затратами!</p>
                        <div>
                            <h4>Этот курс поможет Вам:</h4>
                            <ul class="uk-list uk-list-check">
                                <li>выгодно упаковать свой бизнес;</li>
                                <li>быстро оторваться от конкурентов малыми затратами;</li>
                                <li>оторваться от конкурентов;</li>
                                <li>увеличить лояльность клиентов;</li>
                                <li>системно увеличивать продажи.</li>
                            </ul>
                            <h4>Видеокурс предназначен для:</h4>
                            <ul class="uk-list uk-list-check">
                                <li>начинающих предпринимателей;</li>
                                <li>существующих бизнесов;</li>
                                <li>сетевого бизнеса.</li>
                            </ul>
                            <p class="uk-text-small uk-text-gray">*курс не предназначен для следующих бизнесов: продажа
                                алкоголя, табака, игорные заведения</p>
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
                                    class="uk-text-large">220</span></span><br>
                            <b>видеоуроков</b>, изложенные на
                            простом и понятном языке с
                            примерами и советами!
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-left uk-height-1-1">
                            <span class="uk-text-red uk-text-bold">более <span
                                    class="uk-text-large">350</span></span><br>
                            самых <b>эффективных
                                инструментов</b> маркетинга,
                            рекламы, продвижения и
                            продаж.
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-left uk-height-1-1">
                            <span class="uk-text-red uk-text-bold"><span class="uk-text-large"><i
                                        uk-icon="icon:clock; ratio: 2"></i></span></span><br>
                            <b>12 месяцев:</b> онлайн доступ к
                            курсу в течение года
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-text-left uk-height-1-1">
                            <span class="uk-text-red uk-text-bold"><span class="uk-text-large"><i
                                        uk-icon="icon:file-text; ratio: 2"></i></span></span><br>
                            Онлайн <b>тестирование</b> и
                            <b>сертификат</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="course-content">
        <div class="uk-container uk-container-small uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Содержание видеокурса:
            </h1>
            <ul uk-accordion>
                <li class="uk-open uk-card uk-card-default uk-card-body">
                    <a class="uk-accordion-title" href="#">Блок 1: Позиционирование и упаковка
                        бизнеса</a>
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
                    <a class="uk-accordion-title" href="#">Блок 2: Реклама, продвижение продажи</a>
                    <div class="uk-accordion-content uk-flex uk-flex-center">
                        <div class="uk-margin-top">
                            <h4>Более 60 видеороликов;</h4>
                            <ul class="uk-list">
                                <li><span class="uk-text-red">1.</span> Социальные сети</li>
                                <li><span class="uk-text-red">2.</span> Интернет каталоги</li>
                                <li><span class="uk-text-red">3.</span> Рассылка</li>
                                <li><span class="uk-text-red">4.</span> Продажи "чужими руками</li>
                                <li><span class="uk-text-red">5.</span> Продажи и продвижение через нетворкинг</li>
                                <li><span class="uk-text-red">6.</span> Реклама Btl</li>
                                <li><span class="uk-text-red">7.</span> Прямые продажи</li>
                                <li><span class="uk-text-red">+ Многое другое</span></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="uk-card uk-card-default uk-card-body">
                    <a class="uk-accordion-title" href="#">Блок 3: Фишки и секреты</a>
                    <div class="uk-accordion-content">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur. Excepteur sint occaecat cupidatat proident.</p>
                    </div>
                </li>
                <li class="uk-card uk-card-default uk-card-body">
                    <a class="uk-accordion-title" href="#">Блок 4: Полезные материалы</a>
                    <div class="uk-accordion-content">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur. Excepteur sint occaecat cupidatat proident.</p>
                    </div>
                </li>
                <li class="uk-card uk-card-default uk-card-body">
                    <a class="uk-button-text uk-comment-title" href="#">Полное содержание курса в
                        pdf
                        <button class="uk-button uk-button-default uk-border-red uk-float-right">Скачать</button>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <section class="course-example">
        <div class="uk-container uk-container-large uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Примеры Курса:
            </h1>
            <div uk-slider="" class="uk-slider uk-slider-container">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                    <ul class="uk-child-width-1-4@s uk-grid uk-padding uk-padding-remove-horizontal uk-slider-items">
                        <li>
                            <div class="uk-card uk-card-default uk-height-1-1">
                                <div class="uk-position-relative">
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                        style="background-image: url(/images/online_course/layer_64.png);"></div>
                                    <div
                                        class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                        <span uk-icon="icon: play; ratio: 5" class="uk-text-white uk-icon"></span>
                                    </div>
                                </div>
                                <div class="uk-padding-small">
                                    <p class="uk-text-red">Пример #1</p>
                                    <h3 class="uk-card-title uk-margin-remove-top">Продающая визитка</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default uk-height-1-1">
                                <div class="uk-position-relative">
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                        style="background-image: url(/images/online_course/layer_70.png);"></div>
                                    <div
                                        class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                        <span uk-icon="icon: play; ratio: 5" class="uk-text-white uk-icon"></span>
                                    </div>
                                </div>
                                <div class="uk-padding-small">
                                    <p class="uk-text-red">Пример #2</p>
                                    <h3 class="uk-card-title uk-margin-remove-top">Список Чзв</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default uk-height-1-1">
                                <div class="uk-position-relative">
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                        style="background-image: url(/images/online_course/layer_76.png);"></div>
                                    <div
                                        class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                        <span uk-icon="icon: play; ratio: 5" class="uk-text-white uk-icon"></span>
                                    </div>
                                </div>
                                <div class="uk-padding-small">
                                    <p class="uk-text-red">Пример #3</p>
                                    <h3 class="uk-card-title uk-margin-remove-top">Продающее коммерческое
                                        предложеие</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default uk-height-1-1">
                                <div class="uk-position-relative">
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                        style="background-image: url(/images/online_course/layer_82.png);"></div>
                                    <div
                                        class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                        <span uk-icon="icon: play; ratio: 5" class="uk-text-white uk-icon"></span>
                                    </div>
                                </div>
                                <div class="uk-padding-small">
                                    <p class="uk-text-red">Пример #4</p>
                                    <h3 class="uk-card-title uk-margin-remove-top">Продающий лэндинг пэйдж</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default uk-height-1-1">
                                <div class="uk-position-relative">
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                        style="background-image: url(/images/online_course/layer_64.png);"></div>
                                    <div
                                        class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                        <span uk-icon="icon: play; ratio: 5" class="uk-text-white uk-icon"></span>
                                    </div>
                                </div>
                                <div class="uk-padding-small">
                                    <p class="uk-text-red">Пример #1</p>
                                    <h3 class="uk-card-title uk-margin-remove-top">Продающая визитка</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default uk-height-1-1">
                                <div class="uk-position-relative">
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                        style="background-image: url(/images/online_course/layer_70.png);"></div>
                                    <div
                                        class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                        <span uk-icon="icon: play; ratio: 5" class="uk-text-white uk-icon"></span>
                                    </div>
                                </div>
                                <div class="uk-padding-small">
                                    <p class="uk-text-red">Пример #2</p>
                                    <h3 class="uk-card-title uk-margin-remove-top">Список Чзв</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default uk-height-1-1">
                                <div class="uk-position-relative">
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                        style="background-image: url(/images/online_course/layer_76.png);"></div>
                                    <div
                                        class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                        <span uk-icon="icon: play; ratio: 5" class="uk-text-white uk-icon"></span>
                                    </div>
                                </div>
                                <div class="uk-padding-small">
                                    <p class="uk-text-red">Пример #3</p>
                                    <h3 class="uk-card-title uk-margin-remove-top">Продающее коммерческое
                                        предложеие</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-card uk-card-default uk-height-1-1">
                                <div class="uk-position-relative">
                                    <div
                                        class="uk-background-cover uk-background-top-center uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                        style="background-image: url(/images/online_course/layer_82.png);"></div>
                                    <div
                                        class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                        <span uk-icon="icon: play; ratio: 5" class="uk-text-white uk-icon"></span>
                                    </div>
                                </div>
                                <div class="uk-padding-small">
                                    <p class="uk-text-red">Пример #4</p>
                                    <h3 class="uk-card-title uk-margin-remove-top">Продающий лэндинг пэйдж</h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <a class="uk-position-center-left uk-position-small uk-border-solid-circle uk-visible@s uk-icon uk-border-red uk-text-red"
                       href="#" uk-slider-item="previous" uk-icon="icon: arrow-left; ratio: 2">
                        <svg width="40" height="40" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                             data-svg="arrow-left">
                            <polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline>
                            <line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line>
                        </svg>
                    </a>
                    <a class="uk-position-center-right uk-position-small uk-border-solid-circle uk-visible@s uk-icon uk-border-red uk-text-red"
                       href="#" uk-slider-item="next" uk-icon="icon: arrow-right; ratio: 2">
                        <svg width="40" height="40" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                             data-svg="arrow-right">
                            <polyline fill="none" stroke="#000" points="10 5 15 9.5 10 14"></polyline>
                            <line fill="none" stroke="#000" x1="4" y1="9.5" x2="15" y2="9.5"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @include('widgets.reviews',['image'=>'/images/event_1.png'])
    <section class="price-course uk-margin">
        <div class="uk-container uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Стоимость Курса:
            </h1>
            <div class="uk-child-width-1-2@s" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-border uk-height-1-1">
                        <h3 class="uk-text-center uk-text-bold">Для предпринимателя:</h3>
                        <ul class="uk-list uk-list-check">
                            <li>Один пользователь</li>
                            <li>доступ на 12 месяцев</li>
                        </ul>
                        <p class="uk-text-center">
                            <span
                                class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6 uk-text-gray">Старая цена:</span>
                            <span class="uk-h1 uk-text-gray uk-text-line-through">100 000</span>
                            <br>
                            <span
                                class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-6">Цена снгодня:</span>
                            <span class="uk-h1 uk-text-red">50 000</span>
                        </p>
                        <div class="uk-text-center uk-margin-bottom">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow" type="button"
                                    uk-toggle="target: #modal-pay">Купить
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-border uk-height-1-1">
                        <h3 class="uk-text-center uk-text-bold">Для бизнеса:</h3>
                        <ul class="uk-list uk-list-check">
                            <li>Несколько пользователей</li>
                            <li>доступ на 12 месяцев</li>
                        </ul>
                        <p class="uk-text-center uk-text-red">
                            Цена договорная
                        </p>
                        <div class="uk-text-center uk-margin-bottom">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow" uk-toggle="target: #modal-request">Оставить заявку
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="modal-pay" class="uk-modal-full" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
            <div class="uk-container">
                <form class="uk-padding">
                    <fieldset class="uk-fieldset">

                        <h2 class="uk-h2 uk-text-turquoise uk-text-bold uk-text-center">"Малобюджетный маркетинг и
                            продажи"</h2>
                        <h3 class="uk-text-center uk-text-bold">Оплата курса</h3>
                        <p class="uk-text-red uk-text-center">Во избежание ошибок, пожалуйста, вводите данные верно!</p>
                        <div class="uk-flex uk-flex-center">
                            <div class="uk-width-1-2@s">
                                <div class="uk-margin-small-top">
                                    <span class="uk-display-block uk-form-label">Имя</span>
                                    <input class="uk-input uk-first-column uk-border-rounded"
                                           type="text" placeholder="Имя">
                                </div>
                                <div class="uk-margin-small-top">
                                    <span class="uk-display-block uk-form-label">Фамилия</span>
                                    <input class="uk-input uk-first-column uk-border-rounded"
                                           type="text" placeholder="Фамилия">
                                </div>
                                <div class="uk-margin-small-top">
                                    <span class="uk-display-block uk-form-label">Телефон</span>
                                    <input class="uk-input uk-first-column uk-border-rounded"
                                           type="text" placeholder="+7(___)_______">
                                </div>
                                <div class="uk-margin-small-top">
                                    <span class="uk-display-block uk-form-label">E-mail</span>
                                    <input class="uk-input uk-first-column uk-border-rounded"
                                           type="text" placeholder="E-mail">
                                </div>
                                <div class="uk-margin-small-top">
                                    <span class="uk-display-block uk-form-label">Промо-код</span>
                                    <input class="uk-input uk-first-column uk-border-rounded"
                                           type="text" placeholder="Промо-код если есть">
                                </div>
                                <div class="uk-margin-small-top uk-flex uk-flex-center">
                                    <p class="uk-text-center">
                                        <span
                                            class="uk-display-inline-block uk-margin-right uk-text-right uk-text-small uk-width-1-5 uk-text-red">Итого к оплате</span>
                                        <span class="uk-h1 uk-text-red">50 000</span>
                                    </p>
                                </div>
                                <div class="uk-margin-small-top uk-flex uk-flex-center">
                                    <button class="uk-button uk-button-default uk-text-bold uk-border-yellow"
                                            type="button">Купить курс
                                    </button>
                                </div>

                                <div class="uk-margin">
                                    <p>
                                        Нажимая на кнопку "купить курс", я соглашаюсь с <a class="uk-border-bottom uk-border-red uk-link-reset" href="#">условиями договора-оферты</a>,
                                        а также с тем, что я ознакомлен с условиями использования видео и других
                                        материалов в данном онлайн курсе.</p>
                                    <p>Онлайн оплата осуществляется по системе Smartpos (<a class="uk-border-bottom uk-border-red uk-link-reset" href="#">www.spos.kz</a>).
                                        Все транзакции безопасны и защищены гарантиями Qazkom банка.</p>
                                    <p><span class="uk-text-red">Важно</span>: В системе есть ограничения по количеству транзакций в день. Если Вы
                                        не смогли произвести оплату по этой или любой другой причине, просим
                                        связаться с нами по телефону <a class="uk-button-text" href="tet:+77052711177">+7 705 271 11 77</a>, и мы предоставим Вам другие
                                        варианты оплаты.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-request" class="uk-modal-full" uk-modal>
        <div class="uk-modal-dialog uk-height-viewport">
            <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
            <div class="uk-container">
                <form class="uk-padding">
                    <fieldset class="uk-fieldset">
                        <h2 class="uk-h2 uk-text-turquoise uk-text-bold uk-text-center">"Малобюджетный маркетинг и продажи"</h2>
                        <h3 class="uk-text-center uk-text-bold">Заявка на курс</h3>
                        <p class="uk-text-red uk-text-center">Во избежание ошибок, пожалуйста, вводите данные верно!</p>
                        <div class="uk-flex uk-flex-center">
                            <div class="uk-width-1-2@s">
                                <div class="uk-margin-small-top">
                                    <span class="uk-display-block uk-form-label">Имя</span>
                                    <input class="uk-input uk-first-column uk-border-rounded"
                                           type="text" placeholder="Имя">
                                </div>
                                <div class="uk-margin-small-top">
                                    <span class="uk-display-block uk-form-label">Телефон</span>
                                    <input class="uk-input uk-first-column uk-border-rounded"
                                           type="text" placeholder="+7(___)_______">
                                </div>
                                <div class="uk-margin-small-top uk-flex uk-flex-center">
                                    <button class="uk-button uk-button-default uk-text-bold uk-border-yellow"
                                            type="button">Отправить заявку</button>
                                </div>

                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
