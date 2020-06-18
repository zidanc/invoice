<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新增開獎獎號</title>
  <link rel="stylesheet" href="./css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
</head>
<body>
  <?php include "./include/header.php";?>
  
  <form action="save_number_func.php" method="post">    <!-- <form>表單的結尾標籤，要包住</table> --> 
  <table style="width:400px">
    <tr>
      <td>年月份</td>
      <td colspan="2"><input class="keylot" type="number" name="year" placeholder="民國 / 西元" required>
      
        <select name="period" id="">
          <option value="1">1,2月</option>
          <option value="2">3,4月</option>
          <option value="3">5,6月</option>
          <option value="4">7,8月</option>
          <option value="5">9,10月</option>
          <option value="6">11,12月</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>特別獎</td>
      <td><input class="keylot" type="number" name="sp_num1" placeholder="請輸入獎號8位數" maxlength="8" required></td>
    </tr>
    <tr>
      <td>特獎</td>
      <td><input class="keylot" type="number" name="sp_num2" placeholder="請輸入獎號8位數" maxlength="8" required></td>
    </tr>
    <tr>
      <td>頭獎</td>
      <td>
        <div class="con">
          <input style="margin-bottom:10px" class="keylot" type="number" name="num1[]" placeholder="請輸入獎號8位數" maxlength="8" required>
          <input style="margin-bottom:10px" class="keylot" type="number" name="num1[]" placeholder="請輸入獎號8位數" maxlength="8" required>
          <input class="keylot" type="number" name="num1[]" placeholder="請輸入獎號8位數" maxlength="8" required>
        </div>
      </td>      <!-- 表單裡同name有重複多筆，改成用陣列來存值+傳值。-->
      
    </tr>
    <tr>
      <td class="nb">二獎</td>
      <td class="nb"></td>
    </tr>
    <tr>
      <td class="nb">三獎</td>
      <td class="nb"></td>
    </tr>
    <tr>
      <td class="nb">四獎</td>
      <td class="nb"></td>
    </tr>
    <tr>
      <td class="nb">五獎</td>
      <td class="nb"></td>
    </tr>
    <tr>
      <td class="nb">六獎</td>
      <td class="nb"></td>
    </tr>
    <tr>
      <td>增開六獎</td>
      <td>
        <div class="con">
          <input style="margin-bottom:10px" class="keylot" type="number" name="num2[]" maxlength="8" placeholder="請輸入獎號8位數">    <!-- 表單裡同name有重複多筆，改成用陣列來存值+傳值。-->
          <input style="margin-bottom:10px" class="keylot" type="number" name="num2[]" maxlength="8" placeholder="請輸入獎號8位數">
          <input class="keylot" type="number" name="num2[]" maxlength="8" placeholder="請輸入獎號8位數">
        </div>
      </td>
    </tr>
  </table>
  <div class="opt">
    <input type="submit" value="送出">
    <input type="reset" value="重置">
  </div>
  </form>

<script>
//假如輸入格式錯誤並非8位數，直接紅字警告顯示「兌獎號碼必須8位數，可以0開頭」。
</script>

</body>
</html>