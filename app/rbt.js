//npm install robotjs



const robot = require('robotjs');

// 获取屏幕的大小
const screenSize = robot.getScreenSize();

// 计算屏幕中心位置
const centerX = screenSize.width / 2;
const centerY = screenSize.height / 2;

// 移动鼠标到中心位置
robot.moveMouse(centerX, centerY);

// 点击鼠标左键
robot.mouseClick();