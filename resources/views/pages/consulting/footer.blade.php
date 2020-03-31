<footer class="consulting">
    <hr>
    <div class="uk-child-width-1-1@s" uk-grid>
        <div>
            <div class="uk-dark uk-padding-small uk-text-center uk-container">
                <h3 class="uk-h4 uk-margin-remove uk-text-uppercase">Мы поможем вашему бизнесу получать</h3>
                <p class="uk-h3 uk-text-danger uk-text-uppercase uk-margin-remove">много клиентов малыми затратами</p>
            </div>
            <hr class="uk-hr">
        </div>
    </div>
    <div class="uk-container uk-margin-top uk-container-expand">
        <div class="uk-child-width-1-3@m uk-text-center uk-padding-custom" uk-grid>
            <div>
                <div class="">
                    <a href="tel:+77052711177" class="uk-button uk-button-text uk-text-bold">+7(705) 271 11 77</a>
                    <br>
                    <a href="mailto:info@karada.kz" class="uk-button uk-button-text uk-text-bold">info@karada.kz</a>
                </div>
            </div>
            <div>
                <div class="">
                    <p class="uk-text-subscribe">Подписывайтесь на нас:</p>
                    <a target="_blank" target href="https://www.facebook.com/yusupkarada/?ref=aymt_homepage_panel&eid=ARDxC76wuNtcols3tKxqi6orppxVURp5vWQ88d1U4Juabdn0760YqlcV_xAasmNW224laRtMkYuzhAHJ" class="uk-margin-small-right uk-icon-facebook"></a>
                    <a target="_blank" href="https://www.instagram.com/yusup.karada/" class="uk-margin-small-right uk-icon-instagram"></a>
                    <a target="_blank" href="https://www.youtube.com/channel/UCqaMMY7Jm497AQH_nAQNfow" class="uk-icon-youtube"></a>
                </div>
            </div>
            <div>
                <div class="uk-text-right">
                    <p class="uk-margin-remove uk-text-copyright">© Консалтинг KARADA, 2017-2019. Все права защищены.</p>
                    <p class="uk-margin-remove uk-text-copyright">Разработка сайта - </p>
                    <a href="https://prostokosmos.kz/" target="_blank">
                        <img src="/images/simple_space.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <div id="modal-close-outside" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-width-1-2@m">
                <div class="uk-modal-container">
                    <button class="uk-modal-close-outside" type="button" uk-close></button>
                    <div class="uk-modal-title uk-text-center">
                        <h2 class="uk-margin-small-bottom">Заявка на услугу</h2>
                        <span class="uk-text-uppercase uk-text-turquoise">“Проектный консалтинг”</span>
                    </div>
                    <modal-consulting-component :type="'project_consulting'"></modal-consulting-component>
                    <p class="uk-text-bold uk-text-center uk-price">{{$service_cost}}</p>
                    <p class="uk-text-bold uk-text-center uk-text-red uk-slog">Беремся за реализацию проектов с бюджетом</p>
                    <div class="uk-margin-small-top uk-flex uk-flex-center">
                      <div class="uk-margin-small-top uk-flex uk-flex-center">
                        <p class="uk-text-center uk-width-1-1">
                        <span class="uk-text-right uk-text-small uk-width-1-5 uk-text-red">От<span class="uk-h1 uk-text-red">1 000 000</span>тг</span>
                    </p>
                </div>
            </div>
            <div class="uk-margin-small-top uk-flex uk-flex-center">
                <button class="uk-send-project_consulting uk-button uk-button-default uk-text-bold uk-border-yellow">Оставить
                    заявку
                </button>
            </div>
                </div>
            </div>
        </div>
        <div id="modal-close-counseling" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-width-1-2@m">
                <button class="uk-modal-close-outside" type="button" uk-close></button>
                <div class="uk-modal-container">
                    <div class="uk-modal-title uk-text-center">
                        <h2 class="uk-margin-small-bottom">Заявка на услугу</h2>
                        <span class="uk-text-uppercase uk-text-turquoise">“Консультация”</span>
                    </div>
                    <modal-consulting-component :type="'counseling'"></modal-consulting-component>
                    <p class="uk-text-bold uk-text-center uk-price">{{$service_cost}}</p>
                    <p class="uk-text-bold uk-text-center uk-text-red uk-slog">{{$counseling_2_hour}}</p>
                    <div class="uk-margin-small-top uk-flex uk-flex-center">
                       <div class="uk-margin-small-top uk-flex uk-flex-center">
                        <p class="uk-text-center uk-width-1-1">
                        <span class="uk-text-right uk-text-small uk-width-1-5 uk-text-red"> <span class="uk-h1 uk-text-red">200</span>у.е</span>
                    </p>
                </div>
            </div>
            <div class="uk-margin-small-top uk-flex uk-flex-center">
                <button class="uk-send-counseling uk-button uk-button-default uk-text-bold uk-border-yellow">Оставить заявку</button>
            </div>
                </div>
            </div>
        </div>
        <div id="modal-result" uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-width-1-2@m">
                <div class="uk-modal-container">
                    <button class="uk-modal-close-outside uk-close-large" type="button" uk-close></button>
                    <div class="uk-modal-title uk-text-center">
                        <h2 class="uk-margin-small-bottom">Заявка отправлена!</h2>
                    </div>
                    <div class="uk-flex uk-flex-center">
                        <p>Наши менеджеры свяжутся с Вами
                            самое ближайшее время.</p>
                    </div>
                    <div class="uk-margin-small-top uk-flex uk-flex-center">
                        <button class="uk-button uk-button-default uk-text-bold uk-border-yellow uk-modal-close"
                                type="button">Вернуться на главную
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
