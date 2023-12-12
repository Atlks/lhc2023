<?php

//Not suit for stop evet
use app\model\Setting;

function chkRemainTime_forBet(mixed $bet_time_sec_ramain_adjust) {
  if ($GLOBALS['countdownSeconds'] < 5)
    return 0;
  else return $bet_time_sec_ramain_adjust;


}



/**
 * @return array
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\DbException
 * @throws \think\db\exception\ModelNotFoundException
 */
function getBettimeRemain() {
//  $bet_time = Setting::find(6)->value; //1*60*1000;
//  $bet_time_sec = $bet_time / 1000;
//


  $waring_time = Setting::find(7)->value; //30*1000;
  $waring_time_sec = $waring_time / 1000;


  $countdown_time_sec = $GLOBALS['countdownSeconds'];// if countdown_time_sec120s,so the bettime60s
  //if countdown_time_sec 100s,so bettime 60-(120-countdown_time_sec)

  $bet_time_sec_ramain = $countdown_time_sec - $waring_time_sec;


  $bet_time_sec_ramain_adjust = $bet_time_sec_ramain > 0 ? $bet_time_sec_ramain : 0;

  $bet_time_sec_ramain_adjust = \chkRemainTime_forBet($bet_time_sec_ramain_adjust);


  //  $bet_time_sec = 10;
  var_dump(' $bet_time_sec:' . $bet_time_sec_ramain_adjust);

  return $bet_time_sec_ramain_adjust;
}

function getWarningBetTimeRemain() {


  //if cnt down not pass,use db delay

  $waring_time = Setting::find(7)->value; //30*1000;
  $waring_time_sec = $waring_time / 1000;


//alread bet some sec,then here warn bet timer
  if ($GLOBALS['countdownSeconds'] >= $waring_time_sec)
    return $waring_time_sec;


  //if cntdown sec too mini ,,,last time watit is 0..so onloy cntdown time is ok
  if ($GLOBALS['countdownSeconds'] < $waring_time_sec) {
    $waring_time_sec_remain = chkRemainTime_forBet($GLOBALS['countdownSeconds']);
    return $waring_time_sec_remain;
  }
  // return $GLOBALS['countdownSeconds'];


}


function fenpan_wanrning_event() {

  $waring_time = Setting::find(7)->value; //30*1000;
  $waring_time_sec = $waring_time / 1000;


  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  $bot_words = \app\model\BotWords::where('Id', 1)->find();
  // $waring_time_sec = 5;
  // 1133期还有50秒停止下注
  global $lottery_no;
  $waring_str = "console:" . $lottery_no . "期还有" . $waring_time_sec . "秒停止下注\r\n";
  // sendmessage841($waring_str);
  var_dump(' $waring_time_sec:' . $waring_time_sec);  ///   $waring_time_sec:50
  $words = $bot_words->StopBet_Waring;
  $text = file_get_contents(__DIR__ . "/../db/warn.txt");

  echo $text . PHP_EOL;
  bot_sendMsgTxtMode($text, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);
  //  $bot->sendmessage($chat_id, $text);
}
