<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=invoice";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

echo "<h2>all()</h2>";
// 顯示此陣列的方式 1：
// print_r(all('invoice'));

// 顯示此陣列的方式 2：
$rows=all("invoice");
foreach($rows as $row){
  echo "發票號碼：".$row['number']."-"."花費".$row['expend']."元<br>";
}


function all($table){
  global $pdo;
  $sql="select * from `$table`";
  // echo $sql;
  return $pdo->query($sql)->fetchAll();
  
}
//＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
echo "<h2>find()</h2>";
 
// print_r(find("invoice",2));
// echo "<pre>";print_r(find("invoice",2));"</pre>";   //印不存在的id預期有錯誤訊息，但因為我是顯示陣列，所以它顯示空陣列給我，不會有錯誤訊息。
echo find1("invoice",2)['number']."<br>";            //若是印不存在的id的資訊，它會顯示錯誤訊息。

// echo "<hr>";

$row=find1("invoice",4);     //若第41行變數取名$row。第34行的$row和第45行的$row仍是不相同的，因為function find(){ }內的是區域變數。
if(is_array($row)){
  echo $row['code']."-".$row['number']."-".$row['expend'];        //所以，重點是要return，就可以取返回的值。
}else{
  echo $row;
}

function find1($table,$id){        
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

//＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
echo "<h2>to()</h2>";

// to("index.php");    //最直接用法

// if(isset($_GET['to'])){    //運作解析用法
//   to("index.php");
// }

function to($url){
  header("location:".$url);
}

// echo "<a href='?to=haha'>to自定函式運作解析</a>"
//＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
echo "<h2>find()自定函式，程式碼擴增限制條件</h2>";
echo "<p>&dollar;sql寫法跟del的&dollar;sql很像所以取用來修改</p>";




?>