<?php



function getBlsByU($uid) {

  $rows = \think\facade\Db::name('user')->where('Tg_id', '=', $uid)
    ->select();
  return $rows[0]['Balance'] / 100;
}