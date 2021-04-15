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
 
  $pro_code= $_GET['procode'];
	
	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user ='root';
	$password ='';
	$dbh =new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql ='SELECT name,price,gazou FROM mst_product WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[]= $pro_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$pro_name=$rec['name'];
	$pro_price=$rec['price'];
	$pro_gazou_name=$rec['gazou'];

	$dbh = null;

if($pro_gazou_name=='')
{
	$disp_gazou='';
}	
else
{
	$disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
}
}
catch (Exception $e)
{
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}			

?>

商品情報参照<br />
<br />
商品コード<br />
<?php echo $pro_code;?> 
<br />
商品名<br />
<?php echo $pro_name;?>
<br />
価格<br />
<?php echo $pro_price;?>円
<br/>
<br />
<?php echo $disp_gazou;?>
<br />
<form>
<input type ="button" onclick="history.back()" value ="戻る">
</form>

</body>
</html>