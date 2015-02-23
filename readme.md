# Laravel + LightOpenID 範例 for 新北市

  - [Laravel] 4.2
  - [LightOpenID] 0.7

本範例的程式碼只包含如何從新北市OpenID取得資料，取得資料後之處理只是單純dump出來而已，並未寫入資料庫。

## 自己從頭開始安裝

以下大致說明步驟，並未包含Laravel的細部設定。

#### 安裝 Laravel 4.2

因為Laravel 5已經release，所以要安裝4.2版的話要用以下指令(your-project 請自行替換成自己的專案名稱)

```
composer create-project laravel/laravel your-project 4.2.*
```
在專案根目錄下執行
```
chmod -R 777 app/storage
```

#### 安裝 LightOpenID

在專案根目錄下的composer.json加入require
```
"lightopenid/lightopenid": "dev-master"
```

存檔後在專案根目錄下執行
```
composer update
```

如果有用git，請編輯專案根目錄下的.gitignore，刪除composer.lock那一行

## 程式碼參考
範例程式碼請參考以下檔案
```
app/routes.php
app/controllers/AuthController.php
app/views/hello.php
```





[Laravel]:http://laravel.com/
[LightOpenID]:https://code.google.com/p/lightopenid/