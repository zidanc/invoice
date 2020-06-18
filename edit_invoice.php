<?php include "./common/base.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>統一發票管理系統</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

  
  <?php include "./include/header.php";
 
  $user=find('invoice',$_GET['id']);
  
  ?>
  
  <form action="update_invoice.php" method="post">
    <div class="selection">
        <input type="hidden" name="id" value="<?=$user['id'];?>">
        
        <span class="period_item">期別:</span>
          <select name=<?=$user['period'];?> id="">
            <option value="1">1,2月</option>
            <option value="2">3,4月</option>
            <option value="3">5,6月</option>
            <option value="4">7,8月</option>
            <option value="5">9,10月</option>
            <option value="6">11,12月</option>
          </select>
        
        <span class="period_item">年份:</span>
          <select name="year" id="">
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
          </select>
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



  <!-- 參考之前session的作法： -->
  <!-- <input type="hidden" name="id" value="$res['id']">
    <div><label for="acc">帳號：</label><input type="text" name="acc" value="$res['acc']"></div>
    <div><label for="pw">密碼：</label><input type="password" name="pw" value="$res['pw']"></div>
    <div><label for="name">姓名：</label><input type="text" name="name" value="$res['name']"></div>
    <div><label for="email">email：</label><input type="email" name="email" value="$res['email']"></div>
    <div><label for="tel">手機：</label><input type="tel" name="tel" value="$res['tel']"></div>
    <div><label for="birthday">生日：</label><input type="date" name="birthday" value="$res['birthday']"></div>

    <div class="btn">
      <input type="submit" value="送出">
      <input type="reset" value="重置">
    </div> -->


</body>
</html>