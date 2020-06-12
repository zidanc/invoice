<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

//查詢全部
function all($table,...$arg){
  global $pdo;         
  $sql="select * from $table ";
  
  if(isset($arg[0]) && is_array($arg[0])){
    $tmp=[];
    foreach($arg[0] as $key => $value){
      
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
        
    $sql=$sql." where ".join(" && ",$tmp);
  } 

  if(isset($arg[1])){
    $sql=$sql. " $arg[1]";
  }
  // echo $sql."<br>";
  return $pdo->query($sql)->fetchAll();
}

//查詢單筆
function find($table,$arg){
  global $pdo;
  if (is_array($arg)) {
    $tmp=[];      
    foreach($arg as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql="select * from $table where ".join(" && ",$tmp); 
    
  }else{
    $sql="select * from $table where `id`='$arg'";
  }
  // echo $sql;
  return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}


//刪除資料
function del($table,$arg){   
  global $pdo;
  $sql="delete from $table ";

  if (is_array($arg)) {
    $tmp=[];
    foreach ($arg as $key => $value) {
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql." where ".join(" && ",$tmp);
  }else{
    
    $sql=$sql." where `id`='$arg'";
  }
  // echo $sql;
  return $pdo->exec($sql);
}


//計算筆數
function nums($table,...$arg){
  global $pdo;
  $sql="select count(*) from $table ";
  
  if(isset($arg[0]) && is_array($arg[0])){
    $tmp=[];
    foreach($arg[0] as $key => $value){
      
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql." where ".join(" && ",$tmp);
  } 
  
  if(isset($arg[1])){
    $sql=$sql. " $arg[1]";
  }
  // echo $sql."<br>";
  return $pdo->query($sql)->fetchColumn(); 
}


//萬用查詢
function q($sql){
  
  global $pdo;
  echo $sql;
  return $pdo->query($sql)->fetchAll();

}


//新增或更新
function save($table,$arg){
  global $pdo;
  
  if(isset($arg['id'])){
    //更新
        
    foreach ($arg as $key => $value) {
      if($key!='id'){
        $tmp[]=sprintf("`%s`='%s'",$key,$value);
      }
    }
  
    $sql="update $table set ".join(",",$tmp)." where `id`='".$arg['id']."'" ;

  }else{
    //新增
       
    $sql="insert into $table (`".join("`,`",array_keys($arg))."`) values ('".join("','",$arg)."')";
    
  }
    echo $sql;
    return $pdo->exec($sql);
}


//頁面導向
function to($url){
  header("location:".$url);
}



?>