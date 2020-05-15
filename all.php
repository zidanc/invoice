<?php
include "base.php";

/**
 * "select * from $table ";
 * "select * from $table where ???='xxx'";
 * "select * from $table where ???='xxx' && ???='xxx' ....";
 * "select * from $table where ???='xxx' || ???='xxx' ....";
 * "select * from $table where ???='xxx' && ???='xxx' .... order by ??? ";
 * "select * from $table  order by ??? ";
 * "select * from $table  limit ??? ";
 * "select * from $table  where  ???  limit ";
 * "select * from $table ,(sub query)  where  ???  limit ";
 * 
 * all($table,...$arg)
 * $table =>資料表名
 * $arg[0]=>where 條件句
 * $arg[1]=>order by ,limit ,group by 條件句
 * $arg[2]=>FETCH 類別
 */

function all($table,...$arg){
    global $pdo;
    $sql="select * from $table ";
    
    if(isset($arg[0]) && is_array($arg[0])){
        $tmp=[];
        foreach($arg[0] as $key => $value){
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql." where " . implode(" && ",$tmp);
    }

    if(isset($arg[1])){
        $sql=$sql . $arg[1];
    }

    //echo $sql;

    return $pdo->query($sql)->fetchAll();
}

$rows=all('invoice');
foreach($rows as $row){
    echo $row['id'] ."-";
    echo $row['code'] ."-";
    echo $row['number'] ."-";
    echo $row['period'] ."-";
    echo $row['expend'] ;
    echo "<hr>";
}
echo "<p>有帶參數</p>";
$rows=all('invoice',["year"=>"2020","period"=>"1"]);
foreach($rows as $row){
    echo $row['id'] ."-";
    echo $row['code'] ."-";
    echo $row['number'] ."-";
    echo $row['period'] ."-";
    echo $row['expend'] ;
    echo "<hr>";
}
echo "<p>有帶三個參數</p>";
$rows=all('invoice',["year"=>"2020","period"=>"1"]," order by id desc");
foreach($rows as $row){
    echo $row['id'] ."-";
    echo $row['code'] ."-";
    echo $row['number'] ."-";
    echo $row['period'] ."-";
    echo $row['expend'] ;
    echo "<hr>";
}
echo "<p>不帶條件參數</p>";
$rows=all('invoice',""," order by id desc");
foreach($rows as $row){
    echo $row['id'] ."-";
    echo $row['code'] ."-";
    echo $row['number'] ."-";
    echo $row['period'] ."-";
    echo $row['expend'] ;
    echo "<hr>";
}

?>