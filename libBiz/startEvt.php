<?php


use app\model\LotteryLog;
use app\model\Setting;

function startBetEvtBjl() {
  //// 更新状态开放投注  must close here lst for open b cs secury
  $set = Setting::find(3);
  $set->value = 1;   //1 just close bet
  $set->save();
  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  //-------------------- start bet

  global $lottery_no;

  $qiohao_data =kaipanInfo();
  var_dump($qiohao_data['data'][0]);
  $lottery_no = $qiohao_data['lottery_no'];
  $GLOBALS['qihao'] =$lottery_no;
if($GLOBALS['qihao']=="")
{
  echo "!!! qihao is empty. startBetEvtBjl()L23";
  return;
}

  //$lottery_no="19005195";

  $addTmstmpSec=strtotime($qiohao_data['data'][0]['addTime']);
  $now=time();
  $endTmstmp=$addTmstmpSec+$qiohao_data['data'][0]['countdownSeconds'];
  $GLOBALS['countdownSeconds'] =$endTmstmp-$now;

//  $kaijtime = $qiohao_data ['closetime'];
//  //   touzhu time 90s,, fenpe30s
//  $GLOBALS['kaijtime'] = $kaijtime;


  $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
  //   \think\facade\Log::info($lineNumStr);
  \think\facade\Log::info(" get_current_noV2: " . $lottery_no);


  $today = date("Y-m-d", time());
  $GLOBALS['kaijBlknum']="";
  //准确性保障 添加unqidx must。。。  ALTER TABLE `jbdb`.`lottery_log`   //ADD UNIQUE INDEX `no_unq`(`No`);
  $log = \app\common\Logs::addLotteryLog($today, $lottery_no, $GLOBALS['kaijBlknum']);
//  $log = LotteryLog::create(array(
//
//    'No' => $lottery_no,
//    'Hash' => $GLOBALS['kaijBlknum'],
//  ));


  //var_dump($log);
  $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
  //   \think\facade\Log::info($lineNumStr);
  \think\facade\Log::info("add new lotry qihao " . $lineNumStr);
  \think\facade\Log::info(json_encode($log));

  //--------------------start bet


  $text = file_get_contents(__DIR__ . "/../db/startInfo.txt");
  echo $text . PHP_EOL;
  $text = str_replace("(", "\(", $text);
  $text = str_replace(")", "\)", $text);
  $text = str_replace("-", "\-", $text);

  $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
  $cfile = new \CURLFile(app()->getRootPath() . "res/bet_tips.jpg");
  $bot->sendPhoto($GLOBALS['chat_id'], $cfile, $text, null, null, null, false, "MarkdownV2");
  //    $bot->sendMessage(chatid,txt,parsemode,replyMsgID)
  //// 更新状态开放投注
  $set = Setting::find(3);
  $set->value = 0;
  $set->save();
  \think\facade\Db::close();
}

function kaipanInfo()  {

  while(true)
  {
   // try{
      $json=kaipanInfoCore();
      //if have rzt,already finish...next try
    //if  gameRecord is empty,,now new ju
    // if gamerec hav val,,last ju..
      if($json['data'][0]['gameRecord'] && $json['data'][0]['gameRecord']!="")
      {
        //have val .last ju..

       // if($json['data'][0]['gameRecord']="")
        echo " !!!  kaipanInfoL106 gameRecord no has new ju..contyine retry\r\n";
        var_dump($json['data'][0]);

        sleep(2);
        continue;
      }

      else
      {//  no rezt,,new ju
        return $json;
      }

//    }catch(\Exception $e)
//    {
//       var_dump($e);
//    }

    sleep(2);
  }


}

/**
 * @return mixed
 */
function kaipanInfoCore() {
  require_once __DIR__ . "/../cfg.php";
  if ($GLOBALS['kaijSrcUseLocal']) {
    $f = __DIR__ . "/../dbKaijSrc/kaijsrc.json";
    require_once __DIR__ . "/../lib/file.php";
    $json = file_get_contents_Asjson($f);

    $json['lottery_no'] = $json['data'][0]['gameNo'];
    $GLOBALS['qihao'] = $json['lottery_no'];
    return $json;
  }

  require_once __DIR__."/../lib/http.php";
  $t = http_post("http://34.150.68.52:8080/user/login/submit", "userName=test04&password=aaa111");
  $json = json_decode($t, true);
  $token = $json['data']['userInfo']['token'];
  $url = "http://34.150.68.52:8080/api/baccarat/gameinfo";
  // $tok="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb2RlIjoidGVzdDA0IiwiYWRtaW5JZCI6MTk0MCwiZXhwIjoxNzAyMDMwMjU0fQ.tYHmlQQtnCiPzOOBBDjtzKjRmG0fWN6JjhWULfiDk-8";

  $t = http_post($url, "tableNo=8&token=" . $token);
  $json = json_decode($t, true);
  $json['lottery_no'] = $json['data'][0]['gameNo'];
  $GLOBALS['qihao'] = $json['lottery_no'];
  return $json;
  //ref ft cur dsk.json
}