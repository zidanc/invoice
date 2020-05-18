<?php

include_once "./common/base.php";


// $data=[
//     "code"=>"FG",
//     "number"=>"98182327",
//     "period"=>4,
//     "expend"=>70,
//     "year"=>"2020"
// ];

// save('invoice',$data);

// $row=find("invoice",14);
// $row['code']="EN";
// $row['period']="1";
// $row['number']="96271266";

// save('invoice',$row);


function save($table,$arg){
    global $pdo;
    if(isset($arg['id'])){
        //update
        foreach($arg as $key => $value){
            if($key!='id'){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
        }
    
        $sql="update $table set ".implode(',',$tmp)." where `id`='".$arg['id']."'";
    }else{
        //insert

        $sql="insert into $table (`".implode("`,`",array_keys($arg))."`) values('".implode("','",$arg)."')";
    }

    echo $sql;
    return $pdo->exec($sql);
}

?>