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