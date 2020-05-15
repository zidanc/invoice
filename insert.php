<?php

include_once "./common/base.php"

$data=[
  "code"=>"AA",
  "number"=>"78784545",
  "period"=>1,
  "expend"=>30,
  "year"=>"2020"
];


function insert($table,$arg){
  $sql="insert into ";
  
  foreach($arg as $key => $value){
    $tmpK[]=$key;
    $tmpV[]=$value;
  }

$str1="(`".implode("`,`",$tmpK)."`)";
$str2="('".implode("','",$tmpV)."')";

$sql=$sql.$str1." VALUES ".$str2;

echo $sql;
return $pdo->exec($sql);
}

?>