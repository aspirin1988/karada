@extends('layouts.app')

@section('content')
    <div class="uk-container uk-margin-large-top">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <h2 class="uk-h2 uk-text-turquoise uk-text-bold uk-text-center">Востановление пароля</h2>
            <div class="uk-flex uk-flex-center">
                <div class="uk-width-1-2@s">
                    <div class="uk-margin-small-top uk-flex uk-flex-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <span class="uk-display-block uk-form-label">E-mail</span>
                        <input class="uk-input uk-first-column uk-border-rounded" type="email" name="email"
                               placeholder="E-mail">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="uk-margin-small-top uk-flex uk-flex-center" style="margin-bottom: 150px">
                        <button class="uk-button uk-button-default uk-text-bold uk-border-yellow" type="submit">
                            Отправить запрос
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
