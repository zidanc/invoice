<?php
include_once "base_pra.php";
$num=5;
$character=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O"];


for ($i=0; $i <$num ; $i++) { 
  $data=[
    "code"=>$character[rand(0,14)].$character[rand(0,14)],
    "number"=>rand(16810000,92000000),
    "period"=>rand(1,6),
    "expend"=>round(rand(10,300),-1),
    "year"=>rand(2020,2022)
  ];
  save("invoice",$data);
  // echo "<pre>";print_r($data);"</pre>";
}





?>