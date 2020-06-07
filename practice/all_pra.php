<?php
include "../common/base.php";


function select($table,...$arg){        //,... 這樣子若函式只有$table此一變數，而沒有後方限制條件，還是能執行且不會報錯。
  global $pdo;
  $sql="select * from $table ";
  
  if(isset($arg[0]) && is_array($arg[0])){      //isset需要先寫，讓程式判斷若第二變數不存在就不進行。若先寫is_array，它會去判斷是否是陣列，然後找不到index=0回報警告訊息。
    $tmp=[];
    foreach($arg[0] as $key => $value){
      // $tmp=$tmp."`".$key."`='".$value."'"." && ";  //不好的方式。
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    // ※※樣版： $sql= select * from $table where  `period`='2' && `year`='2020';
    // $tmp=rtrim($tmp," && ");  //不好的方式。
    
    $sql=$sql." where ".join(" && ",$tmp);
  }                                         //不用else，才不會有不是這個，就一定要做另外一個的情況。
                                      //不用else，這樣才可以並行。
  if(isset($arg[1])){
    $sql=$sql. $arg[1];
  }
  echo $sql."<br>";
  return $pdo->query($sql)->fetchAll();
}

$rows=select("invoice");

foreach($rows as $row){
  echo $row['id']."-";
  echo $row['code']."-";
  echo $row['number']."-";
  echo $row['period']."-";
  echo $row['expend'];
  echo "<hr>";
}

echo "<p>有帶兩組以上的參數</p>";
$rows=select("invoice",["period"=>'2',"year"=>'2020']);

foreach($rows as $row){
  echo $row['id']."-";
  echo $row['code']."-";
  echo $row['number']."-";
  echo $row['period']."-";
  echo $row['expend'];
  echo "<hr>";
}

echo "<p>有帶兩組以上的參數，第三組是限制條件中的字串</p>";
$rows=select("invoice",["period"=>'2',"year"=>'2020']," Order by `id` DESC");

foreach($rows as $row){
  echo $row['id']."-";
  echo $row['code']."-";
  echo $row['number']."-";
  echo $row['period']."-";
  echo $row['expend'];
  echo "<hr>";
}

echo "<p>有帶兩組以上的參數，沒有第二組where語句</p>";
// $rows=select("invoice",[]," Order by `id` DESC");    //第二組寫空陣列會出問題，它的$sql:select * from invoice where Order by `id` DESC
$rows=select("invoice",""," Order by `id` DESC");  //我們要讓它完全沒有機會去判斷它是個陣列，所以直接用雙引號，空字串。
foreach($rows as $row){
  echo $row['id']."-";
  echo $row['code']."-";
  echo $row['number']."-";
  echo $row['period']."-";
  echo $row['expend'];
  echo "<hr>";
}


?>