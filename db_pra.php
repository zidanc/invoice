<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

echo "<h2>all()</h2>";
// 顯示此陣列的方式 1：
// print_r(all('invoice'));

// 顯示此陣列的方式 2：
$rows=all("invoice");
foreach($rows as $row){
  echo "發票號碼：".$row['number']."-"."花費".$row['expend']."元<br>";
}


function all($table){
  global $pdo;
  $sql="select * from `$table`";
  // echo $sql;
  return $pdo->query($sql)->fetchAll();
  
}
//＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
echo "<h2>find()</h2>";

// print_r(find("invoice",2));
// echo "<pre>";print_r(find("invoice",2));"</pre>";   //印不存在的id預期有錯誤訊息，但因為我是顯示陣列，所以它顯示空陣列給我，不會有錯誤訊息。
echo find("invoice",2)['number']."<br>";            //若是印不存在的id的資訊，它會顯示錯誤訊息。

// echo "<hr>";

$row=find("invoice",4);     //第34行的$row和第41行的$row是不相同的，因為function find(){ }內的是區域變數。
echo $row['code']."-".$row['number']."-".$row['expend'];        //所以，重點是要return，就可以取返回的值。

function find($table,$id){        
  global $pdo;
  $sql="select * from `$table` where `id`='$id'";   //程式這樣寫有個風險，就是你輸入的id號碼，資料庫也一定要有該id。不然會出現錯誤訊息。
  return $pdo->query($sql)->fetch();                //find自定函式是只取特定一筆，所以用fetch()即可。
  // $row=$pdo->query($sql)->fetch();
  // return $row;
}



?>