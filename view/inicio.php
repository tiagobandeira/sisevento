
<?php  
require_once '../model/TipoEventoModel.php';
require_once '../model/EventoModel.php';
require_once '../model/UsuarioModel.php';
$evento = new EventoModel();
$eventos = $evento->list("");


?>
<!--<h3><i class="fa fa-angle-right"></i> Eventos Cadastrados</h3>-->
<div class="showback">
<h3><i class="fa fa-calendar-o"></i> Eventos Cadastrados</h3>
</div>
<div class="row">
	<?php  
		foreach ($eventos as $value) {

	?>
	<div class="col-lg-4 col-md-4 col-sm-4 mb">
		<div class="product-panel-2 pn">
		<!--<div class="badge badge-hot">HOT</div>-->
		<!--<img src="componentes/assets/img/product.jpg" width="200" alt="">-->
		<h1 class="fa fa-calendar"></h1>
		<h5 class="mt"><?php echo $value->getNome(); ?></h5>
		<h6> <?php echo $value->getEndereco();  ?></h6>
		<h6>Data Início: <?php echo $value->getDataInicio();  ?></h6>
		<h6>Data Fim: <?php echo $value->getDataFim(); ?></h6>
		<form method="POST" action="?view=listaParticipanteEvento&sub=part&item=addE">
			<button class="btn btn-small btn-theme04" >Participantes</button>
			<input type="hidden" name="id" value="<?php echo $value->getId();?>">
		</form>
		
		</div>
	</div><! --/col-md-4 -->
	<?php } ?>
</div>