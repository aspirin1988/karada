@extends('layouts.app')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <form class="uk-padding" method="POST" action="{{ route('login') }}">
            @csrf
            <fieldset class="uk-fieldset">
                <h2 class="uk-h2 uk-text-turquoise uk-text-bold uk-text-center">Вход в личный кабинет</h2>
                <div class="uk-flex uk-flex-center">
                    <div class="uk-width-1-2@s">
                        <div class="uk-margin-small-top">
                            <span class="uk-display-block uk-form-label">E-mail</span>
                            <input class="uk-input uk-first-column uk-border-rounded" type="email" name="email"
                                   placeholder="E-mail">
                        </div>
                        <div class="uk-margin-small-top">
                            <span class="uk-display-block uk-form-label">Пароль</span>
                            <input class="uk-input uk-first-column uk-border-rounded" type="password"
                                   placeholder="Пароль" name="password">

{{--                            <div class="uk-margin-small-top">--}}
{{--                                <input class="uk-checkbox" type="checkbox" name="remember"--}}
{{--                                       id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                                <label class="form-check-label" for="remember">--}}
{{--                                    {{ __('Запомнить меня') }}--}}
{{--                                </label>--}}
{{--                                <br>--}}
{{--                            </div>--}}
                        </div>
                        @if ($errors->has('email'))
                            <span style="color: #ff0000; text-align: center; display: block;" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                        @if ($errors->has('password'))
                            <span style="color: #ff0000; text-align: center; display: block;" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        <div class="uk-margin-small-top uk-flex uk-flex-center">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow" type="submit">
                                Войти
                            </button>
                        </div>
                        <div class="uk-margin-small-top uk-flex uk-flex-center">
                            <a href="/password/reset">Забыли пароль</a>
                        </div>
                    </div>


                </div>
            </fieldset>
        </form>
    </div>

    {{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
    {{--<div class="col-md-8">--}}
    {{--<div class="card">--}}
    {{--<div class="card-header">{{ __('Login') }}</div>--}}

    {{--<div class="card-body">--}}
    {{--<form method="POST" action="{{ route('login') }}">--}}
    {{--@csrf--}}

    {{--<div class="form-group row">--}}
    {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}

    {{--@if ($errors->has('email'))--}}
    {{--<span class="invalid-feedback" role="alert">--}}
    {{--<strong>{{ $errors->first('email') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row">--}}
    {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

    {{--@if ($errors->has('password'))--}}
    {{--<span class="invalid-feedback" role="alert">--}}
    {{--<strong>{{ $errors->first('password') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row">--}}
    {{--<div class="col-md-6 offset-md-4">--}}
    {{--<div class="form-check">--}}
    {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

    {{--<label class="form-check-label" for="remember">--}}
    {{--{{ __('Remember Me') }}--}}
    {{--</label>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row mb-0">--}}
    {{--<div class="col-md-8 offset-md-4">--}}
    {{--<button type="submit" class="btn btn-primary">--}}
    {{--{{ __('Login') }}--}}
    {{--</button>--}}

    {{--@if (Route::has('password.request'))--}}
    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
    {{--{{ __('Forgot Your Password?') }}--}}
    {{--</a>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection
