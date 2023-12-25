
global['execFileX']=execFileX
function execFileX(execFile, args) {

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