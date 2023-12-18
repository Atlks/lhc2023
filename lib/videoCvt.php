<?php
$ffmpeg="C:/ffmpeg-2023-12-11-git-1439784ff0-essentials_build/bin/ffmpeg";
$cutSec=200;
$iptFlv="http://h1.66286662.net:8000/cg/cgvideo12_2.flv";
$output_mp4=__DIR__."/ot3501.mp4";
//能够解决大部分计算资源，速度等同于拷贝文件。
$cmd="$ffmpeg   -i $iptFlv -vcodec copy -acodec copy -t $cutSec $output_mp4";

echo $cmd."\r\n";


//vd2picMlt($ffmpeg,$iptFlv,__DIR__."/../vd/");

//$pipes = getPipes($cmd, $pipes);
//  exec ($cmd);

//fixVd($output_mp4,"fx.mp4");
die();

/**
 * @param string $cmd
 * @param $pipes
 * @return mixed
 */
function getPipes(string $cmd, $pipes) {
  $process = proc_open($cmd, array(), $pipes); //执行录屏命令

  $var = proc_get_status($process); //获取命令进程信息
  var_dump($var);
  $pid = intval($var['pid']) + 1;//pid就是进程ID，$var['pid']得到的ID比实际的少1
  sleep(7);

  $return_value = proc_close($process);
  var_dump($return_value);
  return $pipes;
}



 function fixVd($iptFlv,$output_mp4)
 {
   $ffmpeg="C:/ffmpeg-2023-12-11-git-1439784ff0-essentials_build/bin/ffmpeg";


   $cmd="$ffmpeg   -i $iptFlv -codec copy   $output_mp4";

   echo $cmd."\r\n";

  exec ($cmd);
 //  ffmpeg -i before.mp4 -codec copy after.mp4
 }


//:: 录屏命令 fail
//ffmpeg.exe
$output_mp4="scr.mp4";
$scrCmd="$ffmpeg  -f gdigrab -i desktop -c:v libx264 -r 8 -b:v 0.8M -minrate 0.4M -maxrate 2M -bufsize 4M -y -t $cutSec $output_mp4";
$scrCmd="$ffmpeg  -f gdigrab -i desktop  -f mp4  -t $cutSec $output_mp4";

echo "\r\n".$scrCmd.PHP_EOL;

//exec ($scrCmd);y

//  ffmpeg

//截取当前视频图片
$cmd="$ffmpeg -i $iptFlv   -frames:v 1 foobar.jpeg";
echo $cmd."\r\n";
//exec ($cmd);

//------------vd to mlt pic
//
function vd2picMlt($ffmpeg,$iptFlv,$dr)
{
  //ffmpeg  -t 1000  -i http://h1.66286662.net:8000/cg/cgvideo12_2.flv -f image2 -vf fps=9 -y  vd/%07d.jpg
//  $dr=__DIR__."/../vd/";
// %03d  格式%d  3位数..  相当于001.JPG
 // $cmd="$ffmpeg   -t 600 -r 5 -i $iptFlv -f image2 -vframes 500 -y $dr%03d.jpg";
  $cmd="$ffmpeg     -i $iptFlv -f image2 -vf fps=9 -y $dr%07d.jpg";

  echo $cmd."\r\n";
 exec ($cmd);
}



//MLT PIC TO VD   dft每秒25正，所以500张图片20s。。吧原来100s的视频截图拼接为20s秒
/**
 * @param $ffmpeg
 * @param $dr
 * @return void
 */
function mltpic2vd($ffmpeg, $picdr,$outf): void {
  $cmd = "$ffmpeg -f image2 -r 10 -i $picdr%07d.jpg  $outf";
  echo $cmd . "\r\n";
  exec($cmd);
}

mltpic2vd($ffmpeg, $dr);
