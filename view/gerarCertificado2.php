
<?php    
session_start();
	require_once '../model/CodigoUsuarioModel.php';
	require_once '../model/UsuarioModel.php';
	require_once '../model/CertificadoModel.php';
	require_once 'formataTextoCertFunction.php';
	
    

	#include_once '../lib/mpdf60/mpdf.php';
	include_once '../model/UsuarioModel.php';
	include_once '../model/TipoEventoModel.php';
	include_once '../model/EventoModel.php';
	include_once '../model/TipoCertificadoModel.php';
	include_once '../model/OrganizadorModel.php';
	include_once '../lib/fpdf/fpdf.php';
	include_once '../lib/fpdf/WriteHTML.php';
	$filename = "certificado.html";

	#data
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
   	#date_default_timezone_set('America/Sao_Paulo');
   	$dia = @date("d");
   	$mes = @strftime('%B');
   	$ano = @date('Y');

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

	if(isset($_POST['idcodigo']) or isset($_POST['codigoinput'])){
		$id = $_POST['idcodigo'];
		$codigo = $_POST['codigo'];
		$idtipo = $_POST['idtipo'];
		$nomeEvento = $_POST['evento'];
		$datainicio = $_POST['dataInicio'];
		$datafim = $_POST['dataFim'];
		$data = dataExtenso($datainicio);
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
		$corTexto = $tipocert->getCorTexto();
		#usuario
		
		#evento
		$eventoModel = new EventoModel();
		$evento = $eventoModel->readById($certificado->getEvento());
		$horas = $evento->getCargaHoraria();
		$local = utf8_decode($evento->getEndereco()) ;
		

		#dados 
		$antes = array('#nome', '#horas','#data');
   		$depois = array($nomeUser, $horas, $data);
   		$frase = str_replace($antes, $depois, $texto);

   		#dados rodape - Oganizadores
   		$organizadorModel = new OrganizadorModel();
   		$organizadorLista = $organizadorModel->list($evento->getId());
   		$organizadores = Array();
   		foreach ($organizadorLista as $value) {
   			$usuarioModel = new UsuarioModel();
   			$usuario = $usuarioModel->readById($value->getUsuario());
   			array_push($organizadores, $usuario);
   		}
   		

	}
	#GERA PDF DO CERTIFICADO
	$pdf2=new PDF_HTML();
	$pdf2->AddPage('L');
   	$pdf2->Image('midia/'.$imagem.'',0,0,297);
   	$pdf2->SetFont('Helvetica','', 15);
   	$cor = convertHexa($corTexto);
   	$pdf2->setTextColor($cor['red'], $cor['green'], $cor['blue']);
   	$pdf2->SetXY( 35, 98);
   	$pdf2->WriteHTML("<p align='justify'> ".$frase."</p>");

   	
   	$pdf2->SetFont('Helvetica','', 11);
   	$pdf2->Text(200,135, "$local, $dia de $mes de $ano");
   	
   	#rodapé
	$pdf2->SetXY( 0, 155);
	$position = 0;
	foreach ($organizadores as $value) {
		if ($value != null) {
			setRodape($position, $value->getNomeCompleto(), $value->getCargo(), "SIAPE " . $value->getSiape(), $pdf2);
			$position += 130;
		}
		
	}
	#setRodape(0, "Athanio", "Coordenador do SEIFP", "SIAPE - 15805884", $pdf2);
   	#setRodape(130,"Organizador", "Diretor de Ensino", "SIAPE - 15805884", $pdf2);

   	


   	 $pdf2->Output();

function setRodape($position,$organizador, $cargo, $siape, $pdfObject){
	$pdfObject->SetXY( $position, 155);
   	$pdfObject->MultiCell(180, 5, 
      "_________________________________ \n$organizador\n$cargo\n$siape"
      ,0, 'C', false);
}
function dataExtenso($data){
	$ext = explode("-", $data);
	#verificar data
	$dia = $ext[2];
	$mes = $ext[1];
	$ano = $ext[0];
	switch ($ext[1]) {
		case 1:
			$mes = "janeiro";
			break;
		case 2:
			$mes = "fevereiro";
			break;
		case 3:
			$mes = "março";
			break;
		case 4:
			$mes = "abril";
			break;
		case 5:
			$mes = "maio";
			break;
		case 6:
			$mes = "junho";
			break;
		case 7:
			$mes = "julho";
			break;
		case 8:
			$mes = "agosto";
			break;
		case 9:
			$mes = "setembro";
			break;
		case 10:
			$mes = "outubro";
			break;
		case 11:
			$mes = "novembro";
			break;
		case 12:
			$mes = "dezembro";
			break;
		
		default:
			# code...
			break;
	}

	$strData = $dia . " de " . $mes . " de " . $ano;
	return $strData;
}
#converter a cor do texto que está em hexadecimal para decimal	
 function convertHexa($hexadecimal)
	{
		$strHexadecimal = explode("#", $hexadecimal);
		$colorVal = $strHexadecimal[1];
		$rgbArray = array();
		$seperator = ",";
		if (strlen($colorVal) == 6) { 
        	$colorVal = hexdec($colorVal);
        	$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        	$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        	$rgbArray['blue'] = 0xFF & $colorVal;
    	}
		return $rgbArray;
	}

?>
