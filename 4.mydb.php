<?php
// 4.mydb.php - 連接資料庫並讀取 user 資料表的帳號與密碼

// mysqli_connect(主機, 帳號, 密碼, 資料庫名稱)
// 這裡使用 db4free.net 的雲端資料庫
$conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

// 從 user 資料表查詢所有資料
$result = mysqli_query($conn, "SELECT * FROM user");

// 使用 mysqli_fetch_array() 取出每一筆資料
// 第一筆資料
$row = mysqli_fetch_array($result);
echo $row["id"] . " " . $row["pwd"] . "<br>";

// 第二筆資料
$row = mysqli_fetch_array($result);
echo $row["id"] . " " . $row["pwd"];
?>
