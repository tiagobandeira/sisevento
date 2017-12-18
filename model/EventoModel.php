
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
	class EventoModel
	{
    	private $id;
    	private $nome;
    	private $dataInicio;
    	private $dataFim;
    	private $tipo;
    	private $endereco;
    	private $usuario;
    	private $cargahoraria;
    	private $status;
    	private $con;

    	function __construct($id = null, $nome = null, $dataInicio = null, $dataFim = null, $tipo = null, $endereco = null, $status = null, $usuario = 1, $cargahoraria = 0, $con = null)
		{
			$this->id = $id;
			$this->nome = $nome;
			$this->dataInicio = $dataInicio;
			$this->dataFim = $dataFim;
			$this->tipo = $tipo;
			$this->endereco = $endereco;
			$this->status = $status;
			$this->usuario = $usuario;
			$this->cargahoraria = $cargahoraria;

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
		public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome = $nome;
		}
		public function getDataInicio(){
			return $this->dataInicio;
		}
		public function setDataInicio($data){
			$this->dataInicio = $data;
		}
		public function getDataFim(){
			return $this->dataFim;
		}
		public function setDataFim($data){
			$this->dataFim = $data;
		}
    	public function getTipo(){
    		return $this->tipo;
    	}
    	public function setTipo($tipo){
    		$this->tipo = $tipo;
    	}
    	public function setEndereco($endereco){
			$this->endereco = $endereco;
		}
		public function getEndereco(){
			return $this->endereco;
		}
		public function setUsuario($usuario){
			$this->usuario = $usuario;
		}
		public function getUsuario(){
			return $this->usuario;
		}
		public function setCargaHoraria($cargahoraria){
			$this->cargahoraria = $cargahoraria;
		}
		public function getCargaHoraria(){
			return $this->cargahoraria;
		}
		public function setStatus($status){
			$this->status = $status;
		}
		public function getStatus(){
			return $this->status;
		}
		public function getCon(){
			return $this->con;
		}
    	/*
			Manipulação de dados 
		*/

		public function  save(){
			if(!isset($this->id)){
				$sql = "INSERT INTO evento
						(
							id,
							nome,
							data_inicio,
							data_fim,
							tipo,
							endereco,
							status,
							usuario,
							cargahoraria
						)
						VALUES 
						(
							null,
							'$this->nome',
							'$this->dataInicio',
							'$this->dataFim',
							'$this->tipo',
							'$this->endereco',
							'$this->status',
							'$this->usuario',
							'$this->cargahoraria'
						)";
			}else{
				$sql = "UPDATE 
							evento
						SET 
							nome = '$this->nome',
							data_inicio = '$this->dataInicio',
							data_fim = '$this->dataFim',
							tipo = '$this->tipo',
							endereco = '$this->endereco',
							status = '$this->status',
							usuario = '$this->usuario',
							cargahoraria = '$this->cargahoraria'
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
		}
		public function listAll($nome = null){
			if(!empty($nome)){
				$sql = "SELECT * FROM evento WHERE nome LIKE '$nome%' or '%$nome'";

			}else{
				$sql = "SELECT * FROM evento ORDER BY id DESC";
			}
			$eventos = array();
			try{
				$connect = new Connect();
				$conexao = $connect->getConnect();
				$query = $conexao->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$evento = new EventoModel(null,null,null,null,null, null,null,0, 0, $this->con);#ganbirra
					$evento->setId($value['id']);
					$evento->setNome($value['nome']);
					$evento->setDataInicio($value['data_inicio']);
					$evento->setDataFim($value['data_fim']);
					$evento->setStatus($value['status']);
					$evento->setTipo($value['tipo']);
					$evento->setEndereco($value['endereco']);
					$evento->setCargaHoraria($value['cargahoraria']);
					
					array_push($eventos, $evento);
					
				}
				return $eventos;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM evento WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();
			$evento = new EventoModel();
			foreach ($query as $value) {
				$evento->setId($value['id']);
				$evento->setNome($value['nome']);
				$evento->setDataInicio($value['data_inicio']);
				$evento->setDataFim($value['data_fim']);
				$evento->setStatus($value['status']);
				$evento->setTipo($value['tipo']);
				$evento->setEndereco($value['endereco']);
				$evento->setUsuario($value['usuario']);
				$evento->setCargaHoraria($value['cargahoraria']);
			}
			return $evento;
		}
		public function delete(){
			$sql = "DELETE FROM evento WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
		}
		public function desabled(){

		}
		public function listById($id){
			$sql = "SELECT * FROM evento WHERE id = :id";
			$eventos = array();
			try{

				$query = $this->con->prepare($sql);
				$query->bindValue(":id", $id);
				$query->execute();
				foreach ($query as $value) {
					$evento = new EventoModel(null,null,null,null,null,null, null,0, 0, $this->con);
					$evento->setId($value['id']);
					$evento->setNome($value['nome']);
					$evento->setDataInicio($value['data_inicio']);
					$evento->setDataFim($value['data_fim']);
					$evento->setTipo($value['tipo']);
					$evento->setEndereco($value['endereco']);
					$evento->setUsuario($value['usuario']);
					
					array_push($eventos, $evento);
				}
				return $eventos;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function listaPorUsuario($id){
			$sql = "SELECT * FROM evento WHERE usuario = :id";
			$eventos = array();
			try{

				$query = $this->con->prepare($sql);
				$query->bindValue(":id", $id);
				$query->execute();
				foreach ($query as $value) {
					$evento = new EventoModel(null,null,null,null,null,null, null,0, 0, $this->con);
					$evento->setId($value['id']);
					$evento->setNome($value['nome']);
					$evento->setDataInicio($value['data_inicio']);
					$evento->setDataFim($value['data_fim']);
					$evento->setTipo($value['tipo']);
					$evento->setEndereco($value['endereco']);
					$evento->setUsuario($value['usuario']);
					
					array_push($eventos, $evento);
				}
				return $eventos;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function init(){
			
		}
		
	}
?>