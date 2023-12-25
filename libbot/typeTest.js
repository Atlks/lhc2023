// setInterval(() => {
//
//     main()
// }, 1000 * 999)
main()


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

function main() {


    let txt = "我的内容";
    typeStr(txt);

}

