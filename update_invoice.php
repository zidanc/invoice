<?php 

include "./common/base.php";
// echo "<pre>";print_r($_POST);"</pre>";
$res= save('invoice',$_POST);
  if($res==1){
    echo "更新成功";
    echo "<a href='list.php'>發票清單</a>";
  }else{
    echo "更新失敗 / 沒有影響任何筆資料";
  }

?>