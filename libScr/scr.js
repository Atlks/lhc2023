
errhdl();

(async () => {


})();

main() ;

function saveScrDsktp(f, res) {
    const fs = require('fs');
    var screenshot = require('desktop-screenshot');
    //nircmd.exe savescreenshot scrsht.png
    screenshot(f, function (error, complete) {
        if (error)
            console.log("Screenshot failed", error);
        else {
            console.log("Screenshot succeeded");
            res.sendFile(f);
        }

    });
}

  function main() {

    //--------------------------------ini web svr
    const {join} = require("path");

    //------------- stgart web
    const express = require('express')
    const app_web = express()



    let webroot = join(__dirname + "/", '');
    console.log("webrt=>" + webroot)
    app_web.use(express.static(webroot))


// respond with "hello world" when a GET request is made to the homepage
    app_web.get('/pics', (req, res) => {
        global['dt']="111"  // todo must str..beir conn long time timeout
        res.send( global['dt'])
    })
    app_web.get('/', (req, res) => {
        // todo must str..beir conn long time timeout


        res.send("should   /scr")
       //  const fs = require('fs');
       //
       // arr= fs.readdirSync(webroot);
       //  res.send( JSON.stringify(arr))
    })
    app_web.get('/scrx', (req, res) => {
        // todo must str..beir conn long time timeout
        let url = 'http://www.cg9292.net/';
        let f = __dirname+"/scr.png";
        saveScrDsktp(f, res);

    })
    //end /scr

      app_web.get('/scr',async (req, res) => {
          // todo must str..beir conn long time timeout
          let url = 'http://www.cg9292.net/';
          let f = __dirname+"/scr.png";
          //  saveScrDsktp(f, res);
          await saveScr(url,f,res)

      })


    console.log(77)

    let server = app_web.listen(80, function () {

        let host = server.address().address
        let port = server.address().port

        console.log("应用实例，访问地址为 http://localhost:%s",  port)

    })

    console.log(999999)


}



async function saveScr(url, pathSaveImg,res) {
    const puppeteer = require('puppeteer');
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    await page.goto(url, {waitUntil: 'networkidle2'});

    const screenshot = await page.screenshot({path: pathSaveImg});
    console.log(`Screenshot taken: ${screenshot}`);
    await browser.close();
    res.sendFile(pathSaveImg);
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
