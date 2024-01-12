<?php

log_Vardump();

$id = "612127196612050526";


ini_set('memory_limit', '10960M');
require_once __DIR__ . "/../lib/file.php";
$f = "C:\Users\attil\OneDrive\桌面\users.json";
$js = file_get_contents_Asjson($f);
$a = $js['RECORDS'];

foreach ($a as $value) {

  try {
    $id = $value['idcard'];
    $sx = substr($id, 16, 1);
    if ($sx % 2 == 0) {
      $bday = substr($id, 6, 4);
      if ($bday < 1985)
        continue;
      //f n aft 1985
      var_dump($value);
      $js459 = json_encode($value, JSON_UNESCAPED_UNICODE);

      file_put_contents("slkted.json", $js459 . PHP_EOL, FILE_APPEND);

    }
  } catch (\Throwable $e) {
    print_r($e);
  }

  //$num%2==0

}


//$sx = substr($id, 16, 1);
//if ($sx % 2 == 0) {
//  $bday = substr($id, 6, 4);
//  var_dump($bday);
//  if ($bday < 1985)
//    echo "bef 1985";
//  //f n aft 1985
//  //var_dump($value );
//}

