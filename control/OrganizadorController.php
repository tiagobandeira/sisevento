<?php
	/**
  * Autor: Tiago Bandeira
	* class EventoController
	*@
  */
  require_once '../model/OrganizadorModel.php';

  class OrganizadorController
  {
    private $organizadorModel;
    function __construct()
    {
      $this->organizadorModel = new OrganizadorModel();
    }
    public function add($post = null){
      if($post){
        $organizador = $this->getRequestData($post);
        $organizador->save();
        return true;
      }
      return false;
    }
    public function listaOrganizador($id = null){
        $organizadorList = $this->organizadorModel->listAll($id);
        return $organizadorList;
    }
    public function getRequestData($value = null){
        $organizador = $this->organizadorModel;
        if($value){
            if(isset($value['usuario'])){
                $organizador->setUsuario($value['usuario']);
            }
            if(isset($value['evento'])){
                $organizador->setEvento($value['evento']);
            }
        }
        return $organizador;
    }
    public function get(){
        return $this->organizadorModel;
    }
  }

  $Organizador = new OrganizadorController();

?>
