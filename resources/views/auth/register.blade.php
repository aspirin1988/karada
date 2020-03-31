@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row uk-container uk-margin-large-top">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form class="uk-padding" method="POST" action="{{ route('register') }}">
                            @csrf
                            <fieldset class="uk-fieldset">
                                <h2 class="uk-h2 uk-text-turquoise uk-text-bold uk-text-center">Регистрация</h2>
                                <div class="uk-flex uk-flex-center">
                                    <div class="uk-width-1-2@s">
                                        <div class="uk-margin-small-top">
                                            <label for="name" class="uk-display-block uk-form-label">Имя</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="uk-input uk-first-column uk-border-rounded"
                                                       name="first_name" value="{{ old('first_name') }}"
                                                       placeholder="Имя"
                                                       required autofocus>

                                                @if ($errors->has('first_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="uk-margin-small-top">
                                            <label for="last_name"
                                                   class="uk-display-block uk-form-label">Фамилия</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="uk-input uk-first-column uk-border-rounded"
                                                       name="last_name" value="{{ old('last_name') }}"
                                                       placeholder="Фамилия" required autofocus>

                                                @if ($errors->has('last_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="uk-margin-small-top">
                                            <label for="city" class="uk-display-block uk-form-label">Город</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="uk-input uk-first-column uk-border-rounded"
                                                       name="city" value="{{ old('city') }}" placeholder="Город"
                                                       required autofocus>

                                                @if ($errors->has('city'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('city') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="uk-margin-small-top">
                                            <label for="name" class="uk-display-block uk-form-label">Телефон</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="uk-input uk-first-column uk-border-rounded"
                                                       name="phone" value="{{ old('phone') }}" placeholder="+7"
                                                       required autofocus>

                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="uk-margin-small-top">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                       class="uk-input uk-first-column uk-border-rounded"
                                                       name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="uk-margin-small-top">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-right">Промо-код</label>

                                            <div class="col-md-6">
                                                <input id="promo_code" type="text"
                                                       class="uk-input uk-first-column uk-border-rounded"
                                                       name="promo_code" value="{{ old('promo_code') }}">

                                                @if ($errors->has('promo_code'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promo_code') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $resource = new \App\RedisData('karada');
                                            $price = $resource->getKey('trial','price');
                                            $resource->close();
                                        @endphp
                                        <div class="uk-margin-small-top">
                                            <label for="price" class="col-md-4 col-form-label text-md-right">Цена</label>
                                            <div class="col-md-6">
                                                <input id="price" type="text"
                                                       class="uk-input uk-first-column uk-border-rounded"
                                                       name="price" value="{{ old('price',$price) }}" required>

                                                @if ($errors->has('price'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        {{--                                        <div class="uk-margin-small-top">--}}
                                        {{--                                            <label for="password"--}}
                                        {{--                                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                                        {{--                                            <div class="col-md-6">--}}
                                        {{--                                                <input id="password" type="password"--}}
                                        {{--                                                       class="uk-input uk-first-column uk-border-rounded"--}}
                                        {{--                                                       name="password" required>--}}

                                        {{--                                                @if ($errors->has('password'))--}}
                                        {{--                                                    <span class="invalid-feedback" role="alert">--}}
                                        {{--                                        <strong>{{ $errors->first('password') }}</strong>--}}
                                        {{--                                    </span>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}

                                        {{--                                        <div class="uk-margin-small-top">--}}
                                        {{--                                            <label for="password-confirm"--}}
                                        {{--                                                   class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                                        {{--                                            <div class="col-md-6">--}}
                                        {{--                                                <input id="password-confirm" type="password" class="uk-input uk-first-column uk-border-rounded"--}}
                                        {{--                                                       name="password_confirmation" required>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}

                                        <div class="uk-margin-top">
                                            <div class="uk-margin-small-top uk-flex uk-flex-center">
                                                <button type="submit"
                                                        class="uk-button uk-button-default uk-text-bold uk-border-yellow">
                                                    Зарегистрироваться
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
