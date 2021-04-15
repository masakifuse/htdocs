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
<title>ろくまる農園</title>
</head>
<body>

<?php

require_once('../common/common.php');
$post=sanitize($_POST);

try
{

	$pro_name = $post['name'];
	$pro_price = $post['price'];
	$pro_gazou_name = $_POST['gazou_name'];

	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$password ='';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql = 'INSERT INTO mst_product(name,price,gazou) VALUES (?,?,?)';
	$stmt = $dbh->prepare($sql);
	$data[] = $pro_name;
	$data[] = $pro_price;
	$data[] =$pro_gazou_name;
	$stmt->execute($data);

	$dbh = null;

	echo $pro_name;
	echo 'を追加しました。<br />';

}
catch (Exception $e)
{
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<a href ="pro_list.php">戻る</a>

	
			
</body>
</html>