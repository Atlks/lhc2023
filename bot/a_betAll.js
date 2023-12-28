// require("./bet1")
// require("./bet2")
require(__dirname+"/../lib/http2023.js")
require(__dirname+"/../lib/log.js")
require(__dirname+"/../lib/logger.js")
require(__dirname+"/../lib/file2023.js")
require(__dirname+"/../lib/php.js")
require(__dirname+"/../lib/sys.js")
require(__dirname + "/../lib/exec212.js")

let args = [
    __dirname+"/bet1.js",
    `400`

]


let exeFil811 =__dirname+"/../nodejs/node.exe"

try {
    let message = execFileX(exeFil811, args);

     console.log(message)

} catch (e) {
      console.log(e )
    //return false;
}