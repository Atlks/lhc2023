<?php


// php public/hd2test.php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//    php public/HandleUpdates_core.php
//    php public/HandleUpdates.php
// [ 应用入口文件 ]  HandleUpdates/index
namespace think;

use function libspc\log_err;

require __DIR__ . '/../vendor/autoload.php';


require_once __DIR__."/../lib/iniAutoload.php";


while (true) {
    try {


        $filename = __DIR__ . "/HandleUpdates_core.php";

        $cmd =  "php " . $filename . "       ";
        var_dump($cmd);
        //  exec($cmd);
        system($cmd);
        // echo   iconv("gbk","utf-8","php中文待转字符");//把中文gbk编码转为utf8
        //main_process();
    } catch (\Throwable $exception) {
        var_dump($exception);
        log_err($exception,__LINE__.__METHOD__);

    }
    usleep(300*1000);
}



