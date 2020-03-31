<header>
    <nav>
        <div rel="menu" class="menu hidden-mobile">

        </div>
        <div class="logo-container">
            <div class="logo" href="/">
                <img src="/img/LogoMobile.png" alt="">
            </div>
            @if(isset($back_url))
                <a href="{{$back_url}}" class="back-button hidden-mobile">
                    <img src="/images/arrow-back.svg" alt="">назад
                </a>
            @endif
        </div>
        <div class="title">{{$title ??"KARADA школа продаж"}}</div>
        @if(Auth::check())
            <div class="hidden-mobile">
                <a style="float: right; position: absolute; right: 30px; top: 0; height: 70px;" class="back-button"
                   href="/logout">выйти</a>
            </div>
        @else
            <div class="hidden-mobile">
                <a style="float: right; position: absolute; right: 30px; top: 0; height: 70px;" class="back-button"
                   href="/login">войти</a>
            </div>
        @endif
        <div rel="menu_mobile" style="position: absolute; right: 15px; border-left: 1px solid #e4e4e4; padding-left: 10px;" class="visible-mobile">
            <img src="/img/menu_mobile.svg" alt="">
        </div>
    </nav>
</header>
