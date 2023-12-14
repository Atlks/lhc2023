<?php

//php dbKaijSrc/kaijsrc.php
$seconds = 45;
while(true)
{

  $f = __DIR__ . "/../dbKaijSrc/kaijsrc.json";
  $json=file_get_contents_Asjson($f);
 array_removeElmt($json['data'],100,500);



    //-----------------inset new head
 // $dataJsonCur=["data"=>[]];
  $dttm=date("Y-m-d H:i:s");
  $gameNo=date("His");
  $newJu=["tableNo"=>"南海","shoeNo"=>1,"juNo"=>2,"gameRecord"=>"","addTime"=>$dttm,"countdownSeconds"=>30,"gameNo"=>$gameNo];
  array_insertHead($json['data'],$newJu);
  file_put_contents($f,json_encode($json,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));



  //-------------------------wait...secs

  sleep($seconds);



  //------------------save kaij rzt

//A$B 表示一个露珠，A:1 庄 2和 3闲 4 龙 5 龙虎的和 6 虎
//  B:0无对 1 庄对 2 闲对 3 庄闲对
//

//比如这个3$0 就是 闲，0表示无对子
  $json=file_get_contents_Asjson($f);
  $n=rand(1,3);
  $newJu['gameRecord']=$n."$".rand(0,3);
  $json['data'][0]=$newJu;
  file_put_contents($f,json_encode($json,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));

  //break;
}





function file_get_contents_Asjson($f) {
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