/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueTheMask from 'vue-the-mask'
import VueMoment from 'vue-moment';
import moment from 'moment-timezone';

Vue.use(VueTheMask);
Vue.prototype.$http = axios;
Vue.use(VueMoment, {
    moment,
});

Vue.component('add-ava-component', require('./components/Widget/UploadAva.vue').default);
Vue.component('add-background-component', require('./components/Widget/UploadBackground.vue').default);
Vue.component('create-sales-plan-component', require('./components/Widget/CreatePlan.vue').default);
Vue.component('edit-sales-plan-component', require('./components/Widget/EditPlan.vue').default);
Vue.component('see-sales-plan-component', require('./components/Widget/SeePlan.vue').default);
Vue.component('edit-teammate-sales-plan-component', require('./components/Widget/EditTeammatePlan.vue').default);
Vue.component('edit-sales-plan-modal-component', require('./components/Widget/EditModalPlan.vue').default);
Vue.component('add-personal-goals-component', require('./components/Widget/EditModalPlan.vue').default);
Vue.component('personal_goals_add_model', require('./components/Widget/AddGoals.vue').default);
Vue.component('goals-approve-component', require('./components/Widget/ApproveGoals.vue').default);
Vue.component('goals-edit-component', require('./components/Widget/EditGoals.vue').default);
Vue.component('test-widget-component', require('./components/Widget/Test.vue').default);
Vue.component('add_teammate-componeznt', require('./components/Widget/AddTeammet.vue').default);
Vue.component('password-update-component', require('./components/Widget/UpdatePassword.vue').default);
Vue.component('user-update-component', require('./components/Widget/UpdateUser.vue').default);
Vue.component('timer-component', require('./components/Widget/Timer.vue').default);
Vue.component('time-out-component', require('./components/Widget/TimeOut.vue').default);
Vue.component('add_teammate-component', require('./components/Widget/AddTeammet.vue').default);
Vue.component('pie-component', require('./components/Widget/Pie.vue').default);
Vue.component('remove_teammate-component', require('./components/Widget/RemoveTeammate.vue').default);
Vue.component('input-money-component', require('./components/Widget/InputMoney.vue').default);


const app = new Vue({
    el: '#app'
});


(function () {

        window.addEventListener('contextmenu', function () {
            event.preventDefault();
            return false;     // cancel default menu
        });

        class Slider {
            constructor(el) {
                this._C = el;
                this.arrow_left = el.querySelector('.slide-arrow-left');
                this.arrow_right = el.querySelector('.slide-arrow-right');
                // this.slider_nav = el.querySelector('.slider-nav');
                this.slider_nav_items = null;
                this.i = 0;
                this.x0 = null;
                this.locked = false;
                this.w = window.innerWidth;
                this.ini = null;
                this.fin = null;
                this.rID = null;
                this.anf = null;
                this.n = 0;
                this.N = this._C.children.length;
                this.items = this._C.children;
                this.NF = 30;
                this._C.style.setProperty('--n', this.N);
                this._C.style.setProperty('--i', '0');
                let that = this;
                this.TFN = {
                    'bounce-out': function (k, a = 2.75, b = 1.5) {
                        return 1 - Math.pow(1 - k, a) * Math.abs(Math.cos(Math.pow(k, b) * (that.n + .5) * Math.PI));
                    }
                };

                // for (var j = 0; j < this._C.children.length; j++) {
                //     var a = document.createElement('A');
                //     a.href = "#";
                //     var li = document.createElement('LI');
                //     if (!j) {
                //         li.classList.add('ms-active');
                //     }
                //     li.append(a);
                //     this.slider_nav.append(li);
                // }
                // this.slider_nav_items = this.slider_nav.querySelectorAll('li');


                window.addEventListener('resize', function () {
                    that.size();
                }, false);

                this._C.addEventListener('mousedown', function (e) {
                    that.lock(e);
                }, false);
                this._C.addEventListener('touchstart', function (e) {
                    that.lock(e);
                }, false);

                this._C.addEventListener('mousemove', function (e) {
                    that.drag(e);
                }, false);
                this._C.addEventListener('touchmove', function (e) {
                    that.drag(e);
                }, false);

                this._C.addEventListener('mouseup', function (e) {
                    that.move(e);
                }, false);
                this._C.addEventListener('touchend', function (e) {
                    that.move(e);
                }, false);

                if (this.arrow_left)
                    this.arrow_left.addEventListener('click', function (e) {
                        if (that.i > 0) {
                            let start = that.i;
                            that.i--;
                            that.animatedNumber(start, that.i);
                        }
                        event.preventDefault();
                        return false;

                    }, false);

                if (this.arrow_right)
                    this.arrow_right.addEventListener('click', function (e) {
                        if (that.i < that.N - 1) {
                            let start = that.i;
                            that.i++;
                            that.animatedNumber(start, that.i);
                        }
                        event.preventDefault();
                        return false;
                    }, false);
            }

            stopAni() {
                cancelAnimationFrame(this.rID);
                this.rID = null;
            };

            animatedNumber(start, end) {

                let dx = (end - start) * 250;

                this.s = Math.sign(dx);
                this.f = +(this.s * dx / this.w).toFixed(2);

                this.ini = this.i - this.s * this.f;

                if ((this.i > 0 || this.s < 0) && (this.i < this.N - 1 || this.s > 0) && this.f > .2) {
                    this.i -= this.s;
                    this.f = 1 - this.f;
                }

                this.fin = this.i;
                this.anf = Math.round(this.f * this.NF);
                this.n = 2 + Math.round(this.f);
                this.ani();
                this.x0 = null;
                this.locked = false;
            }

            ani(cf = 0) {

                this._C.style.setProperty('--i', this.ini + (this.fin - this.ini) * this.TFN['bounce-out'](cf / this.anf));

                for (let i = 0; i < this.items.length; i++) {
                    if (i == Math.ceil(this.ini + (this.fin - this.ini) * this.TFN['bounce-out'](cf / this.anf))) {
                        // this.slider_nav_items[i].classList.add('ms-active');
                    } else {
                        // this.slider_nav_items[i].classList.remove('ms-active');
                    }
                }


                if (cf === this.anf) {
                    this.stopAni();
                    return;
                }

                this.rID = requestAnimationFrame(this.ani.bind(this, ++cf));
            };

            unify(e = null) {
                return e.changedTouches ? e.changedTouches[0] : e;
            };

            lock(e) {
                let m = this.unify(e);
                this.x0 = m.clientX;
                this.locked = true;
            };

            drag(e) {
                e.preventDefault();

                if (this.locked) {
                    let m = this.unify(e);
                    let dx = m.clientX - this.x0;
                    this.f = +(dx / this.w).toFixed(2);

                    this._C.style.setProperty('--i', this.i - this.f);
                }
            };

            move(e) {
                if (this.locked) {

                    let m = this.unify(e);
                    let dx = m.clientX - this.x0;
                    this.s = Math.sign(dx);
                    this.f = +(this.s * dx / this.w).toFixed(2);

                    this.ini = this.i - this.s * this.f;

                    if ((this.i > 0 || this.s < 0) && (this.i < this.N - 1 || this.s > 0) && this.f > .2) {
                        this.i -= this.s;
                        this.f = 1 - this.f;
                    }

                    this.fin = this.i;
                    this.anf = Math.round(this.f * this.NF);
                    this.n = 2 + Math.round(this.f);
                    this.ani();
                    this.x0 = null;
                    this.locked = false;
                }
            };

            size() {
                this.w = window.innerWidth;
            };


        }

        // var slider_el = document.querySelector('.ms-main-section .slider-container .slide-items');

        // if (slider_el) {
        //     var slider = new Slider(slider_el);
        // }


        // let sliders = document.querySelectorAll('.slider');

        let see_metric = document.querySelectorAll('[data-see]');

        see_metric.forEach(function (i) {
            i.addEventListener('click', function () {
                let key = i.getAttribute('data-see');
                axios.post('/home/set/see', {key: key});
                i.classList.remove('not-see')
            })
        });

        let videos = document.querySelectorAll('[data-video-1080]');
        let news_video_model = document.querySelector('[rel="news-video"]');
        let news_video_close = document.querySelector('[rel="news-video_modal_close"]');
        let news_video_model_overlay = document.querySelector('[rel="news-video"] .overlay');
        let news_videos = document.querySelectorAll('video');
        let news_video = document.querySelector('[rel="news-video"] video');
        let news_video_overlay = document.querySelector('[rel="news-video"] video+.overlay-video');
        let span_size = document.querySelectorAll('[rel="news-video"] [data-size]');
        let add_teammate_button = document.querySelector('[rel="add_teammate_button"]');
        let add_teammate = document.querySelector('[rel="add_teammate"]');

        if (add_teammate_button) {
            add_teammate_button.addEventListener('click', function () {
                add_teammate.classList.add('active');
                return false;
            })
        }

        // sliders.forEach(function (i) {
        // let item = i.querySelectorAll('.slider-item');
        // let item_active = i.querySelectorAll('.slider-item.active');
        // let buttons = i.querySelectorAll('.slider-arrow-container span');
        // let left_btn = buttons[0];
        // let right_btn = buttons[1];
        // left_btn.addEventListener('click', function () {
        //     console.log(this);
        //     for (let j = 0; j < item.length; j++) {
        //         for (let k = 0; k < item_active.length; j++) {
        //             if (item_active.indexOf(item[j]) >= 0) {
        //                 console.log(item[j]);
        //             }
        //         }
        //     }
        // });
        // right_btn.addEventListener('click', function () {
        //     console.log(this);
        // })
        // var slider = new Slider(i);
        // });

        // span_size.forEach(function (i) {
        //     i.addEventListener('click', function () {
        //         span_size.forEach(function (j) {
        //             j.parentElement.classList.remove('active');
        //         });
        //         i.parentElement.classList.add('active');
        //         news_video.src = i.dataset['size'];
        //         return false;
        //     });
        // });

        if (news_video) {
            news_video.addEventListener('pause', function (e) {
                // news_video.setAttribute('play', 'false');
                // news_video.removeAttribute('controls');
            });
        }

        news_videos.forEach(function (i) {
            if (i !== news_video) {
                i.addEventListener('click', function () {
                    if (!JSON.parse(i.getAttribute('play'))) {
                        i.play();
                        i.setAttribute('play', 'true');
                    } else {
                        i.pause();
                        i.setAttribute('play', 'false');
                    }
                });
            }
        });

        if (news_video_model_overlay) {
            news_video_model_overlay.addEventListener('click', function () {
                news_video_model.classList.remove('active');
                window.player.pause();
                news_video.setAttribute('play', 'false');
            });
        }

        if (news_video_close) {
            news_video_close.addEventListener('click', function () {
                news_video_model.classList.remove('active');
                window.player.pause();
                news_video.setAttribute('play', 'false');
            });
        }

        // if (news_video_overlay) {
        //     news_video_overlay.addEventListener('click', function () {
        //         news_video.play();
        //         news_video.setAttribute('play', 'true');
        //         news_video.setAttribute('controls', 'controls');
        //     });
        // }

        let player = null;
        let player__m = document.querySelector('[rel="motivation_modal"] video');
        if (player__m) {
            window.player_m = new Plyr('[rel="motivation_modal"] video');
            console.log(window.player_m);
            window.player_m.source = {
                type: 'video',
                title: 'Example title',
                sources: [
                    {
                        src: player__m.dataset['video-480'],
                        type: 'video/mp4',
                        size: 480,
                    },
                    {
                        src: player__m.dataset['video-720'],
                        type: 'video/mp4',
                        size: 720,
                    },
                    {
                        src: player__m.dataset['video-1080'],
                        type: 'video/mp4',
                        size: 1080,
                    },
                ],
            };
        }


        let player__help = document.querySelectorAll('.help-video');
        window.player__help = [];
        player__help.forEach(function (i) {
            let plr = new Plyr(i);
            plr.source = {
                type: 'video',
                title: 'Example title',
                sources: [
                    {
                        src: i.dataset['video-480'],
                        type: 'video/mp4',
                        size: 480,
                    },
                    {
                        src: i.dataset['video-720'],
                        type: 'video/mp4',
                        size: 720,
                    },
                    {
                        src: i.dataset['video-1080'],
                        type: 'video/mp4',
                        size: 1080,
                    },
                ],
            };
            window.player__help.push(plr);
        });

        let player__ = document.querySelector('.lesson-video');
        if (player__) {
            window.player_ = new Plyr('.lesson-video');
            console.log(window.player_);
            window.player_.source = {
                type: 'video',
                title: 'Example title',
                sources: [
                    {
                        src: player__.dataset['video-480'],
                        type: 'video/mp4',
                        size: 480,
                    },
                    {
                        src: player__.dataset['video-720'],
                        type: 'video/mp4',
                        size: 720,
                    },
                    {
                        src: player__.dataset['video-1080'],
                        type: 'video/mp4',
                        size: 1080,
                    },
                ],
            };
        }


        videos.forEach(function (i) {
            i.addEventListener('click', function () {
                news_video_model.classList.add('active');

                if (window.player) {
                    window.player.destroy();
                }

                window.player = new Plyr('div[rel="news-video"] video');
                console.log(window.player);
                window.player.source = {
                    type: 'video',
                    title: 'Example title',
                    sources: [
                        {
                            src: i.dataset['video-480'],
                            type: 'video/mp4',
                            size: 480,
                        },
                        {
                            src: i.dataset['video-720'],
                            type: 'video/mp4',
                            size: 720,
                        },
                        {
                            src: i.dataset['video-1080'],
                            type: 'video/mp4',
                            size: 1080,
                        },
                    ],
                };

                // span_size[0].dataset['size'] = i.dataset['video-1080'];
                // span_size[1].dataset['size'] = i.dataset['video-720'];
                // span_size[2].dataset['size'] = i.dataset['video-480'];

            });
        });

        let offcanvas = document.querySelectorAll('.offcanvas:not([rel="menu_modal"])');
        let menu = document.querySelector('[rel="menu"]');
        let menu_mobile = document.querySelector('[rel="menu_mobile"]');
        let menu_modal = document.querySelector('[rel="menu_modal"]');
        let menu_modal_close = document.querySelector('[rel="menu_modal_close"]');
        let menu_modal_overlay = document.querySelector('[rel="menu_modal"] .overlay');

        let motivation_modal = document.querySelector('[rel="motivation_modal"]');
        let motivation_modal_close = document.querySelectorAll('[rel="motivation_modal_close"]');

        let personal_goals_modal = document.querySelector('[rel="personal_goals_modal"]');
        let personal_goals_modal_close = document.querySelectorAll('[rel="personal_goals_modal_close"]');
        let sales_program_modal = document.querySelector('[rel="sales_program_modal"]');
        let sales_program_modal_close = document.querySelectorAll('[rel="sales_program_modal_close"]');

        let sales_plan_edit = document.querySelector('[rel="sales_plan_edit"]');
        let sales_plan_edit_modal = document.querySelector('[rel="sales_plan_edit_modal"]');
        let sales_plan_edit_modal_close = document.querySelector('[rel="sales_plan_edit_modal_close"]');

        let sales_plan_month = document.querySelectorAll('[rel="sales_plan_month"]');
        let sales_plan_month_modal = document.querySelector('[rel="sales_plan_month_modal"]');
        let sales_plan_month_modal_close = document.querySelector('[rel="sales_plan_month_modal_close"]');

        let accordions = document.querySelectorAll('.accordion');
        let reward_download = document.querySelectorAll('[reward-download]');
        let download_rewards_modal = document.querySelector('[rel="download_rewards_modal"]');
        let download_rewards_modal_close = document.querySelector('[rel="download_rewards_modal"] [rel="modal_close"]');

        if (download_rewards_modal_close) {
            download_rewards_modal_close.addEventListener('click', function () {
                download_rewards_modal.classList.remove('active');
            });
        }

        reward_download.forEach(function (i) {
            i.addEventListener('click', function () {
                let umg_url = i.dataset['img'];
                let img = download_rewards_modal.querySelector('img');
                let link = download_rewards_modal.querySelector('a[download=""]');
                link.href = umg_url;
                img.src = umg_url;
                setTimeout(function () {
                    download_rewards_modal.classList.add('active');
                },500);

            });
        });

        offcanvas.forEach(function (i) {
            let overlay = i.querySelector('.overlay');
            if (overlay) {
                overlay.addEventListener('click', function () {
                    i.classList.remove('active');
                    i.classList.add('no-active');
                    document.body.style.overflowY = 'auto';
                    if (window.player) {
                        window.player.stop();
                    }
                    if (window.player_) {
                        window.player_.stop();
                    }
                    if (window.player_m) {
                        window.player_m.stop();
                    }
                });
            }
        });

        accordions.forEach(function (i) {
            let button = i.querySelector('.accordion-header');
            let content = i.querySelector('.accordion-content');

            button.addEventListener('click', function () {
                if (button.classList.contains('open')) {
                    content.style.height = '0px';
                    setTimeout(function () {
                        button.classList.remove('open')
                    }, 500);
                } else {
                    button.classList.add('open');
                    content.style.height = content.scrollHeight + 'px';
                }
            })
        });

        if (sales_plan_edit) {
            sales_plan_edit.addEventListener('click', function () {
                sales_plan_edit_modal.classList.add('active');
            });
        }

        if (sales_plan_edit_modal_close) {
            sales_plan_edit_modal_close.addEventListener('click', function () {
                sales_plan_edit_modal.classList.remove('active');
            });
        }

        sales_plan_month.forEach(function (i) {
            i.addEventListener('click', function () {
                sales_plan_month_modal.classList.add('active');
            });

        });

        if (sales_plan_month_modal_close) {
            sales_plan_month_modal_close.addEventListener('click', function () {
                sales_plan_month_modal.classList.remove('active');

            });
        }

        menu.addEventListener('click', function () {
            menu_modal.classList.add('active');
            menu_modal.classList.remove('no-active');
            document.body.style.overflowY = 'hidden';
        });
        menu_mobile.addEventListener('click', function () {
            let img = menu_mobile.querySelector('img');
            menu_modal.classList.toggle('active');
            // menu_modal.classList.toggle('no-active');
            if (menu_modal.classList.contains('active')) {
                document.body.style.overflowY = 'hidden';
                img.src = '/images/close_blue.svg';
            } else {
                document.body.style.overflowY = 'auto';
                img.src = '/img/menu_mobile.svg';
            }

        });
        if (menu_modal_close) {
            let img = menu_mobile.querySelector('img');
            menu_modal_close.addEventListener('click', function () {
                menu_modal.classList.remove('active');
                menu_modal.classList.add('no-active');
                document.body.style.overflowY = 'auto';
            });
            if (!menu_modal.classList.contains('active')) {
                document.body.style.overflowY = 'auto';
                img.src = '/img/menu_mobile.svg';
            }
        }

        if (menu_modal_overlay) {
            let img = menu_mobile.querySelector('img');
            console.log(img);

            menu_modal_overlay.addEventListener('click', function () {
                menu_modal.classList.remove('active');
                menu_modal.classList.add('no-active');
                document.body.style.overflowY = 'auto';
            });
            if (!menu_modal.classList.contains('active')) {
                document.body.style.overflowY = 'auto';
                img.src = '/img/menu_mobile.svg';
            }
        }

        motivation_modal_close.forEach(function (i) {
            i.addEventListener('click', function () {
                motivation_modal.classList.remove('active');
                personal_goals_modal.classList.add('active');
                if (sales_program_modal) {
                    sales_program_modal.classList.add('active');
                }
                window.player_m.stop();
            });
        });

        personal_goals_modal_close.forEach(function (i) {
            i.addEventListener('click', function () {
                personal_goals_modal.classList.remove('active');
                if (sales_program_modal) {
                    sales_program_modal.classList.add('active');
                }
            });
        });

        sales_program_modal_close.forEach(function (i) {
            i.addEventListener('click', function () {
                sales_program_modal.classList.remove('active');
            });
        });

        window.addEventListener('load', function () {
            let date = new Date();
            date = date.getTime();

            let sales_program_showed = localStorage.getItem('sales_program_modal');
            let personal_goals_showed = localStorage.getItem('personal_goals_modal');
            let motivation_showed = localStorage.getItem('motivation_modal');

            if (sales_program_modal) {
                setTimeout(function () {
                    sales_program_modal.classList.add('active');
                }, 1000);
            }
            if (personal_goals_modal) {
                setTimeout(function () {
                    personal_goals_modal.classList.add('active');
                }, 1000);
            }
            if (motivation_modal) {
                setTimeout(function () {
                    motivation_modal.classList.add('active');
                }, 1000);
            }


        });

        let observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutationRecord) {
                let c = getComputedStyle(mutationRecord.target).getPropertyValue('--p');
                if (c >= 0 && c < 33) {
                    mutationRecord.target.classList.remove('gr_2');
                    mutationRecord.target.classList.remove('gr_3');
                    mutationRecord.target.classList.add('gr_1');
                }
                if (c >= 33 && c < 66) {
                    mutationRecord.target.classList.remove('gr_1');
                    mutationRecord.target.classList.remove('gr_3');
                    mutationRecord.target.classList.add('gr_2');
                }
                if (c >= 66) {
                    mutationRecord.target.classList.remove('gr_1');
                    mutationRecord.target.classList.remove('gr_2');
                    mutationRecord.target.classList.add('gr_3');
                }
            });
        });


        let gradient_charts = document.querySelectorAll('.pie.gradient');
        gradient_charts.forEach(function (i) {
            observer.observe(i, {attributes: true, attributeFilter: ['style']});
            let c = getComputedStyle(i).getPropertyValue('--p');

            if (c >= 0 && c < 33) {
                i.classList.remove('gr_2');
                i.classList.remove('gr_3');
                i.classList.add('gr_1');
            }
            if (c >= 33 && c < 100) {
                i.classList.remove('gr_1');
                i.classList.remove('gr_3');
                i.classList.add('gr_2');
            }
            if (c >= 100) {
                i.classList.remove('gr_1');
                i.classList.remove('gr_2');
                i.classList.add('gr_3');
            }

        });

        let add = document.querySelector('.block.add-goals');
        let modal = document.querySelector('[rel="personal_goals_add_model"]');
        let close = null;
        if (modal) {
            close = modal.querySelector('.button.round.button-gray-stroke');
        }

        if (add) {
            add.addEventListener('click', function () {
                modal.classList.add('active');
            });

        }
        if (close) {
            close.addEventListener('click', function () {
                modal.classList.remove('active');
            });
        }

        let items_tab = document.querySelectorAll('.goals-tabs li');
        let items_tab_switch = document.querySelectorAll('.goals-tabs-switch li');


        items_tab.forEach(function (i) {
            i.addEventListener('click', function () {
                items_tab.forEach(function (j, k) {
                    if (j !== i) {
                        j.classList.remove('active')
                    } else {
                        j.classList.add('active');
                        for (let l = 0; l < items_tab_switch.length; l++) {

                            if (l === k) {
                                items_tab_switch[l].classList.add('active');
                            } else {
                                items_tab_switch[l].classList.remove('active');
                            }
                        }
                    }

                    return false;

                })
            })
        })

    }
)
();
