
<?php  
/*
	@About
	Autor: Tiago Bandeira
	SisEvento 
	Versão: 1.0
*/
	require_once '../lib/ConnectDBModel.php';

	/**
	* 
	*/
	class UsuarioModel
	{
    	private $id;
    	private $nome;
    	private $nomeCompleto;
    	private $senha;
    	private $email;
    	private $tipo;
    	private $fone;
    	private $cargo;
    	private $siape;
    	private $con;

    	function __construct($id = null, $nome = null, $nomeCompleto = null, $senha = null, $email = null, $tipo = null, $fone = 0, $cargo = null, $siape = 0)
		{
			$this->id = $id;
			$this->nome = $nome;
			$this->nomeCompleto = $nome;
			$this->senha = $senha;
			$this->email = $email;	
			$this->tipo = $tipo;
			$this->fone = $fone;
			$this->cargo = $cargo;
			$this->siape = $siape;
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
    	public function getSenha(){
    		return $this->senha;
    	}
    	public function setSenha($senha){
    		$this->senha = $senha;
    	}
    	public function getEmail(){
    		return $this->email;
    	}
    	public function setEmail($email){
    		$this->email = $email;
    	}
    	public function getTipo(){
    		return $this->tipo;
    	}
    	public function setTipo($tipo){
    		$this->tipo = $tipo;
    	}
    	public function getFone(){
    		return $this->fone;
    	}
    	public function setFone($fone){
    		$this->fone = $fone;
    	}
    	public function getNomeCompleto(){
    		return $this->nomeCompleto;
    	}
    	public function setNomeCompleto($nomeCompleto){
    		$this->nomeCompleto = $nomeCompleto;
    	}
    	public function getCargo(){
    		return $this->cargo;
    	}
    	public function setCargo($cargo){
    		$this->cargo = $cargo;
    	}
    	public function getSiape(){
    		return $this->siape;
    	}
    	public function setSiape($siape){
    		$this->siape = $siape;
    	}

    	/*
			Manipulação de dados 
		*/

		public function  save(){
			if(!isset($this->id)){
				$sql = "INSERT INTO usuario
						(
							id,
							nome,
							nomecompleto,
							senha,
							email,
							tipo,
							fone,
							cargo,
							siape
						)
						VALUES 
						(
							null,
							'$this->nome',
							'$this->nomeCompleto',
							'$this->senha',
							'$this->email',
							'$this->tipo',
							'$this->fone',
							'$this->cargo',
							'$this->siape'
						)";
			}else{
				$sql = "UPDATE 
							usuario
						SET 
							nome = '$this->nome',
							nomecompleto = '$this->nomeCompleto',
							senha = '$this->senha',
							email = '$this->email',
							tipo = '$this->tipo',
							fone = '$this->fone',
							cargo = '$this->cargo',
							siape = '$this->siape'
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
		}
		public function list($nome = null){
			if(!empty($nome)){
				$sql = "SELECT * FROM usuario WHERE nomecompleto LIKE '%$nome%'";
			}else{
				$sql = "SELECT * FROM usuario";
			}
			$usuarios = array();
			try{
				$query = $this->con->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$usuario = new UsuarioModel();
					$usuario->setId($value['id']);
					$usuario->setNome($value['nome']);
					$usuario->setNomeCompleto($value['nomecompleto']);
					$usuario->setSenha($value['senha']);
					$usuario->setEmail($value['email']);
					$usuario->setTipo($value['tipo']);
					$usuario->setFone($value['fone']);
					$usuario->setCargo($value['cargo']);
					$usuario->setSiape($value['siape']);
					
					array_push($usuarios, $usuario);
				}
				return $usuarios;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function listByNameUser($nome = null){
			if(!empty($nome)){
				$sql = "SELECT * FROM usuario WHERE nome LIKE '%$nome%'";
			}else{
				$sql = "SELECT * FROM usuario";
			}
			$usuarios = array();
			try{
				$query = $this->con->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$usuario = new UsuarioModel();
					$usuario->setId($value['id']);
					$usuario->setNome($value['nome']);
					$usuario->setNomeCompleto($value['nomecompleto']);
					$usuario->setSenha($value['senha']);
					$usuario->setEmail($value['email']);
					$usuario->setTipo($value['tipo']);
					$usuario->setFone($value['fone']);
					$usuario->setCargo($value['cargo']);
					$usuario->setSiape($value['siape']);
					
					array_push($usuarios, $usuario);
				}
				return $usuarios;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM usuario WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();
			$usuario = new UsuarioModel();
			foreach ($query as $value) {
				$usuario->setId($value['id']);
				$usuario->setNome($value['nome']);
				$usuario->setNomeCompleto($value['nomecompleto']);
				$usuario->setSenha($value['senha']);
				$usuario->setEmail($value['email']);
				$usuario->setTipo($value['tipo']);
				$usuario->setFone($value['fone']);
				$usuario->setCargo($value['cargo']);
				$usuario->setSiape($value['siape']);
			}
			return $usuario;
		}
		public function delete(){
			$sql = "DELETE FROM usuario WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
		}
		public function desabled(){

		}
		public function closeCon(){
			$this->con->close();
		}
		
		
	}

?>
