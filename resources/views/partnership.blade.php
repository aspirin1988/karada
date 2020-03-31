@extends('layouts.app')

@section('content')
    <section id="slider" class="slider">
        <div class="uk-height-large uk-overflow-hidden">
            <div
                class="uk-background-cover uk-background-top-center uk-background-muted uk-height-large uk-panel uk-flex uk-flex-center uk-flex-middle"
                style="background-image: url(/images/partnership/layer_18.png);"></div>
            <div
                class="uk-flex uk-flex-left uk-flex-middle uk-height-large uk-overlay-primary uk-position-top-left uk-width-1-1">
                <div class="uk-flex uk-flex-center uk-text-center uk-width-1-1">
                    <div class="uk-width-1-2@s">
                        <h2 class="uk-article-title" uk-slideshow-parallax="x: 100,-100">
                            Партнерство
                        </h2>
                        <p>Мы всегда открыты для новых знакомств и интересных
                            предложений. Оставьте заявку, и мы с вами свяжемся.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="marketing">
        <div class="uk-container uk-container-large uk-padding uk-margin-auto uk-flex uk-flex-center">
            <div class="uk-form uk-width-2-3@s">
                <div class="uk-margin uk-text-center uk-grid-match uk-grid" uk-grid="">
                    <div class="uk-form-controls uk-width-1-1" uk-grid="">
                        <div class="uk-first-column uk-width-1-2@s">
                            <span class="uk-display-block uk-form-label uk-text-left">Имя</span>
                            <input class="uk-input uk-border-rounded" type="text" placeholder="Имя">
                        </div>
                        <div class="uk-width-1-2@s">
                            <span class="uk-display-block uk-form-label uk-text-left">Телефон</span>
                            <input class="uk-input uk-border-rounded" type="text" placeholder="+7 (___) _______">
                        </div>
                    </div>
                    <div class="uk-first-column uk-form-controls uk-grid-margin uk-padding uk-padding-remove-vertical uk-width-1-1">
                        <span class="uk-display-block uk-form-label uk-text-left">Сообщение</span>
                        <textarea class="uk-textarea uk-form-width-large" id="form-h-textarea" rows="5"
                                  placeholder="Сообщение"></textarea>
                    </div>
                    <div class="uk-form-controls uk-width-1-1">
                        <div>
                            <span style="visibility: hidden" class="uk-display-block uk-form-label">&nbsp;</span>
                            <button class="uk-button uk-button-default uk-border-yellow">Отправить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
