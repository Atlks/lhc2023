<?php


// jaijyo evt
//require  __DIR__ . "/../../lib/iniAutoload.php";
use function app\commonBjl\SendPicRzt;
use function libspc\log_err;

function kaij_draw_evt_bjl() {
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

  //--------------------show kaj rzt
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

//------------------ gene pic rzt
  //  开奖结果图 与走势图
  SendPicRztV2($GLOBALS['qihao'], $GLOBALS['kaij_rzt']);

  //---中奖结果图发送
  $cfile = new \CURLFile(__DIR__ . "/../public/betRztlist.jpg");
  $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
  $bot->sendPhoto($GLOBALS['chat_id'], $cfile);

  \think\facade\Db::close();
  $show_str = "console:" . $lottery_no . "期开奖完毕==开始下注 \r\n";
  //  sendmessage841($show_str);
  // $gl->DrawLottery();
}


/**
 * send kaij rzt pic n trend pic
 * @param GameLogicSsc $gmLgcSSc
 * @return void
 * @throws \TelegramBot\Api\Exception
 * @throws \TelegramBot\Api\InvalidArgumentException
 */
function SendPicRztV2($qihao, $rzt): void {


  require_once __DIR__ . "/../libBiz/bjl.php";

  //$rzt= getKaijRztBjl($qihao);
  try {
    // -----------------闲赢---生成图片
    $cfile = new \CURLFile(app()->getRootPath() . "res/rzt_" . $rzt . ".jpg");
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
  } catch (\Throwable $e) {
    var_dump($e);

  }


  try {
    sendTrendPic();
  } catch (\Throwable $e) {
    var_dump("L116");
    var_dump($e);

  }


}

/**
 * @return void
 * @throws \TelegramBot\Api\Exception
 * @throws \TelegramBot\Api\InvalidArgumentException
 */
function sendTrendPic(): void {
//  require_once __DIR__ . "/../../libTpscrt/kaij.php";
  require_once __DIR__ . "/../libBiz/startEvt.php";
  \createTrendImageV2(\kaipanInfoCore());
  $f549 = __DIR__ . "/../public/trend.jpg";
  //  $f549 = app()->getRootPath() . "public/trend.jpg";
  var_dump($f549);
  $cfile = new \CURLFile($f549);
  $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
  $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
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


function getKaijRztBjl($gameNo) {

  require_once "startEvt.php";
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
  $a = explode("$", $rzt);

  if ($a[0] == 1)
    $win = "庄赢";

  if ($a[0] == 2)
    $win = "和";


  if ($a[0] == 3)
    $win = "闲赢";

  return $win;

//  lewis, [08/12/2023 2:27 pm]
//A$B 表示一个露珠，A:1 庄 2和 3闲 4 龙 5 龙虎的和 6 虎
// B:0无对 1 庄对 2 闲对 3 庄闲对
//
//lewis, [08/12/2023 2:28 pm]
//比如这个3$0 就是 闲，0表示无对子


}


function createTrendImageV2($records) {

  var_dump(__METHOD__ . json_encode(func_get_args()));


//  $records = file_get_contents("C:\\0prj\\lhc2023\\test\\ft_curDsk.json");
//  $records = json_decode($records, true);
  $records = $records['data'];


  $log_txt = __METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


  $font = __DIR__ . "/../public/msyhbd.ttc";
  $font_path = $font;
  var_dump($font_path);

  //echo $font;
  $font_title_size = 16;
  $font_size = 20;


  //--------------------- 创建画布
  $img_height = 370;
  $img_width = 800;

  $img_elmt = array("element" => "canvas", "bkgrd" => "white", "width" => $img_width, "height" => $img_height);
  require_once __DIR__ . "/../lib/painLib.php";
  $img = renderElementCanvas($img_elmt);


  $pos_x = 0;
  $pos_y = 0;
  $int_num = 1;
  $withMain = 50;
  $css_lineHight = $withMain;
  $css_datawidth = $withMain;

  $outFile = __DIR__ . "/../public/trend.jpg";
  //----------------------百家乐 hd-----------
  $row614 = array("th_row" => "true", "left" => 0, 'bkgrd' => 'black', "padBtm" => 0, "top" => 0, 'font' => $font, 'font_size' => $font_size, 'height' => $withMain);

  $bankWinCnt = getBkWinCnt($records, "1$");
  $plyerWinCnt = getBkWinCnt($records, "3$");
  $HeCnt = getBkWinCnt($records, "2$");
  $bkDwiCnt = getDzCnt($records, "$1");
  $plyrDwiCnt = getDzCnt($records, "$2");
  $bkgrdBallWidth = 40;
  // gameRecord
  $ballwd = 40;
  $row614["childs"] = [

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
  renderElementRowV2($row614, $img, $outFile);
  $pos_y = $pos_y + $row614['height'];
  //-----------end head


  $rowIdx = 0;
  $colIdx = 0;

  $maxLen = count($records);
  //todo  列转行 算法：  arr_cut 每次，gene col,push arr,然后循环row num,。。
  //---------tag  row col idx

  $records = array_reverse($records);

  $colss = [];
  $perColRowsCnt = 6;

  while (true) {
    $curCol = array_slice($records, 0, $perColRowsCnt);
    if (count($curCol) == 0)
      break;
    array_push($colss, $curCol);
    require_once __DIR__ . "/../lib/queue.php";
    array_removeElmt($records, 0, $perColRowsCnt);

  }


  //--------render row each
  //max row 6
  for ($rowIdx = 0; $rowIdx < $perColRowsCnt; $rowIdx++) {
    $row614 = array("left" => 0, "row_btm_lineClr" => "grayHalf", "padBtm" => 0, "top" => $pos_y, 'font' => $font, 'font_size' => $font_size, 'height' => $withMain);
    $row614["childs"] = [];

    if ($rowIdx == 4) {
      echo 2;
    }

    $colIdx = 1;
    foreach ($colss as $k => $col) {
      if ($rowIdx == 4 && $colIdx == 5)
        echo 3;
    //  echo "rowIdx" . $rowIdx . " colIdx" . $colIdx . "\r\n";
      if ($rowIdx >= count($col))
        break;
      $cell = $col[$rowIdx];
      if (!$cell)
        break;

      list($win, $curClrTxt) = calcTxtNclr($cell['gameRecord']);

      $cell['txt'] = $win;
      $cell['color'] = "white";

      $cell['bkgrd'] = $curClrTxt;
      $cell['shape'] = 'ball';
      $cell['ballwidth'] = 40;
      $cell['width'] = 50;
      $cell['height'] = $cell['width'];
      array_push($row614["childs"], $cell);
      $colIdx++;
    }

    if (count($row614["childs"]) == 4) {
      echo 1;
    }


    renderElementRowV2($row614, $img, $outFile);
    $pos_y = $pos_y + $row614['height'];

  }
  //end foreach row
  imagepng($img, __DIR__ . "/../public/trend.jpg");
  echo "";
}


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


/**
 * @param $rzt
 * @param $red_color
 * @param $green_color
 * @param $blue_color
 * @return string[]
 */
function calcTxtNclr($rzt): array {
  $a = explode("$", $rzt);

  if ($a[0] == 1) {
    $win = "庄";

    $curClrTxt = "red";
  }


  if ($a[0] == 2) {
    $win = "和";

    $curClrTxt = "green";
  }

  if ($a[0] == 3) {

    $win = "闲";

    $curClrTxt = "blue";
  }
  return array($win, $curClrTxt);
}


function getDzCnt($records, $find) {
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

function getBkWinCnt($records, $find) {
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


function endsWith339($str, $needle) {
  return $needle === '' || substr_compare($str, $needle, -strlen($needle)) === 0;
}
