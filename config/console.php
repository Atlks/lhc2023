<?php
// +----------------------------------------------------------------------
// | 控制台配置
// +----------------------------------------------------------------------
return [
    // 指令定义
    'commands' => [
        'runx' => 'app\main',
      'MainBjlTpcmd' => 'app\commonBjl\MainBjlTpcmd',

      'swoole2' => 'app\common\mainx',
        'keywdReqHdlr' => 'app\common\keywdReqHdlr',
      'msgHdlrBjlTpcmd' => 'app\commonBjl\msgHdlrBjlTpcmd',


      'testx' => 'app\common\testCls',
        
    ],
];
