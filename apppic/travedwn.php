<?php

require_once __DIR__ . "/../lib/file.php";
$f = "C:\\0prj\bjl2023\apppic\\slkted.json";


$a = file_get_contents_Arr($f);



foreach ($a as $v) {

  try{

    $js = json_decode($v,true);
    $f77 = $js['idhold'];

    dwn($f77);
    dwn($js['idfront']);
  //  break;
  }
  catch (Throwable $e){
   // throw $e;
  }



}



/**
 * @param $f77
 * @return void
 */
function dwn($f77): void {
  $url_rlftv = getUrlRltv($f77);
  $absurl="http://45.113.201.166:9369".$url_rlftv;

  $path_parts = pathinfo($f77, PATHINFO_BASENAME);

  if(!file_exists("pic/" . $path_parts))
  {
    file_put_contents("pic/" . $path_parts, file_get_contents($absurl));

  }
  var_dump($path_parts);
}


function getUrlRltv($f) {
  $ps = strpos($f, "/image/");
  $url_rlftv = substr($f, $ps);
  return $url_rlftv;
}