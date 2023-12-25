var nowStat = "stop"
setTimeout(() => {

    setInterval(() => {


        console.log("\r\n\n\n\n\n")
        main()
    }, 2000)


    setInterval(() => {


        scrool()
    }, 1000)


}, 5000)


function main() {


    if (isBetStat()) {
        console.log("!!! now stat is start")
        nowStat = "start"
    }


    if (isStop()) {
        console.log("!!! now stat is stop")
        nowStat = "stop"
    }

    if (nowStat == "start") {
           typeStr("闲100{enter}")
    }

}


function isBetStat() {

    require(__dirname + "/../lib/exec212.js")
    // python="python"

    //jpg =C:/0prj/lhc2023/startPic.jpg

    // pythofil = "locateOnScreen.py"
    // prm = "img=C:/0prj/lhc2023/startPic.jpg&confidence=0.95&region=0,0,900,1111&grayscale=true";


    let args = [
        "locateOnScreen.py",
        "img=C:/0prj/lhc2023/startPic.jpg&confidence=0.95&region=0,0,900,1111&grayscale=true"

    ]


    let python = "C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\python.exe"

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
    let args = [
        "locateOnScreen.py",
        "img=C:/0prj/lhc2023/stop.jpg&confidence=0.9&region=0,0,900,1111&grayscale=true"

    ]


    let python = "C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\python.exe"

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

    let exeFile = "C:\\prgrm\\AutoIt3\\AutoIt3_x64.exe"

    try {
        let message = execFileX(exeFile, args);
        return message

        //console.log(message)
    } catch (e) {
        console.log(e.message)
    }
}


function  scrool()
{
    require(__dirname + "/../lib/exec212.js")

    let python = "C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\python.exe"

    let pos=-50*1000

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