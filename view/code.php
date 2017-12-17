<?php
	require_once '../model/CodigoUsuarioModel.php';
	require_once '../model/EventoModel.php';

	function cod($evento, $usuario = null){
		$K = $evento + 100;
		if(!isset($usuario)){
			return 51 * $K + $usuario;
		}
		return 51 * $K + $usuario;
	}
	function participar($POST){
		$codigo = new CodigoUsuarioModel();

		if(status($POST)){
			$codigo->setCodigo(cod($POST));
			$codigo->setEvento($POST);
			$codigo->setUsuario($_SESSION['id']);
			$codigo->setStatus("B");
			$codigo->save();
			return $codigo;
		}
	}
	function deixarDeParticipar($idCodigo){
		$codigoModel = new CodigoUsuarioModel();
		$codigoModel->setId($idCodigo);
		$codigoModel->delete();
	}
	function status($evento){
		$codigo = new CodigoUsuarioModel();
		$codigo->setUsuario($_SESSION['id']);
		$codigo->setEvento($evento);
		$cod = $codigo->readById($evento);
		$cods = $codigo->list($evento);
		#if($cod == null){
		#	return false;
		#}
		foreach ($cods as $value) {
			if ($value->getUsuario() == $codigo->getUsuario() && $value->getEvento() == $codigo->getEvento()) {
				return false;
			}
		}

		return true;
	}




?>
