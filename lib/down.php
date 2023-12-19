<?php
function download_copyMOde()
{
  copy('http://example.com/image.jpg', 'local/folder/flower.jpg');
}

require_once __DIR__."/../lib/logx.php";
function download_fl($urlimg,$outf)
{
//  $GLOBALS['']

  log_enterMethV2(__METHOD__,func_get_args(),"downlog");
  $urlimg_down=file_get_contents($urlimg);
//  if(!$urlimg_down)
//    return
  file_put_contents($outf, $urlimg_down);
  return $outf;
 }


function download_flV2($urlimg,$outf)
{
  $urlimg_down=file_get_contents($urlimg);
  if(!$urlimg_down)
    return
    file_put_contents($outf, $urlimg_down);
  return $outf;
}