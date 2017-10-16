<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
require_once '../model/TipoEventoModel.php';
require_once '../model/EventoModel.php';
require_once '../model/CertificadoModel.php';
require_once '../model/TipoCertificadoModel.php';

$eve = new EventoModel();
$eves = $eve->list("");
$eve->closeCon();
#tipo
$tipo = new TipoCertificadoModel();
$tipos = $tipo->list();
$tipo->closeCon();
#certificado
$cert = new CertificadoModel();
#tipo de usuario
$tipoUserModel = new TipoUsuarioModel();
$tiposUsuarios = $tipoUserModel->list();


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
                      <h4 class="mb"> Certificado</h4>
                      <form class="form-horizontal style-form"  method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nome" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Evento</label>

                              <div class="col-sm-10">

                                 <select class="form-control" name="tipoE">
                                        <?php foreach ($eves as $value) { ?>
                                            <option value="<?php echo $value->getId() ?>"><?php echo $value->getNome() ?></option>
                                        <?php } ?>
                                  </select>
                              </div>
                          </div>
                         
                            <!-- funções -->
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="tipoC">
                                    <?php foreach ($tipos as $value) { ?>
                                     <option value="<?php echo $value->getId();?>"><?php echo $value->getTipo() ?></option>
                                    <?php } ?>
                                  </select>
                              </div>

                          </div><!--  -->
                           <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">Tipo de Participante</label>
                              <div class="col-sm-9">
                                  <select class="form-control" name="tipoUsuario">
                                    <?php foreach ($tiposUsuarios as $value) { ?>
                                     <option value="<?php echo $value->getId();?>"><?php echo $value->getTipo() ?></option>
                                    <?php } ?>
                                  </select>
                              </div>

                          </div><!--  -->
                          <!-- dados pessoais -->
                          <h4 class="mb"> Adicionar Imagem</h4>
                          <div class="form-group">
                               <div class="col-sm-4">
                                  <!-- MAX_FILE_SIZE deve preceder o campo input no máximo 1MB -->
                                  <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                                  <!-- O Nome do elemento input determina o nome da array $_FILES -->
                                  <input type="file" name="imagem" >
                              </div>
                          </div><!-- end dados -->

                           <div class="form-group">
                              
                               <label class="col-sm-8 col-sm-8 control-label">
                                  Obs: O arquivo não de ultrapassar  1MB.
                                  Tipos suportados: jpg.
                               </label>
                          </div><!-- end dados -->

                    <?php  
                      if(isset($_POST['nome']) && isset($_POST['tipoC']) && isset($_POST['tipoE'])){
                          if(empty($_POST['nome'])){
                              echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                          }else{
                              $cert->setNome($_POST['nome']);
                              $cert->setTipo($_POST['tipoC']);
                              $cert->setEvento($_POST['tipoE']);
                              $cert->setTipoUsuario($_POST['tipoUsuario']);

                              if (!empty($_FILES['imagem']['name'])) {
                                  #chamar a function upload
                                  require_once '../lib/upload.php';
                                  if (imageIsEmpty($_FILES['imagem']['name']) === TRUE) {

                                      $imagem = "certificado_default.png";
                                      $_FILES['imagem']['name'] = $imagem;
                                  }
                                  if (isImage($_FILES['imagem']) === TRUE) {
                                      echo "é uma imagem. ";
                                  }else{

                                  }
                                  moveImage($_FILES['imagem']);#salva a imagem em midia/
                                  $cert->setImagem($_FILES['imagem']['name']);

                              }

                              $cert->setUsuario($_SESSION['id']);
                              $lista = $cert->list($_POST['nome']);
                              $flag = true;
                              foreach ($lista as $value) {
                                if($value->getNome() == $cert->getNome()){
                                  $flag = false;
                                  break;
                                }
                              }
                              if(!$flag){
                                  echo "<div class='alert alert-danger'><b>Não salvou </b> Certifica já existe.</div>";
                              }else{
                                  $cert->save();
                                  echo "<div class='alert alert-success' ><b>Certificado cadastrado!</b> Operação realizada com sucesso.</div>";
                                  # echo "<meta HTTP-EQUIV='refresh' CONTENT='10;URL=administrador.php?view=addCertificado&sub=part&item=add'>";
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
                           <h4 class="mb"><i class="fa fa-certificate"> </i> Criar um tipo de Certificado</h4>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                              <div class="col-sm-10">
                                  <input type="text" name="tipoCertificado" class="form-control">
                              </div>
                          </div>
                         
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Texo</label>
                              <div class="col-sm-10">
                                  <textarea class="form-control" name="texto">Ex: Certificamos que --u participou do evento --e nas datas de --d e d-- . 
                                  </textarea>
                              </div>
                              
                          </div>
                          <div class="form-group">
                              <label class="col-sm-8 col-sm-8 control-label">Cor do texto</label>
                              <div class="col-sm-4">
                                   <input type="color" name="corTexto" class="form-control">
                              </div>
                          </div>
                          
                           <div class="form-group">
                              <label class="col-sm-12 col-sm-12 control-label">--u para mostrar o nome do usuario</label>
                              <label class="col-sm-12 col-sm-12 control-label">--e para mostrar o nome evento</label>
                              <label class="col-sm-12 col-sm-12 control-label">--d para mostrar a data inicial</label>
                              <label class="col-sm-12 col-sm-12 control-label">d-- para mostrar a data final</label>
                              
                          </div>
                          <?php  
                            if (isset($_POST['tipoCertificado'])) {
                             
                              $tipoCertificado = new TipoCertificadoModel();
                              $tipoCertificado->setTipo($_POST['tipoCertificado']);
                              $tipoCertificado->setTexto($_POST['texto']);
                              $tipoCertificado->setCorTexto($_POST['corTexto']);
                              $tipos = $tipoCertificado->list($_POST['tipoCertificado']);
                              $flag = true;
                              if (empty($_POST['tipoCertificado'])) {
                                  echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                              }else{
                                  foreach ($tipos as $value) {
                                    if ($value->getTipo() == $tipoCertificado->getTipo()) {
                                      $flag = false;
                                      break;
                                    }
                                  }
                                  if(!$flag){
                                      echo "<div class='alert alert-danger'><b>Não salvou! </b> Tipo já existe.</div>";
                                  }else{
                                      $tipoCertificado->save();
                                      echo "<div class='alert alert-success'><b>Tipo cadastrado!</b> Operação realizada com sucesso.</div>";
                                      echo "<meta HTTP-EQUIV='refresh' CONTENT='10;URL=administrador.php?view=addCertificado&sub=part&item=add'>";
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
                                $tipoD = new TipoCertificadoModel($_POST['tipoDel'],null,null);
                                if (empty($_POST['tipoDel'])) {
                                  echo "<div class='alert alert-danger'><b>Não excluiodo </b> Selecione um item </div>";
                                }else{
                                  echo "<div class='alert alert-success'><b>Tipo excluido!</b> Operação realizada com sucesso.</div>";
                                  $tipoD->delete($_POST['tipoDel']);
                                  echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=administrador.php?view=addCertificado&sub=part&item=add'>";
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
