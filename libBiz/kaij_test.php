<?php
require_once __DIR__ . "/../libBiz/startEvt.php";
require_once __DIR__ . "/../libBiz/kaijEvt.php";
$f = __DIR__ . "/../dbKaijSrc/kaijsrc.json";
require_once __DIR__ . "/../lib/file.php";
$json = file_get_contents_Asjson($f);

\createTrendImageV2(\kaipanInfoCore());