<?php

require_once __DIR__."/../lib/file.php";
//deldir(__DIR__."/../vd/");
$vddir=__DIR__."/../vd/";
$cmd="ffmpeg     -i http://h1.66286662.net:8000/cg/cgvideo12_2.flv -f image2 -vf fps=9 -y  $vddir%07d.jpg";
echo $cmd;
exec($cmd);