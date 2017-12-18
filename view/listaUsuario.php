<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
$user = new UsuarioModel();
$lista = $user->list("");
$tipoUsuarioModel = new TipoUsuarioModel();
$tipos = $tipoUsuarioModel->list(); 
?>
<style type="text/css">
	@media (max-width: 410px){
		.response{
			background-color: red;
			padding: 0;
			margin: 0;
		}

	}
	.btnAction{
		margin-left:3px;
	}
	.table > tbody > tr > td{
		border: none;
		padding:10;
	}
</style>
<div class="row mt-list">
	<div class="col-lg-12 col-md-12 no-padding">
		<div class="content-panel" style="box-shadow: none">
			
			<div class="col-md-8 " >
				<h4><i class="fa fa-user" ></i> <span>Lista de usuários</span></h4>
			</div>
			
			<div class="col-md-4 " class="form-group" >
				<form method="POST" style="display: flex; padding: 5px" action="?view=users&sub=users">
				<select name="tipos"  id="tipos" class="form-control" >
					<option value="0">Todos</option>
					<?php
						foreach ($tipos as $value) {
					?>
		
					<option value="<?php echo $value->getId()?>" ><?php echo $value->getTipo()?></option>
					
					<?php
						}
					?>
				</select>
				<input type="hidden" name="tab" value="lista">
				<button type="submit" name="lista" class="btn btn-success btn-sm pull-right btnAction">Executar</button>
			
			
				</form>
			
				
			</div>
				
				
			<table class="table table-striped table-advance table-hover ">
				<thead >
					<tr >
				    	<th>#</th>
				    	<th>Nome</th>
				   		<th class="hidden-phone">Email</th>
				    	<th>Tipo</th>
					</tr>
				</thead>
				<tbody style="vibility: hidden; ">
					<?php 
						$tipo = 0;
						if(isset($_POST['tipos'])){
							$tipo = $_POST['tipos'];
						}
						foreach ($lista as $value) { 
							if ($value->getTipo() == $tipo OR $tipo == 0) {
							
					?>
					<tr>
				    	<td ><?php echo  $value->getid() ?></td>
				    	<td ><?php echo $value->getNome() ?></td>
				    	<td class="hidden-phone "><?php echo $value->getEmail() ?></td>
				    	<td ><?php echo $tipoUsuarioModel->readById($value->getTipo())->getTipo()  ?></td>
					</tr>
					<?php } }?>
				</tbody>
			</table>
			<div id="texto"></div>
		</div>
	</div>
	
</div>
