setInterval(() => {

    main()
}, 1000 * 999)
main()


function main() {

  console.log(isStop())

}

function isStop() {

    require(__dirname + "/../lib/exec212.js")
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
        }else
            return false

    } catch (e) {
        //  console.log(e.message)
        return false;
    }
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