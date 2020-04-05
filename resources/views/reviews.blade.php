@extends('layouts.app_main')

@section('script')
    @parent
    <script src="/js/main.js?v=115"></script>
    <script>
        $(".open_popup").on("click", function () {
            location.href = "/#IndexPrice";
        });

        $(document).ready(function () {
            $('[rel="reviews-modal"]').on('click', function (e) {
                $('[rel="reviews-modal"]').removeClass('active');
                $('[rel="reviews-modal"] iframe').attr('src', '/img/index/Мобильный_вижуал.jpg');
                $('body').css('overflow-y', 'auto');
                e.preventDefault();
            });

            $('[data-review]').on('click', function (e) {
                $('[rel="reviews-modal"] iframe').attr('src', e.currentTarget.dataset['review']);
                setTimeout(function () {
                    $('[rel="reviews-modal"]').addClass('active');
                }, 300);

                $('body').css('overflow-y', 'hidden');
                e.preventDefault();
            });

            $('[rel="reviews-modal-max"]').on('click', function (e) {
                $('[rel="reviews-modal-max"]').removeClass('active');
                $('[rel="reviews-modal-max"] iframe').attr('src', '/img/index/Мобильный_вижуал.jpg');
                $('body').css('overflow-y', 'auto');
                e.preventDefault();
            });

            $('[data-review-max]').on('click', function (e) {
                $('[rel="reviews-modal-max"] iframe').attr('src', e.currentTarget.dataset['reviewMax']);
                setTimeout(function () {
                    $('[rel="reviews-modal-max"]').addClass('active');
                }, 300);

                $('body').css('overflow-y', 'hidden');
                e.preventDefault();
            });

        });

    </script>
@stop
@section('content')
    <link rel="stylesheet" href="/css/review.css" type="text/css"/>
    <section class="ReviewWr">
        <div class="container">
            {{--            <h1 class="section-title-md">Отзывы</h1>--}}

            <div class="ReviewNav">
                <ul>
                    <li class="{{$method=='video'?"active":""}}"><a href="/reviews/video"><span
                                style="text-transform: uppercase;" class="desc">Видео</span><span
                                class="mob">Кейсы</span></a>
                    </li>
                    <li class="{{$method=='mail'?"active":""}}"><a href="/reviews/mail"><span
                                style="text-transform: uppercase;" class="desc">Письма</span><span
                                class="mob">Письма</span></a>
                    </li>
                </ul>
            </div>
            @if($method=='video')
                <div class="ReviewInner">
                    <div class="ReviewB" data-review="https://www.youtube.com/embed/Jro3ZXvWYVs">
                        <div class="ReviewBImg">
                            <img src="/img/maxresdefault.jpg" alt="">
                        </div>
                        <div class="ReviewBDesc">
                            <p>
                                Юсуп нам дал понимание маркетинга! Первое, что нам удалось достичь от сотрудничества с
                                Юсупом - это системность в маркетинге.
                                Чтобы это было не в разнобой, мы, сотрудничая с Юсупом, сделали это более системно и
                                теперь
                                движемся по плану.
                            </p>
                            <div style="display: flex; margin-top: 10px; margin-bottom: 20px;">
                                <button
                                    style="padding: 4px 8px; font-size: 10px; background: #ffcc00; color: #000; line-height: 17px;"
                                    class="button-yellow-stroke">Подробнее
                                </button>
                            </div>
                            <p class="author">
                                Саят Сабржанов
                            </p>
                            <p class="org">
                                ТОО “Сабржан”
                            </p>
                        </div>
                    </div>
                    <div class="ReviewB" data-review="https://www.youtube.com/embed/VAtI25XlGqQ">
                        <div class="ReviewBImg">
                            <img src="/img/maxresdefault (2).jpg" alt="">
                        </div>
                        <div class="ReviewBDesc">
                            <p>Меня этот курс заинтересовал, потому что Юсуп мой практикующий коллега. Но самое важное,
                                что
                                Юсуп – казахстанский маркетолог с большим опытом за плечами. Я человек занятой и у меня
                                мало
                                времени. Курс Юсупа Карада позволяет смотреть уроки в удобное время и в удобном формате.
                                Рекомендую этот курс всем предпринимателям!</p>
                            <div style="display: flex; margin-top: 10px; margin-bottom: 20px;">
                                <button
                                    style="padding: 4px 8px; font-size: 10px; background: #ffcc00; color: #000; line-height: 17px;"
                                    class="button-yellow-stroke">Подробнее
                                </button>
                            </div>
                            <p class="author">
                                Зарина Темиргалиева </p>
                            <p class="org">
                                Руководитель маркетинга в строительной компании «SHEBERBUILD»
                            </p>
                        </div>
                    </div>
                    <div class="ReviewB" data-review="https://www.youtube.com/embed/YK-1OIyWEI4">
                        <div class="ReviewBImg">
                            <img src="/img/maxresdefault (3).jpg" alt="">
                        </div>
                        <div class="ReviewBDesc">
                            <p>Это практический видеокурс, который основан на реальных, конкретных действиях, примерах и
                                рекомендациях, которые вы с легкостью сможете применить в своей деятельности. Курс очень
                                удобный для изучения, вы всегда и с легкостью сможете уделить для своего самообразования
                                15-20 минут в день.
                                Курс будет полезен как для собственников бизнеса, так и для штатных менеджеров по
                                маркетингу, и для тех людей, которые хотят развиваться и развивать свой бизнес.</p>
                            <div style="display: flex; margin-top: 10px; margin-bottom: 20px;">
                                <button
                                    style="padding: 4px 8px; font-size: 10px; background: #ffcc00; color: #000; line-height: 17px;"
                                    class="button-yellow-stroke">Подробнее
                                </button>
                            </div>
                            <p class="author">
                                Дана Кайназарова
                            </p>
                            <p class="org">
                                Собственница SMM агентства
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @if($method=='mail')
                <div class="ReviewInner">
                    <div class="ReviewB" data-review-max="/mail/KAZPOST pismo.pdf" style="cursor: zoom-in;">
                        <div class="ReviewBDesc">
                            <p class="author" style="margin-bottom: 20px; text-align: center;">
                                АО «Казпочта»
                            </p>
                            <div class="ReviewBImg">
                                <img src="/mail/DeepinScreenshot_выберите-область_20200307135905.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="ReviewB" data-review-max="/mail/CDB pismo.pdf" style="cursor: zoom-in;">
                        <div class="ReviewBDesc">
                            <p class="author" style="margin-bottom: 20px; text-align: center;">Центральный дом бухгалтера
                            </p>
                            <div class="ReviewBImg">
                                <img src="/mail/DeepinScreenshot_выберите-область_20200307140045.png" alt="">
                            </div>
                        </div>

                    </div>
                    <div class="ReviewB" data-review-max="/mail/Grand park pismo.pdf" style="cursor: zoom-in;">
                        <div class="ReviewBDesc">
                            <p class="author" style="margin-bottom: 20px; text-align: center;">
                                ТРК «GRANDPARK»
                            </p>
                            <div class="ReviewBImg">
                                <img src="/mail/DeepinScreenshot_выберите-область_20200307140125.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="ReviewPagination">
                <ul>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">&gt;</a></li>
                </ul>
            </div>
        </div>

        <div class="offcanvas" rel="reviews-modal">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body">
                    <div rel="reviews-modal" class="close"></div>
                    <iframe style="width: 100%; height: 50vh;" src="/img/index/Мобильный_вижуал.jpg"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="offcanvas" rel="reviews-modal-max">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body">
                    <div rel="reviews-modal" class="close"></div>
                    <iframe style="width: 100%; height: 80vh;" src="/img/index/Мобильный_вижуал.jpg"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>

    </section>

@endsection
