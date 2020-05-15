<?php

$a=["AA","BB"];
$b=["CC","DD"];
$d=["XX","YY","ZZ"];

$c=array_merge($a,$b,$d);

echo "<pre>";print_r($c);"</pre>";

?>

<?php

// 將上述一個個增加的方式，這邊設計一個不用一個個增加的自訂function，讓此自訂函式功能等同於系統提供的array_merge()
function arr_mer($a,...$b){     //這種寫法的$b就已經是二維陣列了。如果寫arr_mer($a,$b)，這樣$b就是一維陣列，跟$a都一樣是一維陣列的狀態。
    if(is_array($a)){
      $array=$a;        //所以這時候陣列array index=0已經是$a陣列了。$array不寫中括號就讓$a丟進去，這樣$array此時是帶有陣列的變數。用echo就可以顯示出來，不用到print_r。
    }else{
      echo "not an array";
    }
  
  foreach ($b as $item){
    
    foreach ($item as $i){
      $array[]=$i;
    }
  }
  return $array;    //回此$array給function arr_mer去執行。
}

$name=[10=>"簡",12=>"志",20=>"瀚"];
$my=arr_mer($b,$a,$d,$name);
echo "<pre>";print_r($my);"</pre>";
?>