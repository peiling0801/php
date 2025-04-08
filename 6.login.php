<?php
// 6.login.php - 根據資料庫中的帳號密碼進行登入驗證

// 建立與資料庫的連線
$conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

// 從資料庫查詢 user 資料表所有帳號密碼
$result = mysqli_query($conn, "SELECT * FROM user");

// 初始化登入狀態變數為 FALSE
$login = FALSE;

// 使用 while 迴圈逐筆檢查資料列
while ($row = mysqli_fetch_array($result)) {
    // 如果使用者輸入的帳號和密碼與資料表中的某筆相符
    if (($_POST["id"] == $row["id"]) && ($_POST["pwd"] == $row["pwd"])) {
        $login = TRUE;
    }
}

// 根據檢查結果顯示登入狀態
if ($login == TRUE)
    echo "登入成功";
else
    echo "帳號/密碼 錯誤";
?>
