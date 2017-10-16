<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
$user = new UsuarioModel();
$lista = $user->list("");
$tipoUsuarioModel = new TipoUsuarioModel();
?>
<div class="row mt-default">
	<div class="col-lg-12 col-md-12">
		<div class="content-panel">
			<h4><i class="fa fa-user"></i> Lista de Participantes</h4>
			<table class="table table-striped  table-hover ">
				<thead>
					<tr>
				    	<th>#</th>
				    	<th>Nome</th>
				   		<th class="hidden-phone">Email</th>
				    	<th>Tipo</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($lista as $value) { 
						if ($value->getTipo() > 2) {
					?>
					<tr>
				    	<td><?php echo  $value->getid() ?></td>
				    	<td><?php echo $value->getNome() ?></td>
				    	<td class="hidden-phone"><?php echo $value->getEmail() ?></td>
				    	<td><?php echo $tipoUsuarioModel->readById($value->getTipo())->getTipo()  ?></td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>
		</div>	
	</div>
</div>