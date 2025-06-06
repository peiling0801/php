<html>
<head>
    <title>使用者管理</title> <!-- 頁面標題 -->
</head>
<body>
<?php
    // 關閉錯誤訊息的輸出（正式環境可考慮改成記錄到 log）
    error_reporting(0);

    // 開始 session，用來檢查登入狀態
    session_start();

    // 若尚未登入（$_SESSION["id"] 為空），顯示提示並導回登入頁面
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3; url=2.login.html'>";
    } else {
        // 使用者已登入，顯示使用者管理功能頁面
        echo "
            <h1>使用者管理</h1>
            [<a href='14.user_add_form.php'>新增使用者</a>] 
            [<a href='11.bulletin.php'>回佈告欄列表</a>]<br><br>

            <table border='1'>
                <tr>
                    <td>操作</td>
                    <td>帳號</td>
                    <td>密碼</td>
                </tr>
        ";

        // 連接資料庫
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 從 user 表格撈出所有使用者資料
        $result = mysqli_query($conn, "SELECT * FROM user");

        // 用 while 逐筆取出資料
        while ($row = mysqli_fetch_array($result)) {
            // 每筆資料列出：帳號、密碼，與「修改 / 刪除」連結
            echo "
                <tr>
                    <td>
                        <a href='19.user_edit_form.php?id={$row['id']}'>修改</a> || 
                        <a href='17.user_delete.php?id={$row['id']}'>刪除</a>
                    </td>
                    <td>{$row['id']}</td>
                    <td>{$row['pwd']}</td>
                </tr>
            ";
        }

        // 關閉資料表
        echo "</table>";
    }
?> 
</body>
</html>
