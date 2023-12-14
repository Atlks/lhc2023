<?php


$outputPic="rendcell.png";
 $img_width = 1000;
$canvas_height = 600;


require_once "../lib/painLib.php";




//-----------def row

$font_size = 20;
$font = __DIR__ . "/../public/msyhbd.ttc";
$css_datawidth=150;
  $css_lineHight=50;
$posY=0;

//---------------百家乐 hdrow
$row327 = array("left" => 0, 'th_row'=>'true','bkgrd' => 'gray', "padBtm" => 3, "top" => 0, 'font' => $font, 'font_size' => $font_size, 'height' => $css_lineHight ,"width"=>$img_width);
$cell1 = array('txt' => "百家乐NO." , 'id' => 'cell1', 'align' => 'left', 'padLeft' => 10, 'bkgrd' => "red", 'width' => 350, 'height' => $css_lineHight);
$cell_bank = array('txt' => '庄', 'tag' => 'th', 'align' => 'center', 'color' => "red", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
$cell_plyr = array('txt' => '闲', 'tag' => 'th', 'color' => "blue", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
$cell_bankDui = array('txt' => '庄对', 'tag' => 'th', 'color' => "red", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);
$cell_plyrDui = array('txt' => '闲对', 'tag' => 'th', 'color' => "blue", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);

$cell_he = array('txt' => '和', 'tag' => 'th', 'color' => "green", 'bkgrd' => "", 'width' => $css_datawidth, 'height' => $css_lineHight);

$row327["childs"] = [$cell1, $cell_bank, $cell_plyr, $cell_bankDui, $cell_plyrDui, $cell_he];


$row327['width']=calcRowWd($row327);

//-------------rend row
# 开始画图
// 创建画布
$img_elmt = array("element" => "canvas", "bkgrd" => "white", "width" => $row327['width'], "height" => $canvas_height);
$img = renderElementCanvas($img_elmt);
renderElementRowV3($row327, $img, $outputPic);


//----------------------百家乐 datarow1-----------
$lastRow=$row327;

for($i=0;$i<5;$i++)
{
  $row614 = array("top" => $lastRow['top']+ $lastRow['height'],"th_row" => "false", "left" => 0, 'bkgrd' => '', "padBtm" => 0,  'font' => $font, 'font_size' => $font_size, 'height' => $css_lineHight);
  $row614["childs"] = [

    array('txt' => "庄".$i, 'ballwidth' => 40, 'color' => "gray", 'shape' => 'ball',  'bkgrd' => "red", 'id' => 'cell1', 'align' => 'left', 'padLeft' => 10, 'width' => 350, 'height' => $css_lineHight),

  ];
  $row614['width']=calcRowWd($row614);
  $GLOBALS['dbg']=1;
  renderElementRowV3($row614, $img, $outputPic);
  $lastRow=$row614;
}










imagepng($img, $outputPic);


// cos
//
//b.x = a.xcos(angle) - a.ysin(angle)
//  b.y = a.xsin(angle) + a.ycos(angle)

//假设o点为圆心(原点0,0)，则有计算公式：
//
//b.x = a.xcos(angle) - a.ysin(angle)
//
//b.y = a.xsin(angle) + a.ycos(angle)
//
//其中顺时针旋转为正，逆时针旋转为负，角度angle是弧度值，如旋转30度转换为弧度为：angle = pi/180 * 30。