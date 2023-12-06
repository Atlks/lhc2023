<?php
// +----------------------------------------------------------------------
// | 控制台配置
// +----------------------------------------------------------------------
return [
    // 指令定义
    'commands' => [
        'runx' => 'app\main',
      'cmd_lhc' => 'app\commonLhc\CmdLhc',

      'swoole2' => 'app\common\mainx',
        'keywdReqHdlr' => 'app\common\keywdReqHdlr',
      'msgHdlrLhc' => 'app\common\msgHdlrLhc',


      'testx' => 'app\common\testCls',
        
    ],
];
