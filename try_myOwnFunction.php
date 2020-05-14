<style>
  body{
    font-family: consolas;
  }
  
</style>
<h2>印出正三角形排列的星星</h2>

<form action="?" method="get">
  <input type="number" name="stars" id="">
  <input type="submit" value="送出">
</form>


<?php

// 由於內層不是印空白就是印星星，
// 因此可以把上面的程式再做簡化，
// 利用判斷式來決定要印的是星星還是空白。

if(isset($_GET["stars"])){
  $stars=$_GET["stars"];
  stars($stars);
}


function stars($row){

  for ($i=1; $i <$row ; $i++) { 
    for ($j=1; $j <($row-1+$i) ; $j++) { 
      if($j<=($row-$i)){
        echo "&nbsp;";
      }else{
        echo "*";
      }
    }
    echo "<br>";
  }

}



?>