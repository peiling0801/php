<html>
<head>
    <title>修改使用者</title>
</head>
<body>
<?php
    // 關閉 PHP 錯誤提示（正式環境建議寫入 log 而非隱藏）
    error_reporting(0);

    // 啟用 session，檢查是否已登入
    session_start();

    // 如果使用者尚未登入，提醒並跳轉至登入頁
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    } else {
        // 已登入，開始顯示修改表單

        // 連接資料庫
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 從 GET 取得要修改的使用者 id，查詢該使用者資料
        $result = mysqli_query($conn, "SELECT * FROM user WHERE id='{$_GET['id']}'");
        $row = mysqli_fetch_array($result);

        // 顯示修改表單（帳號為唯讀，密碼可改）
        echo "
            <form method='post' action='20.user_edit.php'>
                <input type='hidden' name='id' value='{$row['id']}'>
                帳號：{$row['id']}<br> 
                密碼：<input type='text' name='pwd' value='{$row['pwd']}'><p></p>
                <input type='submit' value='修改'>
            </form>
        ";
    }
?>
</body>
</html>
