<?php
	/**
  * Autor: Tiago Bandeira
	* class EventoController
	*@
  */
  require_once '../model/EventoModel.php';

  class EventoController
  {
    private $eventoModel;
    function __construct()
    {
      $this->eventoModel = new EventoModel();
    }
    public function add($post = null){
      if($post){
        $evento = $this->getRequestData($post);
        $evento->save();
        return true;
      }
      return false;
    }
    public function listaEvento(){
      $eventoList = $this->eventoModel->listAll("");
      return $eventoList;
    }
    public function eventosUsuario($id = null){
      $eventoList = $this->eventoModel->listaPorUsuario($id);
      return $eventoList;
    }
    //recebe o ano e retorna eventos daquele ano
    public function selecionaAno($ano = null){
      $eventos = array();
      if($ano){
        $lista = $this->eventoModel->listAll();
        foreach ($lista as $value) {
          $anoEvento = date("Y", strtotime($value->getDataInicio()));
          if($anoEvento == $ano){
            array_push($eventos, $value);
          }
        }
      }else{
        $eventos = $this->selecionaAno(date("Y"));
      }
      return $eventos;
    }
    public function ordenarAno(){
      $anoArray = array();
      $listaAno = array();
      foreach ($this->listaEvento() as $value) {
        $valueAno = date("Y", strtotime($value->getDataInicio()));
        array_push($anoArray, $valueAno);
      }

      if($anoArray){
        for ($i=1; $i < count($anoArray); $i++) {
           for($j = $i + 1; $j < count($anoArray); $j++){

             if($anoArray[$i] > $anoArray[$j]){
               $aux = $anoArray[$i];
               $anoArray[$i] = $anoArray[$j];
               $anoArray[$j] = $aux;

               $i--;
             }
           }
        }
      }
      for ($i=0; $i < count($anoArray); $i++) {
        if($anoArray[$i] != $anoArray[$i - 1]){
          array_push($listaAno, $anoArray[$i]);
        }
      }


      return array_reverse($listaAno);
    }
    public function get($codigoId = null)
    {
      if($codigoId){
        return $this->eventoModel->readById($codigoId);
      }
      return $this->eventoModel;
    }
    public function getRequestData($value = null){
      $evento = $this->eventoModel;
      if($value){
        
        if(isset($value['nome'])){
          $evento->setNome($value['nome']);  
        }
        if(isset($value['data_inicio'])){
          $evento->setDataInicio($value['data_inicio']);
        }
        if(isset($value['data_fim'])){
          $evento->setDataFim($value['data_fim']);
        }
        if(isset($value['status'])){
          $evento->setStatus($value['status']);    
        }
        if(isset($value['tipo'])){
          $evento->setTipo($value['tipo']);
        }
        if(isset($value['endereco'])){
          $evento->setEndereco($value['endereco']);
        }
        if(isset($value['usuario'])){
          $evento->setUsuario($value['usuario']);    
        }
        if(isset($value['cargahoraria'])){
          $evento->setCargaHoraria($value['cargahoraria']);  
        }
      }
      return $evento;
    }
  }

  $Evento = new EventoController();

?>
