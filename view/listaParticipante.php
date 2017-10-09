<?php  
require_once '../model/UsuarioModel.php';
$user = new UsuarioModel();
$lista = $user->list("");
?>
<div class="content-panel">
<table class="table">
	<thead>
		<tr>
	    	<th>#</th>
	    	<th>Nome</th>
	   		<th>Email</th>
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
	    	<td><?php echo $value->getEmail() ?></td>
	    	<td><?php echo $value->getTipo() ?></td>
		</tr>
		<?php } } ?>
	</tbody>
</table>
</div>