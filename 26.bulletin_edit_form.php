<?php
    error_reporting(0);
    session_start();

    // 如果沒登入，提醒並跳回登入頁
    if (!$_SESSION["id"]) {
        echo "please login first";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
        exit();
    }
    else {
        // 連接資料庫
        $conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");

        // 從 GET 取得 bid（佈告編號），查詢該筆資料
        // 注意：這裡沒用防注入措施，建議後續用 prepare 改寫
        $bid = (int)$_GET["bid"];  // 強制轉整數，避免注入
        $result = mysqli_query($conn, "SELECT * FROM bulletin WHERE bid=$bid");
        $row = mysqli_fetch_array($result);

        // 根據佈告類型，設定對應 radio button 的 checked 狀態
        $checked1 = ($row['type'] == 1) ? "checked" : "";
        $checked2 = ($row['type'] == 2) ? "checked" : "";
        $checked3 = ($row['type'] == 3) ? "checked" : "";

        // htmlspecialchars 防止 XSS，把輸出的字串做安全處理
        $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
        $content = htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8');
        $time = htmlspecialchars($row['time'], ENT_QUOTES, 'UTF-8');

        // 輸出表單，表單送到 27.bulletin_edit.php
        echo "
        <html>
            <head><title>修改佈告</title></head>
            <body>
                <form method='post' action='27.bulletin_edit.php'>
                    佈告編號：{$row['bid']}<input type='hidden' name='bid' value='{$row['bid']}'><br>
                    標    題：<input type='text' name='title' value='{$title}'><br>
                    內    容：<br><textarea name='content' rows='20' cols='20'>{$content}</textarea><br>
                    佈告類型：
                    <input type='radio' name='type' value='1' {$checked1}>系上公告 
                    <input type='radio' name='type' value='2' {$checked2}>獲獎資訊
                    <input type='radio' name='type' value='3' {$checked3}>徵才資訊<br>
                    發布時間：<input type='date' name='time' value='{$time}'><p></p>
                    <input type='submit' value='修改佈告'> <input type='reset' value='清除'>
                </form>
            </body>
        </html>
        ";
    }
?>
