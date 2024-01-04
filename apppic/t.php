<?php


/**
 * @return false|string
 */
function getUrlRltv($f) {
 $ps = strpos($f, "/image/");
  $url_rlftv = substr($f, $ps);
  return $url_rlftv;
}


$f = "http://45.113.201.166:9369/image/20231016/20231016110433_44543.jpg";

$url_rlftv = getUrlRltv($f);
var_dump($url_rlftv);