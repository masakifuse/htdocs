<?php 
session_start();
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
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>ろくまる農園</title>
</head>
<body>
		

<h5>ログアウトしました。</h5>
<br />
<a href="../staff_login/staff_login.html" class="logout">ログイン画面へ</a>
			
</body>
</html>