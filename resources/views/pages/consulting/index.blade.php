@extends('pages.consulting.layout')
@section('content')
<section class="business-card">
        <div>
            <div class="uk-form">
                <div class="uk-child-width-expand@s uk-grid-collapse uk-grid" uk-grid="">
                    <div class="uk-grid-item-match">
                        <div class="uk-card uk-position-relative uk-height-viewport">
                            <div
                                class="uk-flex uk-flex-center uk-flex-column uk-flex-middle uk-height-1-1 uk-overlay-primary uk-width-1-1"></div>
                            <div
                                class="uk-background-cover uk-background-top-center uk-height-1-1 uk-width-1-1 uk-position-top-left"
                                style="background-image: url(/images/consulting/background.jpg)"></div>

                            <div class="business-card-text uk-padding uk-position-top-left uk-width-2-3@m">
                                <h1 class="uk-h2 uk-width-5-6@l">Помогу Вашему бизнесу
                                    получать <span class="uk-text-red">много клиентов малыми затратами!</span></h1>
                                <h3 class="uk-text-bold uk-visible@l">Юсуп Карада
                                    <img src="/images/strelka.png" alt="">
                                </h3>
                                <p class="uk-visible@l">Топовый консультант по малобюджетному маркетингу и продажам</p>
                            </div>
                            <div
                                    class="business-card-img uk-padding-remove-bottom uk-padding-small uk-position-bottom-right uk-text-center uk-width-1-3@s">
                                <div class="uk-background-cover uk-background-top-center uk-height-1-1 uk-width-1-1"
                                     style="background-image: url(/images/image/2019-05-13/b09b929f747429555c580cb801c24c43.png)"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="services" class="business-benefit uk-padding uk-padding-remove-horizontal uk-margin-top">
        <div class="uk-container uk-container-services">
            <div class="uk-custom-grid uk-custom-grid-width-1-2 uk-custom-grid-gap-medium">
                <div class="uk-height-1-1">
                    <div class="uk-card uk-card-default uk-margin uk-height-1-1">
                        <div class="uk-card-body">
                            <h3 class="uk-card-title uk-text-large uk-text-turquoise">Консультации</h3>
                            <ul class="uk-list-red">
                                <li>
                                    Почасовые консультации по следующих вопросам
                                    <ul class="uk-no-margin">
                                        <li> Маркетинг, реклама и продвижение</li>
                                        <li> Продажи и масштабирование бизнеса</li>
                                        <li> Борьба с конкурентами</li>
                                        <li> Личный бренд</li>
                                        <li> Запуск нового продукта</li>
                                        <li> Подготовка к продаже бизнеса</li>
                                        <li> другое</li>
                                    </ul>
                                </li>
                                <li>Консультации для всех сфер кроме: алкоголя, табака,
                                    финансовых пирамид и запрещенных законом
                                    деятельностей.
                                </li>
                                <li>Консультации проводятся вживую и онлайн</li>
                                <li>Вы получите быстрое решение своих бизнес вопросов от
                                    - практика, который уже помог сотням
                                    предпринимателей
                                </li>
                            </ul>

                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow"
                                    uk-toggle="target: #modal-close-counseling">Оставить заявку
                            </button>
                        </div>
                    </div>
                </div>
                <div class="uk-height-1-1">
                    <div class="uk-card uk-card-default uk-margin uk-height-1-1">
                        <div class="uk-card-body">
                            <h3 class="uk-card-title uk-text-large uk-text-turquoise">Проектный консалтинг</h3>
                            <ul class="uk-list-red">
                                <li>
                                    Поможем Вашему бизнесу с продвижением товара или
                                    услуг «под ключ» с гарантией результата.
                                </li>
                                <li>Используем лучшие онлайн и офлайн инструменты, с
                                    привлечением профессиональных подрядчиков,
                                    специалистов и экспертов.
                                </li>
                                <li>Поиск клиентов и партнеров на рынках Казахстана и
                                    Узбекистана.
                                </li>
                                <li>Помогаем бизнесам расширять рынки сбыта, поиск
                                    клиентов, дистрибьюторов, маркетинговый анализ рынка,
                                    анализ конкурентов и прочее.
                                </li>
                            </ul>

                            <button class="uk-button uk-button-default uk-text-bold uk-border-yellow"
                                    uk-toggle="target: #modal-close-outside">Оставить заявку
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@php $images = \App\MediaCollection::getImages(1) @endphp
   <section id="founder" class="marketing">
        <div class="uk-container uk-container-large">
            <div class="uk-my-grid-2">
                <div>
                    <div>
                        <div class="uk-card uk-padding uk-padding-remove-vertical">
                            <div class="uk-card">
                                <article class="uk-article">
                                    <h3 class="">Юсуп Карада</h3>
                                    <p class="uk-text-red uk-quote">“УМНЫЙ МАРКЕТИНГ – ОСНОВА БОЛЬШИХ ПРОДАЖ”</p>
                                    <ul class="uk-list-red">
                                        <li>Топовый консультант Казахстана по малобюджетному маркетингу и продажам</li>
                                        <li>Автор книг «Прибыльный маркетинг» , «Малобюджетный маркетинг»</li>
                                        <li>Основатель <a class="uk-link-red" href="http://karadau.kz">Бизнес Школы
                                                KARADA</a></li>
                                        <li>Более 20 лет опыта работы в маркетинге и продажах в США, Европе и
                                            Центральной Азии
                                        </li>
                                        <li>Получил степень Магистра Менеджмента в Чикаго, США в 2007 г.</li>
                                    </ul>
                                </article>
                            </div>

                            <div class="uk-marketing-card-parent uk-child-width-1-2@m uk-grid-collapse uk-grid-match uk-margin-medium-top"
                                 uk-grid="">
                                <div>
                                    <div class="uk-marketing-card">
                                        <i class="uk-icon uk-icon-image uk-position-top-right"
                                           style="background-image: url(/images/consulting/Uzor.png);"></i>
                                        <h3 class="uk-card-title uk-text-red">
                                            <span class="uk-text-small">Более</span> 200
                                        </h3>
                                        <p>подняли продажи после консультаций и сотрудничества с Юсупом.</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="uk-marketing-card">
                                        <i class="uk-icon uk-icon-image uk-position-top-right"
                                           style="background-image: url(/images/consulting/Uzor.png);"></i>
                                        <h3 class="uk-card-title uk-text-red">
                                            <span class="uk-text-small">Более</span> 1000
                                        </h3>
                                        <p>предпринимателей прошли обучение маркетингу и продажам у Юсупа</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-position-relative uk-height-1-1">
                    <div class="uk-height-1-1">
                        <div class="uk-auto-play uk-position-relative uk-height-1-1 uk-marketing-image" uk-slideshow="animation: fade;">
                            <div class="uk-slideshow-dots-container">
                                <a href="#" uk-slideshow-item="previous">
                                    <span class="uk-slider-arrow-up"></span>
                                </a>
                                <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin uk-position-z-index"></ul>
                                <a href="#" uk-slideshow-item="next">
                                    <span class="uk-slider-arrow-down"></span>
                                </a>
                            </div>
                            <div class="uk-position-relative uk-visible-toggle uk-light uk-height-1-1" tabindex="-1">
                                <ul class="uk-slideshow-items uk-height-1-1">
                                    @foreach($images as $image)
                                        <li @if($image->video) uk-lightbox="" @endif >

                                            @if($image->video)
                                                <a class="uk-button" href="{{$image->video}}">@endif
                                                    <div
                                                            class="uk-background-cover uk-background-top-center uk-height-1-1 uk-width-1-1 uk-position-top-left"
                                                            style="background-image: url({{$image->image}}); z-index: 0"></div>
                                                    <div
                                                            class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                                        @if($image->video)
                                                            <span uk-icon="icon: play; ratio: 5"
                                                                  class="uk-text-white uk-icon">
                                                    <svg width="100" height="100" viewBox="0 0 20 20"
                                                         xmlns="http://www.w3.org/2000/svg" data-svg="play">
                                                        <polygon fill="none" stroke="#000"
                                                                 points="6.5,5 14.5,10 6.5,15"></polygon>
                                                    </svg>
                                                </span>
                                                </a>
                                @endif
                            </div>
                            </li>
                            @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="mass-media" class="mass-media">
        <div class="uk-container uk-container-expand">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                СМИ:
            </h1>
            @php $videos = \App\MediaCollection::getImages(4) @endphp
            <div uk-slider="">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                    <ul class="uk-slider-items uk-child-width-1-2@m uk-child-width-1-3@l uk-child-width-1-4@xl uk-grid" uk-lightbox="">
                        @foreach($videos as $video)
                            <li>
                                <a href="{{$video->video}}" class="uk-card uk-card-default uk-height-1-1 uk-display-block" data-caption="{{$video->alt}}">
                                    <div  class="uk-card-media-top uk-position-relative">
                                        <div
                                                class="uk-position-top-left uk-height-medium uk-overlay-primary uk-width-1-1"></div>
                                        <div
                                                class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle"
                                                style="background-image: url({{$video->image}});"></div>
                                        <div class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-padding uk-position-top-left uk-text-center uk-width-1-1">
                                            <span uk-icon="icon: play; ratio: 5" class="uk-text-white uk-icon"></span>
                                        </div>
                                    </div>
                                    <div class="uk-padding-small">
                                        <h3 class="uk-card-title">{{$video->alt}}</h3>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="uk-arrow-container">
                        <a class="uk-position-center-left uk-position-small" href="#"
                           uk-slider-item="previous">
                            <span class="uk-slider-arrow-left"></span>
                        </a>
                      	<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin uk-hidden@m"></ul>
                        <a class="uk-position-center-right uk-position-small" href="#" uk-slider-item="next">
                            <span class="uk-slider-arrow-right"></span>
                        </a>
                    </div>
				<div>
             </div>
        </div>
    </section>
    <section id="customers" class="clients">
        <div class="uk-container uk-container-expand">
            <h1 class="uk-h3 uk-text-center uk-text-uppercase">
                Клиенты:
            </h1>
            @php $clients = \App\MediaCollection::getImages(2) @endphp
            @desktop
            <div class="uk-position-relative uk-visible-toggle uk-light uk-visible@l" tabindex="-1" uk-slider="center: false; ">
                <ul class="uk-slider-items uk-child-width-auto@s uk-child-width-1-6@m">
                    @foreach($clients as $key=>$client)
                        @if($key == 0)
                            <li class="grid">@endif
                                @if($key!=0 && ($key % 2) == 0)
                            </li>
                            <li class="grid">
                                @endif
                                <div class="uk-card uk-card-default"><img src="{{$client->image}}" alt=""></div>
                            @endforeach
                </ul>
                <div class="uk-arrow-container">
                    <a class="uk-position-center-left uk-position-small uk-visible@s" href="#"
                       uk-slider-item="previous">
                        <span class="uk-slider-arrow-left"></span>
                    </a>
                    <a class="uk-position-center-right uk-position-small uk-visible@s" href="#" uk-slider-item="next">
                        <span class="uk-slider-arrow-right"></span>
                    </a>
                </div>
            </div>
            @elsedesktop
            <div class="grid uk-hidden@l">
                @foreach($clients as $key=>$client)
                <div class="uk-card uk-card-default uk-height-1-1"><img src="{{$client->image}}" alt=""></div>
                @endforeach
            </div>
        </div>
      @enddesktop
    </section>
    <section id="reviews" class="reviews uk-margin-top">
        @php $feedbacks = \App\Feedback::get() @endphp
        <div class="uk-position-relative">
            <div
                class="uk-position-top-left uk-background-cover uk-background-top-center uk-background-muted uk-height-1-1 uk-width-1-1 uk-panel uk-flex uk-flex-center uk-flex-middle uk-position-z-index-2"
                style="background-image: url(/images/consulting/layer_17.png);"></div>
            <div
                class="uk-flex uk-flex-left uk-flex-center uk-flex-middle uk-height-1-1 uk-overlay-primary uk-position-top-left uk-width-1-1 uk-position-z-index-1"></div>
            <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-large-top uk-width-1-1">
                <div uk-slider="" class="uk-container uk-container-large">
                    <h3 class="uk-h2 uk-text-center uk-text-uppercase uk-text-white uk-text-bold">
                        Отзывы клиентов:
                    </h3>
                    <div class="uk-position-relative uk-visible-toggle uk-margin-large-top" tabindex="-1">
                        <ul class="uk-slider-items uk-child-width-1-2@m" uk-grid="">
                            @foreach($feedbacks as $feedback )
                            <li>
                                <div class="uk-card uk-card-default uk-card-body uk-padding-small uk-height-1-1">
                                    <article class="uk-comment">
                                        <div class="uk-comment-body">
                                            <p class="uk-text-justify uk-padding-small">
                                                {{$feedback->text}}
                                            </p>
                                        </div>
                                        <header class="uk-comment-header uk-flex-middle uk-my-grid-comment" style="@if($feedback->name =='' && $feedback->position =='') @desktop grid-template-columns: 150px auto 220px; @enddesktop @endif">
                                            <div class="uk-width-auto">
                                                <img class="uk-comment-avatar uk-border-circle" src="{{$feedback->image}}" alt="">
                                            </div>
                                            <div class="uk-width-expand">
                                                @if($feedback->name)
                                                    <h4 class="uk-comment-title uk-margin-remove uk-text-left">
                                                        <span class="uk-text-bold">{{$feedback->name}}</span>
                                                    </h4>
                                                @endif
                                                @if($feedback->position)
                                                    <p class="uk-margin-remove uk-text-left uk-text-meta">{{$feedback->position}}</p>
                                                @endif
                                            </div>
                                            @if($feedback->video)
                                            <div class="uk-width-expand uk-column-1-1@s" uk-lightbox="" >
                                                <a href="{{$feedback->video}}" class="uk-button uk-button-default uk-border-red">
                                                    Открыть видео
                                                </a>
                                            </div>
                                            @endif
                                            @if($feedback->document)
                                                <div class="uk-width-expand uk-column-1-1@s"  uk-lightbox="" >
                                                    <a href="{{$feedback->document}}" class="uk-button uk-button-default uk-border-red">
                                                        Открыть документ
                                                    </a>
                                                </div>
                                            @endif
                                        </header>
                                    </article>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="uk-arrow-container">
                            <a class="uk-position-center-left uk-position-small" href="#"
                               uk-slider-item="previous">
                                <span class="uk-slider-arrow-left uk-slider-arrow-gray"></span>
                            </a>
                            <a class="uk-position-center-right uk-position-small" href="#"
                               uk-slider-item="next">
                                <span class="uk-slider-arrow-right uk-slider-arrow-gray"></span>
                            </a>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection