 
 

      
     <div class="row mt">
              
        <aside class="col-lg-8 mt">
             <section class="panel">
                <div class="panel-body">
                <div id="calendar" class="has-toolbar"></div>
                </div>
             </section>
        </aside>

        <div class="col-lg-4">
                  <div class="form-panel" >
                      <!-- forme add participante -->
                      <form class="form-horizontal style-form" method="POST">
                           <h4 class="mb"><i class="fa fa-calendar"> </i> Pesquisar Evento</h4>
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
                           <button type="submit" class="btn btn-info" >Perquisar</button>
                         </div>
                        
                       </form><!-- end forme add participante -->
                       <hr style="border:0.1px solid #ccc;">
                      
                  </div>
</div>
    </div>


		
