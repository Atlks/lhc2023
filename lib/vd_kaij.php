<?php


//
//$filename = __DIR__ . "/../vd/0000141.jpg";
//$a=filectime($filename);
//echo date("Y-m-d H:i:s",$a);
//
//$startTime = "2023-12-18 17:08:35";
//$endTime = "2023-12-18 17:08:55";
//$vddir = __DIR__ . "/../vd";
//var_dump(kaijVd($startTime,$endTime,$vddir));

function kaijVd($startTime,$endTime,$vddir)
{
  $dirArr = scandir($vddir);
//$dirArr = scandir(__DIR__."/../vdNow/");


  $subdirName = filenameBytime($startTime);
  $n = 1;
  $nowQihaoPicDr = __DIR__ . "/../vdNow/";
  mkdirv2($nowQihaoPicDr . $subdirName . "/");
  $nowQihaoPicDr = $nowQihaoPicDr . $subdirName . "/";
  foreach ($dirArr as $v) {

    $fullFil = $vddir . "/" . $v;
    $crtTime = fileCrtTime($fullFil);
    if ($startTime <= $crtTime && $crtTime <= $endTime) {
     // var_dump($v);
      rename($fullFil, $nowQihaoPicDr . $n . ".jpg");
      $n++;
    }
  }


  $ffmpeg = "ffmpeg";

  $outf = $nowQihaoPicDr . "z20sec.mp4";
  require_once __DIR__."/../lib/file.php";
  if( file_exists($outf))
    delFileV2($outf);
  mltpic2vd($ffmpeg, $nowQihaoPicDr, $outf);

  return $outf;
}

function mkdirv2(string $d) {

  try{
    mkdir($d);
  }catch (\Throwable $e){
    var_dump($e);
  }
}


function mltpic2vd($ffmpeg, $picdr, $outf): void {
  $cmd = "$ffmpeg -f image2 -r 10 -i $picdr%d.jpg  $outf";
  echo $cmd . "\r\n";
  exec($cmd);
}

/**
 * @param string $startTime
 * @return array|string|string[]
 */
function filenameBytime(string $startTime) {
  $subdirName = str_replace(":", "", $startTime);
  $subdirName = str_replace("-", "", $subdirName);
  $subdirName = str_replace(" ", "_", $subdirName);
  return $subdirName;
}

function fileCrtTime(string $fullFil) {

  $a = filectime($fullFil);
  return date("Y-m-d H:i:s", $a);
}