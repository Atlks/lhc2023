var Canvas = require('canvas')


//Canvas.loadImage()
let width = 40;
const canvas = Canvas.createCanvas(width, width);
//var    canvas = new Canvas(150, 150),
var    ctx = canvas.getContext('2d'),
    fs = require('fs');

 let path = __dirname + '/../imagejs.png';
var out = fs.createWriteStream(path)
    , stream = canvas.createPNGStream();

stream.on('data', function(chunk){
    out.write(chunk);
});

clr="red";
x=width/2;y=x
rds=width/2;

var fs = require("fs");
// let rt = fs.readFileSync(__dirname + '/../imgprm.json').toString();
// let json=JSON.parse(rt);
//画一个圆
ctx.beginPath();
ctx.arc(x, y, rds, 0, 2*Math.PI);
//ctx.stroke();
ctx.fillStyle = clr;
ctx.fill();

//imagefilledellipse($img, $smallBall_Lfttp_X, $smallBall_lfttp_Y, $GLOBALS['smallBallWd'], $GLOBALS['smallBallWd'], \getColor(array_key("lfttpClr", $v_cell), $img));
