// C:\w\sdkprj\node_modules\electron\dist\electron.exe  C:\modyfing\jbbot\zmng\dsktp.js

//   npm i  electron
//   npm i chalk
//   npm i esm-hook
//    npm i node-fetch
//     node_modules/electron/dist/electron  dsktp.js

//require("./libx/errHdlr")


//-------------start win


// electron dsk.js
//  cls


const {
    app, BrowserWindow, BrowserView,
    Menu,
    Tray
} = require('electron')
const path = require("path");
//const ini = require("ini");
const fs = require("fs");
const electron = require("electron");


// Electron会在初始化完成并且准备好创建浏览器窗口时调用这个方法
// 部分 API 在 ready 事件触发后才能使用。
app.whenReady().then(createWindow)

//当所有窗口都被关闭后退出
app.on('window-all-closed', () => {
    // 在 macOS 上，除非用户用 Cmd + Q 确定地退出，
    // 否则绝大部分应用及其菜单栏会保持激活。
    if (process.platform !== 'darwin') {
        app.quit()
    }
});


function createWindow() {
    // 创建浏览器窗口
    const win = new BrowserWindow({
        icon: "res/icon.jpg",
        width: 1024,
        height: 768,
        webPreferences: {
            nodeIntegration: true,
            contextIsolation: false,
            enableRemoteModule: true,
            webviewTag: true,


            worldSafeExecuteJavaScript: false,
            webSecurity: false,
        }
    })


    // 菜单模板设置
    let template = [
        {
            label: '用户',
            submenu: [
                {label: '切换用户'}
            ]
        },
        {
            label: '帮助',
            submenu: [
                {
                    label: '控制台',
                    click: () => {
                        win.webContents.openDevTools({mode: 'bottom'})
                    }
                },
                {label: '关于'}
            ]
        }
    ]

    // 加载菜单  hide menu bar
    let m = Menu.buildFromTemplate([])
    Menu.setApplicationMenu(m)

    // 并且为你的应用加载index.html
    var fs = require("fs")
    fs.appendFileSync("log1105.log", "L96\r\n")
    win.loadFile("dsk.htm")
    fs.appendFileSync("log1105.log", "L98\r\n")

    var path = require("path")
    console.log("L101")


    // console.log("Info.debug "+ Info.debug)

    fs.appendFileSync("log1105.log", "xxx")


    //  win.openDevTools();// win.openDevTools();

    //hide menu
    // 加载菜单
    //let m = Menu.buildFromTemplate([])
    //  Menu.setApplicationMenu(m)

    // BrowserView

    // var electron = require('electron');
    // var BrowserView =electron.BrowserView;
    // var view = new BrowserView();
    // win.setBrowserView(view);
    // view.setBounds({x:0,y:100,width:1000,height:450});
    // view.webContents.loadURL('http://www.cg9292.net/');
    // win.setBrowserView(view);



    //, thumbnailSize: thumbSize


    setTimeout(function (){
        try {
            const electron = require('electron')
            const desktopCapturer = electron.desktopCapturer
            let options = {types: ['window']}
            fs.appendFileSync("log1105.log", "options")
            desktopCapturer.getSources(options, function (error, sources) {

                fs.appendFileSync("log1105.log", "getSources")
                if (error) {
                    fs.appendFileSync("log1105.log", JSON.stringify(error))
                    return console.log(error)

                }

                sources.forEach(function (source) {
                    var fs = require("fs");
                    let str = "source.name=>" + source.name + "\r\n";
                    fs.appendFileSync("log1105.log", str)
                    console.log(source.name);
                    // if (source.name === 'Entire screen' || source.name === 'Screen 1') {
                    //     const screenshotPath = path.join(os.tmpdir(), 'screenshot.png')
                    //
                    //     fs.writeFile(screenshotPath, source.thumbnail.toPng(), function (error) {
                    //         if (error) return console.log(error)
                    //         shell.openExternal('file://' + screenshotPath)
                    //         const message = `截图保存到: ${screenshotPath}`
                    //         screenshotMsg.textContent = message
                    //     })
                    // }
                })
            });
            //end getsoursce
        } catch (e) {
            fs.appendFileSync("log1105.log", JSON.stringify(e))
        }
    },5000)



}


function mainPrcsFun1() {
    console.log('mainPrcsFun1')
}

//window.mainPrcsFun1 = mainPrcsFun1;