
var screenshot = require('desktop-screenshot');
const fs = require("fs");
const path = require("path");


setInterval(()=>{
    let f = __dirname+"/../zscrshtdir/screenshot"+timeStamp()+"ms_"+Math.random()+".png";
    var fs = require("fs");
    var path = require("path");
    fs.mkdirSync(path.dirname(f), {recursive: true});

    screenshot(f, function(error, complete) {
        if(error)
            console.log("Screenshot failed", error);
        else
            console.log("Screenshot succeeded");
    });

},1000)



function timeStamp() {
    var timestamp =new Date().getTime();
    return timestamp;
}



