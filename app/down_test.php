<?php


$sec=20;

$endTime = date("Y-m-d H:i:s");
var_dump($endTime);
$endTime=urlencode($endTime);
$url = "http://localhost:89/api.php?call=kaijVd_outputFile%20$sec,$endTime";

$url="http://46.137.239.204/api.php?call=kaijVd_outputFile%20$sec,$endTime";
var_dump($url);


$outf = __DIR__ . "/../down/" . date("md_His") ."_". rand() . ".mp4";
//encode
var_dump($outf);
require_once __DIR__."/../lib/down.php";
$outf = download_fl($url, $outf);

// $f=file_get_contents(  $url  );
////
// file_put_contents('C:\00bk\a701.mp4',$f);

//down_fil_by_curl($url,'C:\00bk\a653.mp4');

function down_fil_by_curl($file_url, $save_to)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POST, 0);
  curl_setopt($ch,CURLOPT_URL,$file_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $file_content = curl_exec($ch);
  curl_close($ch);

  $downloaded_file = fopen($save_to, 'w');
  fwrite($downloaded_file, $file_content);
  fclose($downloaded_file);

}


