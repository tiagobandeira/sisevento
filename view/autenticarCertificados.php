<?php  
	require_once '../model/UsuarioModel.php';
	require_once '../model/EventoModel.php';
	require_once '../model/CertificadoModel.php';
	require_once '../model/CodigoUsuarioModel.php';

	
?>
<style type="text/css">
	.form-panel{
		margin: 0;
	}
	div[class*="col-"]{
		bborder: solid 1px #ccc;
		
	}

</style>
<div class="row mt-default">
	<div class="col-lg-12 col-md-12 col-sm-12 ">
		<div class="showback" >
			<h3><i class="fa fa-lock"></i> Autenticação de certificados</h3>
		</div>
	</div>
	
	
	<div class="col-lg-8">
	<?php  
		if (isset($_POST['search'])) {
			if (empty($_POST['search'])) {
				echo "<h3>Nenhum resultado encontrado</h3>";
			}else{
			

			$user = new UsuarioModel();
			$listaUsuarios = $user->list($_POST['search']);

			if ($listaUsuarios != null) {
				foreach ($listaUsuarios as $valueUsuario) {
					
					$codigoModel = new CodigoUsuarioModel();
					$codigos = $codigoModel->listAll();

			?>
					<div class="showback">
						<h4><i class="fa fa-user"></i> <?php echo $valueUsuario->getNomeCompleto(); ?></h4>
						 <div class="row">
					          <div class="col-md-12">
				                  <table class="table table-striped table-advance table-hover">
				                      <thead>
				                      <tr>
				                          <th><i class="fa fa-certificate"></i> Certificados</th>
				                          <th class="hidden-phone"><i class="fa fa-calendar"></i> Evento</th>
				                          <th><i class="fa fa-lock"></i> Código</th>
				                          <th><i class=" fa fa-edit"></i>Status</th>
				                          
				                      </tr>
				                      </thead>
				                      <tbody>

				                      <!-- bloco que se repetirá -->
				                      <?php  
				                      		foreach ($codigos as $valueCodigo) {
				                      			if ($valueCodigo->getUsuario() == $valueUsuario->getId()) {
				                      				

													$eventoModel = new EventoModel();
													$certificadoModel = new CertificadoModel();
													$eventos = $eventoModel->listById($valueCodigo->getEvento());
													foreach ($eventos as $valueEvento) {
														if($valueCodigo->getUsuario() == $valueUsuario->getId()){
															$certificados = $certificadoModel->listByEvento($valueEvento->getId());
															foreach ($certificados as $valueCertificado) {
																if($valueCertificado->getEvento() == $valueEvento->getId() 
																	&& $valueCertificado->getTipoUsuario() == $valueUsuario->getTipo()){
				                      ?>
				                      <tr>
				                          <td><?php echo $valueCertificado->getNome();  ?></td>
				                          <td class="hidden-phone"><?php echo $valueEvento->getNome();  ?></td>
				                          <td><?php echo $valueCodigo->getCodigo();  ?></td>
				                          <td>
				                          	<span class="<?php echo $valueCodigo->getStatus() == "D" ? 
				                          		'label label-info label-mini': 'label label-danger label-mini';  ?>">
				                          	<?php echo $valueCodigo->getStatus() == "D" ? 'Gerado': 'Pendente';  ?></span>
				                          </td>
				                      </tr>
				                      <?php  
					                      						}#if 2
					                      					}#foreach 2
					                      				}#if 1
					                      			}#foreach 2
					                      		}
				                      		}#foreach 1
				                      ?>
				                       <!-- fim bloco que se repetirá -->

				                      </tbody>
				                  </table>
					          </div><!-- /col-md-12 -->
              			</div><!-- /row -->
					</div>

			<?php
				}#foreach 1
				
			}

		}
		}else{
			echo "<h4><span class='fa fa-check'></span> Os Certificados válidos são os que foram gerados</h4>";
		}
		
	?>
				
</div>

<div class="col-lg-4">
      <form class="form-horizontal form-panel " method="POST">
            <h4 class="mb"><i class="fa fa-search"> </i> Pesquisar</h4>
            <div class="form-group">
	              <div class="col-sm-12">
	                  <input type="text" name="search" class="form-control" placeholder="Nome do Participante ou Cod. Certificado">
	              </div>

            </div>   
      </form> 

</div>
</div>


