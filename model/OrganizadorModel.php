
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
	class OrganizadorModel
	{
    	private $id;
    	private $usuario;
    	private $evento;
    	private $con;

    	function __construct($id = null, $usuario = null, $evento = null)
		{
			$this->id = $id;
			$this->usuario = $usuario;
			$this->evento = $evento;	
			$connect = new Connect();
			$this->con = $connect->getConnect();		
		}

		public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}
    	public function getUsuario(){
    		return $this->usuario;
    	}
    	public function setUsuario($usuario){
    		$this->usuario = $usuario;
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
				$sql = "INSERT INTO organizador
						(
							id,
							usuario,
							evento
						)
						VALUES 
						(
							null,
							'$this->usuario',
							'$this->evento'
						)";
			}else{
				$sql = "UPDATE 
							organizador
						SET 
							usuario = '$this->usuario',
							evento = '$this->evento'							
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
		}
		public function list($id = null){
			if(!empty($id)){
				$sql = "SELECT * FROM organizador WHERE evento = :id";

			}else{
				$sql = "SELECT * FROM organizador";
			}
			$organizadores = array();
			try{
				$query = $this->con->prepare($sql);
				$query->bindValue(":id", $id);
				$query->execute();
				foreach ($query as $value) {
					$organizador = new OrganizadorModel();
					$organizador->setId($value['id']);
					$organizador->setUsuario($value['usuario']);
					$organizador->setEvento($value['evento']);
					
					array_push($organizadores, $organizador);
				}
				return $organizadores;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM organizador WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();
			$organizador = new TipoUsuarioModel();
			foreach ($query as $value) {
				$organizador = new OrganizadorModel();
				$organizador->setId($value['id']);
				$organizador->setUsuario($value['usuario']);
				$organizador->setEvento($value['evento']);
			}
			return $organizador;
		}
		public function delete(){
			$sql = "DELETE FROM organizador WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
		}
		public function desabled(){

		}

	}
?>
