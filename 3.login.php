<?php 
// 3.login.php - 簡易登入驗證：檢查帳號與密碼是否正確

// 如果帳號是 john 且密碼是 john1234，則登入成功
if (($_POST["id"] == "john") && ($_POST["pwd"] == "john1234"))
    echo "登入成功";
else
    // 否則登入失敗
    echo "登入失敗";
?>
