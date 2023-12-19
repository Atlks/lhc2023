<?php


$vddir=__DIR__ . "/../vd";
$dirArr = scandir($vddir);
//$dirArr = scandir(__DIR__."/../vdNow/");



$n = 1;
$nowQihaoPicDr = __DIR__ . "/../vdNow/";
$advsSecs=7200; //clr before 1our
$startTime =date("Y-m-d H:i:s",strtotime("-$advsSecs seconds"));

require_once __DIR__."/../lib/file.php";
foreach ($dirArr as $v) {

  if($v=="." || $v=="..")
    continue;
  $fullFil = $vddir . "/" . $v;
  $crtTime = fileCrtTime406($fullFil);
  if ($crtTime<$startTime  ) {
    // var_dump($v);
    $Dst = __DIR__ . "/../vdRecyle/" . $v;
    rename($fullFil, $Dst);
    $n++;
  }
}
