<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/EventoModel.php';
require_once '../model/CodigoUsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';

$user = new UsuarioModel();
$code = new CodigoUsuarioModel();
$even = new EventoModel();
$code->setCodigo($_POST['id']);
$lista = $code->list($_POST['id']);
$tipoUsuarioModel = new TipoUsuarioModel();
?>

<div class="row mt-default">
	<div class="col-md-12">
		<div class="content-panel">
			<h4><i class="fa fa-user"></i>  
				<?php echo $lista != null?"Usuarios participantes do evento " . $even->readById($lista[0]->getEvento())->getNome():"Ainda não existe nenhum usuário participando";  ?>
			</h4>
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr>
				    	<th class="hidden-phone">id</th>
				    	<th>Nome</th>
				   		<th class="hidden-phone">Email</th>
				    	<th>Tipo</th>
				    	<th class="hidden-phone">Evento</th>
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
				    	<td class="hidden-phone"><?php echo  $usuario->getid() ?></td>
				    	<td><?php echo $usuario->getNome() ?></td>
				    	<td class="hidden-phone"><?php echo $usuario->getEmail() ?></td>
				    	<td><?php echo  $tipoUsuarioModel->readById($usuario->getTipo())->getTipo() ?></td>
				    	<td class="hidden-phone"><?php echo $evento->getNome() ?></td>
				    	<td><?php echo $value->getCodigo() ?></td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
