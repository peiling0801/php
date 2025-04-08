<?php
// 11.bulletin.php - 登入後的佈告欄首頁，顯示所有公告 + 提供修改、刪除等操作

// 關閉錯誤訊息顯示
error_reporting(0);

// 啟動 session
session_start();

// 檢查是否已登入
if (!$_SESSION["id"]) {
    echo "請先登入";
    echo "<meta http-equiv='REFRESH' content='3; url=2.login.html'>";
} else {
    // 已登入，顯示歡迎訊息與操作選單
    echo "歡迎, " . $_SESSION["id"];
    echo " [<a href='12.logout.php'>登出</a>]";
    echo " [<a href='18.user.php'>管理使用者</a>]";
    echo " [<a href='22.bulletin_add_form.php'>新增佈告</a>]<br>";

    // 連接資料庫
    $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

    // 查詢所有佈告
    $result = mysqli_query($conn, "SELECT * FROM bulletin");

    // 顯示公告資料表格
    echo "<table border=2>
            <tr>
                <td></td>
                <td>佈告編號</td>
                <td>佈告類別</td>
                <td>標題</td>
                <td>佈告內容</td>
                <td>發佈時間</td>
            </tr>";

    // 逐筆列出佈告資料與操作按鈕
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>
                <td>
                    <a href='26.bulletin_edit_form.php?bid={$row["bid"]}'>修改</a> 
                    <a href='28.bulletin_delete.php?bid={$row["bid"]}'>刪除</a>
                </td>
                <td>{$row["bid"]}</td>
                <td>{$row["type"]}</td>
                <td>{$row["title"]}</td>
                <td>{$row["content"]}</td>
                <td>{$row["time"]}</td>
              </tr>";
    }

    echo "</table>";
}
?>
