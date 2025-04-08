<?php
// 10.login.php - 登入驗證＋Session 記錄＋頁面導向

// 建立與資料庫的連線
$conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

// 查詢 user 資料表
$result = mysqli_query($conn, "SELECT * FROM user");

// 初始化登入狀態
$login = FALSE;

// 逐筆檢查是否有符合的帳號與密碼
while ($row = mysqli_fetch_array($result)) {
    if (($_POST["id"] == $row["id"]) && ($_POST["pwd"] == $row["pwd"])) {
        $login = TRUE;
    }
}

if ($login == TRUE) {
    // 登入成功：儲存使用者帳號於 Session，並導向到公告頁
    session_start();
    $_SESSION["id"] = $_POST["id"];
    echo "登入成功";
    echo "<meta http-equiv='REFRESH' content='3; url=11.bulletin.php'>";
} else {
    // 登入失敗：提示錯誤並導回登入頁面
    echo "帳號/密碼 錯誤";
    echo "<meta http-equiv='REFRESH' content='3; url=2.login.html'>";
}
?>
