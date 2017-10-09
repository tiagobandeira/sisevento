<?php  
/*
	@About
	Autor: Tiago Bandeira
	Caminho arquivo: SisEvento/database/
	Nome do arquivo: createDB.php
	Arquivo pai: database
	Finalidade arquivo: Criar base de dados junto com as tabelas
*/
/*
	@imports
*/
include_once('executeQuery.php');
require_once '../lib/ConnectDBModel.php';

/**
* 
*/
class CreateDB
{
	private $con;
	function __construct()
	{
		$connect = new Connect();
		$this->con = $connect->getConnect();
	}

	/*
		@create tables
	*/
	public function create(){
		$createTipoEvento = "create table tipoevento( id int primary key auto_increment, tipo varchar(100))";

		$createTipoUsuario = "create table tipousuario(id int primary key auto_increment, tipo varchar(100))";
    	$createUsuario = "create table usuario( id int primary key auto_increment, nome varchar (100), senha varchar(60), email varchar(100), tipo int , fone int ,foreign key (tipo) references tipousuario (id) );";

		$createEvento = "create table evento( id int primary key auto_increment, nome varchar(200), data_inicio date, data_fim date, tipo int, endereco varchar(200), usuario int, foreign key (tipo) references tipoevento (id), foreign key (usuario) references usuario (id))";
		$createCodigoUsuario = "create table codigousuario(id int primary key auto_increment, codigo int, evento int, usuario int, foreign key (usuario) references usuario (id), status varchar(1), foreign key (evento) references evento (id) )";

		$createProgramacao = "create table programacao(id int primary key auto_increment, titulo varchar(100),descricao varchar(200), hora_inicio time, hora_fim time, evento int, foreign key (evento) references evento (id) )";

		#$createParticipante = "create table participante( id int primary key auto_increment, nome varchar(100), cpf varchar(14), fone varchar(16),codigo int )";

		$createTipoCertificado = "create table tipocertificado( id int primary key auto_increment, tipo varchar(50), texto varchar(300), cortexto varchar (7) )";

		$createCertificado = "create table certificado( id int primary key auto_increment,nome varchar(100), evento int, usuario int, imagem varchar(100), tipo int, tipousuario int, foreign key (evento) references evento (id), foreign key (usuario) references usuario (id), foreign key (tipo) references tipocertificado (id),foreign key (tipousuario) references tipousuario (id) )";


		/*
			@execute query
		*/  
		if(isset($this->con)){
			try{
				$this->con->beginTransaction();
					$this->con->exec($createTipoEvento);
					$this->con->exec($createTipoUsuario);
					$this->con->exec($createUsuario);
					$this->con->exec($createEvento);
					$this->con->exec($createCodigoUsuario);
					$this->con->exec($createProgramacao);
					$this->con->exec($createTipoCertificado);
					$this->con->exec($createCertificado);
					
					
				$this->con->commit();
				echo "Tabelas criados com sucesso";	
			}catch(PDOException $e){
				echo "Não foi possível criar as tabelas por algum motivo.";
				echo "Possível solução: Verifique o arquivo connection.php no diretorio database";
			}
		}
	}
}
$banco = new CreateDB();
$banco->create();


?>
