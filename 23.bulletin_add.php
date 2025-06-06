<?php
    // 關閉錯誤顯示
    error_reporting(0);

    // 啟動 Session 檢查登入狀態
    session_start();

    // 若尚未登入，3 秒後跳轉到登入頁
    if (!$_SESSION["id"]) {
        echo "please login first";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else {
        // 使用者已登入，開始處理新增佈告
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 建立 SQL 新增語法，從 POST 中讀取表單資料（存在 SQL injection 風險）
        $sql = "INSERT INTO bulletin(title, content, type, time) 
                VALUES('{$_POST['title']}', '{$_POST['content']}', {$_POST['type']}, '{$_POST['time']}')";

        // 嘗試執行 SQL 指令
        if (!mysqli_query($conn, $sql)) {
            echo "新增命令錯誤";
        } else {
            echo "新增佈告成功，三秒鐘後回到網頁";
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
        }
    }
?>
