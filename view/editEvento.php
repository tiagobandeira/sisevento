<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
require_once '../model/TipoEventoModel.php';
require_once '../model/EventoModel.php';
require_once '../model/OrganizadorModel.php';
$eve = new EventoModel();

$tipouser = new TipoEventoModel();
$tipos = $tipouser->list();
$userModel = new UsuarioModel();

if (isset($_GET['evento'])) {
  $eventoEdit = $eve->readById($_GET['evento']);
  $idEvento = $eventoEdit->getId();
  $nomeEvento = $eventoEdit->getNome();
  $dataInicioEvento = $eventoEdit->getDataInicio();
  $dataFimEvento = $eventoEdit->getDataFim();
  $tipoEvento = $eventoEdit->getTipo();
  $usuarioEvento = $eventoEdit->getUsuario();
  $enderecoEvento = $eventoEdit->getEndereco();
  $tipoNomeEvento = $tipouser->readById($tipoEvento)->getTipo();
  #organizadores
  $organizador1 = new OrganizadorModel();
  $organizador2 = new OrganizadorModel();
  $orgnizadores = $organizador1->list($idEvento); 
  @$organizadorUsuario1 = $userModel->readById($orgnizadores[0] != null?$orgnizadores[0]->getUsuario():0);
  @$organizadorusuario2 = $userModel->readById($orgnizadores[1] != null?$orgnizadores[1]->getUsuario():0);
  #usuarios
  $usuarios = $userModel->list();


}



?>
<div class="row">
    <div class="col-lg-8 no-padding">
                  <div class="form-panel">
                      <h4 class="mb"> Evento</h4>
                      <form class="form-horizontal style-form"  method="POST">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                              <div class="col-sm-10">
                                  <input type="text" value="<?php echo $nomeEvento;?>" name="nome" class="form-control">
                              </div>
                          </div>
                           <div class="form-group">

                              <label class="col-sm-2 col-sm-2 control-label">Organizador 1</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="org1">
                                      <?php 
                                            if ($organizadorUsuario1 != null) {
                                              
                                      ?>
                                      <option value="<?php echo $organizadorUsuario1->getId();  ?>">
                                        <?php  echo $organizadorUsuario1->getNomeCompleto();  ?>
                                      </option> 
                                      <?php
                                            }
                                      ?>
                                      <option value="">
                                        Selecionar um organizador
                                      </option> 
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
                                     <?php 
                                            if ($organizadorUsuario2 != null) {

                                      ?>
                                      <option value="<?php echo $organizadorUsuario2->getId();  ?>">
                                        <?php  echo $organizadorUsuario2->getNomeCompleto();  ?>
                                      </option> 
                                      <?php
                                            }
                                      ?>
                                      
                                      <option value="">
                                        Selecionar um organizador
                                      </option> 
                                      <?php  
                                        foreach ($usuarios as $value) {
                                          if ($value->getTipo() > 2 ) {
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
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Local</label>
                              <div class="col-sm-10">
                                  <input type="text" value="<?php echo $enderecoEvento;?>" name="local" class="form-control">
                              </div>
                          </div>
                         
                            <!-- funções -->
                          <h4 class="mb"> Tipo de Evento</h4>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="tipo">
                                    <option value="<?php echo $tipoEvento;?>"><?php echo $tipoNomeEvento;?></option>
                                    <?php foreach ($tipos as $value) { ?>
                                     <option value="<?php echo $value->getId();?>">
                                        <?php echo $tipoNomeEvento == $value->getTipo()?$tipoNomeEvento:$value->getTipo() ?>
                                      </option>
                                    <?php } ?>
                                  </select>
                              </div>
                          </div><!-- end funções -->
                          <!-- dados pessoais -->
                          <h4 class="mb"> Data do evento</h4>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Início</label>
                              <div class="col-sm-4">
                                  <input type="text" value="<?php echo $dataInicioEvento ?>" name="dataInicio"  placeholder="ex. aaaa-mm-dd" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Fim</label>
                              <div class="col-sm-4">
                                  <input type="text" value="<?php echo $dataFimEvento ?>" name="dataFim"  placeholder="ex. aaaa-mm-dd" class="form-control">
                              </div>
                          </div><!-- end dados -->
                    <?php  
                      if(isset($_POST['nome'])){
                        if(empty($_POST['nome'])){
                          echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                        }else{
                            $eve->setId($idEvento);
                            $eve->setNome($_POST['nome']);
                            $eve->setEndereco($_POST['local']);
                            $eve->setTipo($_POST['tipo']);
                            $eve->setDataInicio($_POST['dataInicio']);
                            $eve->setDataFim($_POST['dataFim']);
                            $eve->setUsuario(1);

                            $lista = $eve->list($_POST['nome']);
                            $flag = true;
                            foreach ($lista as $value) {
                              if($value->getNome() == $eve->getNome() && $idEvento != $value->getId()){
                                $flag = false;
                                break;
                              }
                            }
                        if(!$flag){
                            echo "<div class='alert alert-danger' ><b>Não salvou </b> Evento já existe.</div>";
                          }else{
                            $eve->save();
                            if (isset($_POST['org1']) || isset($_POST['org2'])) {
                                  if(!empty($_POST['org1'])){
                                     $organizador1->setUsuario($_POST['org1']);
                                     $organizador1->setEvento($idEvento);
                                     $organizador1->save();
                                  }
                                  if(!empty($_POST['org2'])){
                                      $organizador2->setUsuario($_POST['org2']);
                                      $organizador2->setEvento($idEvento);
                                      $organizador2->save();
                                  }
                            }
                           
                            echo "<div class='alert alert-success' ><b>Evento cadastrado!</b> Operação realizada com sucesso.</div>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;
                              URL=administrador.php?view=editEvento&sub=listeve&item=list&evento=$idEvento'>";
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
                                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;
                                    URL=administrador.php?view=editEvento&sub=listeve&item=list&evento=$idEvento'>";
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
                                  echo "<meta HTTP-EQUIV='refresh' CONTENT='0;
                                      URL=administrador.php?view=editEvento&sub=listeve&item=list&evento=$idEvento'>";
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
