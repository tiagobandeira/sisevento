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
			require_once '../model/TipoEventoModel.php';
			require_once 'EXEMPLO.php';
			#iniciar tipos de evento e usuario
			$tipouser = new TipoUsuarioModel();
			$tipouser->init();
			$tipoevento = new TipoEventoModel();
			$tipoevento->init();


			$user = new UsuarioModel();
			$user->setNome($_POST['user']);
			$user->setEmail($_POST['email']);
			$user->setSenha($_POST['password']);
			$user->setTipo(1);
			$user->save();

			#iniciar exemplo 
			iniciarExemplo();

			$users = $user->list();
			foreach ($users as $value) {
				if($value->getNome() == $user->getNome()){
					$id = $value->getId();
					$type = $value->getTipo();
					break;
				}
			}
			$_SESSION['id'] = $id;
			$_SESSION['type'] = $type;
			header('Location: administrador.php');

		}
	
?>