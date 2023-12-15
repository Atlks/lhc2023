<?php

function getRowCells(int $rowIdx, array $colss, $f ): array {
  $a = [];

  if ($rowIdx == 4) {
    echo 2;
  }


  //gene row
  $colIdx = 1;
  foreach ($colss as $k => $col) {
    if ($rowIdx == 4 && $colIdx == 5)
      echo 3;
    //  echo "rowIdx" . $rowIdx . " colIdx" . $colIdx . "\r\n";
    if ($rowIdx >= count($col))
      break;
    $cell = $col[$rowIdx];
    if (!$cell)
      break;

    //todo biz code
    // $cell=$f($cell);

    $cell=$f($cell);



    array_push($a, $cell);
    $colIdx++;
  }


  return $a;
}



/**
 * @param $records
 * @return array
 */
function spltToCols($records,$perColRowsCnt): array {
  $records = array_reverse($records);

  $colss = [];
  // $perColRowsCnt = 6;

  while (true) {
    $curCol = array_slice($records, 0, $perColRowsCnt);
    if (count($curCol) == 0)
      break;
    array_push($colss, $curCol);
    require_once __DIR__ . "/../lib/queue.php";
    array_removeElmt($records, 0, $perColRowsCnt);

  }
  return $colss;
}
function array_key713(string $string, $v_cell) {
  if (!array_key_exists($string, $v_cell))
    return "";

  return $v_cell[$string];
}
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

