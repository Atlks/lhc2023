<?php

//kaij timeout

$shouldEndTimestmp=  strtotime("+480 seconds",strtotime($GLOBALS['addTime']));
$shdEndtime=date("Y-m-d H:i:s",$shouldEndTimestmp);
if( $shdEndtime<date("Y-m-d H:i:s"))
  break;