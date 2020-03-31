@extends('layouts.cabinet')

@section('content')
    <section class="course_video uk-margin-large-top uk-background-muted">
        <div class="uk-container uk-container-large uk-padding">
            <h1 class="uk-h4 uk-text-center uk-margin-remove-bottom">
                Онлайн-курс "Малобюджетный маркатинг".
            </h1>
            <h2 class="uk-h2 uk-text-center uk-margin-remove-top">
                Тестирование
            </h2>
            <div class="uk-flex uk-flex-center">
                <div class="uk-width-1-2@s">
                    <div class="uk-text-center">
                        <a href="{{route('home_test_run')}}" class="uk-button uk-button-default uk-text-bold uk-border-yellow">
                            Пройти тест
                        </a>
                    </div>
                    <p class="uk-text-justify">
                        Онлайн тестирование не отражает ваши реальные знания о маркетинге и продажах, а показывает,
                        насколько успешно вы усвоили инструменты, описанные в этом видеокурсе.</p>
                    <p>Рекомендуется пройти тестирование До начала изучения видеокурса, а затем проходить
                        тестирование с интервалом 2-3 недели. При повторном тестировании вопросы могут отличаться. Я
                        хочу, чтобы вы не просто получили высокий балл, а чтобы вы до конца поняли суть описанных
                        инструментов, и начали применять их на практике.</p>
                    <p>По итогам тестирования, вы получие электронный сертификат об успешном прохождении курса.</p>
                    <h3>Правила Тестирования:</h3>
                    <ul class="uk-list uk-margin-left">
                        <li><span class="uk-text-red">1.</span>Вам предоставляется 60 минут, чтобы ответить на 79
                            вопросов.
                        </li>
                        <li><span class="uk-text-red">2.</span>Ваши результаты будут отражены нижеприведенной таблице.
                        </li>
                        <li><span class="uk-text-red">3.</span>Вы можете повторно проходить тестирование.</li>
                        <li><span class="uk-text-red">4.</span>Результаты тестирования отражают насколько успешно вы
                            освоили знания изложенные только В данном видеокурсе.
                        </li>
                    </ul>
                    <p>Бесплатный сертификат выдается только один раз. На ваш е-mail, указанный при регистрации (ваш
                        логин) будет выслан электронный сертификат с порядковым регистрационным иомером,
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
