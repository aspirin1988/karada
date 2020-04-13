@extends('layouts.app_main')

@section('script')
    @parent

    <script src="/js/main.js?v=127"></script>

    <script>
        $('header').addClass('hidden');
        $('.hNav a[href^="#"]').on('click', function (event) {
            event.preventDefault();
            var target = $(this.hash);

            $('body,html').animate(
                {'scrollTop': target.offset().top},
                900
            );
        });
    </script>

    <script>
        $(window).scroll(function () {

            $.fn.scrollBottom = function () {
                return $(document).height() - this.scrollTop() - this.height();
            };

            if (($(window).scrollTop() >= 100)) {
                $('header').removeClass('hidden');
            } else {
                $('header').addClass('hidden');
            }

        });
    </script>

    <script>
        $('.IndexTop .buttons a[href^="#"], .hNav a[href^="#"]').on('click', function (event) {
            event.preventDefault();
            var target = $(this.hash);

            $('body,html').animate(
                {'scrollTop': target.offset().top},
                900
            );
        });
    </script>

    <script src="/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>

    <link rel="stylesheet" href="/js/owl.carousel.css?v=127">
    <script src="/js/owl.carousel.js"></script>

    <script>
        $(document).ready(function () {
            $('.owl-carousel-bullets').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                items: 1,
                stagePadding: 0,
                smartSpeed: 1250,
                autoplay: false,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                navText: 0
            })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('[rel="register-solo-close"]').on('click', function (e) {
                $('[rel="register-solo"]').removeClass('active');
                $('body').css('overflow-y', 'auto');
                e.preventDefault();
            });

            $('[rel="register-solo-show"]').on('click', function (e) {
                $('[rel="register-solo"]').addClass('active');
                $('body').css('overflow-y', 'hidden');
                e.preventDefault();
            });

            $('[rel="register-company-close"]').on('click', function (e) {
                $('[rel="register-company"]').removeClass('active');
                e.preventDefault();
            });

            $('[rel="register-company-show"]').on('click', function (e) {
                $('[rel="register-company"]').addClass('active');
                e.preventDefault();
            });

            $('.tabs .tab-links a').on('click', function (e) {
                var currentAttrValue = $(this).attr('href');

                // Show/Hide Tabs
                $('.tabs ' + currentAttrValue).slideDown(10).siblings().slideUp(10);

                // Change/remove current tab to active
                $(this).parent('li').addClass('activeTab').siblings().removeClass('activeTab');

                e.preventDefault();
            });
        });
    </script>
@stop

@section('content')
    <link rel="stylesheet" href="/css/index.css?v=127" type="text/css"/>
    <section class="IndexTop" style="background: url(/img/index/1920_Вижуал.jpg) no-repeat 50% / cover;">
        <div class="IndexTopH">
            <div class="container">
                <div class="hLogo">
                    <a href="/"><img src="/img/logo.png" alt="Главная"></a>
                </div>
                <div class="hNav">
                    <ul>
                        <li><a href="/about/">О нас</a></li>
                        <li style="display: none;" ><a href="/reviews">Отзывы</a></li>
                        @if(Auth::check())
                            <li style="border-left: 1px solid #000; margin-left: 20px; padding-left: 20px;" ><a href="/logout/">Выйти</a></li>
                        @else
                            <li style="border-left: 1px solid #000; margin-left: 20px; padding-left: 20px;" ><a href="/login" rel="show-login">Вход</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="IndexTopL">
                <h1>Альфа <span>-</span> продавец</h1>
                <p class="undertitle">
                    Курс по продажам №1 на рынке
                </p>
                <strong>
                    Сделаем Вас <br>профессионалом в продажах!
                </strong>
                <div class="buttons">
                    <a href="#IndexPrice" class="yellow">попробовать бесплатно</a>
                    <a href="#IndexProgramm">подробнее</a>
                </div>
            </div>
        </div>
        <div id="IndexProgramm" class="scroll-block"></div>
    </section>

    <section class="index-programm container">
        <h2 class="section-title-md up col-bl">Программа курса</h2>
        <div class="card-wr">
            <div class="card-box wow fadeInUp" data-wow-offset="300">
                <img src="/img/index/01.jpg"/>
                <div class="card-box-info">
                    <span><b>27</b> видеоуроков / Сертификат</span>
                    <ul>
                        <li>Как стать профессионалом в продажах</li>
                        <li>Большие продажи на системной основе</li>
                        <li>Главная продажа любого продавца</li>
                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" @desktop data-wow-delay="0.3s" @elsedesktop data-wow-delay="0.3s" @enddesktop  >
                <img src="/img/index/02.jpg"/>
                <div class="card-box-info">
                    <span><b>30</b> видеоуроков / Сертификат</span>
                    <ul>
                        <li>Использование Правила продаж №1</li>
                        <li>Как быстро стать надежным продавцом</li>
                        <li>Секрет предугадывания продажи</li>
                        <li>Как не терять продажи из-за цены</li>

                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" @desktop data-wow-delay="0.6s"  @enddesktop>
                <img src="/img/index/03.jpg"/>
                <div class="card-box-info">
                    <span><b>74</b> видеоурока / Сертификат</span>
                    <ul>
                        <li>Алгоритм больших продаж</li>
                        <li>Этап 1 - Правильное отношение к продаже</li>
                        <li>Этап 2 - Приветствие клиента</li>
                        <li>Этап 3 - Определение фактов</li>
                        <li>Этап 4 - Презентация продукта</li>
                        <li>Этап 5 - Пробное закрытие</li>
                        <li>Этап 6 - Предложение клиенту</li>
                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" @desktop @elsedesktop data-wow-delay="0.3s" @enddesktop>
                <img src="/img/index/04.jpg"/>
                <div class="card-box-info">
                    <span><b>379</b> видеоуроков / Сертификат</span>
                    <ul>
                        <li>Правила закрытия любой сделки</li>
                        <li>Возражения клиента и приемы закрытия</li>
                        <li>Продвинутые техники закрытия</li>
                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" @desktop data-wow-delay="0.3s" @elsedesktop @enddesktop>
                <img src="/img/index/05.jpg"/>
                <div class="card-box-info">
                    <span><b>22</b> видеоурока / Сертификат</span>
                    <ul>
                        <li>Мастерство телефонных переговоров</li>
                        <li>Эффективные приемы продаж</li>
                        <li>Создание продающего скрипта</li>
                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" @desktop data-wow-delay="0.6s" @elsedesktop data-wow-delay="0.3s" @enddesktop>
                <img src="/img/index/06.jpg"/>
                <div class="card-box-info">
                    <span><b>364</b> видеоурока / Сертификат</span>
                    <ul>
                        <li>Алгоритм продающего звонка</li>
                        <li>Методы обхода секретаря</li>
                        <li>Приемы продажи встречи клиенту</li>
                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" >
                <img src="/img/index/07.jpg"/>
                <div class="card-box-info">
                    <span><b>30</b> видеоуроков / Сертификат</span>
                    <ul>
                        <li>Эффективный поиск клиентов</li>
                        <li>Формирование базы проспектов</li>
                        <li>Как превращать проспектов в клиентов</li>
                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" @desktop data-wow-delay="0.3s" @elsedesktop data-wow-delay="0.3s" @enddesktop>
                <img src="/img/index/08.jpg"/>
                <div class="card-box-info">
                    <span><b>123</b> видеоурока / Сертификат</span>
                    <ul>
                        <li>Креативные методы фоллоу апа</li>
                        <li>Фоллоу ап программа на 12 месяцев</li>
                        <li>Фоллоу ап с «не купившими», «купившими» клиентами, и проспектами</li>
                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" @desktop data-wow-delay="0.6s" @elsedesktop @enddesktop>
                <img src="/img/index/09.jpg"/>
                <div class="card-box-info">
                    <span><b>86</b> видеоуроков / Сертификат</span>
                    <ul>
                        <li>Сервис и забота о клиенте</li>
                        <li>Формирование лояльности клиентов</li>
                        <li>Лучшие стратегии супер сервиса</li>
                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" @desktop @elsedesktop data-wow-delay="0.3s" @enddesktop>
                <img src="/img/index/10.jpg"/>
                <div class="card-box-info">
                    <span><b>23</b> видеоурока / Сертификат</span>
                    <ul>
                        <li>Правила больших продаж лидам</li>
                        <li>Закрытие возражений лидов</li>
                        <li>Увеличение конверсии в 10Х раз</li>
                    </ul>
                </div>
            </div>
            <div class="card-box wow fadeInUp" data-wow-offset="300" @desktop data-wow-delay="0.3s" @elsedesktop @enddesktop>
                <img src="/img/index/11.jpg"/>
                <div class="card-box-info">
                    <span><b>150+</b> видеоуроков</span>
                    <ul>
                        <li>Ежедневная мотивация на достижение целей</li>
                        <li>Формирование позитивного настроя на продажи</li>
                        <li>Повышение личной эффективности в 10Х раз!</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="index-bullets">
        <div class="container">
            <h2 class="section-title-md up">Преимущества курса</h2>

            <div class="icon-wr">
                <div class="icon-box">
                    <img src="/img/index/pr-01.png"/>
                    <h3>Более 1,300 видеоуроков </h3>
                    <p>Самая большая база инструментов по продажам!
                        Здесь есть все необходимое – чтобы ВЫ стали профессионалом в продажах.</p>
                </div>
                <div class="icon-box">
                    <img src="/img/index/pr-02.png"/>
                    <h3>Курс подходит для любого бизнеса!</h3>
                    <p>Универсальные инструменты курса отлично подходят для <span style="text-decoration: underline" >всех</span> видов
                        бизнеса в сферах: B2B, В2С, B2G, и С2С.</p>
                </div>
                <div class="icon-box">
                    <img src="/img/index/pr-03.png"/>
                    <h3>Неограниченный доступ</h3>
                    <p>Онлайн доступ 24/7/365.
                        Обучайтесь  в удобное для Вас время, с любого устройства и без отрыва от работы!</p>
                </div>
                <div class="icon-box">
                    <img src="/img/index/pr-04.png"/>
                    <h3>Лучшие инструменты продаж из США, Европы, России и Азии!</h3>
                    <p>Тщательно отобранные и адаптированные под наш рынок инструменты и знания - помогут Вам поднять продажи в 10х раз! </p>
                </div>
                <div class="icon-box">
                    <img src="/img/index/pr-05.png"/>
                    <h3>Самая выгодная цена на рынке! </h3>
                    <p>Самое высокое качество знаний - по самой низкой цене. Ваши инвестиции начнут приносить прибыль уже с 1-го месяца.</p>
                </div>
                <div class="icon-box">
                    <img src="/img/index/pr-06.png"/>
                    <h3>Снижение зависимости от сотрудников</h3>
                    <p>
                        При уходе сотрудников, «знания» теперь остаются в компании. Быстрое обучение новых продавцов без лишних затрат!
                    </p>
                </div>
            </div>
            <h2 class="section-title-md up mob">Наши преимущества</h2>
            <div class="owl-carousel-bullets">
                <div class="row">
                    <div class="icon-box">
                        <img src="/img/index/pr-01.png"/>
                        <h3>Более 1,300 видеоуроков </h3>
                        <p>Самая большая база инструментов по продажам!
                            Здесь есть все необходимое – чтобы ВЫ стали профессионалом в продажах.</p>
                    </div>
                    <div class="icon-box">
                        <img src="/img/index/pr-02.png"/>
                        <h3>Курс подходит для любого бизнеса!</h3>
                        <p>Универсальные инструменты курса отлично подходят для <span style="text-decoration: underline" >всех</span> видов
                            бизнеса в сферах: B2B, В2С, B2G, и С2С.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="icon-box">
                        <img src="/img/index/pr-03.png"/>
                        <h3>Неограниченный доступ</h3>
                        <p>Онлайн доступ 24/7/365.
                            Обучайтесь  в удобное для Вас время, с любого устройства и без отрыва от работы!</p>
                    </div>
                    <div class="icon-box">
                        <img src="/img/index/pr-04.png"/>
                        <h3>Лучшие инструменты продаж из США, Европы, России и Азии!</h3>
                        <p>Тщательно отобранные и адаптированные под наш рынок инструменты и знания - помогут Вам поднять продажи в 10х раз! </p>
                    </div>
                </div>
                <div class="row">
                    <div class="icon-box">
                        <img src="/img/index/pr-05.png"/>
                        <h3>Самая выгодная цена на рынке! </h3>
                        <p>Самое высокое качество знаний - по самой низкой цене. Ваши инвестиции начнут приносить прибыль уже с 1-го месяца.</p>
                    </div>
                    <div class="icon-box">
                        <img src="/img/index/pr-06.png"/>
                        <h3>Снижение зависимости от сотрудников</h3>
                        <p>
                            При уходе сотрудников, «знания» теперь остаются в компании. Быстрое обучение новых продавцов без лишних затрат!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="index-logo">
        <div class="container">
            <h2 class="section-title-md" style="text-transform: uppercase;">Портфолио клиентов</h2>
            <h2 class="section-title-md mob">Портфолио клиентов</h2>
            <div class="logo-wr">
                <div class="logo-box"><img src="/img/logo/l01b.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l02.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l03.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l04.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l05.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l06.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l07b.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l08.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l09.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l10.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l11.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l12b.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l13.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l14.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l15.jpg"/></div>

                <div class="logo-box"><img src="/img/logo/l16b.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l17.jpg"/></div>
                <div class="logo-box"><img src="/img/logo/l18.jpg"/></div>
            </div>
        </div>
        <div id="IndexPrice" class="scroll-block"></div>
    </section>

    <section class="index-price">
        <div class="container">
            <h2 class="section-title-md up col-bl">СТОИМОСТЬ ОБУЧЕНИЯ</h2>
            <h2 class="section-title-md up col-bl mob">СТОИМОСТЬ КУРСА</h2>
            <div class="tabs price-wr">
                <ul class="tab-links">
                    <li class="activeTab"><a href="#tab1">Соло</a></li>
                    <li><a href="#tab2">Команда</a></li>
                </ul>
                <div class="tab-content">

                    <div id="tab1" class="tab price-box" style="display: flex; flex-direction: column; justify-content: space-between;" >
                        <div class="price-box-img">
                            <h3>СОЛО</h3>
                            <p>индивидуальное обучение</p>
                            <img src="/img/SOLO.jpg"/>
                        </div>
                        <div class="price-box-top">
                            <p>
                                Хотите повысить свои навыки продавца и стать профессионалом?
                                <br/>Хотите системно повышать свои продажи и зарабатывать больше денег?
                            </p>
                            <p>Мы поможем Вам в этом!</p>
                        </div>
                        <div class="price-box-mid">
                            <ul>
                                <li>Более <b>1,300</b> видеоуроков</li>
                                <li>Сертификаты и диплом</li>
                                <li>Неограниченный онлайн доступ на <b>12</b> месяцев</li>
                                <li>Мониторинг достижения личных целей</li>
                            </ul>
                        </div>
                        <div class="price-box-price">
                            <p>Цена:</p>
                            <strong>
                                @php
                                    $resource = new \App\RedisData('karada');
                                    $price = $resource->getKey('trial', 'price');
                                    $price_old = $resource->getKey('trial', 'price_old');
                                    $resource->close();
                                @endphp
                                <span class="old">{{number_format($price_old, 0, ',', ' ')}}</span>
                                <span class="new">{{number_format($price, 0, ',', ' ')}} <b>тг</b></span>
                            </strong>
                            <p>тенге</p>
                        </div>
                        <div class="price-box-buttons">
                            <a href="#" rel="register-solo-show">попробовать бесплатно</a>
                        </div>
                    </div>

                    <div id="tab2" class="tab price-box">
                        <div class="price-box-img white">
                            <h3>команда</h3>
                            <p>Обучение команды продавцов в компании</p>
                            <img src="/img/ph-price-02.jpg"/>
                        </div>
                        <div class="price-box-top">
                            <p>
                                Хотите, чтобы Ваши продавцы стали топовыми профессионалами?
                                <br/>Хотите, чтобы они постоянно увеличивали объемы продаж и доходы компании?
                            </p>
                            <p>Мы поможем Вам в этом!</p>
                        </div>
                        <div class="price-box-mid">
                            <ul>
                                <li>Более <b>1,300</b> видеоуроков</li>
                                <li>Сертификаты и диплом</li>
                                <li>Неограниченный онлайн доступ на <b>12</b> месяцев</li>
                                <li>Контроль за прогрессом обучения сотрудников</li>
                                <li>Контроль за выдачей сертификатов сотрудникам</li>
                            </ul>
                        </div>
                        <div class="price-box-price column">
                            <p>Стоимость курса просчитывается</p>
                            <strong>
                                <span class="new">индивидуально</span>
                            </strong>
                        </div>
                        <div class="price-box-buttons">
                            <a href="#" rel="register-company-show">попробовать бесплатно</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="IndexBanner">
        <a href="http://karadau.kz/" class="container" style="display: none;">
            <img src="/img/banner.jpg" alt="Главная">
            <img src="/img/banner-mob.jpg" alt="Главная" class="mob">
        </a>
    </section>

    <div class="offcanvas" rel="register-solo">
        <div class="overlay"></div>
        <register-solo-component></register-solo-component>
    </div>
    <div class="offcanvas" rel="register-company">
        <div class="overlay"></div>
        <register-company-component></register-company-component>
    </div>
@endsection
