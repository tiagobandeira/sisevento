
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
    	private $senha;
    	private $email;
    	private $tipo;
    	private $fone;
    	private $con;

    	function __construct($id = null, $nome = null, $senha = null, $email = null, $tipo = null, $fone = 0)
		{
			$this->id = $id;
			$this->nome = $nome;
			$this->senha = $senha;
			$this->email = $email;	
			$this->tipo = $tipo;
			$this->fone = $fone;
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

    	/*
			Manipulação de dados 
		*/

		public function  save(){
			if(!isset($this->id)){
				$sql = "INSERT INTO usuario
						(
							id,
							nome,
							senha,
							email,
							tipo,
							fone
						)
						VALUES 
						(
							null,
							'$this->nome',
							'$this->senha',
							'$this->email',
							'$this->tipo',
							'$this->fone'
						)";
			}else{
				$sql = "UPDATE 
							usuario
						SET 
							nome = '$this->nome',
							senha = '$this->senha',
							email = '$this->email',
							tipo = '$this->tipo',
							fone = '$this->fone'
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();
		}
		public function list($nome = null){
			if(!empty($nome)){
				$sql = "SELECT * FROM usuario WHERE nome LIKE '$nome%'";

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
					$usuario->setSenha($value['senha']);
					$usuario->setEmail($value['email']);
					$usuario->setTipo($value['tipo']);
					$usuario->setFone($value['fone']);
					
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
				$usuario->setSenha($value['senha']);
				$usuario->setEmail($value['email']);
				$usuario->setTipo($value['tipo']);
				$usuario->setFone($value['fone']);
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
		
		
	}

?>
