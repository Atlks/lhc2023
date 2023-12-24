setInterval(() => {

    main()
}, 1000 * 999)
main()


function main() {


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
        let message = execFil(python, args);

        if (message.includes("Box(left="))
            console.log("!!!!!!!! rzt true")
    } catch (e) {
        console.log(e.message)
    }

}


function execFil(execFile, args) {

    const {execFileSync, exec, execSync} = require('child_process');

    $rzt = execFileSync(execFile, args, {
        encoding: "utf-8",
        windowsHide: true,
        cwd: process.cwd(),
        timeout: 5000,
        maxBuffer: 10 * 1024 * 1024,
        shell:false
    })

    let message = $rzt.toString();
    message = message.trim()

    console.log(message)
    return message;
}

function qryStr2obj(prm) {
    // prmOBJ=  new URLSearchParams(prm).get("grayscale") not work
    var querystring = require('querystring');

    var prmOBJ = querystring.parse(prm);
    return prmOBJ;
}


function escapeshellarg(prm) {
    return '"' + prm + '"';
    // return encodeURIComponent(prm)
}

function escapeshellarg342() {
    var prmOBJ = qryStr2obj(prm);
    let prmstr = JSON.stringify(prmOBJ)
    return encodeURIComponent(prmstr)
}