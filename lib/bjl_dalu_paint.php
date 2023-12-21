<?php




//DaluPicV2Test();
function DaluPicV2Test(){

  require_once __DIR__ . "/../libBiz/startEvt.php";
  $records= \kaipanInfoCore();
  $records = $records['data'];

  $perColRowsCnt = 6;
  require_once __DIR__ . "/../lib/arr.php";
  $records = array_reverse($records);
  if(noKaijRztInLastRec($records))
    array_pop($records);
  $records = array_slice($records, 0, 60);//meige paisywe zuida 60ge road map

  $withMain = 50;
  $css_lineHight = $withMain;
  $css_datawidth = $withMain;
  DaluPicV2($records,$withMain,$css_lineHight);


}
function DaluPicV2(array $records, int $withMain,   int $css_lineHight  ): void {
  $outf = __DIR__ . "/../public/trend_dalu.jpg";

  $font = __DIR__ . "/../public/msyhbd.ttc";
  $font_path = $font;
  var_dump($font_path);

  //echo $font;
  $font_title_size = 16;
  $font_size = 20;

  $img_elmt = array("element" => "canvas", "bkgrd" => "white", "width" => 40 * 50, "height" => (7+3) * 50);
  require_once __DIR__ . "/../lib/painLib.php";
  $img = renderElementCanvas($img_elmt);


  $records = dalu_setXY_dalu($records);

  //--------render row each
  $perColRowsCnt = 15;
  $lastBlkElmt = ['top' => 0, 'left' => 0, 'height' => 0];
  for ($rowIdx = 1; $rowIdx <= $perColRowsCnt; $rowIdx++) {
    // $row614['heigetRow_dalught']=$css_lineHight;
    $row615 = getRow_daluV2($rowIdx, $records, $withMain);
    $row615['top'] = $lastBlkElmt['top'] + $lastBlkElmt['height'];
    $row615['height'] = $css_lineHight;
    $row615['font'] = $font;
    $row615['font_size'] = $font_size;
    renderElementRowV3($row615, $img, $outf);
    //  imagepng($img, $outFile);
    $lastBlkElmt = $row615;

  }


//----th line
  $row614 = array("th_row" => "true", "left" => 0, 'bkgrd' => '', "padBtm" => 0, "top" => $lastBlkElmt['top'], 'font' => $font, 'font_size' => $font_size, 'height' => 1);

  $row614["childs"] = [];
  for ($i = 0; $i < 40; $i++) {

    $row614["childs"][] = array('txt' => "", 'width' => $withMain, 'height' => 1);
  }
  $row614['height'] = 1;
  $row614['width'] = calcRowWd($row614);
  renderElementRowV3($row614, $img, $outf);

  imagepng($img, $outf);
  echo "";
}

function getRow_daluV2(int $rowIdx, array $records, int $withMain) {

  $elmtWd=$withMain;
  $row614 = array("left" => 0, "row_btm_lineClr" => "gray", "padBtm" => 0);
  $row614["childs"] = [];

  if ($rowIdx == 4) {
    echo 2;
  }

  for($c=1;$c<=40;$c++)
  {
    $cell=getCell_dalu($records,$rowIdx,$c);
    if($cell!=null){
      list($win, $curClrTxt, $duiz) = calcTxtNclr($cell['gameRecord']);



      if ($cell['aftHe'] > 0)
        $cell['txt'] = $cell['aftHe'];
      else
        $cell['txt'] = "";
      $cell['color'] = "green";
      $cell['duiz'] = $duiz;

      if ($duiz == "庄对")
        $cell['lfttpClr'] = "red";
      if ($duiz == "闲对")
        $cell['rtBtmClr'] = "blue";
      if ($duiz == "庄闲对") {
        $cell['rtBtmClr'] = "blue";
        $cell['lfttpClr'] = "red";
      }
      $cell['bkgrd'] = $curClrTxt;
      $cell['shape'] = 'eklps';
      $cell['ballwidth'] = $elmtWd - 10;
      $cell['width'] = $elmtWd;  //50
      $cell['height'] = $cell['width'];
    }
    else if($cell==null)
    {
      $cell = [];
      $cell['txt'] = "";
      $cell['width'] = $withMain;  //50
      $cell['height'] = $cell['width'];
    }



    array_push($row614["childs"], $cell);

  }


  $row614['width'] = calcRowWd($row614);
  return $row614;


}

function dalu_getCell_dalu_longDrg(array $records, int $rowIdx, int $c) {

  if( $rowIdx>6)
    return  ["rowid"=>7]; //new cell
  foreach ($records as $rec) {
    if($rec['rowid']==$rowIdx && $rec['colid']==$c)
      return $rec;
  }

  return null;
}

function getCell_dalu(array $records, int $rowIdx, int $c) {

  foreach ($records as $rec) {
    if($rec['rowid']==$rowIdx && $rec['colid']==$c)
      return $rec;
  }

  return null;
}

function dalu_setXY_dalu(array $records) {
  $lastball=[];
  $lastball['rowid']=0;
  $lastball['colid']=0;
  $lastball['idclr']=0;
  $lastball['aftHe']=0;
  $lastCol=[];
  $lastCol['colid']=0;
  $arr911 = [];


  foreach ($records as $rec) {

    $rec['aftHe']=0;
    $rec = cvt_hz_rzt($rec);



    if ($rec['idclr'] == "green") {

      $lastball['aftHe'] = $lastball['aftHe'] + 1;
      //replace
      require_once "arr.php";
      array_replace_lastone($arr911,$lastball);

      continue;
    }

    if($rec['idclr']==$lastball['idclr'])
    {
      //move ball to undder lastball
      $rec['rowid']= $lastball['rowid']+1;  //per time next row
      $rec['colid']= $lastball['colid'] ;

      //长龙处理
      //if next cell used..right ext
      if($rec['rowid']==7)
        echo "dbg";
      $nextrowBall = dalu_getCell_dalu_longDrg($arr911, $rec['rowid'], $rec['colid']);
      if($nextrowBall!=null)
      {
        // if(   $rec['rowid']>6)
        //right move one cell
        $rec['rowid']=$lastball['rowid'];
        $rec['colid']=$lastball['colid'] +1;
      }

    }

    else
    {
      //another col new col

      $rec['rowid']= 1;  //per time next row
      $rec['colid']= $lastCol['colid']+1 ;
      $lastCol['colid']= $lastCol['colid']+1;

    }
    $lastball=$rec;



    array_push($arr911,$rec);

  }


  //adjust for start is green c lr
  $first=$arr911[0];
  if($first['rowid']==0 &&  $first['aftHe']>0)
  {
    //array_shift — 将数组开头的单元移出数组
    array_shift($arr911);
    $trueElmt=$arr911[0];
    $trueElmt['aftHe']= $trueElmt['aftHe']+$first['aftHe'];
    //rpls first elmt
    array_shift($arr911);
    array_unshift($arr911,$trueElmt);
  }

  return $arr911;


}


function noKaijRztInLastRec($records) {

  $last=end($records);
  if($last['gameRecord']=="")
    return true;
  else
    return  false;
}



//  lewis, [08/12/2023 2:27 pm]
//A$B 表示一个露珠，A:1 庄 2和 3闲 4 龙 5 龙虎的和 6 虎
// B:0无对 1 庄对 2 闲对 3 庄闲对

//比如这个3$0 就是 闲，0表示无对子
function cvt_hz_rzt($rec) {
  $rzt_Int = explode("$", $rec['gameRecord'])[0];
  $arr = [1 => "庄", 2 => "和", 3 => "闲"];
  $arr_idclr = [1 => "red", 2 => "green", 3 => "blue"];
  if(array_key_exists($rzt_Int,$arr))
  {
    $rec['rzt']=$arr[$rzt_Int];
    $rec['idclr']=$arr_idclr[$rzt_Int];
    return $rec;
  }

  else
  {
    $rec['rzt']="";
    $rec['idclr']="";
    return $rec;
  }

}


/**
 * //A$B 表示一个露珠，A:1 庄 2和 3闲 4 龙 5 龙虎的和 6 虎
 * //  B:0无对 1 庄对 2 闲对 3 庄闲对
 */
function calcTxtNclr($rzt) {


  $a = explode("$", $rzt);

  $win = "";
  $curClrTxtBkgrd = "";
  $duiz = "无对";

  $a = explode("$", $rzt);
  if ($rzt == "")
    return array($win, $curClrTxtBkgrd, $duiz);

  if ($a[0] == 1) {
    $win = "庄";

    $curClrTxtBkgrd = "red";
  }


  if ($a[0] == 2) {
    $win = "和";

    $curClrTxtBkgrd = "green";
  }

  if ($a[0] == 3) {

    $win = "闲";

    $curClrTxtBkgrd = "blue";
  }

  if ($a[1] == 1) {
    $duiz = "庄对";
  }
  if ($a[1] == 2) {
    $duiz = "闲对";
  }
  if ($a[1] == 3) {
    $duiz = "庄闲对";
  }

  return array($win, $curClrTxtBkgrd, $duiz);
}

