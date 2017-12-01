<?php  
	include 'mpdf60/mpdf.php';
	include '../model/UsuarioModel.php';
	include '../model/TipoEventoModel.php';
	$filename = "certificado.html";
	$ano = date('Y');
	$palestra = "Neurociência";
	$nome = $_POST['nome'];
	
	#$user = new UsuarioModel();
	#$ps = $user->readById(1);
	#$nome = $ps->getNome();

	$tipoevento = new TipoEventoModel();
	#$tipoevento->setTipo($_POST['tipo']);
	#$tipoevento->save();
	$tipo = $_POST['tipo'];

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
		background-image: url(img3.jpg) no-repeat;
		#background-position-left: 5px;
		background-size: 99.99%;
		width: 100%;
		height: 100%;

	}
	#texto{
		padding: 60px;
		font-family: helvetica;
		color: #068850;
		
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
					<p id='texto' >
						Certificamos que " . $nome . " participou da V semana de tecnologia - SEIFPI, realizado 
					nos dias 27 ao 29 de ". $ano . " no IFPI Campus Parnaíba, nas palestras de " . $tipo .".
			
					</p><br/>
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
