<?php
	/**
  * Autor: Tiago Bandeira
	* class UsuarioController
	*@
  */
  require_once '../model/UsuarioModel.php';

  class UsuarioController
  {
    private $usuarioModel;
    function __construct()
    {
      $this->usuarioModel = new UsuarioModel();
    }
    public function listaUsuario(){
      $usuarioList = $this->usuarioModel->list("");
      return $usuarioList;
    }
  }

  $Usuario = new UsuarioController();

?>
