<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
$user = new UsuarioModel();

$tipouser = new TipoUsuarioModel();
$result = $tipouser->readById(2);
if($result == null){
	$tipouser->setTipo("participante");
	$tipouser->save();
}
$tipos = $tipouser->list();


?>
<!--
<h3><i class="fa fa-angle-right"></i>Adicionar Participante</h3>
<div class="row mt">
	<div class="col-lg-12">
	<p>Incluir content aqui.</p>

	</div>
</div>
-->
<div class="col-lg-8">
                  <div class="form-panel">
                  	  <h4 class="mb"> Participantes</h4>
                      <form class="form-horizontal style-form"  method="POST">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nome" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="text" name="email" class="form-control">
                              </div>
                          </div>
                          	<!-- funções -->
                          <h4 class="mb"> Tipo de participante</h4>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="tipo">
                                  		<?php foreach ($tipos as $value) { ?>
						  					<option value="<?php echo $value->getId();?>"><?php echo $value->getTipo() ?></option>
										 <?php } ?>
									</select>
                              </div>
                          </div><!-- end funções -->
                          <!-- dados pessoais -->
                          <h4 class="mb"> Dados pessoais</h4>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Fone</label>
                              <div class="col-sm-10">
                                  <input type="tel" name="fone" pattern="^\d{9}$" placeholder="ex. 86981414089" class="form-control">
                              </div>
                          </div><!-- end dados -->
                    <?php  
                  		if(isset($_POST['nome']) && isset($_POST['email'])){
                  			if(empty($_POST['nome']) && empty($_POST['email'])){
                  				echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                  			}else{
                 	 			$user->setNome($_POST['nome']);
                  				$user->setEmail($_POST['email']);
                  				$user->setTipo($_POST['tipo']);
                  				if(!empty($_POST['fone'])){
                  					$user->setFone($_POST['fone']);
                  				}

                  			$lista = $user->list($_POST['nome']);
                  			$flag = true;
                  			foreach ($lista as $value) {
                  				if($value->getNome() == $user->getNome() && $value->getEmail() == $user->getEmail()){
                  					$flag = false;
                  					break;
                  				}
                  			}
                  			if(!$flag){
                  					echo "<div class='alert alert-danger'><b>Não salvou </b> Usuario já existe.</div>";
                  				}else{
                  					$user->save();
                  					echo "<div class='alert alert-success'><b>Particepante cadastrado!</b> Operação realizada com sucesso.</div>";
                  				}	
                  			}
                  		}

                    ?>
                         <div align="right">
                         	 <button type="submit" class="btn btn-info" >Salvar</button>
                         </div>
                       </form>
                  </div>
                  
</div>
<div class="col-lg-4">
                  <div class="form-panel" >
                  	  <!-- forme add participante -->
                      <form class="form-horizontal style-form" method="POST">
                      	   <h4 class="mb"><i class="fa fa-user"> </i> Criar um tipo de participante</h4>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                              <div class="col-sm-10">
                                  <input type="text" name="tipoParticipante" class="form-control">
                              </div>

                          </div>
                          <?php  
                          		if (isset($_POST['tipoParticipante'])) {
                  					$tipo = new TipoUsuarioModel(null, $_POST['tipoParticipante']);
                  					$tipos = $tipo->list($_POST['tipoParticipante']);
                  					if (empty($_POST['tipoParticipante'])) {
                  						echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                  					}else{
                  						$flag = true;
                  						foreach ($tipos as $value) {
                  							if ($value->getTipo() == $tipo->getTipo()) {
                  								$flag = false;
                  								break;
                  							}
                  						}
                  						if(!$flag){
                  							echo "<div class='alert alert-danger'><b>Não salvou </b> Tipo já existe.</div>";
                  						}else{
                  							$tipo->save();
                  							echo "<div class='alert alert-success'><b>Tipo cadastrado!</b> Operação realizada com sucesso.</div>";
                  					
											echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=administrador.php?view=addUser&sub=part&item=add'>";
										
                  						}		
                  					}
                  		
                  				}

                          ?>
                         <div align="right">
                         	 <button type="submit" class="btn btn-info" >Salvar</button>
                         </div>
                        
                       </form><!-- end forme add participante -->
                       <hr style="border:0.1px solid #ccc;">
                       <!-- forme del participante -->
                       <form class="form-horizontal style-form" method="POST">
                           <h4 class="mb"><i class="fa fa-trash-o"></i> Exlcuir Tipo</h4>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                              
                                	<div class="col-sm-10">
                                 		<select class="form-control" name="tipoDel">
                                  			<?php foreach ($tipos as $value) { ?>
						  						<option value="<?php echo $value->getId();?>"><?php echo $value->getTipo() ?></option>
											<?php } ?>
										</select>
                              		</div>
                              
                          </div>
                           <?php  
                          		if (isset($_POST['tipoDel'])) {
                  					$tipoP = new TipoUsuarioModel($_POST['tipoDel'],null );
                  					if (empty($_POST['tipoDel'])) {
                  						echo "<div class='alert alert-danger'><b>Não excluiodo </b> Selecione um item </div>";

                  					}else{
                  						echo "<div class='alert alert-success'><b>Tipo cadastrado!</b> Operação realizada com sucesso.</div>";

                  						$tipoP->delete($_POST['tipoDel']);
                  						echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=administrador.php?view=addUser&sub=part&item=add'>";
                  					}
                  		
                  				}

                          ?>
                          <div align="right">
                          	 <button type="submit" class="btn btn-danger" >Excluir</button>
                          </div>
                         
                       </form> <!-- end forme del participante -->
                  </div>
</div>