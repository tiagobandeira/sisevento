<?php  
	/**
	* 
	*/
	require_once '../lib/ConnectDBModel.php';
	require_once '../model/UsuarioModel.php';
	require_once 'controllerModel.php';
	class ControllerIndex 
	{
		private $con;
		function __construct()
		{
			$connect = new Connect();
			$this->con = $connect->getConnect();	
		}
		public function redirect(){
			$user = new UsuarioModel();
			$lista = $user->list();
			if(count($lista) == 0){
				init();

				header('Location: ../view/cadastro.php');
			}
			
		}
	}

	
?>