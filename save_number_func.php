<?php
include "./common/base.php";

echo "<pre><p>還沒轉換的原始傳值</p>";print_r($_POST);"</pre>"; //前頁form表單submit傳值過來以method="post"。所以這頁會以$_POST收到，而且還是陣列形式。

/*
年份->year  ，需要轉中華民國年為西元年，以防有人輸入錯誤。
期數->period
特別獎->sp_num1
特獎->sp_num2
頭獎->num1 二維陣列型式，可能有多筆。
增開六獎->num2 二維陣列型式，可能有多筆，而且只有三碼。
*/

/*
這支程式尚未完成：
檢查輸入的長度、格式、是否真的有輸入。
*/


$table="award_number"; 

$year=$_POST['year'];
if (!empty($year)){
    if ($year<date("Y")) {
      $year=$year+1911;
    }
}

$period=$_POST['period'];
$data=[];

$sp_num1=$_POST['sp_num1'];
$data=[
  "year"=>$year,
  "period"=>$period,
  "number"=>$sp_num1,
  "type"=>1
];
  save($table,$data);


$sp_num2=$_POST['sp_num2'];
$data=[
  "year"=>$year,
  "period"=>$period,
  "number"=>$sp_num2,
  "type"=>2
];
save($table,$data);

$num1=$_POST['num1'];
foreach($num1 as $num){
  $data=[
  "year"=>$year,
  "period"=>$period,
  "number"=>$num,
  "type"=>3
  ];
  // echo "<pre>";print_r($data);"</pre>";
  save($table,$data);      //每一次迴圈都要存起來所以寫在迴圈裡面，不然寫在外面會只存多筆的最後一筆，前面的都被最後一筆洗掉。
}

$num2=$_POST['num2'];
foreach($num2 as $num){
  $data=[
  "year"=>$year,
  "period"=>$period,
  "number"=>$num,
  "type"=>4    //type採用分4種，而非採用頭獎三組號碼，每一組又拆成8,7,6,5,4,3碼共6種，這樣每一期就會讓資料表產生3*6+特別1+特1+增開3=23種type。久遠來說，23種比採用4種的type方式，更造成資料庫負擔!
  ];
  // echo "<pre>";print_r($data);"</pre>";
  save($table,$data);
}
to('invoice.php')
?>