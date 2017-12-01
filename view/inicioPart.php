
<?php  
require_once '../model/TipoEventoModel.php';
require_once '../model/EventoModel.php';
require_once '../model/CodigoUsuarioModel.php';
require_once 'code.php';
$evento = new EventoModel();
$eventos = $evento->list("");

?>
<!--<h3><i class="fa fa-angle-right"></i> Eventos</h3>-->

<div class="row mt-default">
	<div class="col-lg-12 col-md-12 col-sm-12 ">
		<div class="showback" >
			<h3><i class="fa fa-calendar-o" ></i> Eventos Cadastrados</h3>
		</div>
	</div>
	<?php  
		foreach ($eventos as $value) {
			if ($value->getStatus() == "A") {

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
			<button class="btn btn-small btn-theme04 " name="btn" 
				value="<?php echo status($value->getId()) == true?'Participar':'Cancelar Participação' ?>">
					<?php echo status($value->getId()) == true?'Participar':'Cancelar Participação' ?>
			</button>
			<input type="hidden" name="idEvento" value="<?php echo $value->getId();?>">
		</form>
		</div>
	</div><! --/col-md-4 -->
	<?php } }?>
	<?php 
		
		if(isset($_POST['btn'])){
			if ($_POST['btn'] == "Participar") {
				participar($_POST['idEvento']);
				echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=participante.php'>";
			}else{
				$codigoModel = new CodigoUsuarioModel();
				$codigos = $codigoModel->list($_POST['idEvento']);
				$idCodigo = null;
				foreach ($codigos as $value) {
					if ($value->getEvento() == $_POST['idEvento'] && $value->getUsuario() == $_SESSION['id']) {
						$idCodigo = $value->getId();
					}
				}
				deixarDeParticipar($idCodigo);
				echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=participante.php'>";
			}
			
		}
	 ?>
</div>
