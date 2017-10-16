<?php 
/*
	@About
	Autor: Tiago Bandeira
	SisEvento 
	Versão: 1.0
*/
/**
* ConnectDBModel
*/
require_once '../database/install.php';
 class Connect
{
	/*
		Guarda os dados da conexão
	*/
	public  $con;
	function __construct()
	{
		$data = dataConnect();
		$host = $data[0];
		$db = $data[1];
		$user = $data[2];
		$password = $data[3];
		try{
			if ($this->con == null) {
				$this->con = new PDO("mysql:host=$host;dbname=$db", $user, $password);	
			}
		}catch(PDOException $e){
			echo "Não foi possível conectar com a base de dados. " . $e->getMessage();
		}
	}
	public function getConnect(){
		return $this->con;
	}
}
?>