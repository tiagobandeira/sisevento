<?php  
	/*
	@About
	Autor: Tiago Bandeira
	SisEvento 
	Versão: 1.0
*/
	session_start();
		if(isset($_POST['user']) && isset($_POST['password'])){
			require_once '../model/UsuarioModel.php';
			require_once '../model/TipoUsuarioModel.php';
			$tipouser = new TipoUsuarioModel();
			$tipouser->init();

			$user = new UsuarioModel();
			$user->setNome($_POST['user']);
			$user->setEmail($_POST['email']);
			$user->setSenha($_POST['password']);
			$user->setTipo(1);
			$user->save();

			
			$_SESSION['id'] = $id;
			$_SESSION['type'] = $type;
			header('Location: administrador.php');

		}
	
?>