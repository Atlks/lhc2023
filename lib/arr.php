<?php


function array_sum_col($colName,array $a) {
  $records=  array_column($a, colName);
  return array_sum($records);
}

function array_filterx($arr,$f)
{

  $seltedRow = [];
//  array_filter($json['data'],  function ($row) use ($gameNo,$seltedRow) {
//
//    if ($row['gameNo']==$gameNo)
//    {
//      $seltedRow[]=$row;
//      return true;
//    }
//    //  return true;
//
//   // return  false;
//
//
//  });


  foreach ($arr as $k => $row) {
    if ($f($row))
    {
      $seltedRow[]=$row;

    }
  }
  return $seltedRow;
}

