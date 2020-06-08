<?php

/*$a*/$e=["AA","BB"];      //課堂中這組陣列是指定給$a。
/*$b*/$f=["CC","DD"];       //課堂中這組陣列是指定給$b。
$d=["XX","YY","ZZ"];

$c=array_merge($f,$e,$d);       //課堂中執行的array_merge($b,$a,$d)。

// echo "<pre>";print_r($c);"</pre>";

?>

<?php
// $c=array_merge($b,$a,$d);
// 將上述一個個增加的方式，這邊設計一個不用一個個增加的自訂function，讓此自訂函式功能等同於系統提供的array_merge()
function arr_mer($a,...$b){  //區域變數。   //這種...寫法的$b就已經是二維陣列了。如果寫arr_mer($a,$b)，這樣$b就是一維陣列，跟$a都一樣是一維陣列的狀態。
    if(is_array($a)){         //假如第一個代入的變數是個陣列，來做後續判斷。
      $array=$a;        //所以這時候陣列array index=0已經是$a陣列了。$array不寫中括號就讓$a丟進去，這樣$array此時是帶有陣列的變數。用echo就可以顯示出來，不用到print_r。
    }else{
      echo "not an array";
    }
  
  foreach ($b as $item){
    
    foreach ($item as $i){
      // print_r($array)."<br>";
      $array[]=$i;        //第18行$array已是陣列，這時再丟$i進去陣列的變數，原本的不會被覆蓋掉，因為陣列每一次丟進去的東西都會去新的index，不像一般非陣列的變數，後來的會把原本的覆蓋掉。
      // print_r($array)."<br>";
    }
  }
  return $array;    //回此$array給function arr_mer去執行。
}
$matrix=arr_mer($f,$e,$d);
echo "<pre>";print_r($matrix);"</pre>";


$name=[10=>"簡",12=>"志",20=>"瀚"];
$my=arr_mer($f,$e,$d,$name);
echo "<pre>";print_r($my);"</pre>";
?>