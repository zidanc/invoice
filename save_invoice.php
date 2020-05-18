<?php
include "./common/base.php";

// $sql="insert into invoice(`period`, `year`, `code`, `number`, `expend`) values('".$_POST['period']."', '".$_POST['year']."', '".$_POST['code']."', '".$_POST['number']."', '".$_POST['expend']."')";

// $sql="insert into invoice(`period`, `year`, `code`, `number`, `expend`) values('$_POST[period]', '$_POST[year]', '$_POST[code]', '$_POST[number]', '$_POST[expend]')";

//   echo $sql;
  
// $data=[        這可以省略不寫，是因為在當初index.php使用的name與欄位的命名一樣，所以$_POST進來時，不需要重複指定一次。
//   'period'=>$_POST['period'],
//   'year'=>$_POST['year'],
//   'code'=>$_POST['code'],
//   'number'=>$_POST['number'],
//   'expend'=>$_POST['expend'],
// ];
  $res= save('invoice',$_POST);
  if($res==1){
    echo "新增成功";
  }else{
    echo "新增失敗";
  }

  ?>