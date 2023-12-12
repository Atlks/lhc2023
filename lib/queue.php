<?php


function file_get_contents_Asjson1019($f) {
  $t=file_get_contents($f);
  $json = json_decode($t, true);
  return $json;
}

function array_removeElmt(&$data, int $offset, int $len) {
  return array_splice($data,$offset,$len,[]);
}

function array_insertHead(&$data,   $newJu) {


  // array_insertHead    array_unshift
  array_unshift($data,$newJu);
  // insert Frt new ju to data
}