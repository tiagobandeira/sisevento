<?php  
	/*
	@About
	Autor: Tiago Bandeira
	SisEvento 
	Versão: 1.0
*/
	session_start();
	if($_POST['btn'] == "entrar"){
		if(isset($_POST['user']) && isset($_POST['password'])){

			require_once '../model/UsuarioModel.php';
			require_once '../model/TipoUsuarioModel.php';
			
			$user = new UsuarioModel();
			$user->setNome($_POST['user']);
			$user->setSenha($_POST['password']);
			$lista = $user->listByNameUser($user->getNome());
			$flag = false;
			foreach ($lista as $value) {
				if($user->getNome() == $value->getNome() && $user->getSenha() == $value->getSenha()){
					
					$_SESSION['id'] = $value->getId();
					$_SESSION['type'] = $value->getTipo();
					$flag = true;
					unset($_SESSION['error']);
					break;
				}
			}
			if ($flag) {
				if($_SESSION['type'] == 1){
					header("Location: administrador.php");
				}else if($_SESSION['type'] == 2){
					header("Location: usuario.php");
				}else{
					header("Location: participante.php");
				}
			}else{
				$_SESSION['error'] = 'userexists';
				header('Location: ../view');
			}
			
			
		}
	}else if($_POST['btn'] == "cadastrar"){
		header("Location: cadastro-usuario.php");
	}

?>