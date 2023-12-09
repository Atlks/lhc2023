<?php


function array_sum_col(colName,array $a) {
  $records=  array_column($a, colName);
  return array_sum($records);
}