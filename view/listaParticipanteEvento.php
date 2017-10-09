<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/EventoModel.php';
require_once '../model/CodigoUsuarioModel.php';

$user = new UsuarioModel();
$code = new CodigoUsuarioModel();
$even = new EventoModel();
$code->setCodigo($_POST['id']);
$lista = $code->list($_POST['id']);
?>
<div class="content-panel">
<table class="table">
	<thead>
		<tr>
	    	<th>id</th>
	    	<th>Nome</th>
	   		<th>Email</th>
	    	<th>Tipo</th>
	    	<th>Evento</th>
	    	<th>Codigo</th>
	    	
		</tr>
	</thead>
	<tbody>
		<?php foreach ($lista as $value) { 
				
				if ($value->getEvento() == $code->getCodigo()) {
					$usuario = $user->readById($value->getUsuario());
					$evento = $even->readById($value->getEvento());
					
				
		?>
		<tr>
	    	<td><?php echo  $usuario->getid() ?></td>
	    	<td><?php echo $usuario->getNome() ?></td>
	    	<td><?php echo $usuario->getEmail() ?></td>
	    	<td><?php echo $usuario->getTipo() ?></td>
	    	<td><?php echo $evento->getNome() ?></td>
	    	<td><?php echo $value->getCodigo() ?></td>
		</tr>
		<?php  } } ?>
	</tbody>
</table>
</div>
