<div style="width:100%; display: flex; justify-content: center; ">
    <div>
        <div style="width: 500px; border-bottom: 3px solid #fc0d0d; margin-bottom: 40px; padding-bottom: 10px;">
            <img style="width: 160px;" src="{{asset('/img/logo-blue.png')}}" alt="">
        </div>
        <div>
            <p style="font-family: Arial; color: #000000; margin-bottom: 30px;" >Здравствуйте!</p>
            <p style="font-family: Arial; color: #000000; margin-bottom: 30px;" >Вас зарегистрировали на портале KARADA:
                <a style="color: #005bd1;" href="karada.kz">www.karada.kz</a>
            </p>
            <p style="font-family: Arial; color: #000000; margin-bottom: 30px;" >Ваш логин: <span style="color: #005bd1;" >{{$user->email}}</span></p>
            <p style="font-family: Arial; color: #000000; margin-bottom: 40px;" >С уважением,</p>
            <p style="font-family: Arial; color: #000000; margin-bottom: 60px; line-height: 27px;"  >
                Администрация <br>
                KARADA Школа Продаж <br>
                <a href="tel:+7(705)2711177"><strong style="color: #005bd1;" >+7 (705) 271 11 77</strong></a>
            </p>
        </div>
    </div>
</div>
