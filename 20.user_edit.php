<?php
    // 關閉錯誤訊息（不建議用於開發階段）
    error_reporting(0);

    // 啟用 session 檢查登入
    session_start();

    // 檢查是否登入，若無則導向登入頁面
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else {
        // 已登入，開始處理更新密碼
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 執行 SQL 更新密碼指令（直接插入變數，有 SQL injection 風險）
        if (!mysqli_query($conn, "UPDATE user SET pwd='{$_POST['pwd']}' WHERE id='{$_POST['id']}'")) {
            echo "修改錯誤";
            echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
        } else {
            echo "修改成功，三秒鐘後回到網頁";
            echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
        }
    }
?>
