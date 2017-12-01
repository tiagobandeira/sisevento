
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
	class TipoUsuarioModel
	{
    	private $id;
    	private $tipo;
    	private $con;

    	function __construct($id = null, $tipo = null, $con = null)
		{
			$this->id = $id;
			$this->tipo = $tipo;	
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
    	public function getTipo(){
    		return $this->tipo;
    	}
    	public function setTipo($tipo){
    		$this->tipo = $tipo;
    	}

    	/*
			Manipulação de dados 
		*/

		public function  save(){
			if(!isset($this->id)){
				$sql = "INSERT INTO tipousuario
						(
							id,
							tipo
						)
						VALUES 
						(
							null,
							'$this->tipo'
						)";
			}else{
				$sql = "UPDATE 
							tipousuario
						SET 
							tipo = '$this->tipo'							
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
		}
		public function list($tipo = null){
			if(!empty($tipo)){
				$sql = "SELECT * FROM tipousuario WHERE tipo LIKE '$tipo%'";

			}else{
				$sql = "SELECT * FROM tipousuario";
			}
			$tipos = array();
			try{
				$query = $this->con->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$tipo = new TipoUsuarioModel(null, null, $this->con);
					$tipo->setId($value['id']);
					$tipo->setTipo($value['tipo']);
					
					array_push($tipos, $tipo);
				}
				return $tipos;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM tipousuario WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();
			$tipo = new TipoUsuarioModel($this->con);
			foreach ($query as $value) {
				$tipo->setId($value['id']);
				$tipo->setTipo($value['tipo']);
			}
			return $tipo;
		}
		public function delete(){
			$sql = "DELETE FROM tipousuario WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
		}
		public function desabled(){

		}

		/*
		Init
			Para inicionar com valores padrões
		*/
		public function init(){
			$tipo1 = new TipoUsuarioModel(null, null, $this->con);
			$tipo1->setTipo("Administrador");
			$tipo2 = new TipoUsuarioModel(null, null, $this->con);
			$tipo2->setTipo("Usuário");
			$tipo3 = new TipoUsuarioModel(null, null, $this->con);
			$tipo3->setTipo("Ministrante de minicurso");
			$tipo4 = new TipoUsuarioModel(null, null, $this->con);
			$tipo4->setTipo("Palestrante");

			if($tipo1->list($tipo1->getTipo()) == null){
				$tipo1->save();
			}
			if($tipo2->list($tipo2->getTipo()) == null){
				$tipo2->save();
			}
			if($tipo3->list($tipo3->getTipo()) == null){
				$tipo3->save();
			}
			if($tipo4->list($tipo4->getTipo()) == null){
				$tipo4->save();
			}
			


		}
	}
?>
