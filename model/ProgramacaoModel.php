
<?php  
/*
	@About
	Autor: Tiago Bandeira
	SisEvento 
	Versão: 1.0
*/
	require_once '../lib/ConnectDBModel.php';
	require_once '../database/executeQuery.php';

	/**
	* 
	*/
	class ProgramacaoModel
	{
    	private $id;
    	private $titulo;
    	private $descricao;
    	private $horaInicio;
    	private $hotaFim;
    	private $evento;
    	private $con;

    	function __construct($con = null)
		{
			if ($con == null) {
				$connect = new Connect();
				$this->con = $connect->getConnect();	
			}else{
				$this->con = $con;
			}				
		}

		public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}
		public function getTitulo(){
			return $this->titulo;
		}
		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}
		public function getDescricao(){
			return $this->descricao;
		}
		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}
		public function getHoraInicio(){
			return $this->horaInicio;
		}
		public function setHoraInicio($hora){
			$this->horaInicio = $hora;
		}
		public function getHoraFim(){
			return $this->horaFim;
		}
		public function setHoraFim($hora){
			$this->horaFim = $hora;
		}
    	public function getEvento(){
    		return $this->evento;
    	}
    	public function setEvento($evento){
    		$this->evento = $evento;
    	}

    	/*
			Manipulação de dados 
		*/

		public function  save(){
			if(!isset($this->id)){
				$sql = "INSERT INTO programcao
						(
							id,
							titulo,
							descricao
							hora_inicio,
							hora_fim,
							evento
						)
						VALUES 
						(
							null,
							'$this->titulo',
							'$this->descricao',
							'$this->horaInicio',
							'$this->horaFim',
							'$this->evento'
						)";
			}else{
				$sql = "UPDATE 
							programcao
						SET 
							titulo = '$this->titulo',
							descricao = '$this->descricao'
							hora_inicio = '$this->horaInicio',
							hora_fim = '$this->horaFim',
							evento = '$this->evento'
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
		}
		public function list($titulo = null){
			if(!empty($titulo)){
				$sql = "SELECT * FROM programacao WHERE titulo LIKE '$titulo%' or '%$titulo'";

			}else{
				$sql = "SELECT * FROM programacao";
			}
			$programacoes = array();
			try{
				$query = $this->con->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$programacao = new ProgramacaoModel($this->con);
					$programacao->setId($value['id']);
					$programacao->setTitulo($value['titulo']);
					$programacao->setDescricao($value['descricao']);
					$programacao->setHoraInicio($value['hora_inicio']);
					$programacao->setHoraFim($value['hora_fim']);
					$programacao->setEvento($value['evento']);
					
					array_push($programacoes, $programacao);
				}
				return $programacoes;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM programacao WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();

			$programacao = new ProgramacaoModel($this->con);
			foreach ($query as $value) {
				$programacao->setId($value['id']);
				$programacao->setTitulo($value['titulo']);
				$programacao->setDescricao($value['descricao']);
				$programacao->setHoraInicio($value['hora_inicio']);
				$programacao->setHoraFim($value['hora_fim']);
				$programacao->setEvento($value['evento']);
			}
			return $programacao;
		}
		public function delete(){
			$sql = "DELETE FROM programacao WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
		}
		public function desabled(){

		}
	}

?>