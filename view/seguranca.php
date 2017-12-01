<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
$usuarioModel = new UsuarioModel();
$user = $usuarioModel->readById($_SESSION['id']);

?>

	  		<div class="row mt-default" >
	  			<div class="col-md-8 col-md-offset-2" >
	  				<h1 align="center"><span class="fa fa-lock" ></span> Segurança</h1>
	  		<form class="" method="POST" >
		        
		        

		        <div class="" style="background-color: #fff; padding: 15px; border-radius: 4px ;">
		        	<?php  

						if(isset($_POST['senhaAtual']) && isset($_POST['senhaNova'])){
							

							if ($user->getSenha() == $_POST['senhaAtual']) {
								$user->setSenha($_POST['senhaNova']);
								$user->save();
								echo "<p class='alert alert-info'  align='center'>Alterações realizados com sucesso</p>";
							}else{
								echo "<p class='alert alert-danger'  align='center'>Senha incorreta</p>";
							}
					}
		      	?>	
		      		<div align="right">
		      			<button class="btn btn-theme visible-lg"  type="submit"><i class="fa fa-save" ></i> Salvar Alterações</button>
		      		</div>
		      		<label class="checkbox">
		        		<b>Slterar Senha</b>
		        	</label>
		        	<br>
		        	<label class="checkbox">
		        		Senha Atual
		        	</label>
		            <input type="password" name="senhaAtual" value="" class="form-control"  required="password" >
		            <br>
		            <label class="checkbox">
		        		Senha Nova
		        	</label>
		            <input type="password" name="senhaNova" value=""  class="form-control"  required="user">
		            <br>
		           
		            <div align="center">
		      			<button class="btn btn-theme visible-md visible-xs visible-sm"  type="submit"><i class="fa fa-save"></i> Salvar Alterações</button>
		      		</div>
		           
		
		       </div>
		
		      </form>	  	
		      <div>
		      	
		      	
		      </div>
	  	
	  			</div>
	  			
	  		</div>
		      
	