<?php  
	$ano = date("Y");
	$mes = date("m");
	$dia = date("d");
	$arrayData = [$ano, $mes, $dia];
	$data = implode("-", $arrayData);
	echo $data;
?>