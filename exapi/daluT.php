<?php



echo date("Y-m-d H:i:s",strtotime("-20 seconds"));



$records = [["rzt" => "庄","id"=>11], ["rzt" => "庄","id"=>22],
  ["rzt" => "和"], ["rzt" => "闲"]];
echo json_encode(spltToCols_dalu($records), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
function spltToCols_dalu(array $records) {
  $colss = [];
  $colss[] = [];// last ===colss[last][lst]

  foreach ($records as $rec) {

    $rec['aftHe']=0;
    $lastCol = &$colss[count($colss) - 1];
    if( count($lastCol)==0)
    {
      //fisrt
      array_push($lastCol, $rec);

      continue;
    }
    $lastBall = &$lastCol[count($lastCol) - 1];
    if($lastBall==null)
      echo 1;


    //  $curCol = [];
    $rec = cvt_hz_rzt($rec);
    if ($rec['rzt'] == "和") {

      $lastBall['aftHe'] = $lastBall['aftHe'] + 1;

      continue;
    }


    if ($rec['rzt'] == $lastBall['rzt']) {
      array_push($lastCol, $rec);

    } else if ($rec['rzt'] != $lastBall['rzt']) {
      //now col add to  cols arr

      array_push($colss, []);
      $lastCol = &$colss[count($colss) - 1];
      $lastCol[] = $rec;

    }


  }


  return $colss;
}


function cvt_hz_rzt($rec) {
 // $rec['aftHe']=0;
  return $rec;
}