<?php
// 12.logout.php - 登出程式，清除 session 並導回登入頁面

// 啟動 session
session_start();

// 清除儲存登入資訊的 session（這裡是 id）
unset($_SESSION["id"]);

// 顯示登出成功訊息
echo "登出成功....";

// 3 秒後自動導回登入頁面
echo "<meta http-equiv='REFRESH' content='3; url=2.login.html'>";
?>
