<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
$user = new UsuarioModel();
$lista = $user->list("");
$tipoUsuarioModel = new TipoUsuarioModel();
?>
<style type="text/css">
	@media (max-width: 410px){
		.response{
			background-color: red;
			padding: 0;
			margin: 0;
		}
		
	}
</style>
<div class="row mt-list">
	<div class="col-lg-12 col-md-12 no-padding">
		<div class="content-panel">
			<h4><i class="fa fa-user"></i> Lista de usuários</h4>
			<table class="table table-striped table-advance table-hover ">
				<thead >
					<tr >
				    	<th>#</th>
				    	<th>Nome</th>
				   		<th class="hidden-phone">Email</th>
				    	<th>Tipo</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($lista as $value) { 
						if ($value->getTipo() == 1 or $value->getTipo() == 2) {
							
					?>
					<tr>
				    	<td><?php echo  $value->getid() ?></td>
				    	<td><?php echo $value->getNome() ?></td>
				    	<td class="hidden-phone"><?php echo $value->getEmail() ?></td>
				    	<td><?php echo $tipoUsuarioModel->readById($value->getTipo())->getTipo()  ?></td>
					</tr>
					<?php } }?>
				</tbody>
			</table>
		</div>
	</div>
	
</div>
