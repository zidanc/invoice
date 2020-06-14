<?php include "./common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

  
  <?php include "./include/header.php";
  
  $year=date("Y");
  if(isset($_GET['year'])){
    $year=$_GET['year'];
  }
  
  $month=date("n");             //不用m而用n，是因為我們不想要有前導0，有可能會因為回傳是字串而出現問題。
  $period=round(($month/2),0);
  
  if(isset($_GET["period"])){
    $period=$_GET["period"];
  }
  ?>

<form action="list.php?period=<?=$period;?>&year=<?=$year;?>">    <!--？？？？為何切換年份按鈕按下，無法收到網址上已有的$period ？？？？ -->
  <select name="year">
    <option value="2020" <?=($year==2020)?"selected":null;?>>2020</option>
    <option value="2021" <?=($year==2021)?"selected":null;?>>2021</option>
    <option value="2022" <?=($year==2022)?"selected":null;?>>2022</option>
  </select>
  <input type="submit" value="切換年份">
</form>


  <?php
  echo "<p class='note'>此頁面為： ".$year." 年，第&nbsp;".$period."&nbsp;期</p>";
  
  ?>
  
  <h1>發票列表</h1>
  <ul class="nav">
    <li><a href="list.php?period=1&year=<?=$year;?>" style="background:<?=($period==1)?"lightgreen":"white";?>;">第一期(1,2月)</a></li>
    <li><a href="list.php?period=2&year=<?=$year;?>" style="background:<?=($period==2)?"lightgreen":"white";?>;">第二期(3,4月)</a></li>
    <li><a href="list.php?period=3&year=<?=$year;?>" style="background:<?=($period==3)?"lightgreen":"white";?>;">第三期(5,6月)</a></li>
    <li><a href="list.php?period=4&year=<?=$year;?>" style="background:<?=($period==4)?"lightgreen":"white";?>;">第四期(7,8月)</a></li>
    <li><a href="list.php?period=5&year=<?=$year;?>" style="background:<?=($period==5)?"lightgreen":"white";?>;">第五期(9,10月)</a></li>
    <li><a href="list.php?period=6&year=<?=$year;?>" style="background:<?=($period==6)?"lightgreen":"white";?>;">第六期(11,12月)</a></li>
  </ul>

  <?php
  
    // $sql="select * from `invoice` where period='$period'";
    $rows=all('invoice',['period'=>$period,'year'=>$year]);   //參數0是陣列的形式，中間不是","，是"=>"
  ?>
  
  <table>
    <tr>
      <td>編號</td>
      <td>標記</td>
      <td>號碼</td>
      <td>花費</td>
    </tr>
    
  
  
  <?php
  foreach ($rows as $row) {
  ?>  
  
  <tr>
      <td><?=$row['id'];?></td>
      <td><?=$row['code'];?></td>
      <td><?=$row['number'];?></td>
      <td><?=$row['expend'];?></td>
  </tr>
   
  

  <?php
  }
  ?> 
</table>
</body>
</html>