<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Page extends Model
{
    protected $guarded = [];

    public function makePage()
    {
        $slug = $this->slug;
        $template_path = "pages." . $slug;
        $path = Config::get('view.paths')[0];
        $path .= "/pages/{$slug}";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $layout = "<!doctype html>\n<html lang=\"ru\">\n<head>\n\t<meta charset=\"UTF-8\">\n\t<meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">\n\t<meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">\n\t<meta name=\"csrf-token\" content=\"{{ csrf_token() }}\">\n\t<title>Малобюджетный маркетинг, реклама, продвижение и продажи</title>\n\t<link rel=\"stylesheet\" href=\"/ui_kit/css/uikit.css\">\n\t<link rel=\"stylesheet\" href=\"/css/app.css\">\n\t<link href=\"https://fonts.googleapis.com/css?family=Roboto\" rel=\"stylesheet\">\n\t@include('{$template_path}.css')\n</head>\n<body>\n\t@include('{$template_path}.header')\n\t<main>\n\t\t@yield('content')\n\t</main>\n\t@include('{$template_path}.footer')\n</body>\n@include('{$template_path}.script')\n</html>";
        $index = "@extends('pages.{$slug}.layout')\n@section('content')\n@endsection";
        $css = "<link rel=\"stylesheet\" href=\"/css/uikit.css\">\n<link rel=\"stylesheet\" href=\"/css/app.css\">";
        $header = "<header class=\"consulting\">
    <div uk-sticky=\"sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar\">
        <nav class=\"uk-navbar-container uk-navbar-transparent\" uk-navbar>
            <div class=\"uk-navbar-left\">
                <div class=\"uk-position-relative\">
                    <a class=\"uk-logo\" href=\"#\"><img src=\"/images/consulting/logo.png\" alt=\"\"></a>
                </div>
            </div>
            <div class=\"uk-navbar-right\">
                <ul class=\"uk-navbar-nav uk-visible@m\">
                    <li><a href=\"#services\" uk-scroll>Услуги</a></li>
                    <li><a href=\"#founder\" uk-scroll>Основатель</a></li>
                    <li><a href=\"#mass-media\" uk-scroll>СМИ</a></li>
                    <li><a href=\"#customers\" uk-scroll>Клиенты</a></li>
                    <li><a class=\"uk-margin-right\" href=\"#reviews\" uk-scroll>Отзывы</a></li>
                    <li class=\"uk-phone\">
                        <a href=\"tel:+77052711177\" class=\"uk-text-bold\">
                            <img src=\"/images/consulting/phone.png\" alt=\"\">
                            +7(705) 271 11 77
                        </a>
                    </li>
                </ul>
                <a uk-navbar-toggle-icon=\"\" href=\"#offcanvas\" uk-toggle=\"\"
                   class=\"uk-navbar-toggle uk-hidden@m uk-navbar-toggle-icon uk-icon\"></a>
            </div>
        </nav>
    </div>
</header>";
        $script = "<script src=\"/js/uikit.js\"></script>\n<script src=\"/js/uikit-icons.js\"></script>\n<script src=\"/js/app.js\"></script>";
        $footer = "<footer class=\"consulting\">
    <hr>
    <div class=\"uk-child-width-1-1@s\" uk-grid>
        <div>
            <div class=\"uk-dark uk-padding-small uk-text-center uk-container\">
                <h3 class=\"uk-h4 uk-margin-remove uk-text-uppercase\">Мы поможем вашему бизнесам получать</h3>
                <p class=\"uk-h3 uk-text-danger uk-text-uppercase uk-margin-remove\">много клиентов малыми затратами</p>
            </div>
            <hr class=\"uk-hr\">
        </div>
    </div>
    <div class=\"uk-container uk-margin-top uk-container-expand\">
        <div class=\"uk-child-width-1-3@s uk-text-center uk-padding-custom\" uk-grid>
            <div>
                <div class=\"\">
                    <a href=\"tel:+77052711177\" class=\"uk-button uk-button-text uk-text-bold\">+7(705) 271 11 77</a>
                    <br>
                    <a href=\"mailto:info@karada.kz\" class=\"uk-button uk-button-text uk-text-bold\">info@karada.kz</a>
                </div>
            </div>
            <div>
                <div class=\"\">
                    <p class=\"uk-text-subscribe\">Подписывайтесь на нас:</p>
                    <a href=\"\" class=\"uk-margin-small-right uk-icon-facebook\"></a>
                    <a href=\"\" class=\"uk-margin-small-right uk-icon-instagram\"></a>
                    <a href=\"\" class=\"uk-icon-youtube\"></a>
                </div>
            </div>
            <div>
                <div class=\"uk-text-right\">
                    <p class=\"uk-margin-remove uk-text-copyright\">Консалтинг KARADA, 2017. Все права защищены</p>
                    <a class=\"uk-margin-remove uk-text-copyright\">Разработка сайта - <br>
                        <img src=\"/images/simple_space.png\" alt=\"\">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id=\"app\">
        <div id=\"modal-close-outside\" uk-modal>
            <div class=\"uk-modal-dialog uk-modal-body\">
                <button class=\"uk-modal-close-outside uk-close-large\" type=\"button\" uk-close></button>
                <div class=\"uk-modal-title uk-text-center\">
                    <h2 class=\"uk-margin-small-bottom\">Заявка на услугу</h2>
                    <span class=\"uk-text-uppercase uk-text-turquoise\">“Проектный консалтинг”</span>
                </div>
                <modal-consulting-component :type=\"'project_consulting'\"></modal-consulting-component>
            </div>
        </div>
        <div id=\"modal-close-counseling\" uk-modal>
            <div class=\"uk-modal-dialog uk-modal-body\">
                <button class=\"uk-modal-close-outside uk-close-large\" type=\"button\" uk-close></button>
                <div class=\"uk-modal-title uk-text-center\">
                    <h2 class=\"uk-margin-small-bottom\">Заявка на услугу</h2>
                    <span class=\"uk-text-uppercase uk-text-turquoise\">“Консультации”</span>
                </div>
                <modal-consulting-component :type=\"'counseling'\"></modal-consulting-component>
            </div>
        </div>
        <div id=\"modal-result\" uk-modal>
            <div class=\"uk-modal-dialog uk-modal-body\">
                <button class=\"uk-modal-close-outside uk-close-large\" type=\"button\" uk-close></button>
                <div class=\"uk-modal-title uk-text-center\">
                    <h2 class=\"uk-margin-small-bottom\">Заявка отправлена!</h2>
                </div>
                <div class=\"uk-flex uk-flex-center\">
                    <p>Наши менеджеры свяжутся с Вами
                        самое ближайшее время.</p>
                </div>
                <div class=\"uk-margin-small-top uk-flex uk-flex-center\">
                    <button class=\"uk-button uk-button-default uk-text-bold uk-border-yellow uk-modal-close\"
                            type=\"button\">Вернуться на главную
                    </button>
                </div>
            </div>
        </div>
    </div>
</footer>";
        file_put_contents($path . '/layout.blade.php', $layout);
        file_put_contents($path . '/index.blade.php', $index);
        file_put_contents($path . '/css.blade.php', $css);
        file_put_contents($path . '/header.blade.php', $header);
        file_put_contents($path . '/script.blade.php', $script);
        file_put_contents($path . '/footer.blade.php', $footer);
    }

    public function getTemplate($template)
    {
        $slug = $this->slug;

//        $template_path = "pages." . $slug.".{$template}.blade.php";
        $path = Config::get('view.paths')[0];
        $path .= "/pages/" . $slug . "/{$template}.blade.php";
        if (file_exists($path)) {
            $content = file_get_contents($path);
        } else {
            $content = '';
        }
        return $content;
    }

    public function saveTemplate($template, $template_content)
    {
        $slug = $this->slug;

        $path = Config::get('view.paths')[0];
        $path .= "/pages/" . $slug . "/{$template}.blade.php";
        if (file_exists($path)) {
            $result = file_put_contents($path, $template_content);
        } else {
            $result = false;
        }

        return $result;

    }
}
