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

function getKaijRztBjl($gameNo)
{
  $t=http_post("http://34.150.68.52:8080/user/login/submit","userName=test04&password=aaa111");
  $json = json_decode($t, true);
  $token=$json['data']['userInfo']['token'];
  $url="http://34.150.68.52:8080/api/baccarat/gameinfo";
  // $tok="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb2RlIjoidGVzdDA0IiwiYWRtaW5JZCI6MTk0MCwiZXhwIjoxNzAyMDMwMjU0fQ.tYHmlQQtnCiPzOOBBDjtzKjRmG0fWN6JjhWULfiDk-8";

  $t=http_post($url,"tableNo=8&token=".$token);
  $json = json_decode($t, true);
  $json['lottery_no']=$json['data'][0]['gameNo'];




  $seltedRow =  array_filter($json['data'],  function ($row) use ($gameNo) {

    if ($row['gameNo']==$gameNo)
      return true;


  });

  if ($seltedRow['playerCount'] == $seltedRow['bankerCount']) {
    $win = "和";
  }


  if ($seltedRow['playerCount'] >$seltedRow['bankerCount']) {
    $win = "庄赢";

  } else {
    $win = "闲赢";
  }
  return $win;
}