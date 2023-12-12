<?php


function array_sum_col($colName,array $a) {
  $records=  array_column($a, colName);
  return array_sum($records);
}


function in_array_rxChk(string $txt, array $arr_fmt) {

  $fnl=false;
  foreach ($arr_fmt as $itm) {
    if (empty($itm))
      continue;

    $p = '/^' . $itm . '$/iu';
    if (preg_match($p, $txt)) {
      $fnl=true;
    }

  }
  return $fnl;
}

//$f=__DIR__."/../dbKaijSrc/kaijsrc.json";
//require_once "file.php";
//$json=file_get_contents_Asjson($f);
//$rows=array_filterx($json['data'],function ($row){
//    $gameRecord=$row['gameRecord'];
//
//  $find = "3$";
//  if(startwithV1252($gameRecord,$find))
//      return true;
//});
//echo count($rows);

function startwithV1252($str,$pattern) {
  return (strpos($str,$pattern) === 0 )? true:false ;
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

