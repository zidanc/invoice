# 統一發票紀錄
## 使用者情境：
```
1. 有一個輸入畫面可以用來輸入每次拿到的發票號碼，輸入完成的號碼會存到資料庫中
2. 有一個輸入畫面可以用來輸入當期的中獎獎號，並可以區分各獎項及期別，輸入完成的獎號和期別會存入資料庫中
3. 有一個畫面可以用來檢視所有的發票，並有連結或選單可以過濾發票的月份或期別
4. 有一顆按鈕可以用來針對某個期別的發票進行對獎。
5. 對獎的結果可以顯示：六獎=>1張=>小計200元;五獎=>2張=>小計2千元;合計2200元
```
## 畫面設計：
1. 首頁(index.php)
   - 選擇當期期別及月份
   - 有一個輸入欄位，用來輸入發票號碼
   - 有一顆送出按鈕，按後會將發票號碼存入資料庫
   - 有一個顯示當期發票的按鈕，按下後會跳到發票列表畫面
   - 有一個對獎按鈕，按下後會跳到對獎畫面
   - 有一個輸入獎號按鈕，按下後跳到輸入獎號畫面
2. 發票列表(list.php)
   - 會優先顯示當期的發票列表
   - 有提供按鈕或連結可以顯示當年度不同期別的發票列表
   - 每個發票號碼後面有一個編輯按鈕，按下後可以修改發票號碼
3. 對獎畫面(award.php)
   - 會顯示當期可對獎的期別獎號
   - 有一個按鈕[對獎]，按下後會針對該期別的發票進行對獎
   - 逐一對獎並顯示中獎與否
   - 對獎完畢後顯示總計畫面
4. 輸入獎號畫面(standard.php)
   - 畫面分別顯示各獎別的欄位
   - 有一個按鈕是送出，有一個按鈕是重置
   - 依序填入獎號後可以按下送出按鈕
   - 獎號送出後會存入資料庫
   - 有一個查看獎號按鈕，按下後會跳到查詢獎號畫面
5. 查詢獎號畫面(query.php)
   - 顯示當年度六期的期別按鈕
   - 按下某期的按鈕會顯示該期的獎號
   - 有一個編輯的按鈕，按下後可以編輯該期別的獎號
## 資料庫設計
1. 發票資料表-invoice
   - id
   - code
   - number
   - period
   - expend
   - year
2. 獎號資料表- award_number
   - id
   - period
   - item
   - number
   - year
3. 中獎紀錄表- reward_record
   - id
   - number
   - period
   - reward
   - expend
   - year
## 程式功能設計
1. 接收發票號並存入資料庫
2. 接收獎號並存入資料庫
3. 接收中獎紀錄並存入資料庫
4. 發票列表功能
   - by 月 顯示
   - by 期別 顯示
   - 預設顯示當期的發票列表
   - 編輯發票號碼
5. 獎號列表功能
6. 獎號編輯功能
7. 對獎功能
   - 撈出對應期別的發票
   - 依獎項別逐一對獎並顯示結果
   - 對獎結束顯示總計畫面

# 開發紀錄：

合理規範使用者使用行為，避免使用者混淆，也減少犯錯而增加挫折感。
例如：

1.身分證號碼的第一碼英文，不管使用者輸入大寫還是小寫英文，都會自動幫他轉成大寫。

4.還沒到的月份/期數，顯示為Disable狀態，減少使用者誤植到尚未到的欄目。

## Finished

完成2.發票輸入年份，不管輸入西元年還是中華民國年份，都會幫他計算成西元年。

完成3.月份選擇會自動轉換成我們資料表中所需的期數，可以透過&lt;Select&gt;引導使用者選擇我們需要的資訊。

## Issues