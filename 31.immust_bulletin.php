<?php
session_start();

// 檢查是否登入
if (!isset($_SESSION["id"])) {
    echo "請先登入帳號，3秒後跳轉登入頁面...";
    echo "<meta http-equiv='refresh' content='3;url=2.login.html'>";
    exit();
}

// 連接資料庫
$conn = mysqli_connect("db4free.net", "immust", "immustimmust", "immust");
if (!$conn) {
    die("資料庫連線錯誤: " . mysqli_connect_error());
}

// 取得佈告資料
$sql = "SELECT * FROM bulletin ORDER BY time DESC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("查詢錯誤: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>明新科技大學資訊管理系 - 佈告欄</title>
    <link href="https://cdn.bootcss.com/flexslider/2.6.3/flexslider.min.css" rel="stylesheet" />
    <script src="https://cdn.bootcss.com/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/flexslider/2.6.3/jquery.flexslider-min.js"></script>
    <style>
        /* CSS 同前面大部分，可自行補充 */
        body {
            font-family: "微軟正黑體", sans-serif;
            color: gray;
            text-align: center;
        }
        .bulletin table {
            margin: 0 auto;
            border-collapse: collapse;
            font-size: 16px;
            width: 90%;
            max-width: 1000px;
        }
        .bulletin th, .bulletin td {
            border: 1px solid #000;
            padding: 8px;
        }
        .bulletin th {
            background-color: #abdcff;
            color: #fff;
        }
        .bulletin td {
            background-color: #fff;
            color: #0396ff;
            word-break: break-word;
        }
        /* 你也可以補上你其他的CSS */
    </style>
    <script>
    $(window).on('load', function() {
        $('.flexslider').flexslider({
            animation: "slide"
        });
    });
    </script>
</head>
<body>
    <h1>最新公告</h1>
    <div class="bulletin">
        <table>
            <thead>
                <tr>
                    <th>佈告編號</th>
                    <th>佈告類別</th>
                    <th>標題</th>
                    <th>佈告內容</th>
                    <th>發布時間</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= intval($row['bid']) ?></td>
                    <td>
                        <?php 
                            switch ($row['type']) {
                                case 1: echo "系上公告"; break;
                                case 2: echo "獲獎資訊"; break;
                                case 3: echo "徵才資訊"; break;
                                default: echo "其他"; 
                            }
                        ?>
                    </td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['content'])) ?></td>
                    <td><?= htmlspecialchars($row['time']) ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Flexslider 例子 (可自行添加) -->
    <div class="flexslider" style="max-width:800px; margin:20px auto;">
        <ul class="slides">
            <li><img src="https://github.com/shhuangmust/html/raw/111-1/slider1.JPG" alt="slider1" /></li>
            <li><img src="https://github.com/shhuangmust/html/raw/111-1/slider2.JPG" alt="slider2" /></li>
            <li><img src="https://github.com/shhuangmust/html/raw/111-1/slider3.JPG" alt="slider3" /></li>
        </ul>
    </div>

</body>
</html>
<?php mysqli_close($conn); ?>
