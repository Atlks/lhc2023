<?php


function appendElemt(array $e, array $lastElmt, $img) {


  //  hr   line  hengxian
  if ($e['elmtType'] == "line")
    \renderElmtLine($e, $img);

  if ($e['elmtType'] == "tr") {

    $e['top'] = $lastElmt['top'] + $lastElmt['height'];
    $e['left'] = $lastElmt['left'];
    \renderElementRow($e, $img);
  }

}

function renderElmtLine(array $e, $img) {

  $color = getColor($e['color'], $img);
  imageline($img, 0, $e['top'], 2000, $e['top'], $color);

}

//dep
function renderElementRow(array $row140, $img) {
  $posX = $row140["left"];

  $posY = $row140["top"];
  $cells = $row140['childs'];

  if (array_key_exists('bkgrd', $row140)) {
    $surface_color_row = getColor($row140['bkgrd'], $img);
    imagefilledrectangle($img, $posX, $posY, 2000, $posY + $row140['height'], $surface_color_row);

  }


  $idx = 0;
  foreach ($cells as $k => $v_cell) {

    $blktxt = $v_cell['txt'];
    //  if($idx>0)
    //   $posX = $posX + $v_cell['width'];


    // imagefilledrectangle

    if (array_key_exists('bkgrd', $v_cell)) {
      if ($v_cell['bkgrd'] != "") {
        $surface_color = getColor($v_cell['bkgrd'], $img);
        imagefilledrectangle($img, $posX, $posY, $posX + $v_cell['width'], $posY + $v_cell['height'], $surface_color);

      }


    }

    //— 绘制矩形并填充

    $font_baseline_y = $posY + $row140['height'] - ($row140['height'] - $row140["font_size"]) / 2;

    $font_x = calcFontX($v_cell, $posX, $row140["font_size"]);
    $font = $row140['font'];
    if (!array_key_exists('color', $v_cell))
      $v_cell['color'] = "black";
    imagettftext($img, $row140["font_size"], 0, $font_x, $font_baseline_y, getColor($v_cell['color'], $img), $font, $blktxt);
    //竖线。。。
    //todo th implt
    //if th then pain shuxian
    $line_posx = $posX + $v_cell['width'];
    imageline($img, $line_posx, 0, $line_posx, 2000, getColor($v_cell['color'], $img));


    $outputPic = __DIR__ . "/../res/betlist.jpg";
    imagepng($img, $outputPic);
    $idx++;
    $posX = $posX + $v_cell['width'];
  }
  $posY = $row140["top"] + $row140["height"];
  //title baes line
  renderElmtLine(array("top" => $posY, "color" => "red", "elmtType" => "line"), $img);

}


//dep
function              renderElementRowV2(array $row140, $img, $outputPic) {
  $posX = $row140["left"];

  $posY = $row140["top"];
  $cells = $row140['childs'];

  if (array_key_exists('bkgrd', $row140)) {
    $surface_color_row = getColor($row140['bkgrd'], $img);
    imagefilledrectangle($img, $posX, $posY, 2000, $posY + $row140['height'], $surface_color_row);

  }


  $idx = 0;
  foreach ($cells as $k => $v_cell) {

    $blktxt = $v_cell['txt'];
    //  if($idx>0)
    //   $posX = $posX + $v_cell['width'];


    //-------------bkgrd ---- imagefilledrectangle

    if (array_key_exists('bkgrd', $v_cell) && $v_cell['bkgrd'] != "") {

      $curClr = getColor($v_cell['bkgrd'], $img);

      if (array_key_exists('shape', $v_cell) && $v_cell['shape'] == 'ball') {

        $pos_x_eclps = $posX + $v_cell['width'] / 2;
        $pos_y_eclps = $posY + $v_cell['width'] / 2;
        imagefilledellipse($img, $pos_x_eclps, $pos_y_eclps, $v_cell['width'], $v_cell['height'], $curClr);

      } else {
        //df rect
        imagefilledrectangle($img, $posX, $posY, $posX + $v_cell['width'], $posY + $v_cell['height'], $curClr);

      }


    }


    //—-------td txt

    $font_baseline_y = $posY + $row140['height'] - ($row140['height'] - $row140["font_size"]) / 2;

    $font_x = calcFontX($v_cell, $posX, $row140["font_size"]);
    $font = $row140['font'];
    if (!array_key_exists('color', $v_cell))
      $v_cell['color'] = "black";
    imagettftext($img, $row140["font_size"], 0, $font_x, $font_baseline_y, getColor($v_cell['color'], $img), $font, $blktxt);


    if (getCellTagName($v_cell) == "th") {
      //竖线。。。
      //todo th implt
      //if th then pain shuxian
      $line_posx = $posX + $v_cell['width'];

      imageline($img, $line_posx, 0, $line_posx, 2000, getColor($v_cell['color'], $img));
    }

    imagepng($img, $outputPic);
    $idx++;
    $posX = $posX + $v_cell['width'];
  }
  //foreach row end



  //----------------hr line bottom
  $posY = $row140["top"] + $row140["height"];
  //title baes line
  renderElmtLine(array("top" => $posY, "color" => "black", "elmtType" => "line"), $img);
  imagepng($img, $outputPic);
  //end  renderElementRowV2

}


function getRowTagName($row) {

  if (array_key_exists('tag', $row)) {
    return $row['tag'];
  } else
    return "td";

}

function getCellTagName($v_cell) {

  if (array_key_exists('tag', $v_cell)) {
    return $v_cell['tag'];
  } else
    return "td";

}


function calcFontX($v_cell, $posX, $fontSize) {

  // if(!in_array('color',$v_cell))
  if (array_key_exists('align', $v_cell) && $v_cell['align'] == "left") {
    $font_x = $posX + $v_cell['padLeft'];
    return $font_x;
  } else {
    // deflt left
    $blktxt = $v_cell['txt'];
    $blktxtWidth = strlen($blktxt) / 2 * $fontSize;
    $font_x_deft_center = $posX + ($v_cell['width'] - $blktxtWidth) / 2 - 2;
    return $font_x_deft_center;
  }


}

function renderElementCanvas(array $elemt) {


  $img = imagecreatetruecolor($elemt['width'], $elemt['height']);


  $color = \getColor($elemt['bkgrd'], $img);

  imagefill($img, 0, 0, $color); //这里的 "0, 0"是指坐标, 使用体验就类似 Windows 系统"画图"软件的"颜料桶", 点一下之后, 在整个封闭区间内填充颜色
  return $img;
}

function getColor($clrname, $img) {
  $white = imagecolorallocate($img, 255, 255, 255);
  $pink = imagecolorallocate($img, 255, 20, 140);

  $text_color_black = imagecolorallocate($img, 0, 0, 0);
  $white_color = imagecolorallocate($img, 255, 255, 255);
  $red_color = imagecolorallocate($img, 255, 0, 0);
  $green_color = imagecolorallocate($img, 0, 255, 0);
  $blue_color = imagecolorallocate($img, 10, 10, 255);
  // 表面颜色（浅灰）
  $grayColor = imagecolorallocate($img, 235, 242, 255);
  $clrArr = array('pink' => $pink, "red" => $red_color, "white" => $white_color, "black" => $text_color_black, "green" => $green_color, "blue" => $blue_color, "gray" => $grayColor);
  if (!array_key_exists($clrname, $clrArr))
    return $clrArr["black"];


  return $clrArr[$clrname];

}

function delFile(string $string) {
  try {
    unlink($string);
  } catch (\Throwable $e) {
    echo $e;
    // var_dump($e);
  }
}

function getLuck6Amt($BetContent, float $bet) {
  if (str_delLastNumX($BetContent) == "幸运") {
    return $bet . "";
  } else
    return "0";
}

function getHeAmt($BetContent, float $bet) {
  if (str_delLastNumX($BetContent) == "和") {
    return $bet . "";
  } else
    return "0";
}

function getBankDuiAmt($BetContent, float $bet) {
  if (str_delLastNumX($BetContent) == "庄对") {
    return $bet . "";
  } else
    return "0";
}

function getPlayerDuiAmt($BetContent, float $bet) {

  if (str_delLastNumX($BetContent) == "闲对") {
    return $bet . "";
  } else
    return "0";
}

function getPlayerAmt($BetContent, float $bet) {

  if (str_delLastNumX($BetContent) == "闲") {
    return $bet . "";
  } else
    return "0";
}

function getBankAmt($BetContent, $bet) {
  if (str_delLastNumX($BetContent) == "庄") {
    return $bet . "";
  } else
    return "0";

}

function array_sum_col_inpainlib($colName, array $a) {
  $records = array_column($a, $colName);
  return array_sum($records);
}