<?php


function retry($f) {

  for ($i = 0; $i < 3; $i++) {
    try {
      $f();
      break;
    } catch (Throwable $e) {
      var_dump($e);
    }
  }


}

function retry_forever($f) {

  while (true) {

    try {
      $f();
      sleep(1);
    } catch (Throwable $e) {
      var_dump($e);
    }

  }
}