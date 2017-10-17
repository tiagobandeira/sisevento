
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
	class TipoCertificadoModel
	{
    	private $id;
    	private $tipo;
    	private $texto;
    	private $cortexto;
    	private $tipousuario;
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
    	public function getTexto(){
    		return $this->texto;
    	}
    	public function setTexto($texto){
    		$this->texto = $texto;
    	}
    	public function getCorTexto(){
    		return $this->cortexto;
    	}
    	public function setCorTexto($cortexto){
    		$this->cortexto = $cortexto;
    	}

    	/*
			Manipulação de dados 
		*/

		public function  save(){
			if(!isset($this->id)){
				$sql = "INSERT INTO tipocertificado
						(
							id,
							tipo,
							texto,
							cortexto
						)
						VALUES 
						(
							null,
							'$this->tipo',
							'$this->texto',
							'$this->cortexto'
						)";
			}else{
				$sql = "UPDATE 
							tipocertificado
						SET 
							tipo = '$this->tipo',
							texto = '$this->texto',
							cortexto = '$this->cortexto'
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
		}
		public function list($nome = null){
			if(!empty($tipo)){
				$sql = "SELECT * FROM tipocertificado WHERE tipo LIKE '$tipo%'";

			}else{
				$sql = "SELECT * FROM tipocertificado";
			}
			$tipos = array();
			try{
				$query = $this->con->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$tipo = new TipoCertificadoModel($this->con);
					$tipo->setId($value['id']);
					$tipo->setTipo($value['tipo']);
					$tipo->setTexto($value['texto']);
					$tipo->setCorTexto($value['cortexto']);
					
					array_push($tipos, $tipo);
				}
				return $tipos;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM tipocertificado WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();
			$tipo = new TipoCertificadoModel($this->con);
			foreach ($query as $value) {
				$tipo->setId($value['id']);
				$tipo->setTipo($value['tipo']);
				$tipo->setTexto($value['texto']);
				$tipo->setCorTexto($value['cortexto']);
			}
			return $tipo;
		}
		public function delete(){
			$sql = "DELETE FROM tipocertificado WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
		}
		public function desabled(){

		}
	}
?>
