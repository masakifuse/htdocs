<?php 
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	echo 'ログインされていません。<br />';
	echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	echo $_SESSION['staff_name'];
	echo 'さんログイン中<br />';
	echo '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>ろくまる農園</title>
</head>
<body>
<form>		
<h1>ショップ管理トップメニュー</h1>
<br />
<a href ="../staff/staff_list.php" class="button">スタッフ管理</a><br />
<br />
<a  href ="../product/pro_list.php" class="button">商品管理</a><br />
<br />
<a  href="../order/order_download.php" class="button">注文ダウンロード</a><br />
<br />
<a  href="staff_logout.php">ログアウト</a><br />
</form>
			
</body>
</html>