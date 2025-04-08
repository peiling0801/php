<?php
// 5.while.php - 使用 while 迴圈列出 user 資料表中所有帳號與密碼

// 建立與資料庫的連線
$conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

// 執行 SQL 查詢：從 user 資料表取出所有資料
$result = mysqli_query($conn, "SELECT * FROM user");

// 使用 while 迴圈逐筆讀取資料列
while ($row = mysqli_fetch_array($result)) {
    echo $row["id"] . " " . $row["pwd"] . "<br>";
}
?>
