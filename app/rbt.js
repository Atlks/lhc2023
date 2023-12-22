//npm install robotjs


const robot = require('robotjs');

// 获取屏幕的大小
const screenSize = robot.getScreenSize();

// 计算屏幕中心位置
const centerX = screenSize.width / 2;
const centerY = screenSize.height / 2;

// 移动鼠标到中心位置
robot.moveMouse(300, 500);

// 点击鼠标左键
// robot.mouseClick();
robot.scrollMouse(5, "down")
robot.scrollMouse(5, "up")
robot.scrollMouse(5, "down")


// Type "Hello World". not spt chns
//robot.typeString("功He\u6211\u662f\u8c01了");

// Press enter.
//robot.keyTap("enter");

//
// var encoding = 'GBK';
// const { execSync} = require('child_process');
// let buffer = execSync("echo  我是谁  | clip ","utf8");
// console.log(buffer.toString( ))
//
// var iconv=require('iconv-lite');
//
//
// var data = iconv.decode( Buffer.from(buffer) , encoding);//解决字符编码问题
// console.log(data);


//C:\0prj\Tesseract\tesseract.exe C:\0prj\ocrtest.jpg   C:\0prj\ocrout\ocrtest -l chi_sim
//C:\Tesseract-OCR\tesseract.exe C:\0prj\ocrtest.jpg   C:\0prj\ocrout\ocrtest -l chi_sim