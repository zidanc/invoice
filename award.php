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
//獎別用1,2,3,4...看不太明瞭，因此建陣列暫時對應。後續兌獎，也利用此陣列當做小資料表，暫存在記憶體內。此陣列的延伸擴充與運用，是此題關鍵。
$award_type=[
  "1"=>["特別獎",1,8,10000000],
  "2"=>["特獎",2,8,2000000],
  "3"=>["頭獎",3,8,200000],
  "4"=>["二獎",3,7,40000],
  "5"=>["三獎",3,6,10000],
  "6"=>["四獎",3,5,4000],
  "7"=>["五獎",3,4,1000],
  "8"=>["六獎",3,3,200],
  "9"=>["增開六獎",4,3,200]
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
// echo "<pre>";print_r($awd_multi);"</pre>";
?>

<!-- 2.這期有哪些發票 -->
<table>
<?php
$invoice=all("invoice",["year"=>$_GET['year'],"period"=>$_GET['period']]);
foreach ($invoice as $value) {
  echo "<tr class='first'>";
    echo "<td>".$value['code']."</td>";
    echo "<td>".$value['number']."</td>";
    $inv[]=$value['number'];
  echo "</tr>";  
  
}

?>
</table>

<?php
// 3.一張一張的對。
$length=$award_type[$_GET['aw']]['2'];  //需要兌尾數幾碼
//針對增開六獎號，特別處理substr的開始位置。而且不能同樣套用同一$start變數，因為發票的起始位置，和增開六獎原本就只有三碼的起始位置不相同。
$start=8-$length;


foreach ($inv as $inv_value) {
  foreach ($awd_multi as $awd_value) {
    if (mb_substr($inv_value,$start,$length) == mb_substr($awd_value,$start,$length)){         //發票的尾部x碼，兌財政部獎號的尾部x碼。
      echo "<span style='color:red;font-size:1.5rem;'>".$inv_value."中獎了！</span>";
      echo "<br>";
    }else{
      echo "感謝";
    }
  }
}



?>



</body>
</html>