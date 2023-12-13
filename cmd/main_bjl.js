//c: \w\ jbbot > C: \phpstudy_pro\ Extensions\ php\ php7 .3 .4 nts\ php.exe think swoole //ink swoole//// 
//   https://api.telegram.org/bot5464498785:AAGtLv-M-RKgRoIh5G3XEfkdqkCPiVBB1NA/getUpdates
////////   npm install node-telegram-bot-api
//   npm install  ini
//   npm install  mysql
// execSync

//   node cmd/msgHdl_bjl.js
// node  C:\modyfing\jbbot\tlgrm\keywoHdlr.js
const {exec, execSync} = require('child_process');


while (true) {

    try {
        let s = "php " + __dirname + "/../think cmdBjlx";
        console.log(s)
        //size 10M
        let message = execSync(s, {"maxBuffer": 10 * 1024 * 1024 * 1024});

        log211(message);
        execSync("php " + __dirname + "/../lib/sleep.php");
    } catch (e) {
        console.log(e)
    }

}

function log211(message) {
    try {
        console.log(message.toString());
    } catch (e) {
        console.log(e)
    }

}

console.log(9999);


// token="6959066432:AAH9OgIspApiYStnaNyznl7mcJ_qPjBA7Fg";
//    // token="";
//     invoke_bot(token);
