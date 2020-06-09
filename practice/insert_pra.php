<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

// 新增資料:

// $sql="insert into `table` (`field1`,`field2`,`field3`) values('value1','value2','value3')"

// function insert($table,...$arg){ } 也可以這樣自定，但前提是你必須非常清楚該資料表有哪些欄位，這樣程式碼才好寫。

//只要資料表內不是可以null的或自動增值(如Auto Increment或Current TimeStamp)的欄位，都要求填資料進來。資料表欄目設定為varchar 或text，這邊陣列值就要加引號把它歸類為字串。
$data=[
  "code"=>'GH',       
  "number"=>'88666688',     //因為號碼0開頭的情況是實際存在的，所以此欄目類型不適合用integer數字來存，要用varchar字串類型。
  "period"=>4,
  "expend"=>10,
  "year"=>'2020'
]; 

// function insert($table,$arg){       //區域變數。
// // $sql="insert into $table (`id`,`code`,`number`,`period`,`expend`,`year`) values(null,'AA','01122335','2','120','2020')";
//   global $pdo;
//   $sql="insert into $table ";
//   foreach($arg as $key => $value){
//     $tmpK[]=$key;      //$tmpK[]的index=0的值對應$tmpV[]的index=0的值，等同於$sql語法的欄目名稱對應輸入值。
//     $tmpV[]=$value;
//   }
//     $str1=join("`,`",$tmpK);    //join();把陣列元素值用插入值連接起來，並輸出為字串。
//     $str2=join("','",$tmpV);

//     $sql=$sql. "(`".$str1."`) values('".$str2."')";

//   echo $sql;
//   return $pdo->exec($sql);
// }

// $table="invoice";
// insert($table,$data);


// 進化精簡程式碼：
$table="invoice";
echo insert($table,$data);    //可以不要寫echo，這邊寫echo 用意是看出$pdo->exec($sql)到底影響了幾筆，有沒有執行。

function insert($table,$arg){
  global $pdo;
  
  $sql="insert into $table (`".join("`,`",array_keys($arg))."`) values ('".join("','",$arg)."')";
  // echo $sql;
  return $pdo->exec($sql);
}

?>