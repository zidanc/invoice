<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

// 更新資料語法: 首先，必須要有該筆資料，才能更新。 //乙級技術考試出現頻率最高是針對單一筆特定id，不是針對條件。
// $sql="update $table set `$field1`='$value1',`$field2`='$value2'";  //這樣的語法，是每一筆資料都這樣更新
// $sql="update $table set `$field1`='$value1',`$field2`='$value2' where id=X";
$sql="update $table set `$field1`='$value1',`$field2`='$value2' where `xx`='AA' && `yy`='BB'";

function update($table,$arg){     //更新中的變數$arg，一定是我們已經知道值的某筆資料。所以我們先把資料取入，再串成需要的$sql語法。
  global $pdo;
  $sql="update $table set";      
                                //認定要取入的某筆資料就是陣列型態。
  

  echo $sql;
  return $pdo->exec($sql);

}


?>