<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
require_once '../model/TipoEventoModel.php';
require_once '../control/EventoController.php';
require_once '../model/OrganizadorModel.php';
require_once '../model/CodigoUsuarioModel.php';
require_once 'message/Message.php';


$Print = new Message('administrador.php?view=users&sub=users');

$user = new UsuarioModel();

$eventos = $Evento->listaEvento();

$tipouser = new TipoUsuarioModel();
$result = $tipouser->readById(2);
if($result == null){
	$tipouser->setTipo("participante");
	$tipouser->save();
}
$tipos = $tipouser->list();
#organizadores
$organizador1 = new OrganizadorModel();
$organizador2 = new OrganizadorModel();
$userModel = new UsuarioModel();
$usuarios = $userModel->list();

?>
<!--
<h3><i class="fa fa-angle-right"></i>Adicionar Participante</h3>
<div class="row mt">
	<div class="col-lg-12">
	<p>Incluir content aqui.</p>

	</div>
</div>
-->
<div class="row">
    <div class="col-lg-8 no-padding">
        <div class="form-panel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id="eventoTab">
            <li role="presentation" class="<?php echo $_GET['tab'] == 1 || $_GET['tab'] == null && $_POST['tab'] == null ?' active ':'' ?>">
                <a href="#evento" aria-controls="evento" role="tab" data-toggle="tab">
                    <h4 >Evento</h4>
                </a>
            </li>
            <li role="presentation" class="<?php echo $_GET['tab'] == 2?' active ':'' ?>">
                <a href="#lista" aria-controls="lista" role="tab" data-toggle="tab">
                
                    <h4> Lista</h4>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane <?php echo $_GET['tab'] == 1 || $_GET['tab'] == null && $_POST['tab'] == null  ?' active ':'' ?> login-wrap" id="evento">
                <?php
                   if(isset($_GET['message'])){
                       if($_GET['message'] == 1 && $_GET['tab'] == 1){
                            $Print->success('Usuario cadastrado.', null, "&tab=1");
                       }
                   }
                ?>
                <form method="POST" class="form-horizontal style-form" action="../actions/eventoAction.php" class="">
                        <h4 class="mb"> Evento</h4>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                            <div class="col-sm-8">
                                <input type="text" name="nome" class="form-control">
                            </div>
                        </div> 
                        <div class="form-group">
                        <div class="col-sm-2 col-sm-2 control-label">
                            <label >Organizador 1</label>
                        </div>
                        <div class="col-sm-6 col-sm-6 control-label" >
                            <select class="form-control" name="org1">
                                    <option value="">Selecione um organizador</option>
                                <?php
                                    foreach ($usuarios as $value) {
                                    if ($value->getTipo() > 2) {
                                ?>
                                <option value="<?php echo $value->getId();?>">
                                    <?php echo $value->getNomeCompleto();?>
                                </option>
                                <?php
                                    }
                                    }

                                ?>
                            </select><br>
                        </div>
                        <div class="col-sm-4 col-sm-4 control-label">
                            <input type="file" name="" id="">
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="col-sm-2 col-sm-2 control-label">
                            <label >Organizador 2</label>
                        </div>
                        <div class="col-sm-6 col-sm-6 control-label" >
                            <select class="form-control" name="org2">
                                    <option value="">Selecione um organizador</option>
                                <?php
                                    foreach ($usuarios as $value) {
                                    if ($value->getTipo() > 2) {
                                ?>
                                <option value="<?php echo $value->getId();?>">
                                    <?php echo $value->getNomeCompleto();?>
                                </option>
                                <?php
                                    }
                                    }

                                ?>
                            </select><br>
                        </div>
                        <div class="col-sm-4 col-sm-4 control-label">
                            <input type="file" name="" id="">
                        </div>
                        </div>

                        <!--
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Organizador 1</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="org1">
                                    <option value="">Selecione um organizador</option>
                                    <?php
                                    foreach ($usuarios as $value) {
                                        if ($value->getTipo() > 2) {
                                    ?>
                                    <option value="<?php echo $value->getId();?>">
                                    <?php echo $value->getNomeCompleto();?>
                                    </option>
                                    <?php
                                        }
                                    }

                                    ?>
                                </select><br>

                            </div>
                            
                                        
                            <label class="col-sm-2 col-sm-2 control-label">Organizador 2</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="org2">
                                    <option value="">Selecione um organizador</option>
                                    <?php
                                    foreach ($usuarios as $value) {
                                        if ($value->getTipo() > 2) {
                                    ?>
                                    <option value="<?php echo $value->getId();?>">
                                    <?php echo $value->getNomeCompleto();?>
                                    </option>
                                    <?php
                                        }
                                    }

                                    ?>
                                </select>

                            </div>
                        </div>-->

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Local</label>
                            <div class="col-sm-10">
                                <input type="text" name="local" class="form-control">
                            </div>
                        </div>

                        <!-- funções -->
                        <h4 class="mb"> Tipo de Evento</h4>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="tipo">
                                <?php foreach ($tipos as $value) { ?>
                                    <option value="<?php echo $value->getId();?>"><?php echo $value->getTipo() ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div><!-- end funções -->
                        <!-- dados pessoais -->
                        <h4 class="mb"> Data do evento</h4>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Início</label>
                            <div class="col-sm-4">
                                <input type="text" name="data_inicio"  placeholder="ex. aaaa-mm-dd" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Fim</label>
                            <div class="col-sm-4">
                                <input type="text" name="data_fim"  placeholder="ex. aaaa-mm-dd" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Carga Horária</label>
                            <div class="col-sm-4">
                                <input type="number" name="cargahoraria" pattern="^d{2}$" maxlength="2"  placeholder="" class="form-control">
                            </div>
                        </div><!-- end dados -->
                        <!-- php salva-->
                        <div align="right">
                            <button type="submit" name="btn" value="event" class="btn btn-info" >Salvar</button>
                        </div>
                </form>

                
            </div>
            <div role="tabpanel" class="tab-pane login-wrap  <?php echo $_GET['tab'] == 2?' active ':'' ?> " id="lista">
                <?php require_once 'listaEventos.php' ?>
            </div>
        </div>
    </div>               
</div>
<div class="col-lg-4 no-padding">
<div class="form-panel" >
          <!-- forme add tipo evento -->
          <form class="form-horizontal style-form" method="POST">
                <h4 class="mb"><i class="fa fa-calendar"> </i> Criar um tipo de Evento</h4>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                  <div class="col-sm-10">
                      <input type="text" name="tipoEvento" class="form-control">
                  </div>

              </div>
              <?php
                  if (isset($_POST['tipoEvento'])) {
                $tipoE = new TipoEventoModel();
                $tipoE->setTipo($_POST['tipoEvento']);
                $tipos = $tipoE->list($_POST['tipoEvento']);
                if (empty($_POST['tipoEvento'])) {
                  echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                }else{
                  $flag = true;
                  foreach ($tipos as $value) {
                    if ($value->getTipo() == $tipoE->getTipo()) {
                      $flag = false;
                      break;
                    }
                  }
                  if(!$flag){
                    echo "<div class='alert alert-danger'><b>Não salvou! </b> Tipo já existe.</div>";
                  }else{
                    $tipoE->save();
                    echo "<div class='alert alert-success'><b>Tipo cadastrado!</b> Operação realizada com sucesso.</div>";
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=administrador.php?view=addEvento&sub=part&item=add'>";
                  }
                }

              }

              ?>
              <div align="right">
                <button type="submit" class="btn btn-info" >Salvar</button>
              </div>

            </form><!-- end forme add tipo evento -->
            <hr style="border:0.1px solid #ccc;">
            <!-- forme del tipo evento -->
            <form class="form-horizontal style-form" method="POST">
                <h4 class="mb"><i class="fa fa-trash-o"></i> Exlcuir tipo</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="tipoDel">
                            <?php foreach ($tipos as $value) { ?>
                                <option value="<?php echo $value->getId() ?>"><?php echo $value->getTipo() ?></option>
                            <?php } ?>
                        </select>
                      </div>
              </div>
                <?php
                if (isset($_POST['tipoDel'])) {
                    $tipoD = new TipoEventoModel();
                    $tipoD->setId($_POST['tipoDel']);
                    if (empty($_POST['tipoDel'])) {
                      echo "<div class='alert alert-danger'><b>Não excluiodo </b> Selecione um item </div>";


                    }else{
                      echo "<div class='alert alert-success'><b>Tipo cadastrado!</b> Operação realizada com sucesso.</div>";
                      $tipoD->delete($_POST['tipoDel']);
                      echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=administrador.php?view=addEvento&sub=part&item=add'>";
                    }

              }

              ?>
              <div align="right">
                  <button type="submit" class="btn btn-danger" >Excluir</button>
              </div>

            </form> <!-- end forme del participante -->
      </div>
      <div class="form-panel" >
          <!-- forme add tipo evento -->
          <form class="form-horizontal style-form" action="../actions/usuarioAction.php" method="POST">
                <h4 class="mb"><i class="fa fa-users"> </i> Criar um organizador</h4>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                  <div class="col-sm-10">
                      <input type="text" name="nomecompleto" class="form-control">
                  </div>

              </div>
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Cargo</label>
                  <div class="col-sm-10">
                      <input type="text" name="cargo" class="form-control">
                  </div>

              </div>
              <!-- funções -->
              <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Função</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="tipo">
                            <?php foreach ($tipos as $value) { ?>
                                <option value="<?php echo $value->getId() ?>"><?php echo $value->getTipo() ?></option>
                            <?php } ?>
                        </select>
                      </div>
              </div>
              <!-- end funções -->
              <div align="right">
                <button type="submit" class="btn btn-info" >Salvar</button>
              </div>

            </form><!-- end forme add tipo evento -->
           
            <!-- forme del tipo evento -->
            
      </div>
</div>
</div>
<script>
    $('#usuarioTab a').click(function (e) {
        e.preventDefault()
    $(this).tab('show')
    });

</script>