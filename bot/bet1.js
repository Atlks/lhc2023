
// node C:\0prj\lhc2023\bot\bet1.js 400
var nowStat = "stop"

const robot = require('robotjs');
// 移动鼠标到中心位置
const args = process.argv.slice(2)

if(args.length==0)
{
    console.log("args.length==0")
    process.exit(1)
}
global['x'] =args[0];
// robot.moveMouse(x, 1064);
// // 点击鼠标左键
// robot.mouseClick();
console.log("args::"+JSON.stringify(args))


require("../lib/errHdlr")


var betAmt = 3;
var alredyBetAmt = 0;

require("../libbot/bot")
require("./betlib")
setTimeout(() => {


    setInterval(async () => {


        await _main()

    }, 3000)


}, 2000)

setTimeout(()=>{
    process.exit(1)
},20000)


async function _main() {
    console.log("\n-----------------------------\r\n\n\n\n\n")
    console.log("!!! FUN main()")

  //  throw 999

    dbgObj = {"betAmt": betAmt, "alredyBetAmt": alredyBetAmt}
    console.log(dbgObj)


    if (await isBetStat() && nowStat == "stop") {
        console.log("!!! now stat is start")
        nowStat = "start"
        let a = [2, 2, 2, 1, 1, 1, 3, 4, 5, 6]
        betAmt = a[Random(0, 9)]
        //Random(1,5)
        alredyBetAmt = 0
    }


    let promise = await isStop();
    if (promise) {
        console.log("!!! now stat is stop")
        nowStat = "stop"
    }

    if (nowStat == "start") {

        //  while (alredyBetAmt<=betAmt)

        // if (alredyBetAmt >= betAmt)
        //     return
        alredyBetAmt++;

        // let betstr_a = ['闲', '庄']
        //
        //
        // let btstr = betstr_a[Random(0, 1)];

     //   let fnlMny = getRdmMny4bet()

        let line = rdmBetLine();


        const robot = require('robotjs');
// 移动鼠标到中心位置
        robot.moveMouse(global['x'] , 1064);
// 点击鼠标左键
        robot.mouseClick();
        typeStr(line + "{enter}")


    }

    console.log("!!! endfun main() ret ...")

}



async function isBetStat() {

    console.log("\n\n")
    console.log("!!! FUN isBetStat()")
    require(__dirname + "/../lib/http2023.js")
    require(__dirname + "/../lib/log.js")
    require(__dirname + "/../lib/logger.js")
    require(__dirname + "/../lib/file2023.js")
    require(__dirname + "/../lib/php.js")
    require(__dirname + "/../lib/sys.js")
    require(__dirname + "/../lib/exec212.js")
    url = "http://46.137.239.204/stat.txt"

    stt = await http_get(url)

    if (stt == "start")
    {
        console.log(">>> endfun isBetStat() RET TRUE")
        return true
    }
    console.log(">>> endfun isBetStat() RET FALSE")

}

async function isStop() {
    console.log("\n\n")
    console.log("!!! FUN isStop()")
    require(__dirname + "/../lib/http2023.js")
    require(__dirname + "/../lib/log.js")
    require(__dirname + "/../lib/logger.js")
    require(__dirname + "/../lib/file2023.js")
    require(__dirname + "/../lib/php.js")
    require(__dirname + "/../lib/sys.js")
    require(__dirname + "/../lib/exec212.js")

    url = "http://46.137.239.204/stat.txt"

    let stt = await http_get(url)
    if (stt == "stop")
    {
        console.log(">>> endfun isStop() RET TRUE")
        return true

    }

    else
    { console.log(">>> endfun isStop() RET FALSE")
        return false;

    }


}
