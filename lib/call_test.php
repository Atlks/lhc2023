<?php

$endTime = date("Y-m-d H:i:s");
$_GET['call']="kaijVd_outputFile 20,$endTime";
$cmd=$_GET['call'];
$cmdArr=explode(" ",$cmd);

require_once __DIR__ . "/../lib/vd_kaij.php";
// $outf = (kaijVd($startTime, $endTime, $vddir));
$outf= __DIR__ . "/../down/" .date("Ymd_His")."_".rand().".mp4";
$url="http://46.137.239.204/api.php?call=kaijVd_outputFile 20,$endTime";

var_dump($outf);


$args =getArgsFromCallStr($cmd) ;
$fname=$cmdArr[0];
call_user_func_array($fname, $args);


 kaijVd("", $endTime, "");




function getArgsFromCallStr(string $cmd) {

  $cmd=trim($cmd);
  $intPos=strpos($cmd," ");
  $substr = substr($cmd, $intPos);
  $substr=trim($substr);
  return explode(",",$substr) ;
}