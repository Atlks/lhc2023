<?php


use app\model\Setting;
use function app\commonBjl\fenpan_stop_event;
use function app\commonBjl\fenpan_wanrning_event;
use function app\commonBjl\getBettimeRemain;
use function app\commonBjl\getStopRemaintime;
use function app\commonBjl\getWarningBetTimeRemain;

function main_processBjl() {

  $GLOBALS['qihao']="";


  require_once "startEvt.php";
  require_once "betEvt.php";
  require_once "fenpanEvt.php";
  require_once "kaijEvt.php";
  global $lottery_no;
  $lottery_no = 111;
  // var_dump(  $lottery_no);die();
  global $bot_token;
  var_dump($bot_token);
  var_dump($GLOBALS['bot_token']);
  //var_dump(BOT_TOKEN);
  $set = Setting::find(1);
  $GLOBALS['BOT_TOKEN'] = $set->s_value;
  $GLOBALS['chat_id'] = Setting::find(2)->value;

//  //  to head
//  $GLOBALS['BOT_TOKEN']="6959066432:AAH9OgIspApiYStnaNyznl7mcJ_qPjBA7Fg";
//  $GLOBALS['chat_id']=-4038077884;

  var_dump($GLOBALS['BOT_TOKEN']);
  var_dump($GLOBALS['chat_id']); //die();
  //  bot_sendMsg("----",BOT_TOKEN,chat_id);die();
  $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
  \think\facade\Log::info($lineNumStr);
  $bot_words = \app\model\BotWords::where('Id', 1)->find();
  global $lottery_no;
  // $lottery_no = 1133;
  echo "-------------------------开始投注----60s" . PHP_EOL;
  require_once __DIR__."/../libBiz/startEvt.php";
  startBetEvtBjl();
  // $GLOBALS['kaijtime']
  // touzhu ,60then  warning  ,30 then stop  ,,30then kaij
  $bet_time_sec_ramain_adjust= \getBettimeRemain();   // $bet_time:105000     105s   1分40s

  //todo 这里chekAgain 可以合并到getBettimeRemain
  sleep($bet_time_sec_ramain_adjust);

  //------------------------warning bet time
  \fenpan_wanrning_event();

  $waring_time_sec_remain = \getWarningBetTimeRemain();

  sleep($waring_time_sec_remain);

  //-----------------------------封盘时间 stop evet
  \fenpan_stop_event();
  $delay_to_statrt_Kaijyo_sec = $stop_remain_time_sec = \getStopRemaintime();
  // $delay_to_statrt_Kaijyo_sec=chkRemainTime($delay_to_statrt_Kaijyo_sec);
  sleep($delay_to_statrt_Kaijyo_sec);
  //---------------------开奖流程
  require_once __DIR__."/../libBiz/kaijEvt.php";
  kaij_draw_evt_bjl();
}
