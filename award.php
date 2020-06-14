<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <?php 
    include "./include/header.php";
    include "./common/base.php"
  ?>
  <h1>兌獎</h1>
  <p style="color:darkgreen;">Note:第幾獎、幾年、第幾期、對獎結果顯示在此頁面(利用網頁傳值過來的aw=X，撈不同的資料去兌該欄目的號碼，然後結果顯示在頁面)。</p>
  <p style="color:green;">要小心若沒有什麼結果，會不會出現錯誤訊息。對獎功能你會發現很多重複的程式碼，將它做拆解，寫自定function可以省工。</p>

  <p style="margin-bottom:20px;color:darkgreen;">開發邏輯：1.撈出獎號 2.這期有哪些發票 3.一張一張的對。</p>
<?php
//獎別用1,2,3,4...看不太明瞭，因此建陣列暫時對應。
$award_type=[
  "1"=>["特別獎",1],
  "2"=>["特獎",2],
  "3"=>["頭獎",3],
  "4"=>["二獎",3],
  "5"=>["三獎",3],
  "6"=>["四獎",3],
  "7"=>["五獎",3],
  "8"=>["六獎",3],
  "9"=>["增開六獎",4]
];

if(empty($_GET)){
  echo "尚未選擇要對獎的獎別，請至<a href='invoice.php'>各期獎號</a>";
  exit();
}

if(isset($_GET['aw'])){
  echo "<p>獎別： ".$award_type[$_GET['aw']]['0']."</p>";  
}

$year=date("Y");
if (isset($_GET['year'])) {
  echo "<p>年份： ".$_GET['year']."</p>";  
}else{
  echo "<p>年份： $year</p>";  
}

$period=round(date("n")/2,0);
if (isset($_GET['period'])) {
  echo "<p>期別： ".$_GET['period']."</p>";  
}else{
  echo "<p>期別： $period</p>";  
}

// echo "<pre>";print_r($award_type);"</pre>";

//1.撈出財政部獎號
//你也可以不管三七二十一，不判斷前一頁是要針對有多組號碼的獎項、還是只有單一號碼的獎項做兌獎，
//全部用all()出來二維陣列，然後foreach去撈獎號。

$awd_nums=nums("award_number",["type"=>$award_type[$_GET['aw']]['1'],"year"=>$_GET['year'],"period"=>$_GET['period']]);

echo "<h3>對獎獎號：</h3>";
$awd_multi=[];
if($awd_nums>0){
  $awd_number=all("award_number",["type"=>$award_type[$_GET['aw']]['1'],"year"=>$_GET['year'],"period"=>$_GET['period']]);
  foreach ($awd_number as $value) {
    echo "<span class='awd_number'>".$value['number']."</span>";
    $awd_multi[]=$value['number'];
  }
}
// echo "<pre>";print_r($awd_number);"</pre>";
?>

<!-- 2.這期有哪些發票 -->
<table>
<?php
$invoice=all("invoice",["year"=>$_GET['year'],"period"=>$_GET['period']]);
foreach ($invoice as $value) {
  echo "<tr class='first'>";
    echo "<td>".$value['code']."</td>";
    echo "<td>".$value['number']."</td>";
  echo "</tr>";

}

?>
</table>




</body>
</html>