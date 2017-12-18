<?php
	/**
  * Autor: Tiago Bandeira
	* class Message
	*@
  */
  class Message
  {
    public $success;
    public $error;
    function __construct(){
        $this->success = "Operação realizada com sucesso.";
        $this->error = "Erro ao realizar esta operação.";
    }
    public function success($value = null){
        if(!isset($value)){
          $value = $this->success;
        }
        $message = "<div class='alert alert-success' >" . $value . "</div>";
        echo $message;
    }
    public function error($value = null){
        if(!isset($value)){
          $value = $this->error;
        }
        $message = "<div class='alert alert-success' >" . $value . "</div>";
        echo $message;
    }
  }
  $Print = new Message();
  
  
  
?>