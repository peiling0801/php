<?php
// 9.reset_counter.php - 重置 counter 計數器（清除 session 中的 counter）

// 啟動 session
session_start();

// 清除 counter 的 session 變數
unset($_SESSION["counter"]);

// 顯示提示訊息
echo "counter 重置成功...";

// 2 秒後重新導向回 counter 頁面
echo "<meta http-equiv='REFRESH' content='2; url=8.counter.php'>";
?>
