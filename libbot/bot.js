function typeStr(txt) {
    console.log("\n\n")

    var funname = arguments.callee.name;
    let  arg = JSON.stringify(arguments);
    console.log("!!! FUN "+funname+arg)

    require(__dirname + "/../lib/exec212.js")

    // exeFile="exeFile"

    //jpg =C:/0prj/lhc2023/startPic.jpg

    // pythofil = "locateOnScreen.py"
    // prm = "img=C:/0prj/lhc2023/startPic.jpg&confidence=0.95&region=0,0,900,1111&grayscale=true";


    let args = [
        __dirname + "/typeString.au3",
        txt
    ]


    console.log("execFileX_args=>" +JSON.stringify(args))

    let exeFile = __dirname+"/../AutoIt3/AutoIt3_x64.exe"

    try {
        let message = execFileX(exeFile, args);
        console.log(">>> endfun  typeStr()")
        return message

        //console.log(message)
    } catch (e) {
        console.log(e.message)
    }


}

global['typeStr']=typeStr
global['scroolX']=scroolX
function scroolX(pos) {




    require(__dirname + "/../lib/exec212.js")

    let python = __dirname+"/../Python312/python.exe"
// # abt 50just one line
    //  let pos = -50 * 50

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
