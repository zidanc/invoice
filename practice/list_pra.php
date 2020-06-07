<?php include_once "../common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>發票清單</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
include "../include/header.php";  

$month=date("n");
$period=ceil($month/2);

echo "目前當前月份為第"."&nbsp;".$period."期<br>";

if(isset($_GET['period'])){
  $period=$_GET['period'];
}

$rows=found("invoice",3);

function found($table,$period){
  global $pdo;
  $sql="select * from `$table` where `period`='$period'";
  $info=$pdo->query($sql)->fetchAll();
  if(empty($info)){
    return "沒有輸入/當前期別的發票資訊。";
  }
  return $info;
}
// echo $sql;
// $rows=$pdo->query($sql)->fetchAll();
?>

<ul>
  <li><a href="list_pra.php?period=1" style="background:<?=($period==1)?'lightgreen':'white';?>;">第一期(1,2月)</a></li>
  <li><a href="list_pra.php?period=2" style="background:<?=($period==2)?'lightgreen':'white';?>;">第二期(3,4月)</a></li>
  <li><a href="list_pra.php?period=3" style="background:<?=($period==3)?'lightgreen':'white';?>;">第三期(5,6月)</a></li>
  <li><a href="list_pra.php?period=4" style="background:<?=($period==4)?'lightgreen':'white';?>;">第四期(7,8月)</a></li>
  <li><a href="list_pra.php?period=5" style="background:<?=($period==5)?'lightgreen':'white';?>;">第五期(9,10月)</a></li>
  <li><a href="list_pra.php?period=6" style="background:<?=($period==6)?'lightgreen':'white';?>;">第六期(11,12月)</a></li>
</ul>



<?php
foreach ($rows as $row) {
?>
<table>
  <tr>
    <td>編號</td>
    <td>標記</td>
    <td>號碼</td>
    <td>花費</td>
    <td></td>
  </tr>
  <tr>
    <td><?=$row['id'];?></td>
    <td><?=$row['code'];?></td>
    <td><?=$row['number'];?></td>
    <td><?=$row['expend'];?></td>
    <td></td>
  </tr>
</table>


<?php
}
?>




</body>
</html>