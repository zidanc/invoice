<?include_once "./common/base.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>發票清單</title>
</head>
<body>

<?php
include "./include/header.php";  


$sql="select * from `invoice`";
$rows=$pdo->query($sql)->fetchAll();


?>


</body>
</html>