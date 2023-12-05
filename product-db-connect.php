<!-- 連結資料庫 -->
<?php
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "diving";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
if ($conn->connect_error) {
  	die("連線失敗: " . $conn->connect_error);
}else{
    //echo "資料庫連線成功";
}

//php物件要去執行方法，會用受箭頭 ->
//但物件中的指向(賦值)，會用=>
