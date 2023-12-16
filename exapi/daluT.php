<?php

$records=["庄","庄","庄","闲","庄","庄"];
echo json_encode(spltToCols_dalu($records),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
function spltToCols_dalu(array $records) {
  $colss = [];

  $last = "庄";
  $curCol = [];
  foreach ($records as $rec) {


    //  $curCol = [];
    $rztGame = cvt_hz_rzt($rec);
    if ($rztGame == "和")
      continue;

    if ($rztGame == $last) {
      array_push($curCol, $rec);

    } else if ($rztGame != $last) {
      //now col add to col arr
      if (count($curCol) > 0)
        array_push($colss, $curCol);

      //new col  rest col
      $curCol = [];
      array_push($curCol, $rec);
    }

    $last = $rztGame;


  }


  if (count($curCol) > 0)
    array_push($colss, $curCol);
  return $colss;
}


function cvt_hz_rzt($rec)
{
  return $rec;
}