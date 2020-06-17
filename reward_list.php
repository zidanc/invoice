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
<form action="reward_list.php?period=<?=$period;?>&year=<?=$year;?>">
  <select name="year">
    <option value="2020" <?=($year==2020)?"selected":null;?>>2020</option>
    <option value="2021" <?=($year==2021)?"selected":null;?>>2021</option>
    <option value="2022" <?=($year==2022)?"selected":null;?>>2022</option>
  </select>
  <input type="hidden" name="period" value=<?=$period;?>>
  <input type="submit" value="切換年份">
</form>
    







</body>
</html>