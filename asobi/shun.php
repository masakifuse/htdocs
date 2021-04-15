<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

$tsuki=$_POST['tsuki'];

$yasai[] ='';
$yasai[] ='ブロッコリー';
$yasai[] ='カリフラワー';
$yasai[] ='レタス';
$yasai[] ='みつば';
$yasai[] ='アスパラガス';
$yasai[] ='セロリ';
$yasai[] ='ナス';
$yasai[] ='ピーマン';
$yasai[] ='オクラ';
$yasai[] ='さつまいも';
$yasai[] ='大根';
$yasai[] ='ほうれんそう';

echo $tsuki;
echo '月は';
echo $yasai[$tsuki];
echo 'が旬です。';

?>
</body>
</html>