<?php

include_once "./common/base.php";

$num=5;
$char=[
  "A",
  "B",
  "C",
  "D",
  "F",
  "G",
  "H",
  "I",
  "J",
  "K",
  "L",
  "M",
];

for($i=0;$i<$num;$i++){

  $code=$char[rand(0,11)].$char[rand(0,11)];
  $data=[
    'period'=>rand(1,6),
    'year'=>2020,
    'code'=>$code,
    'nmuber'=>rand(12312311,99999999),
    'expend'=>rand(10,1500),
  ];
  save("invoice",$data);
}
echo "已新增".$data["code"]. $data["number"]."<br>";

?>