<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/EventoModel.php';
require_once '../model/CertificadoModel.php';
$cert = new CertificadoModel();

$lista = $cert->list("");
$i = 0;
$j = 0;
$linha = 0;

if (!isset($_SESSION['contCertificado'])) {
  $_SESSION['contCertificado'] = 4; 
}
$cores = ['#f5f6f8', '#FFFFFF'];
#unset($_SESSION['contCertificado']);

?>

  <!--main content start-->
<div class="row">
       <?php  
                        if (isset($_POST['certificado'])) {
                            $certificado = $cert->readById($_POST['certificado']);
                            $certificado->delete();
                            echo "<div class='alert alert-success'><b>Certificado deletado!</b> Operação realizada com sucesso.</div>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=administrador.php?view=listaCertificados&sub=listcert&item=listC'>";
                          
                            
                        }
                       

                    ?>
             
                      <section class="task-panel tasks-widget">
                    <div class="panel-heading">
                          <div class="pull-left"><h5><i class="fa fa-tasks"></i> Lista de Certificados</h5></div>
                          <br>
                    </div>
                          
                          <div class="panel-body">
                              <div class="task-content">
                              <form method="POST">
                                  <ul id="sortable" class="task-list">
                                    <?php foreach ($lista as $value) {  
                                          $linha++;
                                          if ($j <= $_SESSION['contCertificado']) {
                                              $j++;

                                    ?>
                                      <li class="list-primary" style="background-color: <?php echo $cores[($i++)%2];?>;">
                                          
                                          <div class="task-title">
                                              <span class="task-title-sp"><?php echo $value->getNome() ?></span>
                                              <!--<span class="badge bg-theme">Done</span>-->
                                              <div class="pull-right ">
                                                  <!--
                                                  <button class="btn btn-success btn-xs fa fa-check"></button>
                                                  <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                                                  <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                                                  -->
                                                  
                                                  <a href="?view=editCertificado&sub=listcert&item=list&certificado=<?php echo $value->getId();?>">
                                                      <span class="btn btn-primary btn-xs fa fa-pencil"></span>
                                                  </a>
                                                   <button 
                                                          type="submit"
                                                          class="btn btn-danger btn-xs fa fa-trash-o"
                                                          name="certificado"
                                                          value="<?php echo $value->getId();?>">
                                                  </button>
                                              </div>
                                          </div>
                                      </li>

                                     <?php } }?>

                                  </ul>
                              </form>
                              </div>
                               <form method="POST">
                              
                              <div class=" add-task-row">
                                  <a class="btn btn-success btn-sm pull-left" href="?view=addCertificado&sub=part&item=addE">Novo Certificado</a>
                                  <button class="btn btn-default btn-sm pull-right" type="submit" 
                                      name="mais" value="<?php ?>">
                                    <?php  
                                      
                                        if ($_SESSION['contCertificado'] <= $linha) {
                                          echo "Ver mais";
                                        }else{
                                          echo "Recolher";
                                        }
                                    ?>
                                    
                                  </button>

                              </div>
                              </form>
                              
                          </div>
                            <?php  

                            if (isset($_POST['mais'])) {

                                if($_SESSION['contCertificado'] <= $linha){
                                    $_SESSION['contCertificado'] += 4;
                                }else{
                                  $flag = true;
                                  echo "<p class='alert alert-success'  align='center'>Sem mais registros</p>";
                                  unset($_SESSION['contCertificado']);
                                }
                                
                                #unset($_SESSION['cont']);

                            }

                      ?>
                       
                      </section>
              


      
    
      



</div>

              
               