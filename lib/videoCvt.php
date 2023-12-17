<?php
$ffmpeg="C:/ffmpeg-2023-12-11-git-1439784ff0-essentials_build/bin/ffmpeg.exe";
$cutSec=5;
$iptFlv="http://h1.66286662.net:8000/cg/cgvideo12_2.flv";
$output_mp4="ot350.mp4";
//能够解决大部分计算资源，速度等同于拷贝文件。
$cmd="$ffmpeg -i $iptFlv -vcodec copy -acodec copy -t $cutSec $output_mp4";

echo $cmd."\r\n";

//exec ($cmd);


//:: 录屏命令
//ffmpeg.exe
$output_mp4="scr.mp4";
$scrCmd="$ffmpeg  -f gdigrab -i desktop -c:v libx264 -r 8 -b:v 0.8M -minrate 0.4M -maxrate 2M -bufsize 4M -y -t $cutSec $output_mp4";
$scrCmd="$ffmpeg  -f gdigrab -i desktop  -f mp4  -t $cutSec $output_mp4";

echo "\r\n".$scrCmd;

exec ($scrCmd);
