
<?php    
session_start();
	require_once '../model/CodigoUsuarioModel.php';
	require_once '../model/UsuarioModel.php';
	require_once '../model/CertificadoModel.php';
	require_once 'formataTextoCertFunction.php';
	
    

	include_once '../lib/mpdf60/mpdf.php';
	include_once '../model/UsuarioModel.php';
	include_once '../model/TipoEventoModel.php';
	include_once '../model/EventoModel.php';
	include_once '../model/TipoCertificadoModel.php';
	$filename = "certificado.html";

	#verificação de usuario
	#form modal 
		if(isset($_POST['codigoinput'])){
			$codigoModel = new CodigoUsuarioModel();
			$codigoModel->setId($_POST['idcodigo']);
			$codigoModel->setEvento($_POST['idevento']);
			$codigoModel->setUsuario($_POST['idusuario']);
			$codigoModel->setCodigo($_POST['codigo']);

			if ($_POST['codigoinput'] == $codigoModel->getCodigo()) {
				$codigoModel->setStatus("D");
				$codigoModel->save();
				#echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=usuario.php?view=certificadoTesteModal&sub=part&item=add'>";
			}else{
				$_SESSION['error'] = " ";
				$usuarioModel = new UsuarioModel();
				$usuario = $usuarioModel->readById($_SESSION['id']);
				$tipoUsuario = $usuario->getTipo();
				if ($tipoUsuario == 2) {
					header('Location: usuario.php?view=certificado&sub=cert&item=addE');
				}else if($tipoUsuario == 3){
					header('Location: participante.php?view=certificadoParticipante&sub=cert&item=addE');
				}
				
			}
		}
	#fim verificação de usuario

	if(isset($_POST['id']) or isset($_POST['codigoinput'])){
		$id = $_POST['id'];
		$codigo = $_POST['codigo'];
		$idtipo = $_POST['idtipo'];
		$nomeEvento = $_POST['evento'];
		$datainicio = $_POST['dataInicio'];
		$datafim = $_POST['dataFim'];
		$idcert = $_POST['idcert'];
		$nomeUser = $_POST['nomeuser'];
		#imagem certificado
		$cert = new CertificadoModel();
		$certificado = $cert->readById($idcert);
		$imagem = $certificado->getImagem();
		#tipo de certificado
		$tipo = new TipoCertificadoModel();
		$tipocert = $tipo->readById($idtipo);
		$texto = $tipocert->getTexto();
		#usuario
		
		#evento
		

		#dados 
		$dados = [$nomeUser, $datainicio, $datafim, $nomeEvento];
		$texto = formataCert($texto, $dados);

	}



	#$tipoevento = new TipoEventoModel();
	#$tipoevento->setTipo();
	#$tipoevento->save();

	$html = "<!DOCTYPE html>
<html>
<head>
	<title>teste</title>
	<style type='text/css'>
	/*	body{
		background: url(img.jpg) no-repeat;
		background-image-resolution: 300dpi;
		background-image-resize: 6;  
	}*/
	.block{
		background-image: url(midia/". $imagem .") no-repeat;
		#background-position-left: 5px;
		background-size: 99.99%;
		width: 100%;
		height: 100%;

	}
	#texto{
		padding: 60px;
		font-family: helvetica;
		color: ". $tipocert->getCorTexto() .";
		
		font-size: 20pt;
	}
	.table{
		#margin-left: 175px;
		margin-bottom: 295px;; /*295*/ 
		#border: solid 1px #333;
		text-align: center;
		display: inline-block;
	}
	.table td{
		padding: 40px;
	}
	</style>

</head>
<body >
	<div class='block'>
		<table rotate='90deg' class='table'>
			<tr>
				<td>
					<p id='texto' > " . $texto . " </p><br/>
				</td>
			</tr>
		</table>
	</div>
</body>
<!-- <barcode code='". sha1("Teste Código"). "' size='0.8' type='QR' error='M' style='float: left' class='barcode' /> -->
</html>
";
	$mpdf = new mPDF("c", "A4","", "", 0, 0, 0, 0, 0 , 0);
	#$mpdf->Image('certificado.png', 0, 0, 200, 200, 'png', '', true, false);
	$mpdf->setDisplayMode('fullpage');

	#$mpdf->list_indeent_first_level = 0;
	$mpdf->WriteHTML($html);
	#$mpdf->WriteHTML(file_get_contents('tela.php'));
	$mpdf->Output("arquivo.pdf", "I");
	#unlink($filename);
	exit();

?>
