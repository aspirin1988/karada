(function () {
    let aside_menu_item = document.querySelectorAll('aside ul .parent');

    aside_menu_item.forEach(function (i) {
        i.addEventListener('click',function () {
            console.log(i)
        })
    })
})();
