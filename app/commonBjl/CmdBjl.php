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

//   C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\modyfing\jbbot\think swoole2
global $BOT_TOKEN;

global $chat_id;
//$bot_token = "6426986117:AAFb3woph_1zOWFS5cO98XIFUPcj6GqvmXc";  //sscNohk
//$chat_id = -1001903259578;
//php think cmdBjlx


class CmdBjl extends Command {
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


function fenpan_betrLst_test() {
  global $lottery_no;
  $lottery_no = "158283";
  fenpan_betrLst();

}

function main_processBjl() {

//        fenpan_betrLst_test();
//      die();
//  imagefilledrectangle — 绘制矩形并填充


  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));

//  SendPicRzt( 11);
//  die();

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
  require_once __DIR__."/../../libBiz/startEvt.php";
  startBetEvtBjl();
  // $GLOBALS['kaijtime']
  // touzhu ,60then  warning  ,30 then stop  ,,30then kaij
  list($alltimeCycle, $bet_time_sec_ramain_adjust) = getBettimeRemain();   // $bet_time:105000     105s   1分40s

  //todo 这里chekAgain 可以合并到getBettimeRemain
  sleep($bet_time_sec_ramain_adjust);

  //------------------------warning bet time
  fenpan_wanrning_event();

  $waring_time_sec_remain = getWarningBetTimeRemain();

  sleep($waring_time_sec_remain);

  //-----------------------------封盘时间 stop evet
  fenpan_stop_event();
  $delay_to_statrt_Kaijyo_sec = $stop_remain_time_sec = getStopRemaintime();
  // $delay_to_statrt_Kaijyo_sec=chkRemainTime($delay_to_statrt_Kaijyo_sec);
  sleep($delay_to_statrt_Kaijyo_sec);
  //---------------------开奖流程
  require_once __DIR__."/../../libBiz/kaijEvt.php";
  kaij_draw_evt_bjl();
}


//Not suit for stop evet
function chkRemainTime_forBet(mixed $bet_time_sec_ramain_adjust) {
  if ($GLOBALS['countdownSeconds'] < 5)
    return 0;
  else return $bet_time_sec_ramain_adjust;


}

function getStopRemaintime() {


  global $lottery_no;
  $stop_bet_time = Setting::find(8)->value; //10*1000;
  $stop_bet_time_sec = $stop_bet_time / 1000;    //  20s


  $remainTime = $stop_bet_time_sec;

  $remainTime_adjst = $remainTime > 0 ? $remainTime : 0;

  return $remainTime_adjst;


}

/**
 * @return array
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\DbException
 * @throws \think\db\exception\ModelNotFoundException
 */
function getBettimeRemain(): array {
//  $bet_time = Setting::find(6)->value; //1*60*1000;
//  $bet_time_sec = $bet_time / 1000;
//


  $waring_time = Setting::find(7)->value; //30*1000;
  $waring_time_sec = $waring_time / 1000;


  $countdown_time_sec = $GLOBALS['countdownSeconds'];// if countdown_time_sec120s,so the bettime60s
  //if countdown_time_sec 100s,so bettime 60-(120-countdown_time_sec)

  $bet_time_sec_ramain = $countdown_time_sec - $waring_time_sec;

  if ($bet_time_sec_ramain > 0)
    $GLOBALS['cntdown_pass'] = false;
  else
    $GLOBALS['cntdown_pass'] = true;

  $bet_time_sec_ramain_adjust = $bet_time_sec_ramain > 0 ? $bet_time_sec_ramain : 0;

  $bet_time_sec_ramain_adjust = chkRemainTime_forBet($bet_time_sec_ramain_adjust);


  //  $bet_time_sec = 10;
  var_dump(' $bet_time_sec:' . $bet_time_sec_ramain_adjust);

  return array(120, $bet_time_sec_ramain_adjust);
}

function getWarningBetTimeRemain() {


  //if cnt down not pass,use db delay
  if ($GLOBALS['cntdown_pass'] == false) {
    $waring_time = Setting::find(7)->value; //30*1000;
    $waring_time_sec = $waring_time / 1000;
    return $waring_time_sec;
  }


  $countdown_time_sec = $GLOBALS['countdownSeconds'];// if countdown_time_sec120s,so the bettime60s

  $bet_time_sec_ramain = $countdown_time_sec;


  $bet_time_sec_ramain_adjust = $bet_time_sec_ramain > 0 ? $bet_time_sec_ramain : 0;
  $waring_time_sec_remain = chkRemainTime_forBet($bet_time_sec_ramain_adjust);
  return $bet_time_sec_ramain_adjust;


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
  $text = $words;

  echo $text . PHP_EOL;
  bot_sendMsgTxtMode($text, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);
  //  $bot->sendmessage($chat_id, $text);
}


function fenpan_stop_event() {
  dsl__execSql_tp(function () {
    $set = Setting::find(3);
    $set->value = 1;
    $set->save();
  });


  global $lottery_no;

  $stop_bet_time = Setting::find(8)->value; //10*1000;
  $stop_bet_time_sec = $stop_bet_time / 1000;    //  20s
  //  $stop_bet_time_sec = 3;
  // 1133期停止下注==20秒后开奖
  $stop_bet_str = "console:" . $lottery_no . "期停止下注==" . $stop_bet_time / 1000 . "秒后开奖\n";
  // sendmessage841($stop_bet_str);
  var_dump(' $stop_bet_time_sec:' . $stop_bet_time_sec);


  //-----------------停止下注提示
  try {
    \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
    $bot_words = \app\model\BotWords::where('Id', 1)->find();
    $words = $bot_words->StopBet_Notice;
    $text = $words;
    echo $text . PHP_EOL;
    sendmessageBotNConsole($text);
  } catch (\Throwable $e) {
  }

  fenpan_betrLst();

  // bot_sendMsg($msg, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);
  // sendmessageBotNConsole($text);



  $set = Setting::find(3);
  $set->value = 1;
  $set->save();
  \think\facade\Db::close();
}

function fenpan_betrLst() {

  require_once __DIR__ . "/../../lib/painLib.php";
  delFile(__DIR__ . "/../../res/betlist.jpg");

  global $lottery_no;
  try {
    $records = \app\common\Logs::getBetRecordByLotteryNoGrpbyU_BJL($lottery_no);
    $text = "--------本期下注玩家---------" . "\r\n";
    \think\facade\Log::info($text);


    // 图片高度（标题高度 + 每行高度 + 每行内边距）
    $css_lineHight = 40;
    $canvas_height = $css_lineHight * (count($records) + 2) + 9;
    $font_size = 20;
    $font = __DIR__ . "/../../public/msyhbd.ttc";
    $posX = 0;
    $posY = 0;
    $css_datawidth = 120;
    $firstColWidth = 350;

    # 开始画图
    // 创建画布
    $img_elmt = array("element" => "canvas", "bkgrd" => "white", "width" =>  $firstColWidth+$css_datawidth*6, "height" => $canvas_height);

    $img = renderElementCanvas($img_elmt);


    //imageline($img, 0, 3, 500, 3, $red_color);




    //--------------------title
    //百家乐
    $row327 = array("left" => 0,'bkgrd'=>'gray', "padBtm" => 3, "top" => 0, 'font' => $font, 'font_size' => $font_size, 'height' => $css_lineHight + 3);
    $cell1 = array('txt' => "百家乐NO.".$GLOBALS['qihao'],'id' => 'cell1', 'align' => 'left', 'padLeft' => 10,  'bkgrd' => "red", 'width' => $firstColWidth, 'height' => $css_lineHight);
    $cell_bank = array('txt' => '庄', 'align' => 'center', 'color' => "red", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
    $cell_plyr = array('txt' => '闲', 'color' => "blue", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
    $cell_bankDui = array('txt' => '庄对', 'color' => "red", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
    $cell_plyrDui = array('txt' => '闲对', 'color' => "blue", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);

    $cell_he = array('txt' => '和', 'color' => "green", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
    $cell_luck = array('txt' => '幸运6', 'color' => "pink", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);

    $row327["childs"] = [$cell1, $cell_bank, $cell_plyr, $cell_bankDui, $cell_plyrDui, $cell_he, $cell_luck];

    renderElementRow($row327, $img);
    $posY = $posY + $row327['height'];
    //----------show row


    $posY = $css_lineHight;
    $posX = 0;
    $sum = 0;
    $arr = [];
    foreach ($records as $k => $v) {

      try {
        $row114 = [];
        $uid=$v['UserId'];$bettype=$v['betNoAmt'];
        $row114['庄'] = getBankAmtV2($lottery_no,$uid,'庄');
        $row114['闲'] = getBankAmtV2($lottery_no,$uid,'闲');
        $row114['庄对'] = getBankAmtV2($lottery_no,$uid,'庄对');

        $row114['闲对'] = getBankAmtV2($lottery_no,$uid,'闲对');


        $row114['和'] =  getBankAmtV2($lottery_no,$uid,'和');


        $row114['幸运6'] = getBankAmtV2($lottery_no,$uid,'幸运');


        $arr[] = $row114;

        // array_push($bet_lst_echo_arr,  \echox\getBetContxEcHo($value['text']));

//        $echo = betstrx__format_echo_ex($v['betNoAmt'] . "99");
//        $bet = explode(" ", $echo);
        $money = $v['Bet'] / 100;
      //  $betNmoney = $bet[0] . " " . +$money;
        //  \betstr\format_echo_ex();
       // $text = $text . $v['UserName'] . "【" . $v['UserId'] . "】" . $betNmoney . "\r\n";
        $sum += $v['Bet'];


        $row140 = array('elmtType' => 'tr', "padBtm" => 3, 'font' => $font, 'font_size' => $font_size, "left" => 0, "top" => $posY, 'font_size' => $font_size, 'height' => $css_lineHight + 3);

        $cell1 = array('id' => 'cell1', 'txt' => $v['UserName'], 'align' => 'left', 'padLeft' => 10, 'bkgrd' => "", 'width' => $firstColWidth, 'height' => $css_lineHight);
        $cell_bank = array('txt' => $row114['庄'], 'color' => "red", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
        $cell_plyr = array('txt' => $row114['闲'], 'color' => "blue", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
        $cell_bankDui = array('txt' => $row114['庄对'], 'color' => "red", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
        $cell_plyrDui = array('txt' => $row114['闲对'], 'color' => "blue", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);

        $cell_he = array('txt' => $row114['和'], 'color' => "green", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
        $cell_luck = array('txt' => $row114['幸运6'], 'color' => "pink", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);

        $row140['childs'] = [$cell1, $cell_bank, $cell_plyr, $cell_bankDui, $cell_plyrDui, $cell_he, $cell_luck];


        //----------show row
        renderElementRow($row140, $img);
        $posY = $posY + $row140['height'];

        //title baes line
        $line_posY = $posY + 5;
        //  appendElemt(array("top"=>$posY,"color" => "black", "elmtType" => "line"), $row140, $img);
        //  imageline($img, 0, $line_posY, $img_width, $line_posY, $red_color);


      } catch (\Throwable $e) {
        var_dump($e);
      }


    }

   // $line_posY = $posY + 5 + $css_lineHight;
    //   imageline($img, 0, $line_posY, $img_width, $line_posY, $red_color);
  //  renderElmtLine(array("top" => $posY, "color" => "black", "elmtType" => "line"), $img);


    echo $text . PHP_EOL;
    $msg = $text;

    \think\facade\Log::info($msg);

     //-----------------bottom
    $row = array('elmtType' => 'tr','bkgrd'=>'red', 'font_size' => $font_size, 'font' => $font, "left" => 0, "top" => $posY, 'height' => $css_lineHight);

    $row['childs'] = [
      array('txt' => '总计' . count($arr) . '人', 'align' => 'center', 'height' => $css_lineHight, 'bkgrd' => "", 'width' => $firstColWidth),
      array('txt' => array_sum_col('庄', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col('闲', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col('庄对', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col('闲对', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col('和', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col('幸运', $arr), 'bkgrd' => "", 'width' => $css_datawidth)

    ];

    renderElementRow($row, $img);
    // $posY = $posY + $row['height'];

    imagepng($img, __DIR__ . "/../../res/betlist.jpg");
    sendMsgEx($GLOBALS['chat_id'], $msg);


    //------------send pic
    // 生成图片
    $cfile = new \CURLFile(__DIR__ . "/../../res/betlist.jpg");
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);

  } catch (\Throwable $e) {
    var_dump($e);
  }
}

function getBankAmtV2(string $lottery_no, $uid, $bettype) {

  $rows =  \think\facade\Db::name('bet_record')
    ->where('lotteryno', '=', $lottery_no)
    ->where('userid', '=', $uid)
    ->where('betNoAmt', '=', $bettype)
    ->group('userid,username')
    ->field('userid,username,sum(Bet) as sumbet')
    ->select();
  if(count($rows)>0)
     return $rows[0]['sumbet']/100;
  else
    return  0;
}


/**
 * send kaij rzt pic n trend pic
 * @param GameLogicSsc $gmLgcSSc
 * @return void
 * @throws \TelegramBot\Api\Exception
 * @throws \TelegramBot\Api\InvalidArgumentException
 */
function SendPicRzt($qihao,$rzt): void {


  require_once __DIR__ . "/../../libBiz/bjl.php";

 //$rzt= getKaijRztBjl($qihao);
  try {
  //  $gmLgcSSc->SendTrendImage(20); // 生成图片
    $cfile = new \CURLFile(app()->getRootPath() . "res/rzt_".$rzt.".jpg");
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
  } catch (\Throwable $e) {
    var_dump($e);

  }


  try {
    require_once __DIR__ . "/../../libTpscrt/kaij.php";
    \createTrendImageV2(1);
    $f549 = __DIR__ . "/../../public/trend.jpg";
  //  $f549 = app()->getRootPath() . "public/trend.jpg";
    var_dump($f549);
    $cfile = new \CURLFile($f549);
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
  } catch (\Throwable $e) {
    var_dump($e);

  }


}

function sendMsgEx(mixed $chat_id, string $text) {
  try {
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendmessage($GLOBALS['chat_id'], $text);
  } catch (\Throwable $e) {
    try {
      $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
      $bot->sendmessage($GLOBALS['chat_id'], $text);
    } catch (\Throwable $e) {
      try {
        $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
        $bot->sendmessage($GLOBALS['chat_id'], $text);
      } catch (\Throwable $e) {
        log_err($e, __METHOD__);
      }
    }

  }

}


if (!function_exists("main_process")) {
}
