<?php


// jaijyo evt
//require  __DIR__ . "/../../lib/iniAutoload.php";
use function app\commonBjl\SendPicRzt;
use function libspc\log_err;

function _main_kaij_draw_evt_bjl() {
  $GLOBALS['kaij_rzt'] = "";
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

  //--------------------show kaj rzt ,here onlyu gene kaij rzt pic
  try {
    $lottery_no = $GLOBALS['qihao'];
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

  //-------send kaij video
  kaijRzt_sendKaijVideo();


//------------------ gene pic rzt
  //  开奖结果图  zhuangyin syeyin
  kaijRzt_SendPic_kaijRztV2($GLOBALS['qihao'], $GLOBALS['kaij_rzt']);

  // 与走势图
  try {
    trendPic_sendTrendPic();
  } catch (\Throwable $e) {
    var_dump("L116");
    var_dump($e);

  }



  try {
    //---中奖结果图发送  betRztlist
    $cfile = new \CURLFile(__DIR__ . "/../public/betRztlist.jpg");
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
  } catch (\Throwable $e) {
    var_dump("L116");
    var_dump($e);
    log_err($e,__METHOD__);

  }


  \think\facade\Db::close();
 // $show_str = "console:" . $lottery_no . "期开奖完毕==开始下注 \r\n";
  //  sendmessage841($show_str);
  // $gl->DrawLottery();
}

/**
 * @return array
 */
function kaijRzt_sendKaijVideo() {
  try {
    $startTime = date("Y-m-d H:i:s", strtotime("-20 seconds"));
    //$GLOBALS['addTime'];
    $endTime = date("Y-m-d H:i:s");
    $vddir = __DIR__ . "/../vd";
    require_once __DIR__ . "/../lib/vd_kaij.php";
    // $outf = (kaijVd($startTime, $endTime, $vddir));
    mkdirv2(__DIR__ . "/../down/");

    $endTime = urlencode($endTime);
    $sec = 20;
    $url = "http://46.137.239.204/api.php?call=kaijVd_outputFile%20$sec,$endTime";
    require_once __DIR__ . "/../lib/down.php";

    $outf = __DIR__ . "/../down/" . date("md_His") . "_" . rand() . ".mp4";
    var_dump($outf);
    $outf = downld($url, $outf);
    require_once __DIR__ . "/../lib/tlgrmV2.php";
    sendVideoV2($GLOBALS['chat_id'], $outf);
  } catch (\Throwable $e) {
    log_err($e, __METHOD__);


  }

}


/**
 * send kaij rzt pic n trend pic
 * @param GameLogicSsc $gmLgcSSc
 * @return void
 * @throws \TelegramBot\Api\Exception
 * @throws \TelegramBot\Api\InvalidArgumentException
 */
function kaijRzt_SendPic_kaijRztV2($qihao, $rzt): void {


  require_once __DIR__ . "/../libBiz/z_bjl.php";

  //$rzt= getKaijRztBjl($qihao);
  try {
    // -----------------闲赢---生成图片
    $picPath = app()->getRootPath() . "res/rzt_" . $rzt[0] . ".jpg";
    $cfile = new \CURLFile($picPath);
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
  } catch (\Throwable $e) {
    var_dump($e);

  }


}

/**
 * @return void
 * @throws \TelegramBot\Api\Exception
 * @throws \TelegramBot\Api\InvalidArgumentException
 */
function trendPic_sendTrendPic(): void {
  require_once __DIR__ . "/../lib/logx.php";
  try {
    //  require_once __DIR__ . "/../../libTpscrt/kaij.php";
    require_once __DIR__ . "/../libBiz/a_startEvt.php";
    \trendpic_createTrendImageV2(\kaipanInfoCore());
    $f549 = __DIR__ . "/../public/trend.jpg";
    //  $f549 = app()->getRootPath() . "public/trend.jpg";
    var_dump($f549);
    $cfile = new \CURLFile($f549);
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
  } catch (\Exception $e) {

    log_err($e, __METHOD__);

  }

  try {
//---------------------------trend dalu
    $outf = __DIR__ . "/../public/trend_dalu.jpg";
    $cfile = new \CURLFile($outf);
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
  } catch (\Exception $e) {
    log_err($e, __METHOD__);
  }


//--------------scr sht
//  try {
//
//    $cmd = __DIR__ . "/../lib/nircmd.exe";
//    $outf = __DIR__ . "/../public/scrsht.png";
//    //  exec ( $cmd." savescreenshot ".$outf);
//    $urlimg = file_get_contents("http://46.137.239.204/scr");
//    file_put_contents($outf, $urlimg);
//    $cfile = new \CURLFile($outf);
//    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
//    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
//  } catch (\Exception $e) {
//    log_err($e, __METHOD__);
//  }
}


// 开奖
function getKaijRztBjl_blkMode($qihao) {


  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  var_dump("qihao:" . $qihao);
  $log_txt = __METHOD__ . json_encode(func_get_args());

  \think\facade\Log::info($log_txt);
  while (true) {
    try {
      //if long time no kaij rzt ,exit loop

      $shouldEndTimestmp = strtotime("+480 seconds", strtotime($GLOBALS['addTime']));
      $shdEndtime = date("Y-m-d H:i:s", $shouldEndTimestmp);
      if ($shdEndtime < date("Y-m-d H:i:s"))
        break;


      //end


      require_once "a_startEvt.php";
      $kaipanInfo = getKaijRztBjl($qihao);
      if ($kaipanInfo)
        return $kaipanInfo;
      else {
        sleep(1);
        continue;
      }


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


function getKaijRztBjl($gameNo) {

  require_once "a_startEvt.php";
  $json = kaipanInfoCore();


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
    if ($row['gameNo'] == $gameNo) {
      $seltedRow[] = $row;
      break;
    }
  }


  file_put_contents("d635.json", json_encode($seltedRow));


  $rzt = $seltedRow[0]['gameRecord'];

  // $rzt="";//模拟还没开奖，需要卡主
  if ($rzt == "") {
    $str = "!!! no kaij rzt now ,gameno:" . $gameNo;
    echo $str;
    logV3(__METHOD__, $str, "kaij");
    return null;
  }

  $a = explode("$", $rzt);
  $kaijARr = [];

  if ($a[0] == 1) {
    $kaijARr[] = "庄赢";
  }


  if ($a[0] == 2) {
    $kaijARr[] = "和";
  }


  if ($a[0] == 3)
    $kaijARr[] = "闲赢";  //闲赢


  if ($a[1] == 1) {
    $kaijARr[] = '庄对';

  }
  if ($a[1] == 2) {
    $kaijARr[] = "闲对";

  }
  if ($a[1] == 3) {
    $kaijARr[] = '庄对';
    $kaijARr[] = "闲对";
  }

  return $kaijARr;

//  lewis, [08/12/2023 2:27 pm]
//A$B 表示一个露珠，A:1 庄 2和 3闲 4 龙 5 龙虎的和 6 虎
// B:0无对 1 庄对 2 闲对 3 庄闲对
//
//lewis, [08/12/2023 2:28 pm]
//比如这个3$0 就是 闲，0表示无对子


}

require_once __DIR__ . "/../lib/arr.php";
function trendpic_createTrendImageV2($records) {

  var_dump(__METHOD__ . json_encode(func_get_args()));


//  $records = file_get_contents("C:\\0prj\\lhc2023\\test\\ft_curDsk.json");
//  $records = json_decode($records, true);



  $log_txt = __METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


  $font = __DIR__ . "/../public/msyhbd.ttc";
  $font_path = $font;
  var_dump($font_path);

  //echo $font;
  $font_title_size = 16;
  $font_size = 20;

  $pos_x = 0;
  $pos_y = 0;
  $int_num = 1;
  $withMain = 50;
  $css_lineHight = $withMain;
  $css_datawidth = $withMain;


//-------//meige paisywe zuida 60ge road map
  require_once __DIR__."/../lib/bjl_dalu_paint.php";
  $records = $records['data'];
  $records = array_reverse($records);
  if (noKaijRztInLastRec($records))
    array_pop($records);
  $records = array_slice($records, 0, 60);



  //------------------jupelu_pic_gene---------------
  try {
    jupelu_pic_gene($font, $font_size, $withMain, $records, $css_lineHight, $css_datawidth);

  } catch (Throwable $e) {
    log_err($e, __METHOD__);
  }




  //-------------syaselu  dalu pic gener
  try {
    DaluPicV2($records, $withMain, $css_lineHight);
  } catch (Throwable $e) {
    log_err($e, __METHOD__);
  }


}

/**
 * @param string $font
 * @param int $font_size
 * @param int $withMain
 * @param $records
 * @param int $css_lineHight
 * @param int $css_datawidth
 * @param int $pos_y
 * @return array
 */
function jupelu_pic_gene(string $font, int $font_size, int $withMain, $records, int $css_lineHight, int $css_datawidth): array {
//--------------------- 创建画布
  $img_height = 350;
  $img_width = 800;

  $img_elmt = array("element" => "canvas", "bkgrd" => "white", "width" => $img_width, "height" => $img_height);
  require_once __DIR__ . "/../lib/painLib.php";
  //\imagefilledellipseX()
  $img = renderElementCanvas($img_elmt);


  $outFile = __DIR__ . "/../public/trend.jpg";
  delFile($outFile);
  //----------------------百家乐 hd-----------
  $rowHead = array("th_row" => "true", "left" => 0, 'bkgrd' => 'black', "padBtm" => 0, "top" => 0, 'font' => $font, 'font_size' => $font_size, 'height' => $withMain);

  $bankWinCnt = TrendPic_getBkWinCnt($records, "1$");
  $plyerWinCnt = TrendPic_getBkWinCnt($records, "3$");
  $HeCnt = TrendPic_getBkWinCnt($records, "2$");
  $bkDwiCnt = trendPIc_getDzCnt($records, "$1");
  $plyrDwiCnt = trendPIc_getDzCnt($records, "$2");
  $bkgrdBallWidth = 40;
  // gameRecord
  $ballwd = 40;
  $rowHead["childs"] = [

    array('txt' => "庄", 'ballwidth' => $ballwd, 'color' => "white", 'shape' => 'ball', 'bkgrdBallWidth' => $bkgrdBallWidth, 'bkgrd' => "red", 'id' => 'cell1', 'align' => 'left', 'padLeft' => 10, 'width' => $withMain, 'height' => $css_lineHight),
    array('txt' => $bankWinCnt, 'color' => "red", 'bkgrd' => "", 'id' => 'cell1', 'align' => 'left', 'padLeft' => 10, 'width' => $withMain, 'height' => $css_lineHight),

    array('txt' => '闲', 'ballwidth' => $ballwd, 'shape' => 'ball', 'bkgrdBallWidth' => $bkgrdBallWidth, 'align' => 'center', 'color' => "white", 'bkgrd' => "blue", 'width' => $withMain, 'height' => $css_lineHight),
    array('txt' => $plyerWinCnt, 'align' => 'center', 'color' => "blue", 'bkgrd' => "", 'width' => $withMain, 'height' => $css_lineHight),

    array('txt' => '和', 'ballwidth' => $ballwd, 'shape' => 'ball', 'bkgrdBallWidth' => $bkgrdBallWidth, 'color' => "white", 'bkgrd' => "green", 'width' => $css_datawidth, 'height' => $css_lineHight),
    array('txt' => $HeCnt, 'color' => "green", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight),

    array('txt' => '对', 'ballwidth' => $ballwd, 'shape' => 'ball', 'color' => "white", 'bkgrd' => "red", 'width' => $css_datawidth, 'height' => $css_lineHight),
    array('txt' => $bkDwiCnt, 'color' => "red", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight),

    array('txt' => '对', 'ballwidth' => $ballwd, 'shape' => 'ball', 'bkgrdBallWidth' => $bkgrdBallWidth, 'color' => "white", 'bkgrd' => "blue", 'width' => $css_datawidth, 'height' => $css_lineHight),
    array('txt' => $plyrDwiCnt, 'color' => "blue", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight),


  ];

  require_once __DIR__ . "/../lib/painLib.php";
  renderElementRowV2($rowHead, $img, $outFile);
  // $pos_y = $pos_y + $row614['height'];
  //-----------end head


  $rowIdx = 0;
  $colIdx = 0;

  // $maxLen = count($records);
  //todo  列转行 算法：  arr_cut 每次，gene col,push arr,然后循环row num,。。
  //---------tag  row col idx
  $perColRowsCnt = 6;

  $colss = spltToCols($records, $perColRowsCnt);
  //--------render row each
  //max row 6
  $lastBlkElmt = $rowHead;
  for ($rowIdx = 0; $rowIdx < $perColRowsCnt; $rowIdx++) {
    // $row614['height']=$css_lineHight;
    $row615 = jupelu_getRow($rowIdx, $colss, $withMain);
    $row615['top'] = $lastBlkElmt['top'] + $lastBlkElmt['height'];
    $row615['height'] = $css_lineHight;
    $row615['font'] = $font;
    $row615['font_size'] = $font_size;
    renderElementRowV3($row615, $img, $outFile);
    //  imagepng($img, $outFile);
    $lastBlkElmt = $row615;

  }
  //end foreach row


  //-------------end--------------
  imagepng($img, __DIR__ . "/../public/trend.jpg");
  echo "";
  return $records;
}

///**
// * @param array $records
// * @param int $withMain
// * @param array $row615
// * @param int $css_lineHight
// * @param string $font
// * @param int $font_size
// * @param array $row614
// * @return void
// */
//function DaluPic(array $records, int $withMain,   int $css_lineHight ): void {
//  $font = __DIR__ . "/../public/msyhbd.ttc";
//  $font_path = $font;
//  var_dump($font_path);
//
//  //echo $font;
//  $font_title_size = 16;
//  $font_size = 20;
//
//  $img_elmt = array("element" => "canvas", "bkgrd" => "white", "width" => 40 * 50, "height" => 10 * 50);
//  require_once __DIR__ . "/../lib/painLib.php";
//  $img = renderElementCanvas($img_elmt);
//
//  $outf = __DIR__ . "/../public/trend_dalu.jpg";
//  $colss = spltToCols_dalu($records);
//
//  //--------render row each
//  $perColRowsCnt = 15;
//  $lastBlkElmt = ['top' => 0, 'left' => 0, 'height' => 0];
//  for ($rowIdx = 0; $rowIdx < $perColRowsCnt; $rowIdx++) {
//    // $row614['heigetRow_dalught']=$css_lineHight;
//    $row615 = getRow_dalu($rowIdx, $colss, $withMain);
//    $row615['top'] = $lastBlkElmt['top'] + $lastBlkElmt['height'];
//    $row615['height'] = $css_lineHight;
//    $row615['font'] = $font;
//    $row615['font_size'] = $font_size;
//    renderElementRowV3($row615, $img, $outf);
//    //  imagepng($img, $outFile);
//    $lastBlkElmt = $row615;
//
//  }
//
//
////----th line
//  $row614 = array("th_row" => "true", "left" => 0, 'bkgrd' => '', "padBtm" => 0, "top" => $lastBlkElmt['top'], 'font' => $font, 'font_size' => $font_size, 'height' => 1);
//
//  $row614["childs"] = [];
//  for ($i = 0; $i < 40; $i++) {
//
//    $row614["childs"][] = array('txt' => "", 'width' => $withMain, 'height' => 1);
//  }
//  $row614['height'] = 1;
//  $row614['width'] = calcRowWd($row614);
//  renderElementRowV3($row614, $img, $outf);
//
//  imagepng($img, $outf);
//  echo "";
//}
//
//


//A$B 表示一个露珠，A:1 庄 2和 3闲 4 龙 5 龙虎的和 6 虎
//  B:0无对 1 庄对 2 闲对 3 庄闲对
//比如这个3$0 就是 闲，0表示无对子
//function spltToCols_dalu(array $records) {
//  $colss = [];
//  $colss[] = [];// last ===colss[last][lst]
//
//
//  foreach ($records as $rec) :
//
//    //  $curCol = [];
//    $rec['aftHe'] = 0;
//    $lastCol = &$colss[count($colss) - 1];
//    if (count($lastCol) == 0) {
//      //fisrt
//      array_push($lastCol, $rec);
//
//      continue;
//    }
//    $lastBall = &$lastCol[count($lastCol) - 1];
//
//
//    $rec = cvt_hz_rzt($rec);
//    if ($rec['rzt'] == "和") {
//
//      $lastBall['aftHe'] = $lastBall['aftHe'] + 1;
//
//      continue;
//    }
//
//
//    if ($rec['rzt'] == $lastBall['rzt']) {
//      array_push($lastCol, $rec);
//
//    } else if ($rec['rzt'] != $lastBall['rzt']) {
//      //now col add to  cols arr
//
//      array_push($colss, []);
//      $lastCol = &$colss[count($colss) - 1];
//      $lastCol[] = $rec;
//
//    }
//
//  endforeach;
//
//
//  return $colss;
//}
//

//for jupelu
function jupelu_getRow(int $rowIdx, array $colss, $elmtWd): array {
  $row614 = array("left" => 0, "row_btm_lineClr" => "gray", "padBtm" => 0);
  $row614["childs"] = [];

  if ($rowIdx == 4) {
    echo 2;
  }


  //gene row
  $colIdx = 1;
  foreach ($colss as $k => $col) {
    if ($rowIdx == 4 && $colIdx == 5)
      echo 3;
    //  echo "rowIdx" . $rowIdx . " colIdx" . $colIdx . "\r\n";
  // last ball maybe not full row
    if ($rowIdx >= count($col))
      break;
    $cell = $col[$rowIdx];
    if (!$cell)
      break;

    //todo biz code
    // $cell=$f($cell);

    list($win, $curClrTxt, $duiz) = calcTxtNclr($cell['gameRecord']);

    $cell['txt'] = $win;
    $cell['color'] = "white";
    $cell['duiz'] = $duiz;
    if ($duiz == "庄对")
      $cell['lfttpClr'] = "red";
    if ($duiz == "闲对")
      $cell['rtBtmClr'] = "blue";
    if ($duiz == "庄闲对") {
      $cell['rtBtmClr'] = "blue";
      $cell['lfttpClr'] = "red";

    }
    $cell['bkgrd'] = $curClrTxt;
    $cell['shape'] = 'ball';
    $cell['ballwidth'] = $elmtWd - 10;
    $cell['width'] = $elmtWd;  //50
    $cell['height'] = $cell['width'];


    array_push($row614["childs"], $cell);
    $colIdx++;
  }

  if (count($row614["childs"]) == 4) {
    echo 1;
  }

  $row614['width'] = calcRowWd($row614);
  return $row614;
}


/**
 * @param $pos_y
 * @param string $font
 * @param int $font_size
 * @param int $
 * @param array $row614
 * @param int $rowIdx
 * @param array $colss
 * @return array
 */
//function getRow_dalu(int $rowIdx, array $colss, $elmtWd): array {
//  $row614 = array("left" => 0, "row_btm_lineClr" => "gray", "padBtm" => 0);
//  $row614["childs"] = [];
//
//  if ($rowIdx == 4) {
//    echo 2;
//  }
//
//
//  //gene row
//  $colIdx = 1;
//  foreach ($colss as $k => $col) {
//    if ($rowIdx == 4 && $colIdx == 5)
//      echo 3;
//    //  echo "rowIdx" . $rowIdx . " colIdx" . $colIdx . "\r\n";
//    if ($rowIdx >= count($col)) {
//      $cell = [];
//      $cell['txt'] = "";
//      $cell['width'] = $elmtWd;  //50
//      $cell['height'] = $cell['width'];
//
//    } else {
//      //todo biz code
//      // $cell=$f($cell);
//      $cell = $col[$rowIdx];
//      if (!$cell)
//        break;
//
//      list($win, $curClrTxt, $duiz) = calcTxtNclr($cell['gameRecord']);
//
//
//
//      if ($cell['aftHe'] > 0)
//        $cell['txt'] = $cell['aftHe'];
//      else
//        $cell['txt'] = "";
//      $cell['color'] = "green";
//      $cell['duiz'] = $duiz;
//
//      if ($duiz == "庄对")
//        $cell['lfttpClr'] = "red";
//      if ($duiz == "闲对")
//        $cell['rtBtmClr'] = "blue";
//      if ($duiz == "庄闲对") {
//        $cell['rtBtmClr'] = "blue";
//        $cell['lfttpClr'] = "red";
//      }
//      $cell['bkgrd'] = $curClrTxt;
//      $cell['shape'] = 'eklps';
//      $cell['ballwidth'] = $elmtWd - 10;
//      $cell['width'] = $elmtWd;  //50
//      $cell['height'] = $cell['width'];
//    }
//
//
//    array_push($row614["childs"], $cell);
//    $colIdx++;
//
//  }
//
//
////  if (count($row614["childs"]) == 4) {
////    echo 1;
////  }
//
//  $row614['width'] = calcRowWd($row614);
//  return $row614;
//}


//  foreach ($records as $k => $record) // for($i=$maxLen-1;$i>0;$i--)
//  {
//    //  $record=&$records[$i];
//
//    $rzt = $record['gameRecord'];
//    if (!$rzt)
//      continue;  //flt now open game...
//
//
//    //----------split to rowIdx,colIdx
//    $arr_jmp = [7, 13, 19, 25, 31, 37, 43, 49, 55, 61, 67, 73, 79, 85, 91, 97];
//    if (in_array($int_num, $arr_jmp)) {
//      $rowIdx = 0;//rest rowidx
//      $pos_x = $pos_x + $withMain;
//      $pos_y = $withMain;  //这里这番需要avd head..
//
//      $colIdx++;
//
//    }
//    $record['rowIdx'] = $rowIdx;
//    $record['colIdx'] = $colIdx;
//    $rowIdx++;
//    $int_num++;
//
//
//    list($win, $curClrTxt) = calcTxtNclr($rzt);
//    $record['txt'] = $win;
//    $record['color'] = "white";
//
//    $record['bkgrd'] = $curClrTxt;
//
//  }

//function getRow(int $rowIdx, $colss) {
//  $a = [];
//  $maxLen = count($colss);
//  for ($i =0; $i < $maxLen; $i++) {
//
//    $col = $colss[$i];
//    $cell['shape'] = 'ball';
//    $cell['ballwidth'] = 40;
//    $cell['width'] = 50;
//    $cell['height'] = $cell['width'];
//    if ($cell['rowIdx'] == $rowIdx)
//      array_push($a, $cell);
//  }
//  return $a;
//}


//$white_color = imagecolorallocate($img, 255, 255, 255);
//$grayClr= imagecolorallocate($img, 200, 200, 200);
//
//$red_color = imagecolorallocate($img, 255, 0, 0);
//$blue_color = imagecolorallocate($img, 10, 10, 255);
//
//
//// 写入表格
//$temp_height = $title_height;
//
//imageline($img, 0, 3, 500, 3, $red_color);
//  imagettftext($img, $font_size, 0, 0 , 0+20 , $blue_color, $font, "我");

//
//# 开始画图
//// 创建画布
//$img = imagecreatetruecolor($img_width, $img_height);
//
//# 创建画笔
//// 背景颜色（蓝色）
//$bg_color = imagecolorallocate($img, 10, 10, 10);
//$blue_color = imagecolorallocate($img, 10, 10, 255);
//$blue_color_half = imagecolorallocate($img, 100, 100, 255);
//// 表面颜色（浅灰）
//$surface_color = imagecolorallocate($img, 235, 242, 255);
//// 标题字体颜色（白色）
//$title_color = imagecolorallocate($img, 255, 255, 255);
//// 内容字体颜色（灰色）
//$text_color = imagecolorallocate($img, 0, 0, 0);
//
//$text_color_black = imagecolorallocate($img, 0, 0, 0);
//$green_color = imagecolorallocate($img, 0, 255, 0);
//$blueLight_color = imagecolorallocate($img, 100, 149, 237);
//
//// 大双为红色
//$big_2_color = imagecolorallocate($img, 255, 0, 0);
//// 小单为青色
//$small_1_color = imagecolorallocate($img, 100, 149, 237);
//// 无的颜色
//$null_color = imagecolorallocate($img, 125, 125, 125);
//// 对子
//$pair_color = imagecolorallocate($img, 10, 200, 10);
//// 顺子
//$_color = imagecolorallocate($img, 200, 134, 0);
//// 豹子
//$all_color = imagecolorallocate($img, 255, 0, 0);
//$box = imagettfbbox($font_size, 0, $font, "小");
//$big_small_with = $box[2] - $box[0];
//
//
//// 画矩形 （先填充一个大背景，小一点的矩形形成外边框）
//imagefill($img, 0, 0, $bg_color);  //背景颜色（蓝色）
//imagefilledrectangle($img, 0, 0, $img_width, $img_height, $surface_color);


// show jonjyo list 中奖名单  gene zhongj lst pic
function jonjyo_bingoList_calcIncomeGrpby($lotteryno) {
  require_once __DIR__ . "/../lib/painLib.php";
  $outFile = __DIR__ . "/../public/betRztlist.jpg";
  delFile($outFile);
  try {
    $a = [];
    //  //    select sum(bet),sum(payout),sum(bet)-sum(payout) as income
//  //    from betrecord where lotterno=xxx group by userid


    $rows = \think\facade\Db::name('bet_record')
      ->where('lotteryno', '=', $lotteryno)
      ->where('status', '=', 0)
      ->field(' UserName,UserId,sum(bet) Bet,sum(payout) Payout,sum(bet)-sum(payout) as income')
      ->group('userid,username')  //betNoAmt
      ->select();


    //-----------css配置
    $css_lineHight = 40;
    $canvas_height = $css_lineHight * (count($rows) + 2) + 0;
    $font_size = 20;
    $font = __DIR__ . "/../public/msyhbd.ttc";
    $posX = 0;
    $posY = 0;
    $css_datawidth = 180;
    $firstColWidth = 350;

    # 开始画图
    // 创建画布
    $img_elmt = array("element" => "canvas", "bkgrd" => "white", "width" => $firstColWidth + $css_datawidth * 4, "height" => $canvas_height);

    $img = renderElementCanvas($img_elmt);
    //------   本局得分，剩余分，初始分，佣金

    //--------------------title
    //百家乐
    $row614 = array("left" => 0, 'bkgrd' => 'gray217', "padBtm" => 0, "top" => 0, 'font' => $font, 'font_size' => $font_size, 'height' => $css_lineHight);

    $row614["childs"] = [

      array('txt' => "百家乐" . array_key("tabNo_str", $GLOBALS), 'tag' => 'th', 'bkgrd' => "redHalf", 'id' => 'cell1', 'align' => 'left', 'padLeft' => 10, 'width' => $firstColWidth, 'height' => $css_lineHight),
      array('txt' => '本局得分', 'tag' => 'th', 'align' => 'center', 'color' => "black", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight),
      array('txt' => '剩余分', 'tag' => 'th', 'color' => "black", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight),
      array('txt' => '初始分', 'tag' => 'th', 'color' => "black", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight),
      array('txt' => '', 'tag' => 'th', 'color' => "black", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight)

    ];

    renderElementRowV2($row614, $img, $outFile);
    $posY = $posY + $row614['height'];


    //------------show datas

    $row_forCalc = [];
    foreach ($rows as $row) {
      $betamt = $row['Bet'] / 100;

      var_dump($row['Payout'] / 100);
      var_dump($betamt);
      $payout = $row['Payout'];
      var_dump($row['Payout'] / 100 - $betamt);
      $income = $row['Payout'] / 100 - $betamt;
      $uid = $row['UserId'];
      $uname = $row['UserName'];

      require_once "user.php";
      $bls = getBlsByU($uid);
      $row_cur = ['本局得分' => $income, '剩余分' => $bls, '初始分' => $bls - $income, '佣金' => 0];

      $row_forCalc[] = $row_cur;

      $txt = "$uname [$uid]  下注金额:$betamt 盈亏: $income \r\n";
      var_dump($txt);

      $row327 = array("left" => 0, "padBtm" => 0, "top" => $posY, 'font' => $font, 'font_size' => $font_size, 'height' => $css_lineHight);

      $row327["childs"] = [

        array('txt' => $uname, 'id' => 'cell1', 'align' => 'left', 'padLeft' => 10, 'width' => $firstColWidth, 'height' => $css_lineHight),

        array('txt' => $income, 'align' => 'center', 'color' => "black", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight),

        array('txt' => $bls, 'color' => "black", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight),

        array('txt' => $row_cur['初始分'], 'color' => "black", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight),

        array('txt' => '', 'color' => "black", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight)


      ];

      renderElementRowV2($row327, $img, $outFile);
      $posY = $posY + $row327['height'];


      $a[] = $txt;
    }

    //---------show botrtom row
    $row = array('elmtType' => 'tr', 'bkgrd' => "redHalf", 'font_size' => $font_size, 'font' => $font, "left" => 0, "top" => $posY, 'height' => $css_lineHight);

    $row['childs'] = [
      array('txt' => '总计' . count($rows) . '人', 'align' => 'center', 'height' => $css_lineHight, 'bkgrd' => "", 'width' => $firstColWidth),
      array('txt' => array_sum_col_inpainlib('本局得分', $row_forCalc), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col_inpainlib('剩余分', $row_forCalc), 'bkgrd' => "", 'width' => $css_datawidth),
      array('txt' => array_sum_col_inpainlib('初始分', $row_forCalc), 'bkgrd' => "", 'width' => $css_datawidth),

      array('txt' => '', 'bkgrd' => "", 'width' => $css_datawidth),

    ];


    renderElementRowV2($row, $img, $outFile);
    // $posY = $posY + $row['height'];

    imagepng($img, $outFile);


    return join("", $a);
  } catch (\Throwable $exception) {
    try {
      $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
      \think\facade\Log::error("----------------errrrr5---------------------------");
      \think\facade\Log::error("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
      \think\facade\Log::error("errmsg:" . $exception->getMessage());
      \think\facade\Log::error("errtraceStr:" . $exception->getTraceAsString());
      var_dump($exception);
      return "";
    } catch (\Throwable $exception) {
      return "";
    }

    // throw $exception; // for test
  }
}


function trendPIc_getDzCnt($records, $find) {
  //------------------save kaij rzt

//A$B 表示一个露珠，A:1 庄 2和 3闲 4 龙 5 龙虎的和 6 虎
//  B:0无对 1 庄对 2 闲对 3 庄闲对
//

//比如这个3$0 就是 闲，0表示无对子
  require_once __DIR__ . "/../lib/arr.php";
  $rows = array_filterx($records, function ($row) use ($find) {
    $gameRecord = $row['gameRecord'];

    // $find = "3$";
    if (endsWith339($gameRecord, $find))
      return true;
  });
  return count($rows);

}
require_once __DIR__."/../lib/str.php";
function TrendPic_getBkWinCnt($records, $find) {
  //------------------save kaij rzt

//A$B 表示一个露珠，A:1 庄 2和 3闲 4 龙 5 龙虎的和 6 虎
//  B:0无对 1 庄对 2 闲对 3 庄闲对
//

//比如这个3$0 就是 闲，0表示无对子
  require_once __DIR__ . "/../lib/arr.php";
  $rows = array_filterx($records, function ($row) use ($find) {
    $gameRecord = $row['gameRecord'];

    // $find = "3$";
    if (startwithV1252($gameRecord, $find))
      return true;
  });
  return count($rows);

}

