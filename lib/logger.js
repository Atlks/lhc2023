// const {createLogger, format, transports} = require("winston");
// const {appendFileSync} = require("fs");
// require("./datetime.js")
// logger606 = createLogger({
//     transports: [
//         new transports.File({
//             filename: "logs/log403.log",
//             level: "info",
//             format: format.combine(
//                 format.timestamp({format: "MMM-DD-YYYY HH:mm:ss"}),
//                 format.align(),
//                 format.printf(
//                     (info) =>
//                         `${info.level}: ${[info.timestamp]}: ${info.message}`
//                 )
//             ),
//         }),
//     ],
// });
// module.exports = logger606;

//require("datetime")
try {
    require("./datetime")
    require(__dirname + "/datetime.js")
    require("./datetime.js")
    //   var {readFileSync,writeFileSync,appendFileSync} = require("fs");
    global["readFileSync"] = readFileSync;
    global["writeFileSync"] = writeFileSync;
    global["appendFileSync"] = appendFileSync;
    global['log_enterFun'] = log_enterFun
    global['log_fun_enter'] = log_fun_enter

    global['log_fun_ret'] = log_fun_ret
    global['log_errV2'] = log_errV2

    global['errorSeriz'] = errorSeriz
    global['log_warn'] = log_warn
    global['log_err'] = log_err
    global['log_info'] = log_info

} catch (e) {
    //maybe use in html env

}


try {
    require("./sys")
} catch (e) {

}

try {
    require("./libx/sys")
} catch (e) {

}

function appendFileSyncAllenv(f, msg) {
    //alert("appendFileSyncAllenv")

    if (isWinformEnv()) {

        callOBj = "appendFileSync " + encodeURIComponent(f) + " " + encodeURIComponent(msg);

        // alert(callOBj)
        return window.external.callFun(callOBj)
    } else {
        //win env   node env
        let fs = require("fs");
        //  alert(fs)

        fs.appendFileSync(f, msg)
    }
}

// require("./sys")
// appendFileSyncAllenv("log906.log","aaa")

try {
    require("./file2023")
} catch (e) {
}
try {
    require("./libx/file2023")
} catch (e) {
}

try {
    require("./sys")
} catch (e) {
}
try {
    require("./libx/sys")
} catch (e) {
}

global['log_info'] = log_info

function log_info(msg) {
    // require("./file2023")
    try {
        //  logger606.info(msg);   info: Sep-05-2023 18:34:26:
        appendFileV2("../log636.log", curDatetime() + " info " + msg + "\r\n")
    } catch (e) {
        console.log(e)
    }

}

global['log_infoV2'] = log_infoV2
function log_infoV2(msg,logf) {
    // require("./file2023")
    try {
        //  logger606.info(msg);   info: Sep-05-2023 18:34:26:
        appendFileV2(logf, curDatetime() + " info " + msg + "\r\n")
    } catch (e) {
        console.log(e)
    }

}

global['__METHOD__'] = __METHOD__

function __METHOD__(e) {
    //Error
    //     at loadToTableVue (C:\modyfing\jbbot\zmng\node_modules\ui.js:116:17)
    //     at main (C:\modyfing\jbbot\zmng\node_modules\uiT.js:7:5)
    let arr = e.stack.split("\n")
    // var re = /(\w+)@|at (\w+) \(/g, st = e.stack, m;
    // re.exec(st), m = re.exec(st);
    // callerName = m[1] || m[2];
    let funname = arr[1]
    funname = funname.trim();
    let brk = funname.indexOf("(")
    funname = funname.substr(3, brk - 3)
    return funname.trim();
}

function log_enterFun_console(arguments1) {

    var funname;
    // var callerName;
    try {
        throw new Error();
    } catch (e) {
        funname = __METHOD__(e);

    }
    //   var funname = arguments1.callee.name;
    // arguments.callee.name
    arg = JSON.stringify(arguments);
    console.log("*********=>" + funname + arg);

}

global['log_enterFun'] = log_enterFun

/**
 * only log console  dep,use log_console
 * @param arguments
 */
function log_enterFun(arguments) {

    var funname = arguments.callee.name;
    // arguments.callee.name
    arg = JSON.stringify(arguments);
    console.log("*********=>" + funname + arg);

}

try {
    global['log_enterFun_console'] = log_enterFun_console
} catch (e) {
}

global['log_fun_enter'] = log_fun_enter

function log_fun_enter(argsx) {

    var funname = argsx.callee.name;
    // arguments.callee.name
    arg = JSON.stringify(argsx);
    console.log("*********=>" + funname + arg);
    log_info("*********=>" + funname + arg)

}

global['log_fun_enterV2'] = log_fun_enterV2

function log_fun_enterV2(argsx,logf) {

    var funname = argsx.callee.name;
    // arguments.callee.name
    arg = JSON.stringify(argsx);
    console.log("*********=>" + funname + arg);
    log_infoV2("*********=>" + funname + arg,logf)

}


global['log_fun_retV2'] = log_fun_retV2

function log_fun_retV2(arguments, retVal,logf) {

    var funname = arguments.callee.name;
    // arguments.callee.name
  let  arg = JSON.stringify(arguments);


  let retShowStr= JSON.stringify(retVal)
    retShowStr = retShowStr.substring(0, 300)
    //  "*********=>" + funname + arg
    let data = "[" + funname + "] ret=>" + retShowStr;
    console.log(data);
    log_infoV2(data,logf)


}



global['log_fun_ret'] = log_fun_ret

function log_fun_ret(arguments, retVal) {

    var funname = arguments.callee.name;
    // arguments.callee.name
    arg = JSON.stringify(arguments);


    retVal = retVal.substring(0, 300)
    //  "*********=>" + funname + arg
    let data = "[" + funname + "] ret=>" + retVal;
    console.log(data);
    log_info(data)


}


function err_castSerizErr(e) {
    let s = errorSeriz(e)
    return json_decode(s)
}


global['log_errV4'] = log_errV4

/**
 *
 * @param e maybe str,num,obj
 * @param callerArgsX

 */
function log_errV4(e, callerArgsX) {


    //if(e obj)  add stk msg prp for json endocde
    try {
        e.stack1 = e?.stack  //bcs this two prpop cant to json encode

        e.msg1 = e?.message
    } catch (e3) {
        console.log(e3)
    }


    try {

        let eo = {"e": e, "funNargs": callerArgsX}

        console.log(" log_errV3]] :183 ")
        console.log(eo);
        let msg = json_encode(eo)
        appendFileSync("./err_log636.log", curDatetime() + " ERR " + msg + "\r\n")
        return eo;
    } catch (e4) {
        console.log(e4)
    }


}


global['log_errV5'] = log_errV5

function log_errV5(e, callerArgsX, logf) {


    //if(e obj)  add stk msg prp for json endocde
    try {
        e.stack1 = e?.stack  //bcs this two prpop cant to json encode

        e.msg1 = e?.message
    } catch (e3) {
        console.log(e3)
    }


    try {

        let eo = {"e": e, "funNargs": callerArgsX}

        console.log(" log_errV3]] :183 ")
        console.log(eo);
        let msg = json_encode(eo)
        appendFileSync(logf, curDatetime() + " ERR " + msg + "\r\n")
        return eo;
    } catch (e4) {
        console.log(e4)
    }


}


global['log_errV3'] = log_errV3

function log_errV3(e, callerArgs) {

    e.stack1 = e?.stack  //bcs this two prpop cant to json encode
    // if(e.message)
    e.msg1 = e?.message

    // e.stack1=e?.stack
    // // if(e.message)
    // e.msg1=e?.message
    // require("../libx/logger")

    try {

        let eo = {"e": err_castSerizErr(e), "funNargs": callerArgs}
        eo.stack1 = e?.stack;
        eo.msg = e?.message;
        console.log(" log_errV3]] :183 ")
        console.log(eo);
        let msg = json_encode(eo)
        appendFileSync("./err_log636.log", curDatetime() + " ERR " + msg + "\r\n")
        return eo;
    } catch (e) {
        console.log(e)
    }


}


global['log_errV2'] = log_errV2

function log_errV2(e, arguments) {

    try {
        var funname = arguments.callee.name;
        // arguments.callee.name
        arg = JSON.stringify(arguments);

        //  "*********=>" + funname + arg
        let eo = {"e": err_castSerizErr(e), "fun": funname, "args": arguments}

        console.log(eo);
        let msg = json_encode(eo)
        appendFileSync("./err_log636.log", curDatetime() + " ERR " + msg + "\r\n")
        return eo;
    } catch (e) {
        console.log(e)
    }


}


function errorSeriz(e) {
    msg = json_encode(e)    //cuztm errobj
    if (msg.length < 5) {
        //sys error
        let eobj = {"stack": e.stack, "msg": e.message}
        msg = json_encode(eobj)
    }
    return msg;
}


global['log_err'] = log_err

function log_err(e) {
    // require("./fp_ati1990")
    //alert("logeerr")
    var msg = ""
    try {
        if (typeof (e) == 'string')
            msg = e;
        else {
            msg = JSON.stringify(e)
            if (msg == "{}")
                msg = errorSeriz(e);


        }
        //  logger606.info(msg);   info: Sep-05-2023 18:34:26:
        appendFileSyncAllenv("./err_log636.log", curDatetime() + " ERR " + msg + "\r\n")
    } catch (e) {
        // alert(e)
        console.log(e)
    }
}

global['log_warn'] = log_warn

function log_warn(e) {
    require("./fp_ati1990")
    try {

        if (typeof (e) == 'string')
            msg = e;
        else {
            let eobj = {"stack": e.stack, "msg": e.message}
            msg = json_encode(eobj)
        }

        //  logger606.info(msg);   info: Sep-05-2023 18:34:26:
        appendFileSync("./warn_log636.log", curDatetime() + " info " + msg + "\r\n")
    } catch (e) {
        console.log(e)
    }
}

// const winlogger = require("logger");
// winlogger.info(url);


try {
    window['log_info'] = log_info
} catch (e) {
}