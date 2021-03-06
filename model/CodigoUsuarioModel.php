
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
	class CodigoUsuarioModel
	{
    	private $id;
    	private $codigo;
    	private $evento;
    	private $usuario;
    	private $status;
    	private $con;

    	function __construct($con = null)
		{
			$this->id = null;
			$this->codigo = null;	
			$this->evento = null;
			$this->usuario = null;
			$this->status = "D";
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
    	public function getCodigo(){
    		return $this->codigo;
    	}
    	public function setCodigo($codigo){
    		$this->codigo = $codigo;
    	}
    	public function getEvento(){
    		return $this->evento;
    	}
    	public function setEvento($evento){
    		$this->evento = $evento;
    	}
    	public function getUsuario(){
    		return $this->usuario;
    	}
    	public function setUsuario($usuario){
    		$this->usuario = $usuario;
    	}
    	public function getStatus(){
    		return $this->status;
    	}
    	public function setStatus($status){
    		$this->status = $status;
    	}

    	/*
			Manipulação de dados 
		*/

		public function  save(){
			if(!isset($this->id)){
				$sql = "INSERT INTO codigousuario
						(
							id,
							codigo,
							evento,
							usuario,
							status
						)
						VALUES 
						(
							null,
							'$this->codigo',
							'$this->evento',
							'$this->usuario',
							'$this->status'
						)";
			}else{
				$sql = "UPDATE 
							codigousuario
						SET 
							codigo = '$this->codigo',
							evento = '$this->evento',
							usuario = '$this->usuario',	
							status = '$this->status'					
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
		}
		public function listAll($evento = null){
			if(!empty($evento)){
				$sql = "SELECT * FROM codigousuario WHERE evento = $evento";

			}else{
				$sql = "SELECT * FROM codigousuario";
			}
			$codigos = array();
			try{
				$query = $this->con->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$codigo = new CodigoUsuarioModel($this->con);
					$codigo->setId($value['id']);
					$codigo->setCodigo($value['codigo']);
					$codigo->setEvento($value['evento']);
					$codigo->setUsuario($value['usuario']);
					$codigo->setStatus($value['status']);
					
					array_push($codigos, $codigo);
				}
				return $codigos;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM codigousuario WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();
			$codigo = new CodigoUsuarioModel($this->con);
			foreach ($query as $value) {
				$codigo->setId($value['id']);
				$codigo->setCodigo($value['codigo']);
				$codigo->setEvento($value['evento']);
				$codigo->setUsuario($value['usuario']);
				$codigo->setStatus($value['status']);
			}
			return $codigo;
		}
		public function delete(){
			$sql = "DELETE FROM codigousuario WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
		}
		public function desabled(){

		}
		public function listByUsuario($idusuario){
			if(!empty($idusuario)){
				$sql = "SELECT * FROM codigousuario WHERE usuario = :id";

			}else{
				$sql = "SELECT * FROM codigousuario";
			}
			$codigos = array();
			try{
				$query = $this->con->prepare($sql);
				$query->bindValue(":id", $idusuario);
				$query->execute();
				foreach ($query as $value) {
					$codigo = new CodigoUsuarioModel($this->con);
					$codigo->setId($value['id']);
					$codigo->setCodigo($value['codigo']);
					$codigo->setEvento($value['evento']);
					$codigo->setUsuario($value['usuario']);
					$codigo->setStatus($value['status']);
					
					array_push($codigos, $codigo);
				}
				return $codigos;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}

		
	}

?>
