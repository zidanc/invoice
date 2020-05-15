<?php

include_once "./common/base.php";

function del($table,$arg){
  global $pdo;
  $sql="delete from $table ";
  
  if(is_array($arg)){
      $tmp=[];
      foreach($arg as $key => $value){
          $tmp[]=sprintf("`%s`='%s'",$key,$value);
      }
      $sql=$sql." where " . implode(" && ",$tmp);
  }else{
      $sql=$sql." where `id` ='$arg'";
  }


  echo $sql;

  // return $pdo->exec($sql);
}

del('invoice',6);

?>