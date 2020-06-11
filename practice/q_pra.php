<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

//萬用自定函式，將你寫的$sql代入。縱使是insert/update原本是使用exec($sql)，也還是能正常運作。只是它fetchAll()出來是沒有資訊的。
//用在限制條件中，出現類似大於小於範圍需求的。
function q($sql){
  
  global $pdo;
  echo $sql;
  return $pdo->query($sql)->fetchAll();

}



// $rows=q("select * from `invoice` where `period`='2' && `year`='2020'");
// $rows=q("select * from `invoice` where `id`='14'");
// echo "<pre>";print_r($rows);"</pre>";
// echo "<br>";
// echo $rows['2']['number'];

//如果values前方不寫欄位名稱，那後方的代值就必須按照資料表欄位項目以及順序，如實一個個填寫。
// $rows=q("insert into `invoice` values(null,'CC','66991122','4','15','2021')");
// echo "<pre>";print_r($rows);"</pre>";

// $rows=q("delete from `invoice` where `id`='15'");

?>