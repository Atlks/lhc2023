<?php


$sec=20;

$endTime = date("Y-m-d H:i:s");
$url = "http://localhost:89/api.php?call=kaijVd_outputFile%20$sec,$endTime";
var_dump($url);
$f=file_get_contents(  $url  );

file_put_contents('C:\00bk\a.mp4',$f);


