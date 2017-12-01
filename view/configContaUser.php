<?php  
require_once '../model/UsuarioModel.php';
require_once '../model/TipoUsuarioModel.php';



?>


                  <div class="form-panel">
                      <h4 class="mb"> Participantes</h4>
                      <form class="form-horizontal style-form"  method="POST">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nome" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="text" name="email" class="form-control">
                              </div>
                          </div>
             
                          <!-- dados pessoais -->
                          <h4 class="mb"> Dados pessoais</h4>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Fone</label>
                              <div class="col-sm-10">
                                  <input type="tel" name="fone" pattern="^\d{9}$" placeholder="ex. 86981414089" class="form-control">
                              </div>
                          </div><!-- end dados -->
                    <?php  
                      if(isset($_POST['nome']) && isset($_POST['email'])){
                        if(empty($_POST['nome']) && empty($_POST['email'])){
                          echo "<div class='alert alert-danger'><b>Não salvou </b> Preencha os campos</div>";
                        }else{
                        $user->setNome($_POST['nome']);
                          $user->setEmail($_POST['email']);
                          $user->setTipo($_POST['tipo']);
                          if(!empty($_POST['fone'])){
                            $user->setFone($_POST['fone']);
                          }

                        $lista = $user->list($_POST['nome']);
                        $flag = true;
                        foreach ($lista as $value) {
                          if($value->getNome() == $user->getNome() && $value->getEmail() == $user->getEmail()){
                            $flag = false;
                            break;
                          }
                        }
                        if(!$flag){
                            echo "<div class='alert alert-danger'><b>Não salvou </b> Usuario já existe.</div>";
                          }else{
                            $user->save();
                            echo "<div class='alert alert-success'><b>Particepante cadastrado!</b> Operação realizada com sucesso.</div>";
                          } 
                        }
                      }

                    ?>
                         <div align="right">
                           <button type="submit" class="btn btn-info" >Salvar</button>
                         </div>
                       </form>
                  </div>

