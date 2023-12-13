<?php
function calcTxtNclr($rzt) {
  $a = explode("$", $rzt);

  if ($a[0] == 1) {
    $win = "庄";

    $curClrTxtBkgrd = "red";
  }


  if ($a[0] == 2) {
    $win = "和";

    $curClrTxtBkgrd = "green";
  }

  if ($a[0] == 3) {

    $win = "闲";

    $curClrTxtBkgrd = "blue";
  }
  return array($win, $curClrTxtBkgrd);
}

