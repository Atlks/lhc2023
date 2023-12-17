<?php

//dep
fenpanBetLst(11);

echo "fini";
function fenpanBetLst($records) {

  var_dump(__METHOD__ . json_encode(func_get_args()));



  $records = file_get_contents("C:\\0prj\\lhc2023\\test\\ft_curDsk.json");
  $records = json_decode($records, true);
  $records = $records['data'];

  $log_txt = __METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


  // 数据
  $data = ["turn" => '期数', "result" => "         A   B    C   D   E", "sum" => "和", "zuhe" => "组合", 'limit' => "龙虎"];
  $row_x = ["turn" => '12345678', "result" => "a+b+c=102", "sum" => "22", "zuhe" => "组合", 'limit' => "龍"];

  $font = __DIR__ . "/../public/msyhbd.ttc";
  $font_path = $font;
  var_dump($font_path);

  //echo $font;
  $font_title_size = 16;
  $font_size = 20;
  // 标题长度
  //$this_title_box = imagettfbbox($font_size, 0, $font, $title);
  //$title_x_len = $this_title_box[2] - $this_title_box[0];
  $title_height = 40;

  // 每行高度
  $row_hight = $title_height - 10;
  $pre_title_w = [];
//  foreach ($data as $key => $value) {
//    $this_box = \imagettfbbox($font_size, 0, $font, $value);
//    $pre_title_w[$key] = $this_box[2] - $this_box[0];
//  }


  $text_x_len = 0;
  $pre_col_w = [];
  $pre_col_x = [];
//  foreach ($row_x as $key => $value) {
//    $this_box = \imagettfbbox($font_size, 0, $font, $value);
//    $pre_col_w[$key] = $this_box[2] - $this_box[0];
//    $text_x_len += $pre_col_w[$key];
//  }

  // 列数
  $column = 5;

  $title_height = 40;
  // 文本左右内边距
  $x_padding = 10;
  $y_padding = 10;
  // 图片宽度（每列宽度 + 每列左右内边距）
  $img_width = 500;
  // 图片高度（标题高度 + 每行高度 + 每行内边距）
  $img_height = 400;

  # 开始画图
  // 创建画布
  $img = imagecreatetruecolor($img_width, $img_height);

  # 创建画笔
  // 背景颜色（蓝色）
  $bg_color = imagecolorallocate($img, 10, 10, 10);
  $blue_color = imagecolorallocate($img, 10, 10, 255);
  $blue_color_half = imagecolorallocate($img, 100, 100, 255);
  // 表面颜色（浅灰）
  $surface_color = imagecolorallocate($img, 235, 242, 255);
  // 标题字体颜色（白色）
  $title_color = imagecolorallocate($img, 255, 255, 255);
  // 内容字体颜色（灰色）
  $text_color = imagecolorallocate($img, 0, 0, 0);

  $text_color_black = imagecolorallocate($img, 0, 0, 0);
  $green_color = imagecolorallocate($img, 100, 149, 237);

  // 大双为红色
  $big_2_color = imagecolorallocate($img, 255, 0, 0);
  // 小单为青色
  $small_1_color = imagecolorallocate($img, 100, 149, 237);
  // 无的颜色
  $null_color = imagecolorallocate($img, 125, 125, 125);
  // 对子
  $pair_color = imagecolorallocate($img, 10, 200, 10);
  // 顺子
  $_color = imagecolorallocate($img, 200, 134, 0);
  // 豹子
  $all_color = imagecolorallocate($img, 255, 0, 0);
  $box = imagettfbbox($font_size, 0, $font, "小");
  $big_small_with = $box[2] - $box[0];


  // 画矩形 （先填充一个大背景，小一点的矩形形成外边框）
  imagefill($img, 0, 0, $bg_color);  //背景颜色（蓝色）
  imagefilledrectangle($img, 0, 0, $img_width , $img_height , $surface_color);

  $x = 0;
  $title_x = 0;
  $intN = 0;
  foreach ($pre_col_w as $k => $col_x) {
//    $x += $x_padding * 2;
//    $x += $col_x;
//
//    $intN++;
//
//    //  break;
//    imageline($img, $x, $title_height, $x, $img_height, $bg_color);
//
//    $pre_col_x[$k] = $x;
//    //写入首行
//    imagettftext($img, $font_title_size, 0, $title_x + intval(($col_x + $x_padding * 2 - $pre_title_w[$k]) / 2), intval($title_height - $font_title_size / 2), $title_color, $font, $data[$k]);
//    $title_x += $col_x + $x_padding * 2;
  }
  $white_color = imagecolorallocate($img, 255, 255, 255);
  $red_color = imagecolorallocate($img, 255, 0, 0);
  $green_color = imagecolorallocate($img, 100, 149, 237);
  $blue_color = imagecolorallocate($img, 10, 10, 255);


  // 写入表格
  $temp_height = $title_height;

  imageline($img, 0, 3, 500, 3, $red_color);
//  imagettftext($img, $font_size, 0, 0 , 0+20 , $blue_color, $font, "我");


  $pos_x = 0;
  $pos_y = 0;
  $int_num = 1;
  $withMain=50;

  //这里已经打印了title n 竖线。。没有横线
  foreach ($records as $key => $record) {

//    if($int_num==1)
//      $pos_y = $pos_y + $withMain/2;
//    else
//      $pos_y = $pos_y + $withMain;



    if ($int_num % 6 == 0) {
      $pos_x = $pos_x + $withMain;
      $pos_y = 0;
      $linex = $pos_x;
      imageline($img, $linex, 0, $linex, $img_height, $bg_color);
    }
    $int_num++;

    if ($record['playerCount'] == $record['bankerCount']) {
      $win = "和";
      $curClr = $green_color;

    }


    if ($record['playerCount'] > $record['bankerCount']) {
      $win = "庄";
      $curClr = $red_color;
    } else {
      $win = "闲";
      $curClr = $blue_color;
    }


    //---------球球

    $elipse_height = $withMain-10;
    $elipse_width = $elipse_height;
    $color = $green_color;
    $pos_x_eclps=$pos_x+ $withMain/2;
    $pos_y_eclps=$pos_y+ $withMain/2;
    imagefilledellipse($img, $pos_x_eclps, $pos_y_eclps, $elipse_width, $elipse_height, $curClr);

    $font_baseline_y=$pos_y+$font_size+0+($withMain-$font_size)/2;
    $font_x=  $pos_x+($withMain-$font_size)/2-2;
    imagettftext($img, $font_size, 0, $font_x ,$font_baseline_y  , $white_color, $font, $win);


    // 画线 hengsye
    $lineY = $pos_y + $withMain;
    imageline($img, 0, $lineY, $img_width, $lineY, $bg_color);


    $pos_y=     $pos_y +$withMain;
  }

  imagepng($img, __DIR__ . "/../public/trend.jpg");
}
