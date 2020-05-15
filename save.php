<?php

include_once "base.php";


$data=[
    "code"=>"FG",
    "number"=>"98182327",
    "period"=>4,
    "expend"=>70,
    "year"=>"2020"
];

//save('invoice',$data);

$row=find("invoice",14);
$row['code']="EN";
$row['period']="1";
$row['number']="96271266";

save('invoice',$row);

?>