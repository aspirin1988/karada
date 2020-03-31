@extends('profile.app')

@section('content')
    <div class="container">
        <div class="offcanvas active" ref="password_update_modal" rel="password_update_modal">
            <div class="overlay"></div>
            <div class="center-center">
                <div class="block modal-body">
                    <div class="sales_program">
                        <a href="#" style="color: #37a2e9; margin: 0" class="sales_program_title">Пароль изменен!</a>
                    </div>
                    <p style="color: #010101; font-family: Montserrat; font-size: 18px; font-weight: 400; line-height: 27px;">
                        Новый пароль выслан на ваш e-mail
                    </p>
                    <div class="modal-body-sub-header">

                    </div>
                    <a style="width: 201px; height: 50px;" href="/login" rel="sales_program_modal_close"
                       class="button round button-yellow-stroke">Ok</a>
                </div>
            </div>
        </div>
    </div>

@endsection
