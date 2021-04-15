<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
		
<?php 

require_once('../common/common.php');

$seireki = $_POST['seireki'];

$wareki = gengo($seireki);
echo $wareki;



?>
			
</body>
</html>