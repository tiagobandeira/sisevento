
<style type="text/css">
	
	/* Soptify Panel */
/*#spotify {
	background: url(midia/Certificado_Final_04_seifpi.png) no-repeat center top;
	margin-top: -15px;
	background-attachment: relative;
	background-position: center center;
	min-height: 220px;
	width: 100%;
    -webkit-background-size: 100%;
    -moz-background-size: 100%;
    -o-background-size: 100%;
    background-size: 100%;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}*/
#spotify .btn-clear-g {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
	fbackground: #555;
	background: #FBFBFB;
}
#spotify .btn-clear-g:hover{
	background: #117a9c;
}
#spotify .sp-title {
	bottom: 15%;
	left: 25px;
	position: absolute;
	color: #efefef;
}
#spotify .sp-title h3 {
	font-weight: 900;
}
#spotify .play{
	bottom: 18%;
	right: 25px;
	position: absolute;
	color: #efefef;
	font-size: 20px
}
.followers {
	margin-left: 5px;
	margin-top: 5px;
}

</style>
<?php  

require_once '../model/TipoEventoModel.php';
require_once '../model/EventoModel.php';
require_once '../model/CertificadoModel.php';
require_once '../model/CodigoUsuarioModel.php';
require_once '../model/UsuarioModel.php';

require_once 'code.php';


$codigo = new CodigoUsuarioModel();
$codigos = $codigo->listByUsuario(3);
$user = new UsuarioModel();
$usuario = $user->readById(3);

?>
<div class="showback">
<h3><i class="fa fa-certificate"></i> Certificados disponíveis</h3>
</div>
<div class="row">

	<?php  
		foreach ($codigos as $valueCodigo) {
			$certificado = new CertificadoModel();
			$evento = new EventoModel();

			$eve = $evento->listById($valueCodigo->getEvento());
			foreach ($eve as $valueEvento) {
				if($valueCodigo->getUsuario() == 3){
					echo "Codigo: " . $valueCodigo->getCodigo() . "</br>";
					echo "Nome do Evento: " . $valueEvento->getNome() . "</br>";
					echo "Status " . $valueCodigo->getStatus(). "</br>";
					echo "--------------Certificados do evento ".$valueEvento->getNome()."---------------------------<br>";
					$cert = $certificado->listByEvento($valueEvento->getId());
					$i = 1;	
					foreach ($cert as $valueCertificado) {
						if($valueCertificado->getEvento() == $valueEvento->getId() 
								&& $valueCertificado->getTipoUsuario() == $usuario->getTipo()){

							echo "Certificado $i: " . $valueCertificado->getNome() . "</br>";
							$i++;
						}
						
					}
					echo "------------------------------------------------------<br>";
					
				}
				


			}
	 	}
					
	  
	  ?>
	<?php 

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
				echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=participante.php?view=certificado&sub=part&item=add'>";
			}
		}

						
	 ?>

	 
</div>
<?php  
	if(isset($_SESSION['error'])){
		require_once 'popup.php';
		unset($_SESSION['error']);
	}

?>