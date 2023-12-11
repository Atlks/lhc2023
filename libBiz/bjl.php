<?php


function betstrX__compare_dwijyo_bjl($betContext, $kaij_num)
{
 $bet= str_delNum($betContext);

 $win=str_replace("赢",'',$kaij_num);
 if($bet==$win)
   return true;
 else
   return  false;
}
