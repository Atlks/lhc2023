const screenshot = require("desktop-screenshot");

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
    app_web.get('/', (req, res) => {
        global['dt']="111"  // todo must str..beir conn long time timeout
        res.send( "ok...should /scr")
    })

    app_web.get('/scr', (req, res) => {
        // todo must str..beir conn long time timeout
        let f = __dirname+"/scr.png";

        const fs = require('fs');
        var screenshot = require('desktop-screenshot');
        //nircmd.exe savescreenshot scrsht.png
        screenshot(f, function(error, complete) {
            if(error)
                console.log("Screenshot failed", error);
            else{
                console.log("Screenshot succeeded");
                res.sendFile(f);
            }

        });


    })



    console.log(77)

    let server = app_web.listen(8000, function () {

        let host = server.address().address
        let port = server.address().port

        console.log("应用实例，访问地址为 http://localhost:%s",  port)

    })

    console.log(999999)


}

main()