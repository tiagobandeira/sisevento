
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
require_once '../model/TipoCertificadoModel.php';
require_once '../model/CodigoUsuarioModel.php';
require_once '../model/UsuarioModel.php';

require_once 'code.php';


$codigo = new CodigoUsuarioModel();
$codigos = $codigo->listByUsuario($_SESSION['id']);
$user = new UsuarioModel();
$usuario = $user->readById($_SESSION['id']);
$tipoCertificado = new TipoCertificadoModel();
#$tipoCert =  $tipoCertificado->readById();

?>
<div class="showback">
<h3><i class="fa fa-certificate"></i> Certificados disponíveis</h3>
</div>
<div class="row">
	<?php  
		foreach ($codigos as $value) {
			$certificado = new CertificadoModel();
			$evento = new EventoModel();
			$eve = $evento->readById($value->getEvento());
			$cert = $certificado->readByEvento($eve->getId());		
			if($eve->getId() == $cert->getEvento() && $usuario->getTipo() == $cert->getTipoUsuario() && $value->getUsuario() == $_SESSION['id'] ){
			
	?>
				<! -- Spotify Panel -->
					<!-- form -->
 					<form method="post"  action="gerarCertificado.php">
						<div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="content-panel pn">
								<div id="spotify" style="<?php echo 

							"background: url(midia/".$cert->getImagem().") no-repeat center top;
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
    						background-size: cover;"?>";> 

									<div class="col-xs-4 col-xs-offset-8">
									
										<button data-toggle="modal" 
											type="<?php echo $value->getStatus() == 'B'?'button':'submit'; ?>" 
											data-target="#<?php echo $value->getStatus() == 'B'?$value->getId():''; ?>" 
											class="btn btn-sm btn-clear-g" 
											name="id"  
											value="<?php echo $value->getId();?>">
											<?php echo $value->getStatus() == 'B'?'DESBLOQUEAR':'GERAR' ?>
										</button>

									
									</div>
								</div>
								<p class="followers"><i class="fa fa-certificate"></i> <?php echo $eve->getNome() ?></p>
							</div>
						</div><! --/col-md-4-->
		
				 
				
				  		<input type="hidden" name="evento" value="<?php echo $eve->getNome();?>">
    					<input type="hidden" name="dataInicio" value="<?php echo $eve->getDataInicio();?>">
    					<input type="hidden" name="dataFim" value="<?php echo $eve->getDataFim();?>">
    					<input type="hidden" name="idcert" value="<?php echo $cert->getId();?>">
    					<input type="hidden" name="idtipo" value="<?php echo $cert->getTipo();?>">
    					<input type="hidden" name="codigo" value="<?php echo $value->getCodigo();?>">
    					<input type="hidden" name="nomeuser" value="<?php echo $usuario->getNome();?>">	
    				<!-- form -->
		          </form>
				  <!-- form Modal -->
				  <form method="POST" action="gerarCertificado.php">
		          <div aria-hidden="true" aria-labelledby="myModalLabel" 
		          		role="dialog" tabindex="-1" id="<?php echo $value->getId() ?>" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title"><i class="fa fa-lock"></i> Seu Código</h4>
		                      </div>
		                    
		                      <div class="modal-body">
		                          <p>Informe o código que você recebeu quando participou do evento <?php echo $eve->getNome() ?>.</p>
		                          <input type="number" name="codigoinput" placeholder="" autocomplete="off" class="form-control placeholder-no-fix">         
		                          <input type="hidden" name="codigo" value="<?php echo $value->getCodigo();?>">
		                          <input type="hidden" name="idcodigo" value="<?php echo $value->getId();?>">
		                          <input type="hidden" name="idevento" value="<?php echo $value->getEvento();?>">
		                          <input type="hidden" name="idusuario" value="<?php echo $value->getUsuario();?>">

				  				<input type="hidden" name="evento" value="<?php echo $eve->getNome();?>">
    							<input type="hidden" name="dataInicio" value="<?php echo $eve->getDataInicio();?>">
    							<input type="hidden" name="dataFim" value="<?php echo $eve->getDataFim();?>">
    							<input type="hidden" name="idcert" value="<?php echo $cert->getId();?>">
    							<input type="hidden" name="idtipo" value="<?php echo $cert->getTipo();?>">
    							<input type="hidden" name="codigo" value="<?php echo $value->getCodigo();?>">
    						<input type="hidden" name="nomeuser" value="<?php echo $usuario->getNome();?>">	

		                      </div>
		                     
		                      <div class="modal-footer">

		                          <button  data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit">Submit</button>                        
		                      </div>
		                      
		                     
		                  </div>
		              </div>
		             	
		          </div>
		          </form><!--  end form Modal -->
		         

		          

				 
					
	<?php  }} ?>
	 
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
				echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=usuario.php?view=certificadoTesteModal&sub=part&item=add'>";
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