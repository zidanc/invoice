<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

// 根據需求：乙級考題分析後，最常用這兩支：//乙級裡的第二參數，如果它不是陣列，它就是id。如果它不是id，它就是陣列。
// $sql="delete from `table` where `id`='cc'";
// $sql="delete from `table` where `xx`='aa' && `yy`='bb'";

del("invoice",7);
// echo "<br>";
// del("invoice",["id"=>2]);
// echo "<br>";
// del("invoice",["period"=>4,"code"=>'AA']);


function del($table,$arg){        // ,...$arg是代表可以沒有第二參數。del($table,$arg)這樣寫是此自定函式一定要兩個參數。
  global $pdo;
  $sql="delete from $table ";

  if (is_array($arg)) {
    $tmp=[];
    foreach ($arg as $key => $value) {
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql." where ".join(" && ",$tmp);
  }else{
    
    $sql=$sql." where `id`='$arg'";
  }
  echo $sql;
  return $pdo->exec($sql);

}






?>