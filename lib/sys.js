function tipsNendThrowEx(提示内容) {


    throw  "ex@" + 提示内容

}

global['isNumber'] = isNumber
function isNumber(a){

    if(a=="")
        return  false;

    if(a==null)
        return  false;


    if(a==undefined)
        return  false;

    if(isNaN(Number(a,10))){

        return false

    }

    else{

        return true

    }

}

global['nbr_fmt_fix2'] = nbr_fmt_fix2
function nbr_fmt_fix2(arraySum)
{
    try{
        arraySum=parseFloat(arraySum)
    }catch (e)
    {

    }

    try{
        arraySum=arraySum.toFixed(2)
    }catch (e)
    {
        console.log(e)
    }



    try{
        arraySum=parseFloat(arraySum)
    }catch (e)
    {

    }
    return  arraySum

}






global['timeStamp'] = timeStamp
function timeStamp() {
    var timestamp = Date.parse(new Date());
    return timestamp;
}
function timeStamp_sec() {
    var timestamp = Math.round(new Date() / 1000);
    return timestamp;
}



//console.log(timeStamp())

global['parse_ini_file'] = parse_ini_file

/**
 * not rcm use ini file..just use cmd cfg togthr file btr..
 *
 * @param fil

 */
function parse_ini_file(fil) {
    const path = require("path");
   // var ini = require('ini');
    const ini = require("ini");
    const fs = require("fs");
    // const iopath = path.join(__dirname, '../cfgDep.ini'); // 引用Pos.ini的相对地址
    const Info = ini.parse(fs.readFileSync(fil, 'utf-8'));
    return Info
}

try{
    require("./file")
}catch (e){}



global['requirex'] = requirex

/**
 *
 * @param f
 */
function requirex(f) {

    if (!file_exists(f))
        f = "./" + f;
    if (!file_exists(f))
        f = "./libBiz/" + f;


    try {
        console.log(f)
        require(f)
    } catch (e) {
        console.warn(e.message)
    }

}


//console.log(is_int("12"))
/**
 *判断是否整数
 * @param num
 */
function is_int(num) {
    return parseInt(num) == parseFloat(num)
}

function tipsNend(提示内容) {

    return () => {
        throw  "ex@" + 提示内容
    }
}

/**
 *
 * @returns {string}
 */
function callrmtRstapiUrl() {

    return "callrmt?nocache348=" + Math.random() + "&callfun=";
}

try {

    global['isWinformEnv'] = isWinformEnv
} catch (e) {

}

try {
    window['isWinformEnv'] = isWinformEnv
} catch (e) {

}
try {
    window['isset'] = isset
} catch (e) {

}


try {
    global['isset'] = isset
} catch (e) {

}


global['getcurReqID'] = getcurReqID

/**
 *  theard local
 */
function getcurReqID() {
    const async_hooks = require('async_hooks');

    //  let async_hooks=global['async_hooks']
    // 返回当前异步作用域的asyncId
    const eid = async_hooks.executionAsyncId();

// 返回触发此异步操作的异步作用域的asyncId
    const tid = async_hooks.triggerAsyncId();
    return eid
}

function isset(varname) {
    try {
        varname = trim(varname);
        rzt = typeof (eval(varname));
        return typeof (varname) != "undefined";
    } catch (e) {
        console.log("[43isset()] " + e.message);
        //  console_log(e);
        return false;
    }

}


function ifx(条件, ...通过后执行的指令) {
    // if(typeof  条件 =="function")
    //     条件=条件()

    console.log("[如果] cdt=>" + 条件)
    if (条件) {
        {
            let fns = arguments;
            let rzt;

            for (var i = 1; i < fns.length; i++) {
                let f = fns[i];
                // console.log("cur f is =>"+f)
                rzt = f(rzt);

            }
            return rzt;
        }
    }
}

function isWinformEnv() {

    //if(isset("window.external"))
    //  window.external && window.external.external ex..   winformx
    // window.external && && window.external.external==false .electr env
    //
    //  window.external ex just console env

    //  alert(window.external)  //in eletr env is true..
    //  alert( typeof window.external.callFun)  //in eletr env is false..
    try {
        if (window.external && typeof window.external.callFun == "unknown") {


            return true;
        }
        if (window.external && typeof window.external.callFun == "undefined") {


            return false;  //electron env


        }


    } catch (e) {
        //console env just err
        return false;
    }

    return false;


    // alert(window.external.callFun)  无效调用参数可能会自东exe
    try {
        if (window.external.callFun) {
            console.log(":62 winform env")
            return true;
        } else {
            alert("54")
            console.log(":68 not winform env")
            return false;
        }

    } catch (e) {
        alert("61")
        ///  alert(e)
        console.log(":74 not   winform env")
        return false;
    }

}

try {
    if (!isset("global"))
        window['global'] = [];
} catch (e) {
    console.log(e.message)

}

if (isWinformEnv()) {

    console.log(" cur env::" + isWinformEnv())
    __dirname = "";
} else {
    console.log(" cur env::" + isWinformEnv())
}

global['curDatetimeV2'] = curDatetimeV2

function curDatetimeV2() {


    return formatDate(new Date())
    // const date = new Date();
    //  console.log(date.toLocaleString('en-US', { timeZone: 'America/New_York' })); // 2/16/2023, 8:25:05 AM


    // return date.toLocaleString('zh-CN', {timeZone: 'utc'});
}


global['curDatetime'] = curDatetime

function curDatetime() {


    return formatDate(new Date())
    // const date = new Date();
    //  console.log(date.toLocaleString('en-US', { timeZone: 'America/New_York' })); // 2/16/2023, 8:25:05 AM


    // return date.toLocaleString('zh-CN', {timeZone: 'utc'});
}


function padTo2Digits(num) {
    if (num.toString().length == 1)
        return "" + "0" + num;
    else
        return num;
}


global['copyProp'] = copyProp

function copyProp(frm, to) {
    for (let key in frm) {
        // console.log(frm, frm[key])
        to[key] = frm[key];
    }
}

global['idBasetime'] = idBasetime

/**
 *
 * @param date
 * @returns {string}
 */
function idBasetime() {
    let date = new Date()
    return (
        [
            date.getFullYear(),
            padTo2Digits(date.getMonth() + 1),
            padTo2Digits(date.getDate()),
        ].join('') +
        '_' +
        [
            padTo2Digits(date.getHours()),
            padTo2Digits(date.getMinutes()),
            padTo2Digits(date.getSeconds()),
        ].join('')
    );
}

global['rand']=rand
function rand(  min,   max)
{
return Random(min, max)
}


function Random(min, max) {
    return Math.round(Math.random() * (max - min)) + min;
}

//console.log("xxx----:"+rand(2,7))

/**
 *
 * @param date
 * @returns {string}
 */
function formatDate(date) {
    return (
        [
            date.getFullYear(),
            padTo2Digits(date.getMonth() + 1),
            padTo2Digits(date.getDate()),
        ].join('-') +
        ' ' +
        [
            padTo2Digits(date.getHours()),
            padTo2Digits(date.getMinutes()),
            padTo2Digits(date.getSeconds()),
        ].join(':')
    );
}

// 👇️ 2021-10-24 16:21:23 (yyyy-mm-dd hh:mm:ss)
//console.log();

console.log(curDatetime())


global['getLibdir'] = getLibdir

function getLibdir() {
    // _file=>C:\modyfing\jbbot\zmng\shangxiafen.htm
    // if embed in htm...filename just htm path
    // if(!__filename)
    //     __filename=""


    //   console.log("_file=>" + __filename)  //if in html file ,...just for html file path
    //   console.log("__dirname=>" + __dirname)
    try {
        //   console.log(__dirname)
        let libdir = __dirname + '/../libx/'
// C:\modyfing\jbbot\zmng/../lib/
        //   console.log(libdir)

        const fs = require('fs');

        //   console.log("exist dir:=>" + fs.existsSync(libdir))

        if (!fs.existsSync(libdir)) {
            //   console.log(libdir + " not exist")
            libdir = __dirname + '/libx/'
        }
        //   console.log("libdir=>" + libdir)
        return libdir;
    } catch (e) {
        return ""

    }

}




