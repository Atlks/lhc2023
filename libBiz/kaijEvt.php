<?php




// jaijyo evt
//require  __DIR__ . "/../../lib/iniAutoload.php";
use function app\commonBjl\SendPicRzt;
use function libspc\log_err;

function kaij_draw_evt_bjl() {
  $GLOBALS['kaij_rzt']="";
  $draw_str = "console:" . $GLOBALS['qihao'] . "期开奖中..console";
  //  sendmessage841($draw_str);
  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  require_once __DIR__ . "/../app/common/lotrySscV2.php";

  global $lottery_no;
  //--------------get kaijnum  show kaij str

  try {
    $ltr = new \app\common\LotteryHashSsc();
//    $blkHash = getKaijRztBjl_retryX( $GLOBALS['qihao']);
//    var_dump($blkHash);
//    $text = "第" . $lottery_no . "期开奖结果" . "\r\n";
//
//    $kaij_num = getKaijNumFromBlkhash($blkHash);
//    $text = $text . betstrX__convert_kaij_echo_ex($kaij_num);// ();
//    $text = $text . PHP_EOL . "本期区块号码:" . $GLOBALS['kaijBlknum'] . "\r\n"
//      . "本期哈希值:\r\n" . $blkHash . "\r\n";
//    //  sendmessage841($text);
//    //  $text .= $this->result . "\r\n";
//    $text = "开奖结果" . "\r\n";

    //  sendMsgEx($GLOBALS['chat_id'], $text);
  } catch (\Throwable $e) {
    var_dump($e);
  }


  $gmLgcSSc = new   \app\common\GameLogicSsc();  //comm/gamelogc
  // $gl->lottery_no = $lottery_no;

  //--------------------show kaj rzt
  try {
    $lottery_no=$GLOBALS['qihao'];
    $data['hash_no'] = $lottery_no;
    $data['lottery_no'] = $lottery_no;
    $gmLgcSSc->lottery->setData($data);
    $gmLgcSSc->hash_no = $lottery_no;
    $gmLgcSSc->lottery_no = $lottery_no;


    //gene  betRztlist
    $echoTxt = $gmLgcSSc->DrawLotteryBjl($GLOBALS['qihao']);    // if finish chg stat to next..
    // bot_sendMsgTxtModeEx($echoTxt, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);




  } catch (\Throwable $e) {
    log_err($e, __METHOD__);
  }

//------------------ gene pic rzt
  //  开奖结果图 与走势图
  SendPicRzt($GLOBALS['qihao'],$GLOBALS['kaij_rzt']);

  //---中奖结果图发送
  $cfile = new \CURLFile(__DIR__ . "/../public/betRztlist.jpg");
  $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
  $bot->sendPhoto($GLOBALS['chat_id'], $cfile);

  \think\facade\Db::close();
  $show_str = "console:" . $lottery_no . "期开奖完毕==开始下注 \r\n";
  //  sendmessage841($show_str);
  // $gl->DrawLottery();
}


// 开奖
function getKaijRztBjl_retryX($qihao) {



    \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
    var_dump($qihao);
    $log_txt = __METHOD__ . json_encode(func_get_args());

    \think\facade\Log::info($log_txt);
    while (true) {
      try {
        require_once "startEvt.php";
        $kaipanInfo = getKaijRztBjl($qihao);

        return $kaipanInfo;
      } catch (\Throwable $e) {
        $exception = $e;
        $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        \think\facade\Log::error("----------------errrrr3---------------------------");
        \think\facade\Log::error("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
        \think\facade\Log::error("errmsg:" . $exception->getMessage());
        \think\facade\Log::error("errtraceStr:" . $exception->getTraceAsString());
        // var_dump($e);
      }

      sleep(1);
    }




}


function getKaijRztBjl($gameNo)
{

  require_once "startEvt.php";
 $json= kaipanInfoCore();




  $seltedRow = [];
//  array_filter($json['data'],  function ($row) use ($gameNo,$seltedRow) {
//
//    if ($row['gameNo']==$gameNo)
//    {
//      $seltedRow[]=$row;
//      return true;
//    }
//    //  return true;
//
//   // return  false;
//
//
//  });


  foreach ($json['data'] as $k => $row) {
    if ($row['gameNo']==$gameNo)
    {
      $seltedRow[]=$row;
      break;
    }
  }



  file_put_contents("d635.json",json_encode($seltedRow));


  $rzt=$seltedRow[0]['gameRecord'];
  $a=explode("$",$rzt) ;

  if($a[0]==1)
       $win = "庄赢";

  if($a[0]==2)
    $win = "和";


  if($a[0]==3)
    $win = "闲赢";

  return $win;

//  lewis, [08/12/2023 2:27 pm]
//A$B 表示一个露珠，A:1 庄 2和 3闲 4 龙 5 龙虎的和 6 虎
// B:0无对 1 庄对 2 闲对 3 庄闲对
//
//lewis, [08/12/2023 2:28 pm]
//比如这个3$0 就是 闲，0表示无对子

//  if ($seltedRow['playerCount'] == $seltedRow['bankerCount']) {
//    $win = "和";
//  }
//
//  if ($seltedRow['playerCount'] >$seltedRow['bankerCount']) {
//    $win = "庄赢";
//
//  } else {
//    $win = "闲赢";
//  }
//  return $win;
}
