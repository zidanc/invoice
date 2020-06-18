<?php include "./common/base.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
</head>
<body>

  
  <?php include "./include/header.php";
 
  $user=find('invoice',$_GET['id']);
  $year=$user['year'];
  $period=$user['period'];
  ?>
  
  <form action="update_invoice.php" method="post">
    <div class="selection">
        <input type="hidden" name="id" value="<?=$user['id'];?>">
        
        <span class="period_item">期別:
          <select name="period" id="">
            <option value="1" <?=($period==1)?"selected":null;?>>1,2月</option>
            <option value="2" <?=($period==2)?"selected":null;?>>3,4月</option>
            <option value="3" <?=($period==3)?"selected":null;?>>5,6月</option>
            <option value="4" <?=($period==4)?"selected":null;?>>7,8月</option>
            <option value="5" <?=($period==5)?"selected":null;?>>9,10月</option>
            <option value="6" <?=($period==6)?"selected":null;?>>11,12月</option>
          </select>
        </span>

        <span class="period_item yearcol">年份:
          <select name="year" id="">
            <option value="2020" <?=($year==2020)?"selected":null;?>>2020</option>
            <option value="2021" <?=($year==2021)?"selected":null;?>>2021</option>
            <option value="2022" <?=($year==2022)?"selected":null;?>>2022</option>
          </select>
        </span>
    </div>

    <div class="number">
      <span class="period_item">獎號:</span>
        <input type="text" name="code" value=<?=$user['code'];?> class="code_col" maxlength="2" placeholder="英文" required>
        <input type="number" name="number" value=<?=$user['number'];?> class="number_col" maxlength="8" placeholder="數字8碼" required>
    </div>

    <div class="expend">
      <span class="period_item">花費:</span>
        <input type="number" name="expend" value=<?=$user['expend'];?> class="expend_col">
        <input type="submit" value="儲存">
    </div>

  </form>


</body>
</html>