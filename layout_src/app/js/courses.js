(function () {

    let aside_menu_item = document.querySelectorAll('aside ul .parent');
    let aside_menu_item_active = document.querySelector('aside ul .parent.open');

    aside_menu_item.forEach(function (i) {
        let  btn = i.querySelector('a');
        btn.addEventListener('click',function () {
            i.classList.toggle('open');
            let menu = i.querySelector(' ul');
            console.log(menu);
            if(i.classList.contains('open')){
                menu.style.height = menu.scrollHeight+'px';
            }else {
                menu.style.height = '0px';
            }
        })
    });

    if(aside_menu_item_active){
        let menu = aside_menu_item_active.querySelector(' ul');
        menu.style.height = menu.scrollHeight+'px';

    }

})();
