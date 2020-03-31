@extends('layouts.cabinet')

@section('content')
    <section class="price-book uk-margin-large-top uk-background-muted">
        <div class="uk-container uk-padding">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Личный кабинет:
            </h1>
            <div class="uk-child-width-1-5@s uk-flex uk-flex-center" uk-grid>
                <div>
                    <a href="#" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1">
                        <img src="images/svg/image2vector.svg" width="50" alt="">
                        <p class="uk-text-bold">Личные данные</p>
                    </a>
                </div>
                <div>
                    <a href="{{ route('home_course') }}" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1">
                        <img src="images/svg/image2vector (1).svg" width="50" alt="">
                        <p class="uk-text-bold">Онлайн курс "Малобюджетный маркетинг"</p>
                    </a>
                </div>
                <div>
                    <a href="{{route('home_partnership')}}" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1">
                        <img src="images/svg/image2vector (2).svg" width="50" alt="">
                        <p class="uk-text-bold">Партнёрская программа</p>
                    </a>
                </div>
                <div>
                    <a href="{{ route('user.password.change') }}" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1">
                        <img src="images/svg/image2vector (3).svg" width="50" alt="">
                        <p class="uk-text-bold">Смена пароля</p>
                    </a>
                </div>
                <div>
                    <a href="#" class="uk-card uk-card-default uk-padding-small uk-text-center uk-display-inline-block uk-link-reset uk-width-1-1 uk-height-1-1" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="images/svg/image2vector (4).svg" width="50" alt="">
                        <p class="uk-text-bold">Выход из личного кабинета</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
