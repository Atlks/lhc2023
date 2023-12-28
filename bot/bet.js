var nowStat = "stop"

const robot = require('robotjs');
// 移动鼠标到中心位置
robot.moveMouse(800, 1064);
// 点击鼠标左键
robot.mouseClick();


var betAmt=3;
var alredyBetAmt=0;

require("betlib")
setTimeout(() => {



    setInterval(async () => {

        console.log("\r\n\n\n\n\n")
        await  _main()

    }, 3000)





}, 2000)




async function _main() {

    dbgObj={"betAmt":betAmt,"alredyBetAmt":alredyBetAmt}
    console.log(dbgObj)



    if ( await isBetStat() && nowStat == "stop") {
        console.log("!!! now stat is start")
        nowStat = "start"
        let a=[2,2,2,1,1,1,3,4,5,6]
        betAmt=a[Random(0,9)]
            //Random(1,5)
        alredyBetAmt=0
    }


    let promise =await isStop();
    if (promise) {
        console.log("!!! now stat is stop")
        nowStat = "stop"
    }

    if (nowStat == "start") {

      //  while (alredyBetAmt<=betAmt)

        if(alredyBetAmt>=betAmt)
            return
        alredyBetAmt++;

        let  betstr_a=['闲','庄']


        let btstr = betstr_a[Random(0,1)];

        let  fnlMny=getRdmMny4bet()

        let line = rdmBetLine();


        const robot = require('robotjs');
// 移动鼠标到中心位置
        robot.moveMouse(400, 1064);
// 点击鼠标左键
        robot.mouseClick();
        typeStr(line+"{enter}")



    }

}



async function isBetStat() {
    require(__dirname+"/../lib/http2023.js")
    require(__dirname+"/../lib/log.js")
    require(__dirname+"/../lib/logger.js")
    require(__dirname+"/../lib/file2023.js")
    require(__dirname+"/../lib/php.js")
    require(__dirname+"/../lib/sys.js")
    require(__dirname + "/../lib/exec212.js")
    url = "http://46.137.239.204/stat.txt"

    stt = await http_get(url)
    if(stt=="start")
        return  true

}

async function isStop() {

    require(__dirname + "/../lib/http2023.js")
    require(__dirname + "/../lib/log.js")
    require(__dirname + "/../lib/logger.js")
    require(__dirname + "/../lib/file2023.js")
    require(__dirname + "/../lib/php.js")
    require(__dirname + "/../lib/sys.js")
    require(__dirname + "/../lib/exec212.js")

    url = "http://46.137.239.204/stat.txt"

  let  stt = await http_get(url)
    if (stt == "stop")
        return true
    else
        return  false;

}

