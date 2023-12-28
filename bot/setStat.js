const y_scrl = 700;
let scrlAmtPerTime = -50 * 500  //50 is per line
const scroolEnable=true

var nowStat = "stop"
const robot = require('robotjs');
//移动鼠标到中心位置
robot.moveMouse(288, 1064);
// 点击鼠标左键
robot.mouseClick();

robot.moveMouse(288, y_scrl);
robot.scrollMouse(500, "down")
require(__dirname+"/../libbot/bot.js")

if( scroolEnable)
    scroolX(scrlAmtPerTime)

setTimeout(async () => {

    // await _main()
    // return

    setInterval(async () => {

        console.log("\r\n\n\n\n\n")
        await _main()

    }, 1000)


    setInterval(() => {
        if( scroolEnable){
            robot.moveMouse(288, y_scrl);
            // # abt 50just one line
            let pos = -50 * 500
            require(__dirname+"/../libbot/bot.js")
            scroolX(pos)
        }

    }, 3000)


}, 2000)



async function _main() {

    console.log("\n-----------------------------\r\n\n\n\n\n")
    console.log("!!! FUN main()")

    require(__dirname + "/../lib/http2023.js")
    require(__dirname + "/../lib/log.js")
    require(__dirname + "/../lib/logger.js")
    require(__dirname + "/../lib/file2023.js")
    require(__dirname + "/../lib/php.js")
    require(__dirname + "/../lib/sys.js")

    var url = "";

    if (isBetStat() && nowStat == "stop") {
        url = "http://46.137.239.204/setStat.php?stat=start"
    }


    if (isStop()) {
        url = "http://46.137.239.204/setStat.php?stat=stop"
    }

    if (url != "")
        await http_get(url)
    else
        console.log("url is empty")


    console.log(">>> endFUN main()")


}


function isBetStat() {

    console.log("\n\n")
    console.log("!!! FUN isBetStat()")

    require(__dirname + "/../lib/exec212.js")


    startfile=__dirname+"/../cfgBot/start.jpg"

    let args = [
        "locateOnScreen.py",
        `img=${startfile}&confidence=0.8&region=0,0,700,1111&grayscale=true`

    ]


    let python =__dirname+"/../Python312/python.exe"

    try {
        let message = execFileX(python, args);

        if (message.includes("Box(left=")) {
            console.log("!!!!!!!! rzt true")
            console.log(">>> endfun isBetStat() ret true")
            return true
        } else
        {
            console.log(">>> endfun isBetStat() ret false")
            return false

        }
            

    } catch (e) {
          console.log(e.message)
        console.log(">>> endfun isBetStat() ret false")
        return false;
    }
    console.log(">>> endfun isBetStat() ret undfd")
}

function isStop() {

    console.log("\n\n")
    console.log("!!! FUN isStop()")
    startfile=__dirname+"/../cfgBot/stop.jpg"
    let args = [
        "locateOnScreen.py",
        `img=${startfile}&confidence=0.6&region=0,0,700,1111&grayscale=true`

    ]


    let python =__dirname+"/../Python312/python.exe"

    try {
        let message = execFileX(python, args);

        if (message.includes("Box(left=")) {
            console.log("!!!!!!!! rzt true")
            console.log(">>> endfun isStop() ret true")
            return true
        } else
        {
            console.log(">>> endfun isStop() ret false")
            return false
        }
           

    } catch (e) {
           console.log(e.message)
        console.log(">>> endfun isStop() ret false")
        return false;
    }

    console.log(">>> endfun isStop() ret undfd")
}
