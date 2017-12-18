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
    public $time;
    public $url;
    function __construct($url = null){
        $this->success = "Operação realizada com sucesso.";
        $this->error = "Erro ao realizar esta operação.";
        $this->time = 2;
        $this->url = $url;
    }
    public function success($value = null,$time = null, $url = null){
        if(!isset($value)){
          $value = $this->success;
        }
        if(!isset($time)){
          $time = $this->time;
        }
        if(!isset($url)){
          $url = "";
        }
       
        $message = "<div class='alert alert-success' >" . $value . "</div>";
        $refresh = "<meta HTTP-EQUIV='refresh' CONTENT='". $time . ";URL=" . $this->url . $url . "'>";

        echo $message;
        if(isset($url)){
          echo $refresh;
        }
       
    }
    public function error($value = null, $time = null){
        if(!isset($value)){
          $value = $this->error;
        }
        $message = "<div class='alert alert-danger' >" . $value . "</div>";
        echo $message;
    }
    public function setTime($time = null){
      $this->time = $time;
    }
  }
  //$Print = new Message();
  
  
  
?>