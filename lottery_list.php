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
    if(isset($_GET['period'])){
      $period=$_GET['period'];
    }else{
      $period=round(($month/2),0);
    }
  ?>  








</body>
</html>