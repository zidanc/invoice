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
include "./common/base.php";


// 應該要先檢查輸入的資料是否符合格式等等：
// $period=htmlspecialchars() slash() str_replace() trim($_POST['period']);

// $sql語法內的順序不用跟資料庫內的該資料表相同。只要程式`欄位表格`和'輸入值'前後有順序對應就可以。
// $sql="insert into invoice(`period`, `year`, `code`, `number`, `expend`) values('".$_POST['period']."', '".$_POST['year']."', '".$_POST['code']."', '".$_POST['number']."', '".$_POST['expend']."')";

// $sql="insert into invoice(`period`, `year`, `code`, `number`, `expend`) values('$_POST[period]', '$_POST[year]', '$_POST[code]', '$_POST[number]', '$_POST[expend]')";

//   echo $sql;
  
// $data=[        這可以省略不寫，是因為在當初index.php使用的name與欄位的命名一樣，所以$_POST進來時，不需要重複指定一次。
//   'period'=>$_POST['period'],
//   'year'=>$_POST['year'],
//   'code'=>$_POST['code'],
//   'number'=>$_POST['number'],
//   'expend'=>$_POST['expend'],
// ];

echo "<div class='con opt bor'>";
  $res= save('invoice',$_POST);     //$_POST從index.php送值(新增一發票)過來，$_POST本身就是陣列型態了，所以可以這樣寫。
  if($res==1){
    echo "新增成功";
    echo "<a href='index.php'>輸入發票</a>";
    echo "<a href='list.php'>發票清單</a>";
  }else{
    echo "新增失敗";
  }

echo "</div>"

  ?>


  
</body>
</html>