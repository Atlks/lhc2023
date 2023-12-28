var nowStat = "stop"


const robot = require('robotjs');
// 移动鼠标到中心位置
robot.moveMouse(288, 1064);
// 点击鼠标左键
robot.mouseClick();
robot.moveMouse(288, 800);
robot.scrollMouse(500, "down")


setTimeout(() => {



    setInterval(() => {

        console.log("\r\n\n\n\n\n")
         _main()

    }, 1000)


    setInterval(() => {


        scrool()
    }, 1000)


}, 2000)



function _main() {

    require(__dirname+"/../lib/http2023.js")
    require(__dirname+"/../lib/log.js")
    require(__dirname+"/../lib/logger.js")
    require(__dirname+"/../lib/file2023.js")
    require(__dirname+"/../lib/php.js")
    require(__dirname+"/../lib/sys.js")

    var url="";

    if (isBetStat() && nowStat == "stop") {
        url="http://46.137.239.204/setStat.php?stat=start"
    }


    if (isStop()) {
        url="http://46.137.239.204/setStat.php?stat=stop"
    }

    if(url!="")
      http_get(url)
    else
        console.log("url is empty")


}


function scrool() {




    require(__dirname + "/../lib/exec212.js")

    let python = __dirname+"/../Python312/python.exe"
// # abt 50just one line
    let pos = -50 * 50

    let args = [
        __dirname+"/../libbot/mouseScrool.py",
        pos

    ]


    try {
        let message = execFileX(python, args);


    } catch (e) {
        console.log(e.message)

    }
}

function isBetStat() {

    require(__dirname + "/../lib/exec212.js")


    startfile=__dirname+"/../cfgBot/start.jpg"

    let args = [
        "locateOnScreen.py",
        `img=${startfile}&confidence=0.8&region=0,0,900,1111&grayscale=true`

    ]


    let python =__dirname+"/../Python312/python.exe"

    try {
        let message = execFileX(python, args);

        if (message.includes("Box(left=")) {
            console.log("!!!!!!!! rzt true")
            return true
        } else
            return false

    } catch (e) {
        //  console.log(e.message)
        return false;
    }
}

function isStop() {


    startfile=__dirname+"/../cfgBot/stop.jpg"
    let args = [
        "locateOnScreen.py",
        `img=${startfile}&confidence=0.8&region=0,0,900,1111&grayscale=true`

    ]


    let python =__dirname+"/../Python312/python.exe"

    try {
        let message = execFileX(python, args);

        if (message.includes("Box(left=")) {
            console.log("!!!!!!!! rzt true")
            return true
        } else
            return false

    } catch (e) {
        //  console.log(e.message)
        return false;
    }
}
