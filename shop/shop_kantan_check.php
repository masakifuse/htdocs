<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	echo 'ログインされていません。<br />';
	echo '<a href="shop_list.php">商品一覧へ</a>';
	exit();
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

$code=$_SESSION['member_code'];

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,email,postal1,postal2,address,
tel FROM dat_member WHERE code=?';
$stmt= $dbh->prepare($sql);
$data[]=$code;
$stmt->execute($data);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$dbh = null;

$onamae=$rec['name'];
$email=$rec['email'];
$postal1=$rec['postal1'];
$postal2=$rec['postal2'];
$address=$rec['address'];
$tel=$rec['tel'];

echo 'お名前<br />';
echo $onamae;
echo '<br /><br />';

echo 'メールアドレス<br />';
echo $email;
echo '<br /><br />';

echo '郵便番号<br />';
echo $postal1;
echo '-';
echo $postal2;
echo '<br /><br />';

echo '住所<br />';
echo $address;
echo '<br /><br />';

echo '電話番号<br />';
echo $tel;
echo '<br /><br />';

echo '<form method="post" action="shop_kantan_done.php">';
echo '<input type="hidden" name="onamae" value="'.$onamae.'">';
echo '<input type="hidden" name="email" value="'.$email.'">';
echo '<input type="hidden" name="postal1" value="'.$postal1.'">';
echo '<input type="hidden" name="postal2" value="'.$postal2.'">';
echo '<input type="hidden" name="address" value="'.$address.'">';
echo '<input type="hidden" name="tel" value="'.$tel.'">';
echo '<input type="button" onclick="history.back()" value="戻る">';
echo '<input type="submit" value="OK"><br />';
echo '</form>';

?>




			
</body>
</html>