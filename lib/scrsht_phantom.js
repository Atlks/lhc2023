


var page = require('webpage').create();
let net = 'http://www.cg9292.net/';
net="http://www.google.com"
page.open(net, function() {
    setTimeout(function() {
        page.render('google.png');
        phantom.exit();
    }, 200);
});


// C:\phantomjs-2.1.1-windows\bin\phantomjs.exe  C:\0prj\lhc2023\lib\scrsht_phantom.js

// C:\phantomjs-2.1.1-windows\bin\phantomjs.exe  C:\ck\prg2\pgpl\vietnam\scrsht.js