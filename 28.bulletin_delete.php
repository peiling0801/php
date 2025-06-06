<?php
    error_reporting(0);
    session_start();

    // 檢查是否登入
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
        exit();
    }
    else {
        // 連接資料庫
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 從 GET 取得佈告編號，強制轉整數避免 SQL 注入
        $bid = (int)$_GET["bid"];

        // 組成刪除語法
        $sql = "DELETE FROM bulletin WHERE bid=$bid";
        // echo $sql; // 測試用，可解除註解看 SQL 指令

        // 執行刪除命令，失敗則顯示錯誤訊息
        if (!mysqli_query($conn, $sql)) {
            echo "佈告刪除錯誤";
        }
        else {
            echo "佈告刪除成功";
        }

        // 3 秒後跳回佈告列表頁
        echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
    }
?>
