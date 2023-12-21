<?php

namespace app\commonBjl;

use app\model\LotteryLog;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\model\Setting;
use think\view\driver\Php;
use function libspc\log_err;

 global $BOT_TOKEN;

global $chat_id;
//$bot_token = "6426986117:AAFb3woph_1zOWFS5cO98XIFUPcj6GqvmXc";  //sscNohk
//$chat_id = -1001903259578;
//php think cmdBjlx


class MainBjlTpcmd extends Command {
  protected function configure() {
    // 指令配置   php C:\modyfing\jbbot\think    swoole2  sscx
    $this->setName('cmd2')
      ->addArgument('cfgOpt', Argument::OPTIONAL, "cfgOpt name")
      ->setDescription('the cmd2 command');
  }


  protected function execute(Input $input, Output $output) {
    require_once __DIR__ . "/../../lib/iniAutoload.php";
//        require_once __DIR__ . "/../../lib/log23.php";
//        require_once __DIR__ . "/../../lib/logx.php";
    if ($input->getArgument('cfgOpt')) {
      $cfgOpt = trim($input->getArgument('cfgOpt'));
      $cfgOpt = urldecode($cfgOpt);
      \log23::zdbg11(__METHOD__, "cmdopt", $cfgOpt);
      $GLOBALS['cfgOpt'] = $cfgOpt;
      //  \think\facade\Log::dbg11("cfgopt=》".$cfgOpt);
    }


    \think\facade\Log::info('这是一个自定义日志类型');
    //   die();
    // 指令输出
    $output->writeln('cmd2');
    // while (true) {
    try {
      \think\facade\Log::noticexx('这是一个自定义日志类型');

      // echo   iconv("gbk","utf-8","php中文待转字符");//把中文gbk编码转为utf8
      require_once __DIR__ . "/../../libBiz/a__mainBjl.php";
      main_processBjl();
    } catch (\Throwable $exception) {
      $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
      //   \think\facade\Log::info($lineNumStr);
      \think\facade\Log::error("----------------errrrr2---------------------------");
      \think\facade\Log::error("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
      \think\facade\Log::error("errmsg:" . $exception->getMessage());
      \think\facade\Log::error("errtraceStr:" . $exception->getTraceAsString());
      var_dump($exception);

      // throw $exception; // for test
    }
    usleep(50 * 1000);
    //  break;
    // }
  }


}


if (!class_exists("mainx")) {


}

global $lottery_no;   // ="glb no";
static $lottery_no = "...";
$lottery_no = "...";




if (!function_exists("main_process")) {
}
