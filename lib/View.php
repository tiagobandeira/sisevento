<?php  
/*
	@About
	Autor: Tiago Bandeira
	SisEvento 
	Versão: 1.0
*/

class View
{
	private $con;
	private $dados;
	private $contents;
	private $view;
	function __construct($view = null,$dados = null)
	{
		if($view != null){
			$this->view = $view;
		}
		$this->dados = $dados;
	}
	public function getDados(){
		return $this->dados;
	}
	public function setDados(Array $dados){
		$this->dados = $dados;
	}
	public function getView(){
		return $this->view;
	}
	public function setView($view){
		$this->view = $view;
	}

	public function getContents(){
		ob_start();
		if(isset($this->view)){
			require_once $this->view;
		}
		$this->contents = ob_get_contents();
		ob_end_clean();
		return $this->contents;
		
	}
	public function showContents(){
		echo $this->contents;
		exit;
	}
}
?>