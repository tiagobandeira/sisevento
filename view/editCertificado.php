<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';
require_once '../model/TipoEventoModel.php';
require_once '../model/EventoModel.php';
require_once '../model/CertificadoModel.php';
require_once '../model/TipoCertificadoModel.php';

$eve = new EventoModel();
$eves = $eve->list("");
#tipo
$tipo = new TipoCertificadoModel();
$tipos = $tipo->list();
#certificado
$cert = new CertificadoModel();
#usuario 
$userModel = new UsuarioModel();
#tipo de usuario
$tipoUserModel = new TipoUsuarioModel();
$tiposUsuarios = $tipoUserModel->list();

if (isset($_GET['certificado'])) {
    $idCertificado = $_GET['certificado'];
    $certificadoEdit = $cert->readById($_GET['certificado']);
    $idCertificado = $certificadoEdit->getId();
    $nomeCertificado = $certificadoEdit->getNome();

    $nomeEvento = $eve->readById($certificadoEdit->getEvento())->getNome();

    $tipoCertificado = $tipo->readById($certificadoEdit->getTipo())->getTipo();
    $idTipoCertificado = $tipo->readById($certificadoEdit->getTipo())->getId();
    $textoCertificado = $tipo->readById($certificadoEdit->getTipo())->getTexto();
    $tipoNome = $tipo->readById($certificadoEdit->getTipo())->getTipo();
    $corTextoCertificado = $tipo->readById($certificadoEdit->getTipo())->getCorTexto();

    $tipoParticipante = $tipoUserModel->readById($certificadoEdit->getTipoUsuario())->getTipo();
    $idTipoParticipante = $tipoUserModel->readById($certificadoEdit->getTipoUsuario())->getId();

    $imagem = $certificadoEdit->getImagem();

}

?>

<div class="col-lg-8">
                  <div class="form-panel">
                      <h4 class="mb"> Certificado</h4>
                      <form class="form-horizontal style-form"  method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                              <div class="col-sm-10">
                                  <input type="text" value="<?php echo $nomeCertificado;?>" name="nome" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Evento</label>

                              <div class="col-sm-10">

                                 <select class="form-control" name="tipoE">
                                        <option value="<?php echo $certificadoEdit->getEvento() ?>">
                                          <?php echo $nomeEvento ?>
                                        </option>
                                        <?php foreach ($eves as $value) { 
                                                if ($value->getId() != $certificadoEdit->getEvento() ) {
                                        ?>
                                        <option value="<?php echo $value->getId() ?>"><?php echo $value->getNome() ?></option>
                                        <?php     
                                                  } 
                                              } 
                                        ?>
                                  </select>
                              </div>
                          </div>
                         
                            <!-- funções -->
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="tipoC">
                                     <option value="<?php echo $certificadoEdit->getTipo()?>">
                                       <?php echo $tipoCertificado; ?>
                                     </option>
                                    <?php foreach ($tipos as $value) { 
                                        if ($value->getId() != $certificadoEdit->getTipo()) {
                                     
                                    ?>
                                      <option value="<?php echo $value->getId();?>"><?php echo $value->getTipo() ?></option>
                                    <?php } } ?>
                                  </select>
                              </div>

                          </div><!--  -->
                           <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">Tipo de Participante</label>
                              <div class="col-sm-9">
                                  <select class="form-control" name="tipoUsuario">
                                   <option value="<?php echo $idTipoParticipante;?>"><?php echo $tipoParticipante;  ?></option>
                                    <?php foreach ($tiposUsuarios as $value) { 
                                            if ($value->getId() != $idTipoParticipante) {
                                              
                                            
                                    ?>
                                     <option value="<?php echo $value->getId();?>"><?php echo $value->getTipo() ?></option>
                                    <?php } }?>
                                  </select>
                              </div>

                          </div><!--  -->
                          <!-- dados pessoais -->
                          <h4 class="mb"> Substituir imagem <?php echo $imagem; ?></h4>
                          
                          <div class="form-group">
                               <div class="col-sm-4">
                                  <!-- MAX_FILE_SIZE deve preceder o campo input no máximo 1MB -->
                                  <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                                  <!-- O Nome do elemento input determina o nome da array $_FILES -->
                                  <input type="file"  name="imagem" >
                              </div>
                              
                          </div><!-- end dados -->

                           <div class="form-group">
                              
                               <label class="col-sm-8 col-sm-8 control-label">
                                  Obs: O arquivo não de ultrapassar  1MB.
                                  Tipos suportados: <b>jpg</b>.
                               </label>
                          </div><!-- end dados -->

                    <?php  
                      if(isset($_POST['nome']) && isset($_POST['tipoC']) && isset($_POST['tipoE'])){
                          if(empty($_POST['nome'])){
                              echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                          }else{
                              $cert->setId($certificadoEdit->getId());
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
                                  
                                  moveImage($_FILES['imagem']);#salva a imagem em midia/
                                  $cert->setImagem($_FILES['imagem']['name']);
                                  

                              }else{
                                $cert->setImagem($imagem);
                                


                              }

                              $cert->setUsuario($_SESSION['id']);
                              $lista = $cert->list($_POST['nome']);
                              $flag = true;
                              foreach ($lista as $value) {
                                if($value->getNome() == $cert->getNome() && $value->getId() != $idCertificado){
                                  $flag = false;
                                  break;
                                }
                              }
                              if(!$flag){
                                  echo "<div class='alert alert-danger'><b>Não salvou </b> Certificado já existe.</div>";
                              }else{
                                  $cert->save();
                                  echo "<div class='alert alert-success' ><b>Certificado atualizado!</b> Operação realizada com sucesso.</div>";
                                   echo "<meta HTTP-EQUIV='refresh' CONTENT='3;URL=administrador.php?view=editCertificado&sub=listcert&item=list&certificado=$idCertificado'>";
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
<div class="col-lg-4">
                  <div class="form-panel" >
                      <!-- forme add tipo evento -->
                      <form class="form-horizontal style-form" method="POST">
                           <h4 class="mb"><i class="fa fa-certificate"> </i> Editar tipo de Certificado</h4>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                              <div class="col-sm-10">
                                  <input type="text" value="<?php echo $tipoNome;?>" name="tipoCertificado" class="form-control">
                              </div>
                          </div>
                         
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Texo</label>
                              <div class="col-sm-10">
                                  <textarea class="form-control" name="texto"><?php echo $textoCertificado ; ?></textarea>
                              </div>
                              
                          </div>
                          <div class="form-group">
                              <label class="col-sm-8 col-sm-8 control-label">Cor do texto</label>
                              <div class="col-sm-4">
                                   <input type="color" value="<?php echo $corTextoCertificado;?>" name="corTexto" class="form-control">
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
                              $tipoCertificado->setId($idTipoCertificado);
                              $tipoCertificado->setTipo($_POST['tipoCertificado']);
                              $tipoCertificado->setTexto($_POST['texto']);
                              $tipoCertificado->setCorTexto($_POST['corTexto']);
                              $tipos = $tipoCertificado->list($_POST['tipoCertificado']);
                              $flag = true;
                              if (empty($_POST['tipoCertificado'])) {
                                  echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                              }else{
                                  foreach ($tipos as $value) {
                                    if ($value->getTipo() == $tipoCertificado && $value->getId() != $idTipoCertificado) {
                                      $flag = false;
                                      break;
                                    }
                                  }
                                  if(!$flag){
                                      echo "<div class='alert alert-danger'><b>Não salvou! </b> Tipo já existe.</div>";
                                  }else{
                                      $tipoCertificado->save();
                                      echo "<div class='alert alert-success'><b>Tipo cadastrado!</b> Operação realizada com sucesso.</div>";
                                       echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=administrador.php?view=editCertificado&sub=listcert&item=list&certificado=$idCertificado'>";
                                  }   
                              }
                              
                            }
                      
            

                          ?>
                         <div align="right">
                           <button type="submit" class="btn btn-info" >Salvar</button>
                         </div>
                        
                       </form><!-- end forme add tipo evento -->
                      
                       
                  </div>
</div>
