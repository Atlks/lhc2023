<?php



echo date("Y-m-d H:i:s",strtotime("-20 seconds"));



$records = [["idclr" => "red","id"=>11], ["idclr" => "red","id"=>22],
  ["idclr" => "green"], ["idclr" => "blue"]];
echo json_encode(spltToCols_dalu($records), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
function spltToCols_dalu(array $records) {

//  $dsnGrid=getgrid();
//  $curPntGridRowid=1;
//  $curPntGridColid=1;
  $lastball=[];
  $lastball['rowid']=0;
  $lastball['colid']=0;
  $lastball['idclr']=0;
  $colss = [];


  foreach ($records as $rec) {

    $rec['aftHe']=0;
    $rec = cvt_hz_rzt($rec);



    if ($rec['idclr'] == "green") {

      $lastball['aftHe'] = $lastball['aftHe'] + 1;

      continue;
    }

    if($rec['idclr']==$lastball['idclr'])
    {
      //move ball to undder lastball
      $rec['rowid']= $lastball['rowid']+1;  //per time next row
      $rec['colid']= $lastball['colid'] ;

    }

    else
    {
      //another col new col
      $rec['rowid']= 1;  //per time next row
      $rec['colid']= $lastball['colid']+1 ;

    }
    $lastball=$rec;


    array_push($colss,$rec);

  }


  return $colss;
}

function getgrid() {

  $rowMax=6;$colMax=40;
  $table=array();
  for($i=1;$i<=$rowMax;$i++)
  {
    $row=["rowid"=>"r".$i,"cells"=>[]];
    for($colIdx =1;$colIdx<=$colMax;$colIdx++){
        $cell=["cellid"=>$colIdx,"rowidx"=>$i,"colidx"=>$colIdx];

      array_push($row['cells'],$cell);
    }
    array_push($table,$row);
  }
  return $table;
}


function cvt_hz_rzt($rec) {
 // $rec['aftHe']=0;
  return $rec;
}