<?php  
/*
	@About
	Autor: Tiago Bandeira
	SisEvento 
	Versão: 1.0
*/
	function init(){
		require_once '../database/createDB.php';
		$create = new CreateDB();
		return $create->create();
	}

?>