<?php 

include "./common/base.php";

$res= save('invoice',$_POST);
  if($res==1){
    echo "更新成功";
    echo "<a href='list.php'>發票清單</a>";
  }else{
    echo "更新失敗";
  }

?>