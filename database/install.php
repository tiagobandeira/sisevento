<?php
	/*
	@About
	Autor: Tiago Bandeira
	SisEvento
	Versão: 1.0

	*/
	function dataConnect(){
		
		$host = "mysql.hostinger.com.br";
		$db = "u599766642_even";
		$user = "u599766642_tiago";
		$password = "i6d3tUWfH5Ax";
		
		$data = array();
		array_push($data, $host);
		array_push($data, $db);
		array_push($data, $user);
		array_push($data, $password);
		return $data;
	}
?>
