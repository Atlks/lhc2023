<?php

/**
 * 百家乐兑奖规则bjl dwij ruler
 * @param $betContext
 * @param $kaij_num
 * @return bool
 */
function betstrX__compare_dwijyo_bjl($betContext, $kaij_num) {
  $bet = str_delNum($betContext);

  if ($bet == "庄" && $kaij_num[0] == "庄赢")
    return true;

  if ($bet == "闲" && $kaij_num[0] == "闲赢")
    return true;
  if ($bet == "和" && $kaij_num[0] == "和")
    return true;

  if (in_array("庄对", $kaij_num))
    return true;
  if (in_array("闲对", $kaij_num))
    return true;

  //$win=str_replace("赢",'',$kaij_num);
  if (in_array($bet, $kaij_num))
    return true;
  else
    return false;
}
