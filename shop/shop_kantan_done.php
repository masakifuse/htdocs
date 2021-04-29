<?php
  session_start();
	session_regenerate_id(true);
	if(isset($_SESSION['member_login'])==false)
	{
		echo 'ログインされていません。<br />';
		echo '<a href="shop_list.php>商品一覧へ</a>';
		exit();
	}
	$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
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

require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];



echo $onamae.'様<br />';
echo 'ご注文ありがとうございました。<br />';
echo $email.'にメールを送りましたのでご確認ください。<br />';
echo '商品は以下の住所に発送させていただきます。<br />';
echo $postal1.'-'.$postal2.'<br />';
echo $address.'<br />';
echo $tel.'<br />';

$honbun='';
$honbun.=$onamae."様 \n\n このたびはご注文ありがとうございました。\n";
$honbun.="\n";
$honbun.="ご注文商品 \n";
$honbun.="-------------------\n";

$cart= $_SESSION['cart'];
$kazu= $_SESSION['kazu'];
$max= count($cart);

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

for($i=0; $i<$max; $i++)
{
	$sql='SELECT name,price FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$cart[$i];
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

	$name = $rec['name'];
	$price = $rec['price'];
	$kakaku[]=$price;
	$suryo = $kazu[$i];
	$shokei = $price * $suryo;

	$honbun.=$name.' ';
	$honbun.=$price.'円 ×';
	$honbun.=$suryo.'個=';
	$honbun.=$shokei."円\n";
}

$sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$lastmembercode=$_SESSION['member_code'];


$sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel)
VALUES(?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=$lastmembercode;
$data[]=$onamae;
$data[]=$email;
$data[]=$postal1;
$data[]=$postal2;
$data[]=$address;
$data[]=$tel;
$stmt->execute($data);

$sql='SELECT LAST_INSERT_ID()';
$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$lastcode=$rec['LAST_INSERT_ID()'];

for($i=0; $i<$max; $i++)
{
	$sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity)
	VALUES(?,?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$lastcode;
	$data[]=$cart[$i];
	$data[]=$kakaku[$i];
	$data[]=$kazu[$i];
	$stmt->execute($data);
}

$sql='UNLOCK TABLES';
$stmt=$dbh->prepare($sql);
$stmt->execute();
$dbh = null;


$honbun.="送料は無料です。\n";
$honbun.="----------------------\n";
$honbun.="\n";
$honbun.="代金は以下の口座にお振り込みください。\n";
$honbun.="ろくまる銀行 野菜支店 普通口座 1234567\n";
$honbun.="入金確認が取れ次第、梱包、発送させていただきます。 \n";
$honbun.="\n";

$honbun.="□□□□□□□□□□□□□□□□□□□□□□□□\n";
$honbun.="  ~安心野菜のろくまる農園~ \n";
$honbun.="\n";
$honbun.="○○県六丸郡六丸村 123-4\n";
$honbun.="電話 0906060-××××\n";
$honbun.="メール info@rokumarunouen.co.jp\n";
$honbun.="□□□□□□□□□□□□□□□□□□□□□□□□\n";
echo '<br />';
echo nl2br($honbun);

//メールを送信するプログラム
$title='ご注文ありがとうございます。';
$header='From:info@rokumarunouen.co.jp';
$honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($email,$title,$honbun,$header);

//お店側の注文確認メールプログラム
$title='お客様から注文がありました。';
$header='From:'.$email;
$honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail('info@rokumarunouen.co.jp',$title,$honbun,$header);

//メールヘッダーインジェクション対策
$from = str_replace(PHP_EOL, '', $from);

mb_language('ja');
mb_internal_encoding('UTF-8');                        
mb_send_mail('example@example.com', 'Title', 'Body',"From: {$from}");
}
catch(Exception $e)
{
	echo $e;
	exit();
}
?>
<br />
<a href="shop_list.php">商品画面へ</a><br />
カートの中身を空に致します。<br />
			
</body>
</html>