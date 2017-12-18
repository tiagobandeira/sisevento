
<?php
require_once '../model/TipoEventoModel.php';

require_once '../control/UsuarioController.php';
require_once '../control/EventoController.php';

$eventos = $Evento->eventosUsuario($_SESSION['id']);
$url_key = "year";

?>
<!--<h3><i class="fa fa-angle-right"></i> Eventos Cadastrados</h3>-->

<div class="showback" style="margin-top: 5px">
	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">

			<div class="col-lg-6 col-md-6 col-sm-6">
				<h3><i class="fa fa-calendar-o" ></i> Eventos Cadastrados</h3>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6  goright">
				<!-- Single button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-theme dropdown-toggle btn-lg" data-toggle="dropdown">

							<?php
								if(isset($_GET[$url_key])){
									echo $_GET[$url_key];
								}else{
									echo date("Y");
								}
							?>
							<span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
								<?php
								/*
									$years = array();
									foreach ($eventos as $value) {
										$valueAno = date("Y", strtotime($value->getDataInicio()));
										array_push($years, $valueAno);
									}*/
									$yearsOrder = $Evento->ordenarAno();

									foreach ($yearsOrder as $value) {
										if($value != $value - 1){
											echo "<li><a href='?year=" . $value . "'> " . $value . "</a></li>";
										}

									}
								?>
						</div>
			</div>

	</div>
</div>
</div>

<div class="row mt-default">
	<!--
	<div class="col-lg-12 col-md-12 col-sm-12 ">
		<div class="showback" >
			<h3><i class="fa fa-calendar-o" ></i> Eventos Cadastrados</h3>
		</div>
	</div>
	-->

	<?php
		$anoUrl = $_GET[$url_key];
		$eventoAno = $Evento->selecionaAno($anoUrl);
		//print_r($ano);
		foreach ($eventoAno as $value) {
			//$dataStr = $value->getDataInicio();
			#$data = data('Y', strtotime($dataStr));
			if ($value->getStatus() == "A"  && $value->getUsuario() == $_SESSION['id']) {
	?>

	<div class="col-lg-4 col-md-4 col-sm-4 mb" >
		<div class="product-panel-2 pn">
		<!--<div class="badge badge-hot">HOT</div>-->
		<!--<img src="componentes/assets/img/product.jpg" width="200" alt="">-->
		<h1 class="fa fa-calendar"></h1>
		<h5 class="mt"><?php echo $value->getNome(); ?></h5>
		<h6> <?php echo $value->getEndereco();  ?></h6>
		<h6>Data Início: <?php echo $value->getDataInicio();  ?></h6>
		<h6>Data Fim: <?php echo $value->getDataFim(); ?></h6>
		<form method="POST" action="?view=listaParticipanteEvento&id=<?php echo $value->getId()?>">
			<button class="btn btn-small btn-theme04" >Participantes</button>
			<input type="hidden" name="id" value="<?php echo $value->getId();?>">
		</form>
		</div>
	</div><! --/col-md-4 -->
	<?php } }?>

</div>
