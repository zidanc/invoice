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

  $month=date("n");     //不用m而用n，是因為我們不想要有前導0，有可能會因為回傳是字串而出現問題。
  $period=round(($month/2),0);
  echo "目前當前月份為：第&nbsp;".$period."&nbsp;期<br>";
  
  if(isset($_GET["period"])){
    $period=$_GET["period"];
  }
  ?>
  
  <h1>發票列表</h1>
  <ul class="nav">
    <li><a href="list.php?period=1" style="background:<?=($period==1)?"lightgreen":"white";?>;">第一期(1,2月)</a></li>
    <li><a href="list.php?period=2" style="background:<?=($period==2)?"lightgreen":"white";?>;">第二期(3,4月)</a></li>
    <li><a href="list.php?period=3" style="background:<?=($period==3)?"lightgreen":"white";?>;">第三期(5,6月)</a></li>
    <li><a href="list.php?period=4" style="background:<?=($period==4)?"lightgreen":"white";?>;">第四期(7,8月)</a></li>
    <li><a href="list.php?period=5" style="background:<?=($period==5)?"lightgreen":"white";?>;">第五期(9,10月)</a></li>
    <li><a href="list.php?period=6" style="background:<?=($period==6)?"lightgreen":"white";?>;">第六期(11,12月)</a></li>
  </ul>

  <?php
  
    // $sql="select * from `invoice` where period='$period'";
    $rows=all('invoice',['period'=>$period]);   //參數0是陣列的形式，中間不是","，是"=>"
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