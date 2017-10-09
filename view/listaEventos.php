<style type="text/css">
  
  .modalStyle{
      background: #5F7EC8;
  }
  .modalBtn{
      background: #5F7EC8;
  }
</style>
<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/EventoModel.php';
$eve = new EventoModel();
$lista = $eve->list("");

?>
          
                
                      <section class="task-panel tasks-widget">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Lista de eventos</h5></div>
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
                                                  <button class="btn btn-success btn-xs fa fa-check" ></button>
                                                  <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                                                  <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                                                  -->
                                                  <a href=""><span class="btn btn-success btn-xs fa fa-check"></span></a>
                                                  <a href="?view=editEvento&sub=listeve&item=list&evento=<?php echo $value->getId();?>">
                                                      <span class="btn btn-primary btn-xs fa fa-pencil"></span>
                                                  </a>
                                                  <a data-toggle="modal" href="#delete">
                                                      <span class="btn btn-danger btn-xs fa fa-trash-o"></span>
                                                  </a>

                                              </div>
                                          </div>
                                      </li>
                                     <?php } ?>

                                  </ul>
                                   <!-- Modal -->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delete" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header modalStyle">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Confirmação</h4>
                          </div>
                          <div class="modal-body">
                              <p>Deseja realmente excluir</p>
                              
    
                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                              <button class="btn btn-theme modalBtn" type="button">Submit</button>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- modal -->
                              </div>
                              <div class=" add-task-row">
                                  <a class="btn btn-success btn-sm pull-left" href="#">Novo Evento</a>
                                  <a class="btn btn-default btn-sm pull-right" href="#">Ver mais</a>
                              </div>
                          </div>
                      </section>
                      <?php  
                       

                      ?>

              


			
		
      


