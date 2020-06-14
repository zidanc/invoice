<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <?php include "./include/header.php";?>
  <h1>兌獎</h1>
  Note:第幾獎、幾年、第幾期、對獎結果顯示在此頁面(利用網頁傳值過來的aw=X，撈不同的資料去兌該欄目的號碼，然後結果顯示在頁面)。
  要小心若沒有什麼結果，會不會出現錯誤訊息。對獎功能你會發現很多重複的程式碼，將它做拆解，寫自定function可以省工。
<?php
//獎別用1,2,3,4...看不太明瞭，因此建陣列暫時對應。
$award_type=[
  1=>["特獎",],
  2=>["特別獎",],
  3=>["頭獎",],
  4=>["二獎",],
  5=>["三獎",],
  6=>["四獎",],
  7=>["五獎",],
  8=>["六獎",3],
  9=>["增開六獎",4]
]

?>

</body>
</html>