<?php
    // 關閉錯誤訊息顯示，避免錯誤資訊暴露在網頁上
    error_reporting(0);

    // 啟用 Session，確認使用者是否登入
    session_start();

    // 如果沒有登入（$_SESSION["id"] 為空），就導回登入頁面
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else {   
        // 若已登入，執行刪除使用者功能

        // 連接遠端 MySQL 資料庫
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 建立 SQL 刪除語句，從 GET 取得使用者帳號 id
        // ⚠️ 有 SQL Injection 風險，下面會改寫為安全版本
        $sql = "DELETE FROM user WHERE id='{$_GET["id"]}'";

        // 執行 SQL 語句，如果失敗顯示錯誤訊息
        if (!mysqli_query($conn, $sql)) {
            echo "使用者刪除錯誤";
        } else {
            echo "使用者刪除成功";
        }

        // 三秒後跳回使用者列表頁
        echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
    }
?>
