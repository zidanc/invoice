<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

//計算筆數
// $sql="select count(*) from table where xx='yy' && zz='aa'";
// $sql="select count(*) from table";         結構跟all()很像。
// $sql="select count(*) from table group by";

$total=nums("invoice");
echo $total;
echo "<hr>";

$total=nums("invoice",["period"=>2]);
echo $total;
echo "<hr>";

$total=nums("invoice",["period"=>2,"year"=>2021]);
echo $total;
echo "<hr>";

$total=nums("invoice",["period"=>2],"Group by year");   //會出問題，實際代入phpMyAdmin可以清楚看出。要正確，變成nums自定函式內容要稍微修改。fetchColumn()->fetchAll();
echo $total;
echo "<hr>";

$total=nums("invoice","","Group by year");      //會出問題，實際代入phpMyAdmin可以清楚看出。要正確，變成nums自定函式內容要稍微修改。fetchColumn()->fetchAll();
echo $total;                                    //我們要讓它完全沒有機會去判斷它是個陣列，所以直接用雙引號，空字串。
echo "<hr>";                      //寫空陣列會出問題，它的$sql:select count(*) from invoice where Group by year


function nums($table,...$arg){
  global $pdo;
  $sql="select count(*) from $table ";
  
  if(isset($arg[0]) && is_array($arg[0])){
    $tmp=[];
    foreach($arg[0] as $key => $value){
      
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql." where ".join(" && ",$tmp);
  } 
  
  if(isset($arg[1])){
    $sql=$sql. " $arg[1]";
  }
  echo $sql."<br>";
  return $pdo->query($sql)->fetchColumn();    //預設值index=0，也就是第一筆欄位的資料。
  // return $pdo->query($sql)->fetchColumn(2);   //索引值index=2，也就是第三筆欄位的資料。
}



?>