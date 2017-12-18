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
  }

  $Evento = new EventoController();

?>
