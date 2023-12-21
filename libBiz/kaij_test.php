<?php
require_once __DIR__ . "/../libBiz/a_startEvt.php";
require_once __DIR__ . "/../libBiz/kaij_Evt.php";
$f = __DIR__ . "/../dbKaijSrc/kaijsrc.json";
require_once __DIR__ . "/../lib/file.php";
$json = file_get_contents_Asjson($f);

\trendpic_createTrendImageV2(\kaipanInfoCore());