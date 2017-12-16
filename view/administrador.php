
<?php  
  /*
  @About
  Autor: Tiago Bandeira
  SisEvento 
  Versão: 1.0
*/
  session_start();
  $id = $_SESSION['id'];
  $type = $_SESSION['type'];
  require_once '../model/UsuarioModel.php';
  require_once 'itemFunction.php';
  $o_user = new UsuarioModel();
  $user = $o_user->readById(1);
  $username = $user->getNome();
  $usertype = $user->getTipo();
  $_SESSION[$username] = $username;
  if($_SESSION['id'] == 1 && isset($_SESSION[$username]) && 
  $usertype == 1){

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>SisEvento</title>

    <!-- Bootstrap core CSS -->
    <link href="componentes/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="componentes/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
     
        
    <!-- Custom styles for this template -->
    <link href="componentes/assets/css/style.css" rel="stylesheet">
    <link href="componentes/assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="componentes/assets/css/to-do.css">
    <link href="componentes/assets/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="administrador.php" class="logo"><b>SisEvento</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                
                <!--  notification end -->
            </div>
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout visible-lg" href="../view">Logout</a></li>
                    <li><a class="logout visible-md visible-xs visible-sm" href="../view"><span class="fa fa-sign-out"></span></a></li>
              </ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="administrador.php"><img src="componentes/assets/img/default-user.png" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $username ?></h5>
                    
                  <li class="mt">
                      <a href="administrador.php" class="<?php echo $_GET['sub'] == ''?'active':'' ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Painel de Controle</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" class="<?php echo $_GET['sub'] == 'part'?'active':'' ?>"> 
                          <i class="fa fa-plus"></i>
                          <span>Adicionar</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="?view=addEvento&sub=part&item=addE">Evento</a></li>
                          <li><a  href="?view=addCertificado&sub=part&item=add">Certificado</a></li>
                           <li><a  href="?view=addUser&sub=part&item=add">Usuarios</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:; " class="<?php echo $_GET['sub'] == 'listpart'?'active':'' ?>" >
                          <i class="fa fa-user"></i>
                          <span>Usuários</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="?view=listaUsuario&sub=listpart&item=list">Usuario</a></li>
                          <li><a  href="?view=listaParticipante&sub=listpart&item=list">Convidados</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a  href="javascript:;" class="<?php echo $_GET['sub'] == 'listeve'?'active':'' ?>">
                          <i class="fa fa-calendar"></i>
                          <span>Eventos</span>
                      </a>
                      <ul class="sub">
                          <li ><a  href="?view=listaEventos&sub=listeve&item=list">Todos</a></li>
                          <li><a  href="?view=eventosDesativados&sub=listeve&item=listC">Desativados</a></li>
                          <li><a  href="?view=calendar&sub=listeve&item=listC">Calendário</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="<?php echo $_GET['sub'] == 'listcert'?'active':'' ?>">
                          <i class="fa fa-certificate"></i>
                          <span>Certificados</span>
                      </a>
                      <ul class="sub">
                          <li><a href="?view=listaCertificados&sub=listcert&item=listC">Todos</a></li>
                            <li><a href="?view=altenticarCertificados&sub=listcert&item=listC">Altenticar</a></li>
                      </ul>
                     
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="<?php echo $_GET['sub'] == 'configConta'?'active':'' ?>">
                          <i class="fa fa-cogs"></i>
                          <span>Configuração</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="?view=conta&sub=configConta">Conta</a></li>
                      </ul>
                       <ul class="sub">
                          <li><a  href="?view=seguranca&sub=configConta">Segurança</a></li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
           <!-- <h3><i class="fa fa-angle-right"></i><?php echo getItem() ?></h3> -->
            <div class="row">
              <div class="col-lg-12 ">

                <?php
                    

                    if(isset($_GET['view'])){
                        $file = $_GET["view"] . ".php";
                        if(file_exists($file) == false){
                            echo "Pagina não existe";
                        }else{
                            include_once $file; 
                        }
                    }else{
                        $file = "inicio.php";
                        @include_once $file;
                    }
                ?>


              </div>
            </div>
          </section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <?php print date('Y')?> - SisEvento
              <a href="" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
 

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="componentes/assets/js/jquery.js"></script>
    <script src="componentes/assets/js/bootstrap.min.js"></script>
    <script src="componentes/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="componentes/assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="componentes/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="componentes/assets/js/jquery.scrollTo.min.js"></script>
    <script src="componentes/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="componentes/assets/js/fullcalendar/fullcalendar.min.js"></script>   
    <?php require_once 'calendarConfig.php';  ?>


    <!--common script for all pages-->
    <script src="componentes/assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>    
    <script src="componentes/assets/js/tasks.js" type="text/javascript"></script>

    <script>
      jQuery(document).ready(function() {
          TaskList.initTaskWidget();
      });

      $(function() {
          $( "#sortable" ).sortable();
          $( "#sortable" ).disableSelection();
      });

    </script>
    
    
     
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
  

  </body>
</html>
<?php  

#FINALIZA 
}else{
   header("Location: ../view");
}
    
?>