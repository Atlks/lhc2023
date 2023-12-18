<?php
$GLOBALS['BOT_TOKEN'] = '6959066432:AAH9OgIspApiYStnaNyznl7mcJ_qPjBA7Fg';
$GLOBALS['chat_id'] = -4038077884;


// 命令行入口文件
// 加载基础文件
require __DIR__ . '/../vendor/autoload.php';

//$outf = "http://h1.66286662.net:8000/cg/cgvideo12_2.flv";
$outf="C:/0prj/lhc2023/lib/../vdNow/20231218_170835/z20sec.mp4";
$cfile = new \CURLFile($outf);
$bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
$bot->sendVideo($GLOBALS['chat_id'], $cfile,20,"");
