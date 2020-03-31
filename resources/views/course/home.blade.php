@extends('layouts.cabinet')

@section('content')
    <section class="price-book uk-margin-large-top uk-background-muted">
        <div class="uk-container uk-padding">
            <h1 class="uk-h4 uk-text-center uk-margin-remove-bottom">
                Онлайн-курс
            </h1>
            <h2 class="uk-h2 uk-text-center uk-margin-remove-top">
                "Малобюджетный маркетинг"
            </h2>
            <div class="uk-child-width-1-5@s uk-flex uk-flex-center" uk-grid>
                <div>
                    <a href="{{ route('home_video') }}" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1">
                        <img src="/images/svg/image2vector (5).svg" width="50" alt="">
                        <p class="uk-text-bold">Видео уроки</p>
                    </a>
                </div>
                <div>
                    <a href="{{route('home_life_hack')}}" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1">
                        <img src="/images/svg/image2vector (6).svg" width="50">
                        <p class="uk-text-bold">Полезные материалы</p>
                    </a>
                </div>
                <div>
                    <a href="{{route('home_test')}}" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1">
                        <img src="/images/svg/image2vector (7).svg" width="50" alt="">
                        <p class="uk-text-bold">Тестирование</p>
                    </a>
                </div>
                <div>
                    <a href="{{route('home_test_result')}}" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1">
                        <img src="/images/svg/image2vector (8).svg" width="50" alt="">
                        <p class="uk-text-bold">Мои результаты</p>
                    </a>
                </div>
                <div>
                    <a href="{{route('home')}}" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1">
                        <img src="/images/svg/image2vector (4).svg" width="50" alt="">
                        <p class="uk-text-bold">Вернутся из личного кабинета</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
