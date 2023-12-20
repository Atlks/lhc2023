<?php

//php dbKaijSrc/kaijsrc.php
$seconds = 45;
/**
 * @param int $seconds
 * @return void
 */

while (true) {
  try {
    //geneQihao($seconds);
    $cmd = "php " . __DIR__ . "/../libBiz/kaipanInfoForTest.php";
    var_dump($cmd);
    system($cmd);
    //sleep(1);
  } catch (Throwable $e) {
    var_dump($e);
  }




  //break;
}


