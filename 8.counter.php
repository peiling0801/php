<?php
// 8.counter.php - 使用 session 記錄瀏覽次數的簡易計數器

// 啟動 session 機制（每位使用者會有自己的 session）
session_start();

// 如果尚未設定 counter，就初始化為 1
if (!isset($_SESSION["counter"])) {
    $_SESSION["counter"] = 1;
} else {
    // 如果已經存在，則將 counter 增加 1
    $_SESSION["counter"]++;
}

// 顯示目前的瀏覽次數
echo "counter = " . $_SESSION["counter"];

// 顯示重置連結，導向到 9.reset_counter.php
echo "<br><a href='9.reset_counter.php'>重置 counter</a>";
?>
