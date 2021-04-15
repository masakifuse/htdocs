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

try
{
 
  $staff_code= $_GET['staffcode'];
	
	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user ='root';
	$password ='';
	$dbh =new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql ='SELECT name FROM mst_staff WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[]= $staff_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$staff_name=$rec['name'];

	$dbh = null;

}
catch (Exception $e)
{
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}			

?>

スタッフ削除<br />
<br />
スタッフコード<br />
<?php echo $staff_code;?> 
<br />
スタッフ名<br />
<?php echo $staff_name;?>
<br />
このスタッフを削除してもよろしいですか？<br />
<br />
<form method="post" action="staff_delete_done.php">
<input type ="hidden" name="code" value="<?php echo $staff_code;?>">

<input type ="button" onclick="history.back()" value ="戻る">
<input type ="submit" value="OK">

</body>
</html>