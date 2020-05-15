<?php

$a=["AA","BB"];
$b=["CC","DD"];
$d=["XX","YY","ZZ"];

$c=array_merge($a,$b,$d);

echo "<pre>";print_r($c);"</pre>";

?>

<?php

// 將上述一個個增加的方式，這邊設計一個不用一個個增加的自訂function，讓此自訂函式功能等同於系統提供的array_merge()
function arr_mer($a,...$b){
    if(is_array($a)){
      $array=$a;
    }else{
      echo "not an array";
    }
  
  foreach ($b as $item){
    
    foreach ($item as $i){
      $array[]=$i;
    }
  }
  return $array;
}

$name=[10=>"簡",12=>"志",20=>"瀚"];
$my=arr_mer($b,$a,$d,$name);
echo "<pre>";print_r($my);"</pre>";
?>