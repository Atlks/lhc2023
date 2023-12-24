setInterval(() => {

    main()
}, 1000)

function main() {
    const {exec, execSync} = require('child_process');

    python = "C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\python.exe"
// python="python"
    cmd = `${python} matchTmplt.py`

    // cmd=`${python} t.py`
    $rzt = execSync(cmd, {
        cwd: process.cwd()

    })

    let message = $rzt.toString();
    message = message.trim()

    console.log(message)

    if (message.includes("true"))
        console.log("!!!!!!!! rzt true")
}
