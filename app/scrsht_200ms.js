

errhdl();

(async () => {


})();

main() ;



function main() {

    //--------------------------------ini web svr
    const {join} = require("path");

    setInterval(()=>{

    },10000);

    saveScrDsktp( __dirname+"/scrpic/")



}



function saveScrDsktp(dir) {
    const fs = require('fs');
    var screenshot = require('desktop-screenshot');
    //nircmd.exe savescreenshot scrsht.png
   let f= dir +timeStamp()+".jpg";
    screenshot(f, function (error, complete) {
        if (error)
            console.log("Screenshot failed", error);
        else {
            console.log("Screenshot succeeded");


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


        }

    });
}
function timeStamp() {
    var timestamp =new Date().getTime();
    return timestamp;
}


/**
 * 删除文件夹下所有文件及将文件夹下所有文件清空-同步方法
 * @param {*} path
 */
function emptyDir(path) {
    const files = fs.readdirSync(path);
    files.forEach(file => {
        const filePath = `${path}/${file}`;
        const stats = fs.statSync(filePath);
        if (stats.isDirectory()) {
            emptyDir(filePath);
        } else {
            fs.unlinkSync(filePath);
            console.log(`删除${file}文件成功`);
        }
    });
}

function errhdl()
{
    process.on('uncaughtException', function (err) {

        try {
            console.log(err)
            console.error('未捕获的异常', err.message);
            console.error(err)


        } catch (e) {
            console.log(e)
        }

    })

    process.on('unhandledRejection', function (err, promise) {
        try {
            console.error('有Promise被捕获的失败函数', err.message);
            console.error(err)


        } catch (e) {
            console.log(e)
        }
    })
}
