<!-- ID=<form action="?" method="get">
  <input type="number" name="id" id="">
  <input type="submit" value="送出">
</form> -->

<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,'root',"");
date_default_timezone_set("Asia/Taipei");
session_start();

$rows=all('invoice');

foreach($rows as $row){
  echo $row["number"]. "-" .$row["expend"]."<br>";
}


function all($table){
  global $pdo;
  $sql="select * from $table";
  $rows=$pdo->query($sql)->fetchAll();
  return $rows;       
  // return是執行到此行，後面的程式就不會繼續進行了。
}
echo "<hr>";
?>
<h4>從invoice表單中取出特定id的資料。</h4>


<?php

$rows=find('invoice',7);
// echo "ID".$id."<br>";

if(is_array($row)){
  echo $row["number"]."<br>";
  echo $row["expend"];
}else{
  echo $row;
}

function find($table,$id){
  global $pdo;
  $sql="select * from $table where `id`='$id'";
  $row=$pdo->query($sql)->fetch();
  if(empty($row)){
    return "無符合資料的內容";
  }
  return $row;
  
}

?>