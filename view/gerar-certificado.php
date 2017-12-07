
<?php
	require_once '../control/AppController.php';

	require_once 'formataTextoCertFunction.php';
	include_once '../model/OrganizadorModel.php';
	include_once '../model/UsuarioModel.php';
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

	#fim verificação de usuario

	if(isset($_POST['ch'])){
	
    #GERA PDF DO CERTIFICADO
   
    $pdf2=new PDF_HTML();
    foreach ($_POST['ch'] as $value) {
      //dados
      $obj = $Aplication->getObgs($value);
      
      $codigo = $obj['codigo']->getCodigo();
      $idtipo = $obj['tipoCertificado']->getId();
      $nomeEvento = $obj['evento']->getNome();
      $datainicio = $obj['evento']->getDataInicio();
      $datafim = $obj['evento']->getDataFim();
      $data = dataExtenso($datainicio);
      $idcert = $obj['certificado']->getId();
      $nomeUser = $obj['usuario']->getNome();
      #imagem certificado

      $imagem = $obj['certificado']->getImagem();
      #tipo de certificado

      $tipocert = $obj['tipoCertificado']->getTipo();
      $texto = $obj['tipoCertificado']->getTexto();
      $corTexto = $obj['tipoCertificado']->getCorTexto();
      #usuario

      #evento

      $evento = $obj['evento'];
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
      //fim dados

      //gerar pdf
      $pdf2->AddPage('L');
      if($imagem){$pdf2->Image('midia/'.$imagem.'',0,0,297);}
       $pdf2->SetFont('Helvetica','', 15);
       if($corTexto){
        $cor = convertHexa($corTexto);
        $pdf2->setTextColor($cor['red'], $cor['green'], $cor['blue']);
      }else{
        $pdf2->setTextColor(0,0, 0);
      }
  
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
     
    }
    $pdf2->Output();
    #fim gerar pdf
	}

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
