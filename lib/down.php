<?php
function download_copyMOde()
{
  copy('http://example.com/image.jpg', 'local/folder/flower.jpg');
}


function download_fl($urlimg,$outf)
{
  $urlimg_down=file_get_contents($urlimg);
  if(!$urlimg_down)
    return
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