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
    public function add($post = null){
      if($post){
        $usuario = $this->getRequestData($post);
        //logica para adicionar o codigo do evento
        $usuario->save();
        return "Adicionou";
      }
      return "Não adicionou";
    }
    public function getRequestData($value = null){
      $usuario = $this->usuarioModel;
      if($value){
        if(isset($value['nome'])){
          $usuario->setNome($value['nome']);
        }
        if(isset($value['nomecompleto'])){
          $usuario->setNomeCompleto($value['nomecompleto']);
        }
        if(isset($value['senha'])){
          $usuario->setSenha($value['senha']);
        }
        if(isset($value['email'])){
          $usuario->setEmail($value['email']);
        }
        if(isset($value['tipo'])){
          $usuario->setTipo($value['tipo']);
        }
        if(!empty($value['fone'])){
          $usuario->setFone($value['fone']);
        }
        if(isset($value['cargo'])){
          $usuario->setCargo($value['cargo']);
        }
        if(!empty($value['siape'])){
          $usuario->setSiape($value['siape']);
        }
        if(isset($value['evento'])){
          //criar codigo do usuario para aquele evento
        }
      }
      return $usuario;
    }
    public function get(){
      return $this->usuarioModel;
    }
  }

  $Usuario = new UsuarioController();

?>
