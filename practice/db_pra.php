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
echo "<p style='font-size:0.6rem;color:#CCC;'>&dollar;sql寫法跟del的&dollar;sql很像，若考試時間需要，可以取用來修改</p>";

function find($table,$arg){      //如果是寫find($table,...$arg)，這樣第二個參數、第三個參數一定是併成一個二維陣列顯示。然後若這樣寫，程式第77行會因為二維陣列foreach出來第一個$key是0，所以$sql的限制條件會變成`0`=''。
  global $pdo;
  if (is_array($arg)) {
    $tmp=[];          //PHP因為很鬆散的語言，所以可以不用先宣告，但正常嚴謹點是要的。
    foreach($arg as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql="select * from $table where ".join(" && ",$tmp); 
    
  }else{
    $sql="select * from $table where `id`='$arg'";
  }
  echo $sql;
  // $rows=$pdo->query($sql);
  // $array=$rows->fetch(PDO::FETCH_ASSOC);    //測試: 當資料表中有同樣的三筆資料的情況下，一筆一筆fetch，讓 pointer移動。
  // $array=$rows->fetch(PDO::FETCH_ASSOC);
  // $array=$rows->fetch(PDO::FETCH_ASSOC);
  // return $array;
  return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

$table="invoice";
$data=[
  "code"=>'wv',
  "year"=>'2021'
];
// $data=5;

$row=find($table,$data);
echo "<pre>";print_r($row);"</pre>";

$row=[
  "id"=>'15',
  "code"=>'XX',
  "number"=>'11112222',
  "period"=>3,
  "expend"=>22,
  "year"=>'2021'
];

// $row['code']='YY';  若要存值，這方式比較快，可以直接針對你要的欄目修改。若是寫第103行~110行來存值，要每個欄目都寫，不然比如你只寫4個欄目，存值後原本6個欄目的會剩下4個欄目。

echo "<br>";
echo save($table,$row);


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
    // echo $sql;
    return $pdo->exec($sql);
}

?>