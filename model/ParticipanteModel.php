
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
	class ParticipanteModel
	{
    	private $id;
    	private $nome;
    	private $cpf;
    	private $fone;
    	private $codigo;
    	private $tipo;
    	private $con;

    	function __construct($id = null, $nome = null, $cpf = null, $fone = null, $codigo = null, $tipo = null)
		{
			$this->nome = $nome;
			$this->cpf = $cpf;
			$this->fone = $fone;	
			$this->codigo = $codigo;
			$this->tipo = $tipo;
			$connect = new Connect();
			$this->con = $connect->getConnect();		
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
    	public function getCPF(){
    		return $this->cpf;
    	}
    	public function setCPF($cpf){
    		$this->cpf = $cpf;
    	}
    	public function getFone(){
    		return $this->fone;
    	}
    	public function setFone($fone){
    		$this->fone = $fone;
    	}
    	public function getCodigo(){
    		return $this->codigo;
    	}
    	public function setCodigo($codigo){
    		$this->codigo = $codigo;
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
				$sql = "INSERT INTO participante
						(
							id,
							nome,
							cpf,
							fone,
							codigo,
							tipo
						)
						VALUES 
						(
							null,
							'$this->nome',
							'$this->cpf',
							'$this->fone',
							'$this->codigo',
							'$this->tipo'
						)";
			}else{
				$sql = "UPDATE 
							participante
						SET 
							nome = '$this->nome'
							cpf = '$this->cpf',
							fone = '$this->fone',
							codigo = '$this->codigo',
							tipo = '$this->tipo'
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
		}
		public function list($nome = null){
			if(!empty($nome)){
				$sql = "SELECT * FROM participante WHERE nome LIKE '$nome%'";

			}else{
				$sql = "SELECT * FROM participante";
			}
			$participantes = array();
			try{
				$query = $this->con->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$participante = new ParticipanteModel();
					$participante->setId($value['id']);
					$participante->setNome($value['nome']);
					$participante->setCPF($value['cpf']);
					$participante->setFone($value['fone']);
					$participante->setCodigo($value['codigo']);
					$participante->setTipo($value['tipo']);
					
					array_push($participantes, $participante);
				}
				return $participantes;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM participante WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();
			$participante = new ParticipanteModel();
			foreach ($query as $value) {
				$participante = new ParticipanteModel();
				$participante->setId($value['id']);
				$participante->setNome($value['nome']);
				$participante->setCPF($value['cpf']);
				$participante->setFone($value['fone']);
				$participante->setFone($value['codigo']);
				$participante->setTipo($value['tipo']);
			}
			return $participante;
		}
		public function delete(){
			$sql = "DELETE FROM participante WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
		}
		public function desabled(){

		}
	}

?>
