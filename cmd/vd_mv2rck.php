<?php

while (true) {

  try {
    clr226();
    sleep(1);
} catch (Throwable $e) {
    var_dump($e);
  }

}
/**
 * @param $vddir
 * @param $startTime
 * @param $n
 * @return void
 */
function clr226(): void {
  $vddir = __DIR__ . "/../vd";
  $dirArr = scandir($vddir);
//$dirArr = scandir(__DIR__."/../vdNow/");


  $n = 1;
  $nowQihaoPicDr = __DIR__ . "/../vdNow/";
  $advsSecs = 7200; //clr before 1our
  $timestampBfPnt = strtotime("-$advsSecs seconds");
  $startTime = date("Y-m-d H:i:s", $timestampBfPnt);

  require_once __DIR__ . "/../lib/file.php";
  foreach ($dirArr as $v) {

    try {
      if ($v == "." || $v == "..")
        continue;
      $fullFil = $vddir . "/" . $v;
      $crtTime = fileCrtTime406($fullFil);
      if ($crtTime < $startTime) {
        var_dump($v);
        $Dst = __DIR__ . "/../vdRecyle/" . $v;
        rename($fullFil, $Dst);
        $n++;
      }
    } catch (Throwable $e) {
      var_dump($e);
    }


  }
}


