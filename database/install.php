<?php  
	/*
	@About
	Autor: Tiago Bandeira
	SisEvento 
	Versão: 1.0

	*/
	function dataConnect(){
		
		$host = "127.0.0.1";
		$db = "sisevento";
		$user = "root";
		$password = "tiagoadmin";

		
		$data = array();
		array_push($data, $host);
		array_push($data, $db);
		array_push($data, $user);
		array_push($data, $password);
		return $data;
	}
?>
