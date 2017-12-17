<?php
	/**
  * Autor: Tiago Bandeira
	* class CodigoUsuarioController
	*@
  */
  require_once '../model/CodigoUsuarioModel.php';
  
  class CodigoUsuarioController
  {
    private $codigoUsuarioModel;
    function __construct()
    {
        $this->codigoUsuarioModel = new CodigoUsuarioModel();
    }
    public function listaCodigoUsuario(){
        $codigoList = $this->codigoUsuarioModel->listAll("");
        return $codigoList;
    }
    public function add($post = null){
        if($post){
        $codigo = $this->getRequestData($post);
        //logica para adicionar o codigo do evento
        $codigo->save();
        return "Adicionou";
        }
        return "Não adicionou";
    }
    public function getRequestData($value = null, $data = null){
        $codigo = $this->codigoUsuarioModel;
        if($value){
            if(isset($value['codigo'])){
                $codigo->setCodigo($value['codigo']);
            }
            if(isset($value['evento'])){
                $codigo->setEvento($value['evento']);
            }
            if(isset($value['usuario'])){
                $codigo->setUsuario($value['usuario']);
            }
            if(isset($value['status'])){
                $codigo->setStatus($value['status']);
            }
        }
        return $codigo;
    }
    public function get(){
      return $this->codigoUsuarioModel;
    }
  }

  $Codigo = new CodigoUsuarioController();

?>
