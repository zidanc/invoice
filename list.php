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
<!-- form標籤內若沒寫method屬性值，預設會是get。 -->
<form action="list.php?period=<?=$period;?>&year=<?=$year;?>">   <!--？為何切換年份按鈕按下，無法收到網址上已有的$period？ 解法，加一個hidden的input傳沒收到的值-->
  <select name="year">
    <option value="2020" <?=($year==2020)?"selected":null;?>>2020</option>
    <option value="2021" <?=($year==2021)?"selected":null;?>>2021</option>
    <option value="2022" <?=($year==2022)?"selected":null;?>>2022</option>
  </select>
  <input type="hidden" name="period" value=<?=$period;?>>
  <input type="submit" value="切換年份">
</form>


  <?php
  echo "<p class='note'>現在時刻為： ".date("Y")." 年 ".$month." 月，第&nbsp;".(round(($month/2),0))."&nbsp;期</p>";
  echo "<p class='note'>您所在位置為： ".$year." 年，第&nbsp;".$period."&nbsp;期</p>";
  
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
      <td>操作</td>
    </tr>
    
  
  
  <?php
  foreach ($rows as $row) {
  ?>  
  
  <tr>
      <td><?=$row['id'];?></td>
      <td><?=$row['code'];?></td>
      <td><?=$row['number'];?></td>
      <td><?=$row['expend'];?></td>
      <td>
        <!-- 如果label的for跟後方跟的標籤name一樣，這樣可以擴大可點選的範圍。 -->
        <label for="edit"><a href="edit_invoice.php?id=<?=$row['id'];?>">  
          <svg x="0px" y="0px" width="28.35px" height="28.351px" viewBox="0 0 28.35 28.351" enable-background="new 0 0 28.35 28.351" xml:space="preserve">
              <g><path fill="#8FBDFF" d="M24.18,0H4.17C1.87,0,0,1.87,0,4.171v20.01c0,2.3,1.87,4.17,4.17,4.17h20.01c2.301,0,4.17-1.87,4.17-4.17
              V4.171C28.35,1.87,26.48,0,24.18,0z M10.48,22.101H6.95v-3.53L17.35,8.171l3.531,3.529L10.48,22.101z M23.6,8.971l-1.719,1.72
              l-3.521-3.52l1.72-1.721c0.359-0.37,0.96-0.37,1.32,0l2.199,2.2C23.971,8.011,23.971,8.601,23.6,8.971z"/></g>
          </svg>
          </a></label>
        <label for="delete"><a href="delete_invoice.php?period=<?=$period;?>&year=<?=$year;?>&id=<?=$row['id'];?>">
          <svg x="0px" y="0px" width="28.34px" height="28.351px" viewBox="0 0 28.34 28.351" enable-background="new 0 0 28.34 28.351" xml:space="preserve">
              <g><path fill="#8FBDFF" d="M24.181,0H4.16C1.86,0,0,1.87,0,4.171v20.01c0,2.3,1.86,4.17,4.16,4.17h20.021c2.3,0,4.159-1.87,4.159-4.17
		          V4.171C28.34,1.87,26.48,0,24.181,0z M22.681,20.28l-2.4,2.4l-6.11-6.11l-6.1,6.11l-2.4-2.4l6.101-6.1L5.67,8.07l2.4-2.399
              l6.1,6.109l6.11-6.109l2.4,2.399l-6.11,6.11L22.681,20.28z"/></g>
          </svg>
        </a></label>
      </td>
  </tr>
   
  

  <?php
  }
  ?> 
</table>
</body>
</html>