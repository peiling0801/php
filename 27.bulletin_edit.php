<?php
    error_reporting(0);
    session_start();

    // 檢查是否已登入，未登入則跳回登入頁
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
        exit();
    }
    else {
        // 連接資料庫
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 直接用 mysqli_query 執行更新 SQL，這裡存在 SQL Injection 風險
        // $_POST['title'], $_POST['content'], $_POST['time'] 是字串，需加引號並避免特殊字元影響SQL
        // $_POST['type'] 與 $_POST['bid'] 應強制轉型為整數以避免注入

        // 強制轉型並做安全處理
        $bid = (int)$_POST['bid'];
        $type = (int)$_POST['type'];
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $time = mysqli_real_escape_string($conn, $_POST['time']);

        $sql = "UPDATE bulletin 
                SET title='$title', content='$content', time='$time', type=$type 
                WHERE bid=$bid";

        if (!mysqli_query($conn, $sql)) {
            echo "修改錯誤";
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
        }
        else {
            echo "修改成功，三秒鐘後回到佈告欄列表";
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
        }
    }
?>
