<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/EventoModel.php';
require_once '../model/CertificadoModel.php';
$cert = new CertificadoModel();

$lista = $cert->list("");

?>

  <!--main content start-->
     

          	<!-- SORTABLE TO DO LIST  -->
			
             
                      <section class="task-panel tasks-widget">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Lista de Certificados</h5></div>
	                        <br>
	                 	</div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list">
                                  	<?php foreach ($lista as $value) {  ?>
                                      <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                          <div class="task-checkbox">
                                              <input type="checkbox" class="list-child" value=""  />
                                          </div>
                                          <div class="task-title">
                                              <span class="task-title-sp"><?php echo $value->getNome() ?></span>
                                              <!--<span class="badge bg-theme">Done</span>-->
                                              <div class="pull-right hidden-phone">
                                                  <!--
                                                  <button class="btn btn-success btn-xs fa fa-check"></button>
                                                  <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                                                  <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                                                  -->
                                                  <a href=""><span class="btn btn-success btn-xs fa fa-check"></span></a>
                                                  <a href="?view=editCertificado&sub=listcert&item=list&certificado=<?php echo $value->getId();?>">
                                                      <span class="btn btn-primary btn-xs fa fa-pencil"></span>
                                                  </a>
                                                  <a href=""><span class="btn btn-danger btn-xs fa fa-trash-o"></span></a>
                                              </div>
                                          </div>
                                      </li>
                                     <?php } ?>

                                  </ul>
                              </div>
                              <div class=" add-task-row">
                                  <a class="btn btn-success btn-sm pull-left" href="todo_list.html#">Novo Certificado</a>
                                  <a class="btn btn-default btn-sm pull-right" href="todo_list.html#">Ver Mais</a>
                              </div>
                          </div>
                      </section>
              


			
		
      


