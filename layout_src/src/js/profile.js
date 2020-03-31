(function () {

    let offcanvas = document.querySelectorAll('.offcanvas');
    let menu = document.querySelector('[ref="menu"]');
    let menu_modal = document.querySelector('[ref="menu_modal"]');
    let menu_modal_close = document.querySelector('[ref="menu_modal_close"]');

    let motivation_modal = document.querySelector('[ref="motivation_modal"]');
    let motivation_modal_close = document.querySelector('[ref="motivation_modal_close"]');

    let personal_goals_modal = document.querySelector('[ref="personal_goals_modal"]');
    let personal_goals_modal_close = document.querySelector('[ref="personal_goals_modal_close"]');

    let sales_program_modal = document.querySelector('[ref="sales_program_modal"]');
    let sales_program_modal_close = document.querySelector('[ref="sales_program_modal_close"]');

    let sales_plan_edit = document.querySelector('[ref="sales_plan_edit"]');

    let sales_plan_month = document.querySelectorAll('[ref="sales_plan_month"]');
    let sales_plan_month_modal = document.querySelector('[ref="sales_plan_month_modal"]');
    let sales_plan_month_modal_close = document.querySelector('[ref="sales_plan_month_modal_close"]');

    let accordions = document.querySelectorAll('.accordion');
    let reward_download = document.querySelectorAll('[reward-download]');
    let download_rewards_modal = document.querySelector('[ref="download_rewards_modal"]');

    let slider_containers = document.querySelectorAll('.slider');

    reward_download.forEach(function (i) {
        i.addEventListener('click', function () {
            download_rewards_modal.classList.add('active');
        });
    });

    // slider_containers.forEach(function (i) {
    //     let next = i.querySelector('.slider-arrow-container [data-next]');
    //     let prev = i.querySelector('.slider-arrow-container [data-prev]');
    //     next.addEventListener('click', function () {
    //
    //     })
    // });

    offcanvas.forEach(function (i) {
        let overlay = i.querySelector('.overlay');
        if (overlay) {
            overlay.addEventListener('click', function () {
                i.classList.remove('active');
                i.classList.add('no-active');
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
                }, 850);
            } else {
                button.classList.add('open');
                content.style.height = content.scrollHeight + 'px';
            }
        })
    });

    if (sales_plan_edit) {
        sales_plan_edit.addEventListener('click', function () {
            let sales_plan_edit_modal = document.querySelector('[ref="sales_plan_edit_modal"]');
            sales_plan_edit_modal.classList.add('active');
        });
        let sales_plan_edit_modal_close = document.querySelector('[ref="sales_plan_edit_modal_close"]');
        sales_plan_edit_modal_close.addEventListener('click', function () {
            let sales_plan_edit_modal = document.querySelector('[ref="sales_plan_edit_modal"]');
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
    if (menu_modal_close) {

        menu_modal_close.addEventListener('click', function () {
            menu_modal.classList.remove('active');
            menu_modal.classList.add('no-active');
            document.body.style.overflowY = 'auto';
        });
    }

    if (motivation_modal_close) {
        motivation_modal_close.addEventListener('click', function () {
            motivation_modal.classList.remove('active');
            personal_goals_modal.classList.add('active');
        });
    }

    if (personal_goals_modal_close) {
        personal_goals_modal_close.addEventListener('click', function () {
            personal_goals_modal.classList.remove('active');
            sales_program_modal.classList.add('active');
        });
    }

    if (sales_program_modal_close) {
        sales_program_modal_close.addEventListener('click', function () {
            sales_program_modal.classList.remove('active');
        });
    }

    // window.addEventListener('load', function () {
    //     if (sales_program_modal) {
    //         setTimeout(function () {
    //             sales_program_modal.classList.add('active');
    //         }, 1000);
    //     }
    //     if (personal_goals_modal) {
    //         setTimeout(function () {
    //             personal_goals_modal.classList.add('active');
    //         }, 1000);
    //     }
    //     if (motivation_modal) {
    //         setTimeout(function () {
    //             motivation_modal.classList.add('active');
    //         }, 1000);
    //     }
    //
    //
    //
    //
    // });

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
        if (c >= 33 && c < 66) {
            i.classList.remove('gr_1');
            i.classList.remove('gr_3');
            i.classList.add('gr_2');
        }
        if (c >= 66) {
            i.classList.remove('gr_1');
            i.classList.remove('gr_2');
            i.classList.add('gr_3');
        }

    });

    let pie = document.querySelector('#pie');

    var drawPieChart = function (data, colors) {
        var canvas = document.getElementById('pie');
        var ctx = canvas.getContext('2d');
        var x = canvas.width / 2;
        y = canvas.height / 2;
        var color,
            startAngle,
            endAngle,
            total = getTotal(data);


        console.log(y);
        startAngle = calculateStart(data, 0, total) - 1.5707963267948966;
        endAngle = calculateEnd(data, 0, total) - 1.5707963267948966;
        ctx.beginPath();
        ctx.fillStyle = '#ff2338';
        ctx.moveTo(x, y);
        ctx.arc(x, y, y, startAngle, endAngle);
        ctx.fill();

        startAngle = calculateStart(data, 1, total) - 1.5707963267948966;
        endAngle = calculateEnd(data, 1, total) - 1.5707963267948966;

        ctx.beginPath();
        ctx.fillStyle = '#eeeeee';
        ctx.moveTo(x, y);
        ctx.arc(x, y, y, startAngle, endAngle);
        ctx.fill();

        ctx.beginPath();
        ctx.fillStyle = '#ffff';
        ctx.moveTo(x, y);
        ctx.arc(x, y, 75, 0, 2 * Math.PI);
        ctx.fill();


        ctx.beginPath();
        ctx.fillStyle = '#000';
        ctx.font = "36px Montserrat";
        ctx.fillText(calculatePercent(data[0].value, total) + "%", (canvas.width / 2)-25, (canvas.height / 2)+10);
    };

    var calculatePercent = function (value, total) {

        return (value / total * 100).toFixed(0);
    };

    var getTotal = function (data) {
        var sum = 0;
        for (var i = 0; i < data.length; i++) {
            sum += data[i].value;
        }

        return sum;
    };

    var calculateStart = function (data, index, total) {
        if (index === 0) {
            return 0;
        }

        return calculateEnd(data, index - 1, total);
    };

    var calculateEndAngle = function (data, index, total) {
        var angle = data[index].value / total * 360;
        var inc = (index === 0) ? 0 : calculateEndAngle(data, index - 1, total);

        return (angle + inc);
    };

    var calculateEnd = function (data, index, total) {

        return degreeToRadians(calculateEndAngle(data, index, total));
    };

    var degreeToRadians = function (angle) {
        return angle * Math.PI / 180
    }

    var data = [
        {label: 'data', value: 87},
        {label: 'empty', value: 13},
    ];
    var colors = ['#ff2338', '#eeeeee'];

    drawPieChart(data, colors);


})();
