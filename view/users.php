<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
require_once '../control/EventoController.php';

$user = new UsuarioModel();

$eventos = $Evento->listaEvento();

$tipouser = new TipoUsuarioModel();
$result = $tipouser->readById(2);
if($result == null){
	$tipouser->setTipo("participante");
	$tipouser->save();
}
$tipos = $tipouser->list();


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
        <ul class="nav nav-tabs" role="tablist" id="usuarioTab">
            <li role="presentation" class="active">
                <a href="#participante" aria-controls="participante" role="tab" data-toggle="tab">
                    <h4 >Participante</h4>
                </a>
            </li>
            <li role="presentation" >
                <a href="#usuario" aria-controls="usuario" role="tab" data-toggle="tab">
                
                    <h4> Usuario</h4>
                </a>
            </li>
            <li role="presentation" >
                <a href="#convidado" aria-controls="convidado" role="tab" data-toggle="tab">
                    <h4 > Convidado</h4>
                </a>
            </li>
            <li role="presentation"  >
                <a href="#lista" aria-controls="lista" role="tab" data-toggle="tab">
                    <h4 > Lista</h4>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active login-wrap" id="participante">
                <form method="POST" action="../actions/usuarioAction.php">
                    <label class="checkbox">
                        Nome do Participante do evento
                    </label>
                    <input type="text" name="nome" class="form-control"  required="user" >
                    <br>
                    <label class="checkbox">
                        Selecione um evento para este participante
                    </label>
                    <div class="form-group">
                        <select class="form-control" name="evento" id="">
                            <?php 
                            foreach ($eventos as $value) {
                            ?>
                            <option value="<?php echo $value->getId()?>">
                                <?php echo $value->getNome()?>
                            </option> 
                            <?
                            }
                            ?>
                        </select>
                    </div>
                    <label class="checkbox">
                        Email
                    </label>
                    <input type="email" name="email" class="form-control"  required="email"><br>
                    <input type="hidden" name="tipo" value="5">

                    <div align="right">
                        <button class="btn btn-info"  type="submit"><i class="fa fa-save"></i> Salvar</button>
                    </div>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane " id="usuario">
                <form name="form1" class="" action="../actions/usuarioAction.php" method="POST" style="background-color: #fff; padding: 3px; ">
                    <div class="login-wrap">
                        <?php  
                        //Aqui tem uma verificação  
                        ?>
                        <label class="checkbox">
                            Nome de Usuario
                        </label>
                        <input type="text" name="nome" class="form-control"  required="user" >
                        <br>
                        <label class="checkbox">
                            Nome
                        </label>
                        <input type="text" name="nomecompleto" class="form-control"  required="user" >
                        <br>
                        <label class="checkbox">
                            Senha
                        </label>
                        <input type="password" name="senha" class="form-control"  required="password"><br>
                        <label class="checkbox">
                            Email
                        </label>
                        <input type="email" name="email" class="form-control"  required="email"><br>
                        <input type="hidden" name="tipo" value="2"><br>
                        <div align="right">
                            <button class="btn btn-info"  type="submit"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </div>
                </form>	  
            </div>
            <div role="tabpanel" class="tab-pane" id="convidado">
                <form action="../actions/usuarioAction.php"  name="form2"  method="POST">
               
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label class="">Nome de Usuario</label>
                            <input type="text" name="nome" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="">Nome completo</label>
                            <input type="text" name="nomecompleto" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="">Cargo</label>
                            <input type="text" name="cargo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="">Senha Temporaria</label>
                            <input type="text" name="senha" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="">Email</label><br>
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <!-- funções -->
                        <h4 class="mb"> Função do convidado</h4>
                        <div class="form-group">
                            <label class="">Função</label>
                                <select class="form-control" name="tipo">
                                    <?php foreach ($tipos as $value) { ?>
                                    <option value="<?php echo $value->getId();?>"><?php echo $value->getTipo() ?></option>
                                    <?php } ?>
                                </select>
                        
                        </div><!-- end funções -->

                         <!-- dados pessoais -->
                        <h4 class="mb"> Dados pessoais</h4>
                        <div class="form-group">
                            <label class="">Fone</label>
                            <input type="tel" name="fone" pattern="^\d{9}$"  placeholder="ex. 86981414089" class="form-control"><br>
                        </div><!-- end dados -->
                        <div class="form-group">
                            <label class="">SIAPE</label>
                            <input type="tel" name="siape" pattern="^\d{8}$" class="form-control">
                        </div>
                        <!-- end dados -->
                       

                    </div>
                    
                    <?php  
                    ?>
                   
                    <div align="right" style="margin-top: 10px"> 
                        <button class="btn btn-info"  type="submit"><i class="fa fa-save"></i> Salvar</button>
                    </div>
               
                </form>
            </div>
               
            <div role="tabpanel" class="tab-pane" id="lista">
             <?php require_once 'listaUsuario.php' ?>
            </div>
        </div>
    </div>               
</div>
<div class="col-lg-4 no-padding">
                  <div class="form-panel" >
                      <!-- forme add participante -->
                      <form class="form-horizontal style-form" method="POST">
                           <h4 class="mb"><i class="fa fa-user"> </i> Criar um tipo de Convidado</h4>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                              <div class="col-sm-10">
                                  <input type="text" name="tipoParticipante" class="form-control">
                              </div>

                          </div>
                          <?php  
                              if (isset($_POST['tipoParticipante'])) {
                            $tipo = new TipoUsuarioModel(null, $_POST['tipoParticipante']);
                            $tipos = $tipo->list($_POST['tipoParticipante']);
                            if (empty($_POST['tipoParticipante'])) {
                              echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                            }else{
                              $flag = true;
                              foreach ($tipos as $value) {
                                if ($value->getTipo() == $tipo->getTipo()) {
                                  $flag = false;
                                  break;
                                }
                              }
                              if(!$flag){
                                echo "<div class='alert alert-danger'><b>Não salvou </b> Tipo já existe.</div>";
                              }else{
                                $tipo->save();
                                echo "<div class='alert alert-success'><b>Tipo cadastrado!</b> Operação realizada com sucesso.</div>";
                            
                                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=administrador.php?view=addUser&sub=part&item=add'>";
                    
                              }   
                            }
                      
                          }

                          ?>
                         <div align="right">
                           <button type="submit" class="btn btn-info" >Salvar</button>
                         </div>
                        
                       </form><!-- end forme add participante -->
                       <hr style="border:0.1px solid #ccc;">
                       <!-- forme del participante -->
                       <form class="form-horizontal style-form" method="POST">
                           <h4 class="mb"><i class="fa fa-trash-o"></i> Exlcuir Tipo</h4>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                              
                                  <div class="col-sm-10">
                                    <select class="form-control" name="tipoDel">
                                        <?php foreach ($tipos as $value) { ?>
                          <option value="<?php echo $value->getId();?>"><?php echo $value->getTipo() ?></option>
                      <?php } ?>
                    </select>
                                  </div>
                              
                          </div>
                           <?php  
                              if (isset($_POST['tipoDel'])) {
                            $tipoP = new TipoUsuarioModel($_POST['tipoDel'],null );
                            if (empty($_POST['tipoDel'])) {
                              echo "<div class='alert alert-danger'><b>Não excluiodo </b> Selecione um item </div>";

                            }else{
                              echo "<div class='alert alert-success'><b>Tipo cadastrado!</b> Operação realizada com sucesso.</div>";

                              $tipoP->delete($_POST['tipoDel']);
                              echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=administrador.php?view=addUser&sub=part&item=add'>";
                            }
                      
                          }

                          ?>
                          <div align="right">
                             <button type="submit" class="btn btn-danger" >Excluir</button>
                          </div>
                         
                       </form> <!-- end forme del participante -->
                  </div>
</div>
</div>
<script>
    $('#usuarioTab a').click(function (e) {
        e.preventDefault()
    $(this).tab('show')
    });

</script>