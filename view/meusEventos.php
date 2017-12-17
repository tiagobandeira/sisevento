<?php  
require_once '../model/EventoModel.php';
require_once '../model/CodigoUsuarioModel.php';
$eventoModel = new EventoModel();
$listaEvento = $eventoModel->listAll("");
$codigoModel = new CodigoUsuarioModel();
$listaCodigo = $codigoModel->listByUsuario($_SESSION['id']);
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
			<h4><i class="fa fa-calendar"></i> Meus de eventos</h4>
			<table class="table table-striped table-advance table-hover ">
				<thead >
					<tr >
				    	<th>Nome</th>
				   		<th class="hidden-phone">Local</th>
				    	<th>Data</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($listaCodigo as $value) { 
						$evento = $eventoModel->readById($value->getEvento());
					?>
					<tr>
				    	<td><?php echo $evento->getNome() ?></td>
				    	<td class="hidden-phone"><?php echo $evento->getEndereco() ?></td>
				    	<td><?php echo $evento->getDataInicio() ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	
</div>
