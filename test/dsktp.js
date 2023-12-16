// C:\w\sdkprj\node_modules\electron\dist\electron.exe  C:\modyfing\jbbot\zmng\dsktp.js

//   npm i  electron
//   npm i chalk
//   npm i esm-hook
//    npm i node-fetch
//     node_modules/electron/dist/electron  dsktp.js

//require("./libx/errHdlr")





//-------------start win




const {
    app, BrowserWindow,BrowserView,
    Menu,
    Tray
} = require('electron')
const path = require("path");
const ini = require("ini");
const fs = require("fs");



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
})



function createWindow() {
    // 创建浏览器窗口
    const win = new BrowserWindow({
        icon:"res/icon.jpg",
        width: 1024,
        height: 768,
        webPreferences: {
            nodeIntegration: true,
            contextIsolation: false,
            enableRemoteModule: true,
            webviewTag:true,

autoHideMenuBar:true,
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
                        win.webContents.openDevTools({ mode: 'bottom' })
                    }
                },
                {label: '关于'}
            ]
        }
    ]

    // 加载菜单   hide menu bar
    let m = Menu.buildFromTemplate([])
      Menu.setApplicationMenu(m)

    // 并且为你的应用加载index.html

     win.loadFile("t.htm")

    var ini= require("ini")
    var path=require("path")
    var fs=require("fs")


    console.log("Info.debug "+ Info.debug)


win.webContents.closeDevTools();

     // win.openDevTools();// win.openDevTools();

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

}


function mainPrcsFun1() {
    console.log('mainPrcsFun1')
}

//window.mainPrcsFun1 = mainPrcsFun1;