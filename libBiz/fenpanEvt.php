<?php


use app\model\Setting;


use function libspc\log_err;


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
  $outputPic = __DIR__ . "/../public/betlist.jpg";
  require_once __DIR__ . "/../lib/painLib.php";
  delFile($outputPic);

  global $lottery_no;
  try {
    $records = \app\common\Logs::getBetRecordByLotteryNoGrpbyU_BJL($lottery_no);
    $text = "--------本期下注玩家---------" . "\r\n";
    \think\facade\Log::info($text);


    // 图片高度（标题高度 + 每行高度 + 每行内边距）
    $css_lineHight = 40;
    $canvas_height = $css_lineHight * (count($records) + 2) + 9;
    $font_size = 20;
    $font = __DIR__ . "/../public/msyhbd.ttc";
    $posX = 0;
    $posY = 0;
    $css_datawidth = 120;
    $firstColWidth = 350;

    # 开始画图
    // 创建画布
    $img_elmt = array("element" => "canvas", "bkgrd" => "white", "width" => $firstColWidth + $css_datawidth * 6, "height" => $canvas_height);

    $img = renderElementCanvas($img_elmt);


    //imageline($img, 0, 3, 500, 3, $red_color);


    //--------------------title
    //百家乐
    $row327 = array("left" => 0, 'bkgrd' => 'gray', "padBtm" => 3, "top" => 0, 'font' => $font, 'font_size' => $font_size, 'height' => $css_lineHight + 3);
    $cell1 = array('txt' => "百家乐NO." . $GLOBALS['qihao'], 'id' => 'cell1', 'align' => 'left', 'padLeft' => 10, 'bkgrd' => "red", 'width' => $firstColWidth, 'height' => $css_lineHight);
    $cell_bank = array('txt' => '庄', 'tag' => 'th', 'align' => 'center', 'color' => "red", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
    $cell_plyr = array('txt' => '闲', 'tag' => 'th', 'color' => "blue", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
    $cell_bankDui = array('txt' => '庄对', 'tag' => 'th', 'color' => "red", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
    $cell_plyrDui = array('txt' => '闲对', 'tag' => 'th', 'color' => "blue", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);

    $cell_he = array('txt' => '和', 'tag' => 'th', 'color' => "green", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
    $cell_luck = array('txt' => '幸运6', 'tag' => 'th', 'color' => "pink", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);

    $row327["childs"] = [$cell1, $cell_bank, $cell_plyr, $cell_bankDui, $cell_plyrDui, $cell_he, $cell_luck];

    renderElementRowV2($row327, $img, $outputPic);
    $posY = $posY + $row327['height'];
    //----------show row


    $posY = $css_lineHight;
    $posX = 0;
    $sum = 0;
    $arr = [];
    foreach ($records as $k => $v) {

      try {
        $row114 = [];
        $uid = $v['UserId'];
        $bettype = $v['betNoAmt'];
        $row114['庄'] = getBankAmtV2($lottery_no, $uid, '庄');
        $row114['闲'] = getBankAmtV2($lottery_no, $uid, '闲');
        $row114['庄对'] = getBankAmtV2($lottery_no, $uid, '庄对');

        $row114['闲对'] = getBankAmtV2($lottery_no, $uid, '闲对');


        $row114['和'] = getBankAmtV2($lottery_no, $uid, '和');


        $row114['幸运6'] = getBankAmtV2($lottery_no, $uid, '幸运');


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
        renderElementRowV2($row140, $img, $outputPic);
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
    $row = array('elmtType' => 'tr', 'bkgrd' => 'red', 'font_size' => $font_size, 'font' => $font, "left" => 0, "top" => $posY, 'height' => $css_lineHight);

    $row['childs'] = [
      array('txt' => '总计' . count($arr) . '人', 'align' => 'center', 'height' => $css_lineHight, 'bkgrd' => "", 'width' => $firstColWidth),
      array('txt' => array_sum_col_inpainlib('庄', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col_inpainlib('闲', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col_inpainlib('庄对', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col_inpainlib('闲对', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col_inpainlib('和', $arr), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col_inpainlib('幸运', $arr), 'bkgrd' => "", 'width' => $css_datawidth)

    ];

    renderElementRowV2($row, $img, $outputPic);
    // $posY = $posY + $row['height'];

    imagepng($img, $outputPic);
    sendMsgExV1009($GLOBALS['chat_id'], $msg);


    //------------send pic
    // 生成图片
    $cfile = new \CURLFile($outputPic);
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);

  } catch (\Throwable $e) {
    var_dump($e);
  }
}


function sendMsgExV1009(mixed $chat_id, string $text) {
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


function getBankAmtV2(string $lottery_no, $uid, $bettype) {

  $rows = \think\facade\Db::name('bet_record')
    ->where('lotteryno', '=', $lottery_no)
    ->where('userid', '=', $uid)
    ->where('betNoAmt', '=', $bettype)
    ->group('userid,username')
    ->field('userid,username,sum(Bet) as sumbet')
    ->select();
  if (count($rows) > 0)
    return $rows[0]['sumbet'] / 100;
  else
    return 0;
}


function fenpan_betrLst_test() {
  global $lottery_no;
  $lottery_no = "158283";
  fenpan_betrLst();

}

function getStopRemaintime() {


  global $lottery_no;
  $stop_bet_time = Setting::find(8)->value; //10*1000;
  $stop_bet_time_sec = $stop_bet_time / 1000;    //  20s


  $remainTime = $stop_bet_time_sec;

  $remainTime_adjst = $remainTime > 0 ? $remainTime : 0;

  return $remainTime_adjst;


}