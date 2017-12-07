
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
	class CertificadoModel
	{
    	private $id;
    	private $nome;
    	private $evento;
    	private $participante;
    	private $usuario;
    	private $tipousuario;
    	private $tipo;
    	private $imagem;
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
		public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome = $nome;
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
		public function getTipo(){
			return $this->tipo;
		}
		public function setTipo($tipo){
			$this->tipo = $tipo;
		}
    	public function getImagem(){
    		return $this->imagem;
    	}
    	public function setImagem($imagem){
    		$this->imagem = $imagem;
    	}
    	public function getTipoUsuario(){
			return $this->tipousuario;
		}
		public function setTipoUsuario($tipousuario){
			$this->tipousuario = $tipousuario;
		}

    	/*
			Manipulação de dados
		*/

		public function  save(){
			if(!isset($this->id)){
				$sql = "INSERT INTO certificado
						(
							id,
							nome,
							evento,
							usuario,
							tipo,
							imagem,
							tipousuario
						)
						VALUES
						(
							null,
							'$this->nome',
							'$this->evento',
							'$this->usuario',
							'$this->tipo',
							'$this->imagem',
							'$this->tipousuario'
						)";
			}else{
				$sql = "UPDATE
							certificado
						SET
							nome = '$this->nome',
							evento = '$this->evento',
							usuario = '$this->usuario',
							tipo = '$this->tipo',
							imagem = '$this->imagem',
							tipousuario = '$this->tipousuario'
						WHERE id = $this->id";
			}
			$query = $this->con->prepare($sql);
			$query->execute();

		}
		public function list($nome = null){
			if(!empty($nome)){
				$sql = "SELECT * FROM certificado WHERE nome LIKE '%$nome%'";

			}else{
				$sql = "SELECT * FROM certificado ORDER BY id DESC";
			}
			$certificados = array();
			try{
				$query = $this->con->prepare($sql);
				$query->execute();
				foreach ($query as $value) {
					$certificado = new CertificadoModel($this->con);
					$certificado->setId($value['id']);
					$certificado->setNome($value['nome']);
					$certificado->setEvento($value['evento']);
					$certificado->setUsuario($value['usuario']);
					$certificado->setTipo($value['tipo']);
					$certificado->setImagem($value['imagem']);
					$certificado->setTipoUsuario($value['tipousuario']);

					array_push($certificados, $certificado);
				}
				return $certificados;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}
		}
		public function readById($id){
			$sql = "SELECT * FROM certificado WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $id);
			$query->execute();
			$certificado = new CertificadoModel();
			foreach ($query as $value) {
				$certificado->setId($value['id']);
				$certificado->setNome($value['nome']);
				$certificado->setEvento($value['evento']);
				$certificado->setUsuario($value['usuario']);
				$certificado->setTipo($value['tipo']);
				$certificado->setImagem($value['imagem']);
				$certificado->setTipoUsuario($value['tipousuario']);
			}
			return $certificado;
		}
		public function delete(){
			$sql = "DELETE FROM certificado WHERE id = :id";
			$query = $this->con->prepare($sql);
			$query->bindValue(":id", $this->getId());
			$query->execute();
		}
		public function desabled(){

		}



		public function readByEvento($evento){
			$sql = "SELECT * FROM certificado WHERE evento = :evento";
			$query = $this->con->prepare($sql);
			$query->bindValue(":evento", $evento);
			$query->execute();
			$certificado = new CertificadoModel();
			foreach ($query as $value) {
				$certificado->setId($value['id']);
				$certificado->setNome($value['nome']);
				$certificado->setEvento($value['evento']);
				$certificado->setUsuario($value['usuario']);
				$certificado->setTipo($value['tipo']);
				$certificado->setImagem($value['imagem']);
				$certificado->setTipoUsuario($value['tipousuario']);
			}
			return $certificado;
		}
		public function listByEvento($idevento){

			$sql = "SELECT * FROM certificado WHERE evento = :idevento";


			$certificados = array();
			try{
				$query = $this->con->prepare($sql);
				$query->bindValue(":idevento", $idevento);
				$query->execute();
				foreach ($query as $value) {
					$certificado = new CertificadoModel();
					$certificado->setId($value['id']);
					$certificado->setNome($value['nome']);
					$certificado->setEvento($value['evento']);
					$certificado->setUsuario($value['usuario']);
					$certificado->setTipo($value['tipo']);
					$certificado->setImagem($value['imagem']);
					$certificado->setTipoUsuario($value['tipousuario']);

					array_push($certificados, $certificado);
				}
				return $certificados;
			}catch(PDOEcxeption $e){
				echo "Não foi possível listar" . $e->getMesage();
			}

}
	}

?>
