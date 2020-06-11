<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

$table="invoice";
//新增&更新這兩種陣列代值的寫法都可以。
$data=find($table,11);
// 新增   
$data['code']="EF";
$data['number']="77443333";
$data['period']=4;
$data['expend']=70;
$data['year']="2021";

// 更新
// $data=[
//   "id"=>11,
//   "code"=>"WV",
//   "number"=>"12345678",
//   "year"=>"2021"

// ];

save($table,$data);



function save($table,$arg){
  global $pdo;
  
  if(isset($arg['id'])){          //有指定id欄位的陣列資料，就是要套用更新function。新增function的陣列中，不會有id欄位值，因為資料表自動增值。
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

//因為此檔案不是採用include "../base.php"，(因為base檔內已有find Function，再取名相同名稱find是不行的)，所以這邊沒用include方式，得再貼一次。
function find($table,$id){        
  global $pdo;
  $sql="select * from `$table` where `id`='$id'";   //程式這樣寫有個風險，就是你輸入的id號碼，資料庫也一定要有該id。不然會出現錯誤訊息。
  // return $pdo->query($sql)->fetch();                //find自定函式是只取特定一筆，所以用fetch()即可。
  $info=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  if (empty($info)) {
    return "無符合的這筆資料";    //當$id是不存在資料庫的，就返回此字串給find函式，因此第34行若找的$id是不在資料庫的，此時$row就會是存取該句字串。
  }                             //然後35行就會出錯，因為當$row是拿到字串時，怎麼會有陣列形式可以呼叫出來顯示呢，是吧。
                              //return特性：函式中的return一旦執行，其下方的行數就不會再去跑了。所以42一旦成立return返回了43行資訊給find函式，46就不會去跑了。
  // echo "<pre>";print_r($info);"</pre>";
  return $info;
}



?>