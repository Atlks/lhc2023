<?php

//php dbKaijSrc/kaijsrc.php

while(true)
{

  $f = __DIR__ . "/../dbKaijSrc/kaijsrc.json";
  $json=file_get_contents_Asjson($f);
 array_removeElmt($json['data'],100,500);



    //-----------------inset new head
 // $dataJsonCur=["data"=>[]];
  $dttm=date("Y-m-d H:i:s");
  $gameNo=date("His");
  $newJu=["gameRecord"=>"","addTime"=>$dttm,"countdownSeconds"=>30,"gameNo"=>$gameNo];
  array_insertHead($json['data'],$newJu);
  file_put_contents($f,json_encode($json,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));



  //-------------------------wait...secs
  sleep(45);



  //------------------save kaij rzt
  $json=file_get_contents_Asjson($f);
  $newJu['gameRecord']="3$0";
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