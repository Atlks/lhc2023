<?php

function delFileV2(string $string) {
  try {
    unlink($string);
  } catch (\Throwable $e) {
    echo $e;
    // var_dump($e);
  }
}

function mkdirv3(string $d) {

  try{
    mkdir($d);
  }catch (\Throwable $e){
    var_dump($e);
  }
}

function fileCrtTime406(string $fullFil) {

  $a = filectime($fullFil);
  return date("Y-m-d H:i:s", $a);
}

function deldir($dir) {
  //先删除目录下的文件：
  $dh=opendir($dir);
  while ($file=readdir($dh)) {

    if($file!="." && $file!="..") {

      $fullpath=$dir."/".$file;

      if(!is_dir($fullpath)) {
        unlink($fullpath);
      } else {
        deldir($fullpath);// 递归
      }
    }
  }
  closedir($dh);

  // 删除空文件夹：递归
  if(rmdir($dir)) {
    return true;
  } else {
    return false;
  }
}

function file_get_contents_Asjson($f) {
  $t=file_get_contents($f);
  $json = json_decode($t, true);
  return $json;
}
function file_mov(string $filpath, string $dir_oked): void
{
    if (!file_exists($dir_oked))
        mkdir($dir_oked);

    $fil_basename = basename($filpath);
    rename($filpath, $dir_oked . $fil_basename);
}

function file_put_contentsx($file, $dt, $flg = FILE_APPEND) {


  try {
    var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));


    log23::info(__LINE__ . __METHOD__, "Arg", func_get_args());

    //检查是否有该文件夹，如果没有就创建，并给予最高权限
    if (!file_exists(dirname($file)))
      mkdir(dirname($file), 0777, true);
    file_put_contents($file, $dt, $flg);
  } catch (\Throwable $exception) {
    try {
      var_dump($exception);
      log23::err(__LINE__ . __METHOD__, "arg", func_get_args());
      log23::err(__LINE__ . __METHOD__, "e", $exception);

    } catch (\Throwable $exception2) {
      var_dump($exception2);
    }

  }


}

function file_get_contentsx($file)
{
    var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
    log23::info(__LINE__ . __METHOD__, "Arg", func_get_args());
    try {
        file_get_contents($file);
    } catch (\Throwable $exception) {
        var_dump($exception);
        log23::err(__LINE__ . __METHOD__, "arg", func_get_args());
        log23::err(__LINE__ . __METHOD__, "e", $exception);

    }

}

//function file_mov(string $filpath, string $dir_oked): void
//{
//    if (!file_exists($dir_oked))
//        mkdir($dir_oked);
//
//    $fil_basename=basename( $filpath);
//    rename($filpath, $dir_oked . $fil_basename);
//}