<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
require_once '../model/TipoEventoModel.php';
require_once '../model/EventoModel.php';
$eve = new EventoModel();

$tipouser = new TipoEventoModel();
$result = $tipouser->readById(2);
if($result == null){
  #$tipouser->setTipo("evento1");
  #$tipouser->save();
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
<div class="col-lg-8 col-sm-10">
                  <div class="form-panel">
                      <h4 class="mb"> Evento</h4>
                      <form class="form-horizontal style-form"  method="POST">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nome" class="form-control">
                              </div>
                          </div>
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
                                  <input type="text" name="dataInicio"  placeholder="ex. aaaa-mm-dd" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Fim</label>
                              <div class="col-sm-4">
                                  <input type="text" name="dataFim"  placeholder="ex. aaaa-mm-dd" class="form-control">
                              </div>
                          </div><!-- end dados -->
                    <?php  
                      if(isset($_POST['nome'])){
                        if(empty($_POST['nome'])){
                          echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                        }else{
                            $eve->setNome($_POST['nome']);
                            $eve->setEndereco($_POST['local']);
                            $eve->setTipo($_POST['tipo']);
                            $eve->setDataInicio($_POST['dataInicio']);
                            $eve->setDataFim($_POST['dataFim']);
                            $eve->setUsuario(1);

                            $lista = $eve->list($_POST['nome']);
                            $flag = true;
                            foreach ($lista as $value) {
                              if($value->getNome() == $eve->getNome()){
                                $flag = false;
                                break;
                              }
                            }
                        if(!$flag){
                            echo "<div class='alert alert-danger' ><b>Não salvou </b> Evento já existe.</div>";
                          }else{
                            $eve->save();
                            echo "<div class='alert alert-success' ><b>Evento cadastrado!</b> Operação realizada com sucesso.</div>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='10;URL=administrador.php?view=addEvento&sub=part&item=add'>";
                          } 
                        }
                      }

                    ?>
                         <div align="right">
                           <button type="submit" class="btn btn-info" >Salvar</button>
                         </div>
                       </form>
                  </div>
                  
</div>
<div class="col-lg-4 col-sm-2  col-xs- 10" >
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
                            $tipoE = new TipoEventoModel(null, $_POST['tipoEvento']);
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
                                $tipoD = new TipoEventoModel($_POST['tipoDel'],null );
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
</div>
