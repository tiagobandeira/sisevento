<?php  
/*
	@About
	Autor: Tiago Bandeira
	SisEvento 
	Versão: 1.0
*/
	/**
	* 
	*/
	require_once '../model/UsuarioModel.php';
	require_once '../view/View.php';
	class UsuarioController
	{
		

		public function listarUsuarioAction(){
			$usuario = new UsuarioModel();

			$usuarios = $usuario->list();

			$view = new View();
			$view->setView('../view/conta/lista-usuarios.php');

			$view->setDados(array('usuarios' => , $usuarios));

			$view->showContents();
		}
	}

?>