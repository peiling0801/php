<?php
// 7.bulletin.php - 顯示 bulletin 資料表中的所有公告資訊

// 關閉錯誤報告（避免顯示警告訊息）
error_reporting(0);

// 建立與資料庫的連線
$conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

// 執行查詢：取得 bulletin 資料表中的所有紀錄
$result = mysqli_query($conn, "SELECT * FROM bulletin");

// 顯示表格標題列
echo "<table border=2>
        <tr>
            <td>佈告編號</td>
            <td>佈告類別</td>
            <td>標題</td>
            <td>佈告內容</td>
            <td>發佈時間</td>
        </tr>";

// 使用迴圈逐筆輸出資料列
while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td>" . $row["bid"] . "</td>
              <td>" . $row["type"] . "</td>
              <td>" . $row["title"] . "</td>
              <td>" . $row["content"] . "</td>
              <td>" . $row["time"] . "</td></tr>";
}

echo "</table>";
?>
