@extends('layouts.app')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <form class="uk-padding" method="POST" action="{{ route('password.update') }}">
            @csrf
            <fieldset class="uk-fieldset">
                <h2 class="uk-h2 uk-text-turquoise uk-text-bold uk-text-center">Восстановление пароля</h2>
                <div class="uk-flex uk-flex-center">
                    <div class="uk-width-1-2@s">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group row uk-margin-bottom">
                            <label for="email" class="uk-display-block uk-form-label">E-Mail Адрес</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="uk-input uk-first-column uk-border-rounded form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email"
                                       value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row uk-margin-bottom">
                            <label for="password" class="uk-display-block uk-form-label">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="uk-input uk-first-column uk-border-rounded form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password"
                                       required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row uk-margin-bottom">
                            <label for="password-confirm"
                                   class="uk-display-block uk-form-label">Подтверждение пароля</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password"
                                       class="uk-input uk-first-column uk-border-rounded"
                                       name="password_confirmation"
                                       required>
                            </div>
                        </div>

                        <div class="uk-margin-small-top uk-flex uk-flex-center">
                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow" type="submit">
                                Сбросить пароль
                            </button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
