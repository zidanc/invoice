<?php

include_once "./common/base.php";

$table="invoice";


function find($table,$id){
  global $pdo;
  $sql="select * from $table where id='$id'";
  $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  if(empty($row)){
    return "無符合資料的內容";
  }
  return $row;
}

$row=find($table,1);
echo "<pre>";print_r($row);"</pre>";

$row['code']="ZZ";

update($table,$row);


function update($table,$arg){
    global $pdo;
    
    foreach($arg as $key => $value){
        $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }

    $sql="update $table set ".implode(',',$tmp)." where `id`='".$arg['id']."'";
    echo $sql;
    return $pdo->exec($sql);
}



?>