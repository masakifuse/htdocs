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
$staff_name=$post['name'];
$staff_pass=$post['pass'];
$staff_pass2=$post['pass2'];


if($staff_name=='')
{
  echo'スタッフ名が入力されていません。<br />';
}
else
{
  echo 'スタッフ名:';
  echo $staff_name;
  echo '<br />';
}

if($staff_pass=='')
{
  echo 'パスワードが入力されていません。<br />';
}

if($staff_pass!= $staff_pass2)
{
  echo 'パスワードが一致しません。<br />';
}

if($staff_name==''||$staff_pass==''||$staff_pass!=$staff_pass2)
{
  echo '<form>';
  echo '<input type = "button" onclick= "history.back()" value="戻る">';
  echo '</form>';
}
else
{
  $staff_pass=md5($staff_pass);
  echo '<form method="post" action="staff_add_done.php">';
  echo '<input type="hidden" name= "name" value="'.$staff_name.'">'; 
  echo '<input type="hidden" name= "pass" value="'.$staff_pass.'">';
  echo '<br />';
  echo '<input type="button" onclick="history.back()" value="戻る">';
  echo '<input type="submit" value = "OK">';
  echo '</form>';
}
?>
</body>
</html>