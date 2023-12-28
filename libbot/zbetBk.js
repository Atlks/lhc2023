var nowStat = "stop"

const robot = require('robotjs');
// 移动鼠标到中心位置
robot.moveMouse(288, 1064);
// 点击鼠标左键
robot.mouseClick();
robot.moveMouse(288, 800);
robot.scrollMouse(500, "down")

var betAmt=3;
var alredyBetAmt=0;
setTimeout(() => {



    setInterval(() => {

        console.log("\r\n\n\n\n\n")
        _main()

    }, 3000)


    setInterval(() => {


        scrool()
    }, 1000)


}, 2000)




function _main() {

    dbgObj={"betAmt":betAmt,"alredyBetAmt":alredyBetAmt}
    console.log(dbgObj)


    if (isBetStat() && nowStat == "stop") {
        console.log("!!! now stat is start")
        nowStat = "start"
        let a=[2,2,2,1,1,1,3,4,5,6]
        betAmt=a[Random(0,9)]
            //Random(1,5)
        alredyBetAmt=0
    }


    if (isStop()) {
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

        typeStr(line+"{enter}")



    }

}




function getRdmMny4bet() {

    let  mny0_a=[100,1000]


    let  nmy0= mny0_a[Random(0,1)];

    let  mny= Random(1,9)

    let fnlMny=mny*nmy0;
    return  fnlMny
}

function rdmBetLine() {
    const fs = require('fs');


    // read contents of the file
    const data = fs.readFileSync(__dirname + '/../cfgBot/bets.txt', 'UTF-8');

    // split the contents by new line
    const lines = data.split(/\r?\n/);

    rdm = Random(0, lines.length - 1)

    let line = lines[rdm];
    return line;
}

function Random(min, max) {
    return Math.round(Math.random() * (max - min)) + min;
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

function typeStr(txt) {
    require(__dirname + "/../lib/exec212.js")

    // exeFile="exeFile"

    //jpg =C:/0prj/lhc2023/startPic.jpg

    // pythofil = "locateOnScreen.py"
    // prm = "img=C:/0prj/lhc2023/startPic.jpg&confidence=0.95&region=0,0,900,1111&grayscale=true";


    let args = [
        __dirname + "/typeString.au3",
        txt
    ]


    console.log(JSON.stringify(args))

    let exeFile = __dirname+"/../AutoIt3/AutoIt3_x64.exe"

    try {
        let message = execFileX(exeFile, args);
        return message

        //console.log(message)
    } catch (e) {
        console.log(e.message)
    }
}


function scrool() {
    require(__dirname + "/../lib/exec212.js")

    let python = "C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\python.exe"

    let pos = -50 * 1000

    let args = [
        "mouseScrool.py",
        pos

    ]


    try {
        let message = execFileX(python, args);


    } catch (e) {
        console.log(e.message)

    }
}