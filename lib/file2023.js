
global['writeFile']=writeFile
function writeFile(f, t) {



    if(isWinformEnv())
    {


        let txtInshell=encodeURIComponent(t)
        let fl=encodeURIComponent( f);
        var hedtx=window.external.callFun("writeFileV3 "+fl+" "+ txtInshell);
    }
    else
    {
        f=f.replace("__USERPROFILE__",process.env.USERPROFILE);
        f=f.replace("__rootdir__",__dirname)
        // f=f.replace("__USERPROFILE__",process.env.USERPROFILE);
        // f=f.replace("__rootdir__",__dirname)
        writeFileSyncx( f,t );

    }

}

global['writeFileSyncV2']=writeFileSyncV2

/**
 * dep
 * @param fil
 * @param str
 */
function writeFileSyncV2(fil, str) {
    log_enterFun_console(arguments)
    try{
        var fs = require("fs");
        var path = require("path");
        fs.mkdirSync(path.dirname(fil), {recursive: true});
        //   fs.mkdirSync(appRoot + '/css

        fs.writeFileSync(fil, str);
    }catch (e)
    {
        console.log(e)
    }

}

global['getlib']=getlib
function getlib(basename) {

    let f = __dirname + "/"+basename;
    if(!file_exists(f))
        f = __dirname + "/../libx/"+basename;
    if(!file_exists(f))
        f = __dirname + "/../libxBiz/"+basename;



    if(!file_exists(f))
        f = __dirname + "/libx/"+basename;

    if(!file_exists(f))
        f = __dirname + "/libx/"+basename;



    if(!file_exists(f))
        f = __dirname + "/../"+basename;

    // if (libdir)
    //     f = libdir + "/../cfgDep.ini";
    return f;
}


try{
    require("./sys")
}catch (e){}
try{
    require("./libx/sys")
}catch (e){}



try{
    require("./file")
}catch (e){}
try{
    require("./libx/file")
}catch (e){}
global['appendFileV2']=appendFileV2
function  appendFileV2(f,t){

    const {appendFileSync} = require("fs");
    if(isWinformEnv())
    {


        let txtInshell=encodeURIComponent(t)
        let fl=encodeURIComponent( f);
        var hedtx=window.external.callFun("appendFileV2 "+fl+" "+ txtInshell);
    }
    else
    {
      //  require("./file")
        f=f.replace("__USERPROFILE__",process.env.USERPROFILE);
        f=f.replace("__rootdir__",__dirname)
        // f=f.replace("__USERPROFILE__",process.env.USERPROFILE);
        // f=f.replace("__rootdir__",__dirname)
        appendFileSync( f,t );

    }
}