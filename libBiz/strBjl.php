<?php


use think\exception\ValidateException;

function betstrX__split_convert_decodeLhc(string $bet_str) {
  $a = [];
  $bet_str = betstrX__fmt_bjlV2($bet_str);
  $betType = str_delLastNumX($bet_str);
  if ($betType == "三宝") {
    return sanbao_arr($bet_str);
  }
  $a[] = $bet_str;
  return $a;

}

function sanbao_arr($str) {
  //$betType = str_delLastNumX($txt);
  $amt = getAmt_frmStrLastV2($str);

  $a = ["和" . $amt, "庄对" . $amt, "闲对" . $amt];
  return $a;
}

//---fmt statnd fmt ,then chk fmt
function betstrX__fmt_bjlV2($txt) {
  $txt = trim($txt);
  $txt = strtolower($txt);


  //-----------cvt to statnd fmt
  //-----------soha
  $txt = str_replace("sbs", "三宝梭", $txt);
  $txt = str_replace("zs", "庄梭", $txt);
  $txt = str_replace("xs", "闲梭", $txt);
  $txt = str_replace("hs", "和梭", $txt);
  $txt = str_replace("ds", "对梭", $txt);

  //-----------------
  $txt = str_replace("sb", "三宝", $txt);
  $txt = str_replace("xy", "幸运", $txt);

  $txt = str_replace("zd", "庄对", $txt);
  $txt = str_replace("xd", "闲对", $txt);
  $txt = str_replace("z", "庄", $txt);
  $txt = str_replace("x", "闲", $txt);
  $txt = str_replace("h", "和", $txt);


  $txt = str_replace("d", "庄闲各对", $txt);
  $txt = str_replace("l", "幸运", $txt);


  $txt = trim($txt);

  //-----------chk fmt
  $arr_fmt = ["三宝梭", "庄梭", "和梭", "闲梭", "对梭", "庄\d+", "闲\d+", "和\d+", "三宝\d+", "幸运\d+", "庄对\d+", "闲对\d+", "庄闲各对\d+"];
  if(!in_array_rxChk($txt,$arr_fmt))
    throw new ValidateException("");


  $arrFmt = ["庄", "和", "闲", "三宝", "庄对", "闲对", "幸运", "庄梭", "闲梭", "和梭", "对梭", "三宝梭"];
  $betType = str_delLastNumX($txt);
//  if (!in_array($betType, $arrFmt))
//    throw new ValidateException("");

//chk amt>0  if not soha,chek  amt>0
  $sohaArr = ["庄梭", "闲梭", "和梭", "对梭", "三宝梭"];
  if (!in_array($txt, $sohaArr)) {
    $betType = str_delLastNumX($txt);
    //if no amt ,ret null
    $amt = getAmt_frmStrLastV2($txt);
    if (!$amt)
      throw new ValidateException("");
    if ($amt <= 0)
      throw new ValidateException("");
  }





  return $txt;
}

function in_array_rxChk(string $txt, array $arr_fmt) {

    $fnl=false;
  foreach ($arr_fmt as $itm) {
    if (empty($itm))
      continue;

    $p = '/^' . $itm . '$/iu';
    if (preg_match($p, $txt)) {
      $fnl=true;
    }

  }
  return $fnl;
}

//if no amt ,ret null
function getAmt_frmStrLastV2($str) {
  $str = trim($str);
  //   $str = $msg['text'];
  if (preg_match('/(\d+)$/', $str, $match)) {
    $number = $match[0];
  }
  return $number;
}

function getAmt_frmStrLastV3($str, $def = 0) {
  $str = trim($str);
  //   $str = $msg['text'];
  if (preg_match('/(\d+)$/', $str, $match)) {
    $number = $match[0];
  }

  if ($number == null)
    return 0;

  return $number;
}
