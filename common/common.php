<?php 

function gengo($seireki)
{
	
	if(1868<=$seireki && $seireki<=1911)
{
	$gengo='明治';
}
else{
	$gengo='記入が間違っています';
}
  if(1912<=$seireki && $seireki<=1925)
  {
		$gengo='大正';
	}
	if(1926<=$seireki && $seireki<=1988)
	{
		$gengo='昭和';
	}
	if(1989<=$seireki && $seireki<=2018)
	{
		$gengo='平成';
	}
	if(2019<=$seireki)
	{
		$gengo='令和';
	}
	
	return($gengo);
}


function sanitize($before)

  {	

	foreach($before as $key=>$value)

	{
		$after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');

	}
	
	return $after;
}

