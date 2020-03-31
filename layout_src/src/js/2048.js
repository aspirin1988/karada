(function () {

    let game = create_range();

    console.log(game);

    let canvas = document.querySelector('.canvas2048');
    let ctx = canvas.getContext('2d');
    canvas.width = 500;
    canvas.height = 500;

    ctx.beginPath();
    ctx.fillStyle = '#000';
    ctx.fillRect(0, 0, 500, 500);
    ctx.fill();

    ctx.beginPath();
    ctx.strokeStyle = '#bbada0';
    ctx.lineWidth = 10;
    ctx.rect(5, 5, 490, 490);
    ctx.stroke();

    for (let i = 100; i < 500; i += 100) {
        ctx.beginPath();
        ctx.strokeStyle = '#bbada0';
        ctx.lineWidth = 10;
        ctx.moveTo(0, i);
        ctx.lineTo(500, i);
        ctx.moveTo(i, 0);
        ctx.lineTo(i, 500);
        ctx.stroke();

    }

    for (let i = 0; i < 5; i++) {
        for (let j = 0; j < 5; j++) {
            ctx.beginPath();
            ctx.fillStyle = '#eee4da';
            ctx.fillRect((!i ? 10 + (i * 100) : 5 + (i * 100)), (!j ? 10 + (j * 100) : 5 + (j * 100)), 85, 85);
            ctx.fill()

        }
    }


    function create_range() {
        let range = [];
        let count = 0;
        for (let i = 0; i < 5; i++) {
            let item = [];
            for (let j = 0; j < 5; j++) {
                let num = Math.ceil(Math.random() * 4);
                item.push(((num % 2 === 0) && count < 2 ? num : 0));
                if (!(num % 2)) {
                    count++;
                }
            }
            range.push(item);
        }

        return range;
    }

})();