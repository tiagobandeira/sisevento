 
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
	class TipoEventoModel
	{
    	private $id;
    	private $tipo;
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
				$sql = "INSERT INTO tipoevento
						(id, tipo)
						VALUES 
						(
							null,
							'$this->tipo'
						)";
			}else{
				$sql = "UPDATE 
							tipoevento
						SET 
							tipo = '$this->tipo'
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
			
		}
		public function list($tipo = null){
			if(!empty($tipo)){
				$sql = "SELECT * FROM tipoevento WHERE tipo LIKE '$tipo%'";

			}else{
				$sql = "SELECT * FROM tipoevento";
			}
			$tipos = array();
			try{
				$query = $this->con->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$tipoevento = new TipoEventoModel($this->con);
					$tipoevento->setId($value['id']);
					$tipoevento->setTipo($value['tipo']);
					
					array_push($tipos, $tipoevento);
				}
				
				return $tipos;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM tipoevento WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();
			$tipoevento = new TipoEventoModel($this->con);
			foreach ($query as $value) {
				
				$tipoevento->setId($value['id']);
				$tipoevento->setTipo($value['tipo']);
			}
			
			return $tipoevento;
		}
		public function delete(){
			$sql = "DELETE FROM tipoevento WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
			
		}
		public function desabled(){

		}

		public function init(){
			$tipo1 = new TipoEventoModel($this->con);
			$tipo1->setTipo("Informática");
			$tipo2 = new TipoEventoModel($this->con);
			$tipo2->setTipo("Outro");	

			if ($tipo1->list($tipo1->getTipo()) == null) {
				$tipo1->save();
			}
			if ($tipo2->list($tipo2->getTipo()) == null) {
				$tipo2->save();
			}
			

		}
	}

?>
