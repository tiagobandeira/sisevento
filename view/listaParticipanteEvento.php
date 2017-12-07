<?php
require_once '../model/UsuarioModel.php';
require_once '../model/EventoModel.php';
require_once '../model/CodigoUsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';

$user = new UsuarioModel();
$code = new CodigoUsuarioModel();
$even = new EventoModel();
$code->setCodigo($_GET['id']);
$lista = $code->list($code->getCodigo());
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
				    	<th class="hidden-phone">Codigo</th>
							<th>Gerar</th>
							<th>
								<form name="checkForm">
									<input type="checkbox" id="todos" class="list-child" value="teste" onclick="checkcedUnchecked()"/>
								</form>
							</th>

					</tr>
				</thead>
				<tbody>
					<form name="itensForm" method="POST" action="gerar-certificado.php">
					<?php

							foreach ($lista as $value) {

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
				    	<td class="hidden-phone"><?php echo $value->getCodigo() ?></td>
							<!--<td> <button type="submit" value="<?php echo $value->getId() ?>" name="idcodigo" class="btn btn-default btn-xs" align="center"><i class="fa fa-print"></i></button></td>-->
							<td>
							<a href="gerarCertificado2.php?cod=<?php echo $value->getId();?>">
									<span class="btn btn-default btn-xs fa fa-print"></span>
							</a>
						</td>
						<td><input type="checkbox"  class="check list-child" value="<?php echo $value->getId()?>" name="ch[]"/></td>

					</tr>

					<?php  } } ?>
					<tr>
						<td colspan="8">
							<div class=" add-task-row">
									<!--<a class="btn btn-default btn-sm pull-left" href="todo_list.html#">See All Tasks</a>-->
									<input type="hidden" name="idcodigo" value="<?php echo $_GET['id']?>">
									<button class="btn btn-success btn-sm pull-right" type="submit">Gerar marcados</button>
							</div>
						</td>
					</tr>
				</form>
				</tbody>

			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	//Marca e desmarca todos
	function checkcedUnchecked(){
		var status = document.forms.checkForm.elements['todos'].checked;
		for (i = 0; i < document.forms.itensForm.elements.length; i++){
			if (document.forms.itensForm.elements[i].type == "checkbox"){
				document.forms.itensForm.elements[i].checked = status;
			}
		}
	}
</script>
