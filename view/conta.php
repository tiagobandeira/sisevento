<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
$usuarioModel = new UsuarioModel();
$user = $usuarioModel->readById($_SESSION['id']);

?>

	  		<div class="row mt-default" >
	  			<div class="col-md-8 col-md-offset-2" >
	  				<h1 align="center"><span class="fa fa-user" ></span> Conta</h1>
	  		<form class="" method="POST" >
		        
		        

		        <div class="" style="background-color: #fff; padding: 15px; border-radius: 4px ;">
		        	<?php  

						if(isset($_POST['user']) OR isset($_POST['nomeCompleto']) OR isset($_POST['email'])){
							

							
							$user->setNome($_POST['user']);
							$user->setEmail($_POST['email']);
							$user->setNomeCompleto($_POST['nomeCompleto']);
							$flag = true;
							$listaNome = $user->listByNameUser($user->getNome());
							foreach ($listaNome as $value) {
								if ($value->getNome() == $user->getNome() && $value->getId() != $user->getId()) {
									$flag = false;
								}
							}
							if($flag){
								$user->save();
								echo "<p class='alert alert-info'  align='center'>Alterações realizados com sucesso</p>";
							}else{
								echo "<p class='alert alert-danger'  align='center'>Nome de usuario já está sendo usado</p>";
							}
							

					}
		      	?>	
		      		<div align="right">
		      			<button class="btn btn-theme visible-lg"  type="submit"><i class="fa fa-save"></i> Salvar Alterações</button>
		      		</div>
		      		
		        	<label class="checkbox">
		        		Nome de Usuario
		        	</label>
		            <input type="text" name="user" value="<?php echo $user->getNome(); ?>" class="form-control"  required="user" >
		            <br>
		            <label class="checkbox">
		        		Nome Completo
		        	</label>
		            <input type="text" name="nomeCompleto" value="<?php echo $user->getNomeCompleto(); ?>"  class="form-control"  required="user" >
		            <br>
		           
		            
		            <label class="checkbox">
		        		Email
		        	</label>
		            <input type="email" name="email" value="<?php echo $user->getEmail(); ?>" class="form-control"  required="email"><br>
		           
		            <div align="center">
		      			<button class="btn btn-theme visible-md visible-xs visible-sm"  type="submit"><i class="fa fa-save"></i> Salvar Alterações</button>
		      		</div>
		           
		
		       </div>
		
		      </form>	  	
		      <div>
		      	
		      	
		      </div>
	  	
	  			</div>
	  			
	  		</div>
		      
	