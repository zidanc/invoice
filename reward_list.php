<?php include "./common/base.php";

$period=ceil(date("n")/2);

  $monthStr=[
    '1'=>"1,2月",
    '2'=>"3,4月",
    '3'=>"5,6月",
    '4'=>"7,8月",
    '5'=>"9,10月",
    '6'=>"11,12月"
  ];

  if(isset($_GET['period'])){
    $period=$_GET['period'];
  }

  $year=date("Y");
  if(isset($_GET['year'])){
    $year=$_GET['year'];
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
</head>

<body>
  <?php include "./include/header.php";
    
    $month=date("n");
    $period=round(($month/2),0);
    
    if(isset($_GET['period'])){
      $period=$_GET['period'];
    }

    $year=date("Y");
    if(isset($_GET['year'])){
      $year=$_GET['year'];
    }

  ?>  
<form class="yearswitch" action="reward_list.php?period=<?=$period;?>&year=<?=$year;?>">
  <select name="year">
    <option value="2020" <?=($year==2020)?"selected":null;?>>2020</option>
    <option value="2021" <?=($year==2021)?"selected":null;?>>2021</option>
    <option value="2022" <?=($year==2022)?"selected":null;?>>2022</option>
  </select>
  <input type="hidden" name="period" value=<?=$period;?>>
  <input type="submit" value="切換年份">
</form>

<?php
$table="reward_bonus";

$count=nums($table,['year'=>$year]);
$sum=all($table,['year'=>$year]);
$each=[];
foreach($sum as $oneary){
  $each[]=$oneary['reward'];   //print_r可以知道這樣寫法，其實還是一維陣列。
}

// array_sum($each); 

// echo array_sum($each);
// echo "<hr>";
// echo "<pre>";print_r($each);"</pre>";
// echo "<pre>";print_r($sum);"</pre>";

?>
<div class="period_item" style="font-size:1.5rem">西元<?=$year;?>全年，中獎發票共有<?=$count;?>張</div>
<?php
for ($period=1; $period <7 ; $period++) { 
  $countperperiod[]=nums($table,['year'=>$year,'period'=>$period]);
  echo "<div class='period_item'>第 ".$period." 期中 ".$countperperiod[($period-1)]."張</div>";
}
// echo "<pre>";print_r($countperperiod);"</pre>";

// $award_type_re=[
//   "10000000"=>"特別獎",
//   "2000000"=>"特獎",
//   "200000"=>"頭獎",
//   "40000"=>"二獎",
//   "10000"=>"三獎",
//   "4000"=>"四獎",
//   "1000"=>"五獎",
//   "200"=>"增開六獎"
// ];
// echo "<hr>";
// $reward=all($table,['year'=>$year,'period'=>$period]);
// echo "<pre>";print_r($reward);"</pre>";

?>


<div class="period_item" style="font-size:1.5rem">西元<?=$year;?>全年，中獎金額共新台幣<span style="color:red"><?=array_sum($each);?></span>元</div>

<p class="period_item">領獎期間請以財政部公布時間為準，別讓財神爺擦身而過</p>

</body>
</html>