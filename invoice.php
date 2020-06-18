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
    if(isset($_GET['period'])){
      $period=$_GET['period'];
    }else{
      $period=round(($month/2),0);
    }
  ?>  

  <form class="yearswitch" action="invoice.php?period=<?=$period;?>&year=<?=$year;?>" method="get">    <!--？？？？為何切換年份按鈕按下，無法收到網址上已有的$period ？？？？ -->
    <select name="year">
      <option value="2020" <?=($year==2020)?"selected":null;?>>2020</option>
      <option value="2021" <?=($year==2021)?"selected":null;?>>2021</option>
      <option value="2022" <?=($year==2022)?"selected":null;?>>2022</option>
    </select>
    <input type="hidden" name="period" value="<?=$period;?>">
    <input type="submit" value="切換年份">
  </form>

  <?php
    echo "<p class='note'>目前當前月份為：第&nbsp;".round(($month/2),0)."&nbsp;期，</p>";
    echo "<span class='note'>要 ";
    if($month%2==0 && $month!=12){
      echo ($month+1)."月 25日才會開獎喔！";
    }else if($month%2==1 && $month!=11){
      echo ($month+2)."月 25日才會開獎喔！";
          }else{
            echo "明年 1月 25日才會開獎喔！";
          }
    echo "</span>";
    
    
    if(isset($_GET["period"])){
      $period=$_GET['period'];
    }
  ?>

  <h1>期別</h1>
   
  <ul class="nav">
    <li><a href="invoice.php?period=1&year=<?=$year;?>" style="background:<?=($period==1)?"lightgreen":"white";?>">第一期(1,2月)</a></li>
    <li><a href="invoice.php?period=2&year=<?=$year;?>" style="background:<?=($period==2)?"lightgreen":"white";?>">第二期(3,4月)</a></li>
    <li><a href="invoice.php?period=3&year=<?=$year;?>" style="background:<?=($period==3)?"lightgreen":"white";?>">第三期(5,6月)</a></li>
    <li><a href="invoice.php?period=4&year=<?=$year;?>" style="background:<?=($period==4)?"lightgreen":"white";?>">第四期(7,8月)</a></li>
    <li><a href="invoice.php?period=5&year=<?=$year;?>" style="background:<?=($period==5)?"lightgreen":"white";?>">第五期(9,10月)</a></li>
    <li><a href="invoice.php?period=6&year=<?=$year;?>" style="background:<?=($period==6)?"lightgreen":"white";?>">第六期(11,12月)</a></li>
  </ul>
  <div class="button_layout"><a href="add_lottery_number.php"><button class="yearswitch">新增獎號</button></a></div>
  
  <?php
  $sp_num1=find('award_number',['period'=>$period,'year'=>$year,'type'=>1]);
  $sp_num2=find('award_number',['period'=>$period,'year'=>$year,'type'=>2]);
  $num1=all('award_number',['period'=>$period,'year'=>$year,'type'=>3]);
  $num2=all('award_number',['period'=>$period,'year'=>$year,'type'=>4]);
  ?>

  <div>
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
      <td rowspan=2><a href="award.php?aw=1&year=<?=$year;?>&period=<?=$period;?>"><div class="award_button">對獎</div></a></td>
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
      <td rowspan=2><a href="award.php?aw=2&year=<?=$year;?>&period=<?=$period;?>"><div class="award_button">對獎</div></a></td>
    </tr>
    <tr>
      <td>同期統一發票收執聯8位數號碼，與特獎號碼相同者，獎金200萬元</td>
    </tr>
    <tr>
      <td rowspan=2>頭獎</td>
      <td class="lottery_number">
        <div>
          <?php
            if(!empty($num1)){
              foreach ($num1 as $value) {
                echo $value['number']."<br>";
              }
            }
          ?>
        </div>
      </td>
      <td rowspan=2><a href="award.php?aw=3&year=<?=$year;?>&period=<?=$period;?>"><div class="award_button">對獎</div></a></td>
    </tr>
    <tr>
      <td>同期統一發票收執聯8位數號碼，與頭獎號碼相同者，獎金20萬元</td>
    </tr>
    <tr>
      <td>二獎</td>
      <td>同期統一發票收執聯末7位數號碼，與頭獎中獎號碼末7位相同者，各得獎金4萬元</td>
      <td><a href="award.php?aw=4&year=<?=$year;?>&period=<?=$period;?>"><div class="award_button">對獎</div></a></td>
    <!-- 這邊欲網址傳值到award.php的$_GET['aw']，即使改成$_GET['type']，讓名稱與award_number資料表內的type欄目名稱一樣，也還是跟資料表的type是不同的意義。 -->
    <!-- 要準備用$sql語法存值到資料庫前的那個陣列Key名稱，才是與資料庫type對應的命名。-->            
  </tr>
    <tr>
      <td>三獎</td>
      <td>同期統一發票收執聯末6位數號碼，與頭獎中獎號碼末6位相同者，各得獎金1萬元</td>
      <td><a href="award.php?aw=5&year=<?=$year;?>&period=<?=$period;?>"><div class="award_button">對獎</div></a></td>
    </tr>
    <tr>
      <td>四獎</td>
      <td>同期統一發票收執聯末5位數號碼，與頭獎中獎號碼末5位相同者，各得獎金4千元</td>
      <td><a href="award.php?aw=6&year=<?=$year;?>&period=<?=$period;?>"><div class="award_button">對獎</div></a></td>
    </tr>
    <tr>
      <td>五獎</td>
      <td>同期統一發票收執聯末4位數號碼，與頭獎中獎號碼末4位相同者，各得獎金1千元</td>
      <td><a href="award.php?aw=7&year=<?=$year;?>&period=<?=$period;?>"><div class="award_button">對獎</div></a></td>
    </tr>
    <tr>
      <td>六獎</td>
      <td>同期統一發票收執聯末3位數號碼，與頭獎中獎號碼末3位相同者，各得獎金2佰元</td>
      <td><a href="award.php?aw=8&year=<?=$year;?>&period=<?=$period;?>"><div class="award_button">對獎</div></a></td>
    </tr>
    <tr>
      <td>增開六獎</td>
      <td class="lottery_number">
          <?php
              if (!empty($num2)){
                foreach($num2 as $num){
                  echo $num['number']."<br>";
                }
              }
          ?>
      </td>
      <td><a href="award.php?aw=9&year=<?=$year;?>&period=<?=$period;?>"><div class="award_button">對獎</div></a></td>
    </tr>
  </table>
</body>
</html>