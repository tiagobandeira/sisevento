<?php  
	require_once '../model/UsuarioModel.php';
	require_once '../model/CodigoUsuarioModel.php';
	require_once 'code.php';
	require_once '../model/EventoModel.php';

	require_once '../model/CertificadoModel.php';
	require_once '../model/TipoCertificadoModel.php';
	require_once '../model/OrganizadorModel.php';
	#criar participante
	function iniciarExemplo()
	{
		#valores do evento
		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		$ano = date("Y");
		$mes = date("m");
		$dia = date("d");
		$arrayData = [$ano, $mes, $dia];
		$data = implode("-", $arrayData);
		#valores do tipo de certificado
		$texto = "Certificamos que #nome participou da VI Semana de Tecnologia do IFPI - SEIFPI, com carga horária de #horas h, realizado no dia #data no IFPI Campus Parnaíba.";
		$cor = "#36a275";
		#valores certificado
		$imagem = "Certificado_Final_04_seifpi.png";

		#criar participantes
		$usuarioModel1 = new UsuarioModel();
		$usuarioModel1->setNome("Athanio");
		$usuarioModel1->setNomeCompleto("Athânio de Sousa");
		$usuarioModel1->setSenha("1234");
		$usuarioModel1->setEmail("athanio@email.com");
		$usuarioModel1->setTipo(4);
		$usuarioModel1->setCargo("Coordenador");
		$usuarioModel1->setSiape(12345678);
		$usuarioModel1->save();

		$usuarioModel2 = new UsuarioModel();
		$usuarioModel2->setNome("Francisco");
		$usuarioModel2->setNomeCompleto("Francisco de Assis Carvalho");
		$usuarioModel2->setSenha("1234");
		$usuarioModel2->setEmail("francisco@email.com");
		$usuarioModel2->setTipo(4);
		$usuarioModel2->setCargo("Diretor de Ensino");
		$usuarioModel2->setSiape(87654321);
		$usuarioModel2->save();

		#criar evento
		$eventoModel = new EventoModel();
		$eventoModel->setNome("SEIFPI");
		$eventoModel->setDataInicio($data);
		$eventoModel->setDataFim($data);
		$eventoModel->setTipo(1);
		$eventoModel->setEndereco("IFPI Campus Parnaíba");
		$eventoModel->setStatus("A");
		$eventoModel->setCargaHoraria(4);
		$eventoModel->save();

		#criar organizadores
		$organizadorModel1 = new OrganizadorModel();
		$organizadorModel1->setUsuario(2);
		$organizadorModel1->setEvento(1);
		$organizadorModel1->save();

		$organizadorModel2 = new OrganizadorModel();
		$organizadorModel2->setUsuario(3);
		$organizadorModel2->setEvento(1);
		$organizadorModel2->save();

		#criar código dos usuarios
		$codigoUsuarioModel1 = new CodigoUsuarioModel();
		$codigoUsuarioModel1->setCodigo(cod(2));
		$codigoUsuarioModel1->setUsuario(2);
		$codigoUsuarioModel1->setEvento(1);
		$codigoUsuarioModel1->setStatus("B");
		$codigoUsuarioModel1->save();

		$codigoUsuarioModel2 = new CodigoUsuarioModel();
		$codigoUsuarioModel2->setCodigo(cod(3));
		$codigoUsuarioModel2->setUsuario(3);
		$codigoUsuarioModel2->setEvento(1);
		$codigoUsuarioModel2->setStatus("B");
		$codigoUsuarioModel2->save();

		#criar tipo de certificado
		$tipoCertificado = new TipoCertificadoModel();
		$tipoCertificado->setTipo("Modelo de Certificado para o SEIFPI");
		$tipoCertificado->setTexto($texto);
		$tipoCertificado->setCorTexto($cor);
		$tipoCertificado->save();
		#criar certificado
		$certificadoModel = new CertificadoModel();
		$certificadoModel->setNome("Certificado SEIFPI (Palestrante)");
		$certificadoModel->setEvento(1);
		$certificadoModel->setUsuario(1);
		$certificadoModel->setTipo(1);
		$certificadoModel->setTipoUsuario(4);
		$certificadoModel->setImagem($imagem);
		$certificadoModel->save();

		$certificadoModel = new CertificadoModel();
		$certificadoModel->setNome("Certificado SEIFPI (Usuário)");
		$certificadoModel->setEvento(1);
		$certificadoModel->setUsuario(1);
		$certificadoModel->setTipo(1);
		$certificadoModel->setTipoUsuario(2);
		$certificadoModel->setImagem($imagem);
		$certificadoModel->save();





	}
?>