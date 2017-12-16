
<?php  
require_once '../model/UsuarioModel.php';
require_once '../control/EventoController.php';
$lista = $Evento->listaEvento();
$i = 0;
$j = 0;
$linha = 0;
if (!isset($_SESSION['contEvento'])) {
  $_SESSION['contEvento'] = 4; 
}
$cores = ['#f5f6f8', '#FFFFFF'];

?>
<div class="row">
    <?php  
                        if (isset($_POST['evento'])) {
                            $evento = $eve->readById($_POST['evento']);
                            $evento->setStatus("A");
                            $evento->save();
                            echo "<div class='alert alert-success'><b>Evento desativado!</b> Operação realizada com sucesso.</div>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=administrador.php?view=eventosDesativados&sub=listeve&item=list'>";
                          
                            
                        }

                       

                    ?>
                      <section class="task-panel tasks-widget">
                    <div class="panel-heading">
                          <div class="pull-left"><h5><i class="fa fa-tasks"></i> Lista de eventos</h5></div>
                           <br>
                          
                    </div>
                           
                          <div class="panel-body">
                              <div class="task-content">
                              <form method="POST">
                                  <ul id="sortable" class="task-list">
                                    <?php foreach ($lista as $value) { 
                                          if ($value->getStatus() == "D") { 
                                          $linha++;
                                          if ($j <= $_SESSION['contEvento']) {
                                              $j++;
                                         
                                    ?>
                                      <li class="list-danger" style="background-color: <?php echo $cores[($i++)%2];?>;">
                                             <!-- Split button -->
                             
                                          
                                          <div class="task-title">

                                              <span class="task-title-sp" id="<?php echo $value->getId()?>">
                                                <?php echo $value->getNome() ?>                                                
                                              </span>
                                              <!--<span class="badge bg-theme">Done</span>-->
                                              <div class="pull-right ">
                                                  <!--
                                                  <button class="btn btn-success btn-xs fa fa-check" ></button>
                                                  <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                                                  <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                                                  -->
                                                
                                                
                                                  <button data-toggle="modal" 
                                                          type="submit"
                                                          data-target="#del" 
                                                          class="btn btn-danger btn-xs fa fa-refresh"
                                                          name="evento"
                                                          value="<?php echo $value->getId();?>">
                                                  </button>
                                                  

                                              </div>
                                          </div>
                                      </li>
                         
                        <!-- Modal -->

                        
                       
                      
                        <!-- modal -->
                       
                                     <?php }} }?>

                                  </ul>
                            </form>
                            </div>
                              <form method="POST">
                              
                              <div class=" add-task-row">
                                  <a class="btn btn-success btn-sm pull-left" href="?view=addEvento&sub=part&item=addE">Novo Evento</a>
                                  <button class="btn btn-default btn-sm pull-right" type="submit" 
                                      name="mais" value="<?php ?>">
                                    <?php  
                                      
                                        if ($_SESSION['contEvento'] <= $linha) {
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

                                if($_SESSION['contEvento'] <= $linha){
                                    $_SESSION['contEvento'] += 4;
                                }else{
                                  $flag = true;
                                  echo "<p class='alert alert-success'  align='center'>Sem mais registros</p>";
                                  unset($_SESSION['contEvento']);
                                }
                                
                                #unset($_SESSION['cont']);

                            }

                      ?>
                      </section>


</div>
          
                  

              


			
		
      


