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
<?php 

echo "<div class='con opt bor'>";

include "./common/base.php";
// echo "<pre>";print_r($_POST);"</pre>";
$res= save('invoice',$_POST);
  if($res==1){
    echo "更新成功";
    echo "<a href='list.php'>發票清單</a>";
  }else{
    echo "更新失敗 / 沒有影響任何筆資料";
  }

echo "</div>"

?>


  
</body>
</html>