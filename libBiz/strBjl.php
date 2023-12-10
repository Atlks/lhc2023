<?php


  function betstrX__split_convert_decodeLhc(string $bet_str_arr_clr) {
  $a=[];
  $bet_str_arr_clr=betstrX__fmt_bjlV2($bet_str_arr_clr);
  $a[]=$bet_str_arr_clr;
  return $a;

}


function betstrX__fmt_bjlV2($txt) {

  $txt= strtolower($txt);
  $txt = str_replace("sbs", "三宝梭", $txt);

  $txt = str_replace("zs", "庄梭", $txt);
  $txt = str_replace("xs", "闲梭", $txt);
  $txt = str_replace("hs", "和梭", $txt);
  $txt = str_replace("ds", "对梭", $txt);

  $txt = str_replace("sb", "三宝", $txt);
  $txt = str_replace("xy", "幸运", $txt);

  $txt = str_replace("zd", "庄对", $txt);
  $txt = str_replace("xd", "闲对", $txt);
  $txt = str_replace("z", "庄", $txt);
  $txt = str_replace("x", "闲", $txt);
  $txt = str_replace("d", "庄闲各对", $txt);
  $txt = str_replace("l", "幸运", $txt);

  $txt = str_replace("h", "和", $txt);


  return $txt;
}