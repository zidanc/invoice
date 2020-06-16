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
  <h1>兌獎結果</h1>
<!-- Note:第幾獎、幾年、第幾期、對獎結果顯示在此頁面(利用網頁傳值過來的aw=X，撈不同的資料去兌該欄目的號碼，然後結果顯示在頁面)。 -->
<!-- <p style="color:green;margin-bottom:20px;color:darkgreen;">要小心若沒有什麼結果，會不會出現錯誤訊息。對獎功能你會發現很多重複的程式碼，將它做拆解，寫自定function可以省工。</p> -->

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
  to('award.php?year=2020&period=3');
  // echo "尚未選擇要對獎的獎別，請至<a href='invoice.php'>各期獎號</a>";
  // exit();
}

if(isset($_GET['aw'])){
  echo "<p>獎別： ".$award_type[$_GET['aw']]['0']."</p>";  
}else{
  echo "尚未選擇要對獎的獎別，請選擇各期獎號";
  exit();
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
$inv=[];
foreach ($invoice as $value) {
  echo "<tr class='first'>";
    echo "<td>".$value['code']."</td>";
    echo "<td>".$value['number']."</td>";
   
  echo "</tr>";  
  
}

?>
</table>

<?php
// 3.一張一張的對。兩次foreach迴圈，各將發票號碼與財政部獎號取出，然後判斷比對每一碼。


//針對增開六獎號，特別處理substr的開始位置。而且不能同樣套用同一$start變數，因為發票(共8碼)的起始位置，和增開六獎(共3碼)的起始位置不相同。
// if ($_GET['aw']!==9) {
//   $start=8-$length;      //？？？？這寫法有問題，知道錯在哪？？？？
// }else{                   雖然財政部的增開六獎這樣else後有修正正確，從0開始，取長度3碼。但自己的發票每一張依然是8碼，若從0開始，取長度3碼，這樣就不正確了。
//   $start=3-$length;
// }

// echo "財政部獎號";
// echo "<pre>";print_r($awd_multi);"</pre>";   //一維陣列。
// echo "自己的發票";
// echo "<pre>";print_r($inv);"</pre>";   //一維陣列。

$award_type_re=[
  "10000000"=>"特別獎",
  "2000000"=>"特獎",
  "200000"=>"頭獎",
  "40000"=>"二獎",
  "10000"=>"三獎",
  "4000"=>"四獎",
  "1000"=>"五獎"
];


$total_num=0;
$bonus=[];

foreach ($invoice as $inv) {
  
  foreach ($awd_multi as $awd_value) {
    $length=$award_type[$_GET['aw']]['2'];  //需要兌尾數幾碼
    $start=8-$length;

    if ($_GET['aw']!=9){
      $target_num=mb_substr($awd_value,$start,$length);
    }else{
      $target_num=$awd_value;
    }

    
    if(mb_substr($inv['number'],$start,$length) == $target_num){                        //發票的尾部x碼，兌財政部獎號的尾部x碼。
      $count=nums("reward_bonus",["year"=>$_GET['year'],"period"=>$_GET['period'],"number"=>$inv['number']]);    
      
      $bonus=[              //如果不採用兌中發票號碼存資料庫而只存進陣列的話，不存成二維陣列只用一維，這樣當下每一筆會洗掉之前的紀錄。
        "year"=>$inv['year'],
        "period"=>$inv['period'],
        "number"=>$inv['number'],
        "reward"=>$award_type[$_GET['aw']]['3'],
        "expend"=>$inv['expend']
      ];

        if($count == 0) {
            $table="reward_bonus"; 
            save($table,$bonus);

            echo "<span style='color:red;font-size:1.5rem;'>".$inv['number']."中".$award_type[$_GET['aw']]['0']."了！</span>";
            $total_num++;
            echo "<br>";

        }else{
            $table="reward_bonus";
            $inv_checked=find($table,["year"=>$inv['year'],"period"=>$inv['period'],"number"=>$inv['number']]);
            // echo "<pre>";print_r($inv_checked);"</pre>";
            echo "<span style='color:red;font-size:1.5rem;'>".$inv['number']."中過".$award_type_re[$inv_checked['reward']]."了！</span>";
        }
    }

        
    

  }
}
//147行，測試用的echo
// echo "<pre>";print_r($inv_value);"</pre>"; 
$total=$total_num*($award_type[$_GET['aw']]['3']);

?>

<div>
  <p>本期<?=$award_type[$_GET['aw']]['0'];?>中獎筆數： <?=$total_num;?> 張</p> 
  <p>本期<?=$award_type[$_GET['aw']]['0'];?>中獎總金額： <?=$total;?> 元</p> 


</div>

</body>
</html>