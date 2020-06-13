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

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <?php include "./include/header.php";?>
 
  <h1>期別</h1>
   
  <ul class="nav">
    <li><a href="invoice.php?period=1" style="background:<?=($period==1)?"lightgreen":"white";?>">1(1,2)</a></li>
    <li><a href="invoice.php?period=2" style="background:<?=($period==2)?"lightgreen":"white";?>">2(3,4)</a></li>
    <li><a href="invoice.php?period=3" style="background:<?=($period==3)?"lightgreen":"white";?>">3(5,6)</a></li>
    <li><a href="invoice.php?period=4" style="background:<?=($period==4)?"lightgreen":"white";?>">4(7,8)</a></li>
    <li><a href="invoice.php?period=5" style="background:<?=($period==5)?"lightgreen":"white";?>">5(9,10)</a></li>
    <li><a href="invoice.php?period=6" style="background:<?=($period==6)?"lightgreen":"white";?>">6(11,12)</a></li>
  </ul>
  <a href="add_lottery_number.php"><button>新增獎號</button></a>
  
  <?php
  $sp_num1=find('award_number',['period'=>$period,'year'=>$year,'type'=>1]);
  $sp_num2=find('award_number',['period'=>$period,'year'=>$year,'type'=>2]);
  $num1=all('award_number',['period'=>$period,'year'=>$year,'type'=>3]);
  $num2=all('award_number',['period'=>$period,'year'=>$year,'type'=>4]);
  ?>

  <table>
    <tr>
      <td>年月份</td>
      <td><?=$year;?>年 <?=$monthStr[$period];?></td>
      <td></td>
    </tr>
    <tr>
      <td rowspan=2>特別獎</td>
      <td class="lottery_number">
        <?php
          if(!empty($sp_num1['number'])){
            echo $sp_num1['number'];
          }
        ?>
      </td>
      <td rowspan=2>12</td>
    </tr>
    <tr>
      <td>同期統一發票收執聯8位數號碼，與特別獎號碼相同者，獎金1,000萬元</td>
    </tr>
    <tr>
      <td rowspan=2>特獎</td>
      <td class="lottery_number">
        <?php
          if(!empty($sp_num2['number'])){
            echo $sp_num2['number'];
          }
        ?>
      </td>
      <td rowspan=2>33</td>
    </tr>
    <tr>
      <td>同期統一發票收執聯8位數號碼，與特獎號碼相同者，獎金200萬元</td>
    </tr>
    <tr>
      <td rowspan=2>頭獎</td>
      <td><div>11</div><div>111</div><div>1111</div></td>
      <td rowspan=2>12</td>
    </tr>
    <tr>
      <td>同期統一發票收執聯8位數號碼，與頭獎號碼相同者，獎金20萬元</td>
    </tr>
    <tr>
      <td>二獎</td>
      <td>同期統一發票收執聯末7位數號碼，與頭獎中獎號碼末7位相同者，各得獎金4萬元</td>
      <td><a href="award.php?aw=4&year=<?=$year;?>&period=<?=$period;?>">對獎</a></td>
    </tr>
    <tr>
      <td>三獎</td>
      <td>同期統一發票收執聯末6位數號碼，與頭獎中獎號碼末6位相同者，各得獎金1萬元</td>
      <td><a href="award.php?aw=5&year=<?=$year;?>&period=<?=$period;?>">對獎</a></td>
    </tr>
    <tr>
      <td>四獎</td>
      <td>同期統一發票收執聯末5位數號碼，與頭獎中獎號碼末5位相同者，各得獎金4千元</td>
      <td><a href="award.php?aw=6&year=<?=$year;?>&period=<?=$period;?>">對獎</a></td>
    </tr>
    <tr>
      <td>五獎</td>
      <td>同期統一發票收執聯末4位數號碼，與頭獎中獎號碼末4位相同者，各得獎金1千元</td>
      <td><a href="award.php?aw=7&year=<?=$year;?>&period=<?=$period;?>">對獎</a></td>
    </tr>
    <tr>
      <td>六獎</td>
      <td>同期統一發票收執聯末3位數號碼，與頭獎中獎號碼末3位相同者，各得獎金2佰元</td>
      <td><a href="award.php?aw=8&year=<?=$year;?>&period=<?=$period;?>">對獎</a></td>
    </tr>
    <tr>
      <td>增開六獎</td>
      <td>
          <?php
              foreach($num4 as $num){
                echo $num['number']."<br>";
              }
          ?>
      </td>
      <td><a href="award.php?aw=9&year=<?=$year;?>&period=<?=$period;?>">對獎</a></td>
    </tr>
  </table>
</body>
</html>