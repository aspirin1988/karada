@extends('profile.app')

@section('content')
    @php($user = Auth::user())
    <div class="container">
        <div class="profile-edit block">
            <div class="profile-ava">
                <img src="{{$user->getAva()??'/img/empty.png'}}" alt="">
                <add-ava-component></add-ava-component>
                <add-background-component></add-background-component>
            </div>
            <div class="profile-data">
                <div class="form">
                    <p class="first_name" >{{$first_name}}</p>
                    <p class="last_name" >{{$last_name}}</p>
                    <div class="row">
                        <label for="name">Начало обучения:</label>
                        <p class="big-text">{{date('Y-m-d',strtotime($user->created_at))}}</p>
                    </div>
                    <div class="row">
                        <label for="first_name">Конец обучения:</label>
                        <p class="big-text">{{$user->getAccessEnd()}}</p>
                    </div>
                </div>
            </div>
            <div class="profile-buttons">
                {{--                <a href="#" class="button round button-blue-stroke ">--}}
                {{--                    <i class="icon card"></i>--}}
                {{--                    данные по платежам</a>--}}
                {{--                <a href="/home/password/update" class="button round button-blue-stroke ">--}}
                {{--                    <i class="icon lock"></i>--}}
                {{--                    сменить пароль--}}
                {{--                </a>--}}
                {{--                <a href="/logout" class="button round button-blue-stroke ">--}}
                {{--                    <i class="icon exit"></i>выйти--}}
                {{--                </a>--}}
                <div class="warnings">
                    <p>Уважаемый пользователь!</p>
                    <p>В целях соблюдения безопасности и защиты ваших личных данных изменение анкетных данных доступно
                        только через модератора сайта.</p>
                    <p>В данный момент в анкете находятся данные, которые Вы указали при регистрации на сайте.</p>
                    <p>Если у вас есть необходимость внести зменения в свою личные данные, отправьте заявку на нашу
                        почту <a style="color: #818181; font-weight: bold;" href="mailto:help@karada.kz">help@karada.kz</a>, и мы свяжемся с Вами.</p>
{{--                    <div class="row">--}}
{{--                        <user-update-component :id="'{{$user->id}}'"></user-update-component>--}}
{{--                    </div>--}}
                    <div class="row">
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <a style="max-width: 180px; margin: 20px auto;" class="button round button-blue-stroke"
                               href="/admin">Админ-панель</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
