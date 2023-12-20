<?php


 //kaijVd_outputFile(30,date("Y-m-d H:i:s"));

//
//$filename = __DIR__ . "/../vd/0000141.jpg";
//$a=filectime($filename);
//echo date("Y-m-d H:i:s",$a);
//
//$startTime = "2023-12-18 17:08:35";
//$endTime = "2023-12-18 17:08:55";
//$vddir = __DIR__ . "/../vd";
//var_dump(kaijVd($startTime,$endTime,$vddir));
function kaijVd_outputFile($advsSecs,$endTime,$vddir=__DIR__ . "/../vd")
{
  ob_start();
  $startTime =date("Y-m-d H:i:s",strtotime("-$advsSecs seconds",strtotime($endTime)));


  $kaijVd_fil = kaijVd($startTime, $endTime, $vddir);
  ob_end_clean();


  header("Content-type:video/mp4");
  header("Content-Length: ".filesize($kaijVd_fil));
  //请求范围的度量单位
  Header ( "Accept-Ranges: bytes" );
//  header('Content-Disposition:attachment; filename=a.mp4');
 // readfile()
 // echo file_get_contents($kaijVd_fil
  readfile($kaijVd_fil);
 // echo file_get_contents( 'C:\0prj\lhc2023\vdNow\20231219_145430\z20sec.mp4');
}

require_once __DIR__."/../lib/logx.php";
function kaijVd($startTime,$endTime,$vddir)
{
  log_enterMethV2(__METHOD__,func_get_args(),"vdcvt");
  $dirArr = scandir($vddir);
//$dirArr = scandir(__DIR__."/../vdNow/");


  $subdirName = filenameBytime($endTime);
  $n = 1;
  $nowQihaoPicDr = __DIR__ . "/../vdNow/";
  mkdirv2($nowQihaoPicDr . $subdirName . "/");
  $nowQihaoPicDr = $nowQihaoPicDr . $subdirName . "/";
  foreach ($dirArr as $v) {

    $fullFil = $vddir . "/" . $v;
    $crtTime = fileCrtTime($fullFil);
    if ($startTime <= $crtTime && $crtTime <= $endTime) {
      if($n%1000==0)
       var_dump($v);
      copy($fullFil, $nowQihaoPicDr . $n . ".jpg");
      $n++;
    }
  }


  $ffmpeg = "ffmpeg";

  $outf = $nowQihaoPicDr . "z20sec.mp4";
  require_once __DIR__."/../lib/file.php";

  if( file_exists($outf))
    return $outf;
  else
  {
    mltpic2vd($ffmpeg, $nowQihaoPicDr, $outf);
    return $outf;
  }
//  if( file_exists($outf))
//    delFileV2($outf);
//  mltpic2vd($ffmpeg, $nowQihaoPicDr, $outf);
//
//  return $outf;
}

function mkdirv2(string $d) {

  try{
    mkdir($d);
  }catch (\Throwable $e){
  //  echo "----warning..";
   // var_dump($e);
  }
}


function mltpic2vd($ffmpeg, $picdr, $outf): void {
  log_enterMethV2(__METHOD__,func_get_args(),"vdcvt");

  $ffmpeg="C:\\ffmpeg-2023-12-11-git-1439784ff0-essentials_build\\bin\\ffmpeg.exe";
  $cmd = "$ffmpeg -f image2 -r 10 -i $picdr%d.jpg  $outf";
  echo $cmd . "\r\n";
 // $cmd="php ".__DIR__."/../pic2vd.php";
  logV3(__METHOD__,$cmd,"vdcvt");
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