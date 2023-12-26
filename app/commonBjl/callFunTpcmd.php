<?php


use app\model\LotteryLog;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\model\Setting;
use think\view\driver\Php;
use function libspc\log_err;


class callFunTpcmd extends Command {
  protected function configure() {
  }


  protected function execute(Input $input, Output $output) {
        $GLOBALS['fun2023']($GLOBALS['args2023']);
  }


}

