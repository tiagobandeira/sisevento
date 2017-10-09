
<?php  
require_once '../model/TipoEventoModel.php';
require_once '../model/EventoModel.php';
require_once 'code.php';
$evento = new EventoModel();
$eventos = $evento->list("");

?>
<!--<h3><i class="fa fa-angle-right"></i> Eventos</h3>-->



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
		<h6>Data Início: <?php echo $value->getDataInicio(); ?></h6>
		<h6>Data Fim: <?php echo $value->getDataFim(); ?></h6>
		<form method="post" >
			<button class="btn btn-small btn-theme04 " name="id" ><?php echo status($value->getId()) == true?'Participar':'Cancelar Participação' ?></button>
			<input type="hidden" name="id" value="<?php echo $value->getId();?>">
		</form>
		</div>
	</div><! --/col-md-4 -->
	<?php } ?>
	<?php 
		
		if(isset($_POST['id'])){
			if (status($_POST['id'])) {
				participar($_POST['id']);
				echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=participante.php'>";
			}
			
		}
	 ?>
</div>