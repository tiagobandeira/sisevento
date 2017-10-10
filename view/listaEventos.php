
<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/EventoModel.php';
$eve = new EventoModel();
$lista = $eve->list("");
$i = 0;
$cores = ['#f5f6f8', '#FFFFFF'];

?>
          
                    <?php  
                        if (isset($_POST['evento'])) {
                            $evento = $eve->readById($_POST['evento']);
                            $evento->delete();
                            echo "<div class='alert alert-success'><b>Evento deletado!</b> Operação realizada com sucesso.</div>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=administrador.php?view=listaEventos&sub=listeve&item=list'>";
                          
                            
                        }
                       

                    ?>
                      <section class="task-panel tasks-widget">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Lista de eventos</h5></div>
                            <a class="btn btn-success btn-sm pull-right" href="?view=addEvento&sub=part&item=addE">Novo Evento</a>
                            <br>
                          
	                 	</div>
                           <form method="POST">
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list">
                                  	<?php foreach ($lista as $value) {  ?>
                                      <li class="list-primary" style="background-color: <?php echo $cores[($i++)%2];?>;">
                                             <!-- Split button -->
                             
                                          
                                          <div class="task-title">

                                              <span class="task-title-sp"><?php echo $value->getNome() ?></span>
                                              <!--<span class="badge bg-theme">Done</span>-->
                                              <div class="pull-right hidden-phone">
                                                  <!--
                                                  <button class="btn btn-success btn-xs fa fa-check" ></button>
                                                  <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                                                  <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                                                  -->
                                                
                                                  <a href="?view=editEvento&sub=listeve&item=list&evento=<?php echo $value->getId();?>">
                                                      <span class="btn btn-primary btn-xs fa fa-pencil"></span>
                                                  </a>
                                                  <button data-toggle="modal" 
                                                          type="submit"
                                                          data-target="#del" 
                                                          class="btn btn-danger btn-xs fa fa-trash-o"
                                                          name="evento"
                                                          value="<?php echo $value->getId();?>">
                                                  </button>
                                                  

                                              </div>
                                          </div>
                                      </li>
                         
                        <!-- Modal -->

                        
                       
                      
                        <!-- modal -->
                       
                                     <?php } ?>

                                  </ul>
                            </form>
                        
                        
                              </div>
                              <div class=" add-task-row">
                                  <a class="btn btn-success btn-sm pull-left" href="?view=addEvento&sub=part&item=addE">Novo Evento</a>
                                  <a class="btn btn-default btn-sm pull-right" href="#">Ver mais</a>

                              </div>
                          </div>
                      </section>


              


			
		
      


