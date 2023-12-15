var Canvas = require('canvas')


const canvas = Canvas.createCanvas(150, 150);
//var    canvas = new Canvas(150, 150),
var    ctx = canvas.getContext('2d'),
    fs = require('fs');

let path = __dirname + '/../imagejs.png';
var out = fs.createWriteStream(path)
    , stream = canvas.createPNGStream();

stream.on('data', function(chunk){
    out.write(chunk);
});

//在左边画正方形
ctx.fillStyle = '#A00'
ctx.fillRect(0, 30,50,50);
ctx.save();

//在右边画正方形
ctx.fillStyle = '#aaa'
ctx.fillRect(50, 30, 50, 50);

//画文字
ctx.fillStyle = "#000";
ctx.font = "20px Arial";
ctx.fillText("Hello World", 0, 20);

//画一个圆
ctx.beginPath();
ctx.arc(30, 110, 20, 0, 2*Math.PI);
ctx.stroke();
ctx.fillStyle = "green";
ctx.fill();

//imagefilledellipse($img, $smallBall_Lfttp_X, $smallBall_lfttp_Y, $GLOBALS['smallBallWd'], $GLOBALS['smallBallWd'], \getColor(array_key("lfttpClr", $v_cell), $img));
