@extends('layouts.app_main')

@section('script')
    @parent
    <script src="/js/main.js?v=128"></script>
    <script>
        (function($) {
            $(function() {
                $('.open_mob_menu').click(function() {
                    $('.MobMenu').toggleClass('open');
                });
            });
        })(jQuery);
    </script>

    <script>
        $(".open_popup").on("click", function () {
            location.href = "/#IndexPrice";
        })
    </script>

    <script>
        $('.hNav a[href^="#"]').on('click', function(event){
            event.preventDefault();
            var target= $(this.hash);

            $('body,html').animate(
                {'scrollTop':target.offset().top},
                900
            );
        });
    </script>

    <style>
        .AboutB .AboutBDesc ul.none-list li{
            padding-left: 0;
        }
        .AboutB .AboutBDesc ul.none-list li:after{
            display: none;
        }
    </style>
@stop

@section('content')
    <link rel="stylesheet" href="/css/about.css" type="text/css"/>
    <section class="AboutWr">
        <div class="container">
            <div class="AboutB">
                <div class="AboutBImg">
                    <img src="/img/ph-course-01.png" alt="О нас">
                </div>
                <div class="AboutBDesc">
                    <h2 class="big">ЮСУП КАРАДА</h2>
                    <ul>
                        <li>Предприниматель, бизнес тренер, консультант, автор бизнес книг</li>
                        <li>20+ лет опыта работы в прямых продажах в США, Европе и Средней Азии в крупных международных брендах и локальных компаниях.</li>
                        <li>Личный опыт продаж: сделка на $1,200,000 в Казахстане</li>
{{--                        <li>Получил степень Магистра Управления в Чикаго, США в 2007 году</li>--}}
                        <li>Степень Магистра Управления – Чикаго, США / 2007 год</li>
                    </ul>
                </div>
            </div>
            <div class="AboutB">
                <div class="AboutBImg">
                    <img src="/img/ph-course-02.png" alt="О нас">
                </div>
                <div class="AboutBDesc">
                    <h2>Школа Продаж KARADA</h2>
                    <ul class="none-list" >
                        <li>Мы предлагаем самые эффективные инструменты для бизнесов и предпринимателей, которые хотят повысить продажи, увеличить доход и победить конкурентов.</li>
                        <li>Кроме обучения продажам, мы также предлагаем курс по малобюджетному маркетингу и продвижению.</li>
                        <li>Наши уникальные курсы уже помогли сотням людей достичь успеха, и они гарантированно помогут и Вам!</li>
                    </ul>
                    <p style="display: none">
                        На данный момент Университет предлагает еще и <a target="_blank" href="http://karadau.kz/">курс по маркетингу</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
