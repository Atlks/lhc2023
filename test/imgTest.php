<?php


$outputPic="testpic.png";
 $cell_width = 600;
$cell_height = 600;
$img = imagecreatetruecolor($cell_width, $cell_height);

require_once "../lib/painLib.php";
$color = \getColor("white", $img);

imagefill($img, 0, 0, $color); //这里的 "0, 0"是指坐标, 使用体验就类似 Windows 系统"画图"软件的"颜料桶", 点一下之后, 在整个封闭区间内填充颜色


$center_x_ball = $cell_width / 2;
$center_y_ball = $cell_width / 2;
$width_ball = 400;
imagefilledellipse($img, $center_x_ball, $center_y_ball, $width_ball, $width_ball, \getColor("red", $img));

$rds= $width_ball/2;
$offset=($cell_width-$width_ball)/2;

//----------left side
$duiz_ball_wd = 70;
$duizBallX_ini=$center_x_ball-$rds ;  //ini pos
$duizBally_ini=$center_y_ball;  //ini pos
imagefilledellipse($img, $duizBallX_ini, $duizBally_ini, $duiz_ball_wd, $duiz_ball_wd, \getColor("blue", $img));
imagepng($img, $outputPic);


//-----------$lefttop
$offset=40;  //$duiz_ball_wd size not tkefk..
$smallBallX_lftTop=$center_x_ball-$rds/2-$offset;
$smallBallY_lfttop=$center_y_ball-$rds/2-$offset;

imagefilledellipse($img, $smallBallX_lftTop, $smallBallY_lfttop, $duiz_ball_wd, $duiz_ball_wd, \getColor("blue", $img));


imagepng($img, $outputPic);

//-------rt btm
$smallBallX_rtBtm=$center_x_ball+$rds/2+$offset;
$smallBallY_rtBtm=$center_y_ball+$rds/2+$offset;

imagefilledellipse($img, $smallBallX_rtBtm, $smallBallY_rtBtm, $duiz_ball_wd, $duiz_ball_wd, \getColor("blue", $img));


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