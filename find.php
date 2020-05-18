<?php

include_once "./common/base.php";
include_once "save.php";
$table="invoice";

echo "<hr>"; 

function find($table,$arg){
  global $pdo;
  
  $sql="select * from $table";
  
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
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);  
  }



$row=find($table,15);
echo "<pre>";print_r($row);"</pre>";

$row=find($table,['code'=>'ab','year'=>'2020']);
echo "<pre>";print_r($row);"</pre>";

// 更新上方這一筆的部分欄目
$row['code']="CB";
$row['number']="12332122";

?>