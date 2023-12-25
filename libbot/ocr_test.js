
let f= __dirname+"/../app/scrpic/" +timeStamp()+".jpg";


let ocrexe="C:\\Tesseract-OCR\\tesseract.exe"
const {exec, execSync} = require('child_process');
let cmd=`${ocrexe} ${f}   C:\\0prj\\ocrout\\ocrtest -l chi_sim`
console.log(cmd)

let message = execSync(cmd, {"maxBuffer": 10 *  1024 * 1024});
console.log(message.toString())


var fs = require("fs");
let fileStream = fs.readFileSync("C:\\0prj\\ocrout\\ocrtest.txt" );//读取文件
let t=fileStream.toString();

console.log(t)


function timeStamp() {
    var timestamp =new Date().getTime();
    return timestamp;
}
