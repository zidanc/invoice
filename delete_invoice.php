<?php
include_once "./common/base.php";

// echo "<pre>";print_r($_GET);"</pre>";
if(isset($_GET['id'])){
  del('invoice',$_GET['id']);
  to("list.php?period=$_GET[period]&year=$_GET[year]");
}else{
  to("list.php?period=$_GET[period]&year=$_GET[year]");
}
//試試刪除鈕新增AJAX，提示是否真的要刪除。
//畫面上既有的發票，要失敗基本上不可能，所以我想要增加刪除失敗等警示字樣，加了也沒機會顯示出來。

?>