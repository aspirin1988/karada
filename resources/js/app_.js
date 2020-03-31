require('./bootstrap');

(function () {

    window.isTabActive = true;

    window.onfocus = function () {
        isTabActive = true;
    };

    window.onblur = function () {
        isTabActive = false;
    };

    window.init_over = function () {
        window.over_container = document.querySelector('[uk-over-container]');
        window.over_list = document.querySelectorAll('[uk-over]');
        window.over_list.forEach(function (i) {
            i.addEventListener('mouseover', function () {
                window.over_list.forEach(function (item) {
                    item.classList.remove('uk-active')
                });
                let img = this.getAttribute('uk-over');
                this.classList.add('uk-active');
                window.over_container.style.backgroundImage = 'url(' + img + ')';
            })
        })

    };
    window.select_video = function () {
        window.video_container_title = document.querySelector('[uk-video-title]');
        window.video_container = document.querySelector('[uk-show-video]');
        window.vidoe_list = document.querySelectorAll('[uk-select-video]');
        window.vidoe_list.forEach(function (i) {
            i.addEventListener('click', function () {
                window.vidoe_list.forEach(function (item) {
                    item.classList.remove('uk-active')
                });
                let video = this.getAttribute('uk-select-video');
                let title = this.getAttribute('uk-select-title');
                this.classList.add('uk-active');
                window.video_container_title.innerText = title;
                window.video_container.src = video + '?autoplay=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1&amp;playsinline=1';
                return false;
            })
        })

    };

    window.addEventListener('load', function () {
        let promo_code = document.querySelector('#promo_code');
        let price = document.querySelector('#price');
        let next = document.querySelector('.uk-slideshow.uk-auto-play *[uk-slideshow-item="next"]');
        window.init_over();
        window.select_video();
        if (next) {
            setInterval(function () {
                if (isTabActive) {
                    next.click();
                }
            }, 7000)
        }

        promo_code.addEventListener('keyup', function () {
            window.axios.post('/help/get/price', {'code': promo_code.value}).then(
                response => {
                    let data = response.data;
                    if(data.price){
                        price.value = data.price;
                    }
                }
            )
        })
    });

})();
