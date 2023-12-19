<?php


  $outf="C:\\0prj\\lhc2023\\lib\/..\/vdNow\/20231219_173418\/z20sec.mp4";
$picdr="C:\\0prj\\lhc2023\\lib\/..\/vdNow\/20231219_173418";
$cmd = "ffmpeg -f image2 -r 10 -i $picdr%d.jpg  $outf";
echo $cmd . "\r\n";
exec($cmd);