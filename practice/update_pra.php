<?php
include_once "../common/base.php";
// include_once "db_pra.php";



// 更新資料語法: 首先，必須要有該筆資料，才能更新。 //乙級技術考試出現頻率最高是針對單一筆特定id，不是針對條件。
// $sql="update $table set `$field1`='$value1',`$field2`='$value2'";  //這樣的語法，是該資料表每一筆資料都更新，因為沒有限制條件。
// $sql="update $table set `$field1`='$value1',`$field2`='$value2' where `xx`='AA' && `yy`='BB'";
// $sql="update $table set `$field1`='$value1',`$field2`='$value2' where `id`='X'";

$table="invoice";

$row=find($table,2);
echo "<pre>";print_r($row);"</pre>";

$row['code']="ZZ";
$row['expend']="350";
                          //原本第14行撈出來的資料是資料庫出來的，完全一模一樣代入update()不會有更動，所以第17行我們改了code=zz。
update($table,$row);     //mySQL若發現帶入的資料與原本資料庫中的該筆完全相同的話，它是不會去更動的，因為沒必要。這是好事，減少資料庫的操勞。

function update($table,$arg){     //更新中的變數$arg，一定是我們已經知道值的某筆資料。所以我們先把資料取入，再串成需要的$sql語法。
  global $pdo;
  
                                //認定要代入的某筆資料就是陣列型態。
    foreach ($arg as $key => $value) {
      if($key!='id'){               //$key鍵名稱不是id，我才做下列sprintf()合併。因為不需要$sql語法內，要更動的欄目值語句中出現id=X，因為我們更新一筆資料時，不該動id欄目的值。$sql語句當中只需要限制條件有id=X。
        $tmp[]=sprintf("`%s`='%s'",$key,$value);
      }
    }
  
  $sql="update $table set ".join(",",$tmp)." where `id`='".$arg['id']."'" ;

  // echo $sql;
  return $pdo->exec($sql);

}


?>