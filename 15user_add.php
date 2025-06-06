<?php

// 關閉錯誤訊息顯示（正式環境建議開啟錯誤日誌 log，但不顯示給使用者）
error_reporting(0);

// 啟用 Session，檢查是否已登入
session_start();

// 若未登入，顯示提示並自動跳回登入頁面
if (!$_SESSION["id"]) {
    echo "請登入帳號";
    echo "<meta http-equiv=REFRESH content='3; url=2.login.html'>";
}
else {
    // 如果已登入，執行以下新增使用者流程

    // 使用 mysqli_connect() 連線到遠端 MySQL 資料庫
    // 主機: db4free.net，帳號: immust，密碼: immustimmust，資料庫: immust
    $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

    // 建立 SQL 新增語法，將表單送來的帳號與密碼寫入 user 表格中
    // 此寫法存在 SQL Injection 風險（下面會教你改進）
    $sql = "INSERT INTO user(id, pwd) VALUES('{$_POST['id']}', '{$_POST['pwd']}')";

    // 執行 SQL 指令，如果執行失敗就顯示錯誤訊息
    if (!mysqli_query($conn, $sql)) {
        echo "新增命令錯誤"; // 比較通用的提示，未顯示具體錯誤內容
    }
    else {
        // 執行成功，顯示成功訊息並跳回使用者清單頁
        echo "新增使用者成功，三秒鐘後回到網頁";
        echo "<meta http-equiv=REFRESH content='3; url=18.user.php'>";
    }
}
?>
