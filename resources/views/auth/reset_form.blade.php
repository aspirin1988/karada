@extends('layouts.cabinet')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <form class="uk-padding" method="POST" action="{{ route('user.password.update') }}">
            @csrf
            <fieldset class="uk-fieldset">

                <h2 class="uk-h2 uk-text-turquoise uk-text-bold uk-text-center">Смена пароля</h2>
                <div class="uk-flex uk-flex-center">
                    <div class="uk-width-1-2@s">
                        <div class="uk-margin-small-top">
                            <span class="uk-display-block uk-form-label">Новый пароль</span>
                            <input class="uk-input uk-first-column uk-border-rounded" type="password" placeholder="Новый пароль" name="password">
                        </div>
                        <div class="uk-margin-small-top">
                            <span class="uk-display-block uk-form-label">Подтверждение пароля</span>
                            <input class="uk-input uk-first-column uk-border-rounded" type="password" placeholder="Подтверждение пароля" name="password_confirm">
                        </div>
                        <div class="uk-margin-small-top uk-flex uk-flex-center">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow" type="submit">Сменить</button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
