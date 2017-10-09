
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
  $user = $o_user->readById($id);
  $username = $user->getNome();
  $usertype = $user->getTipo();
  $_SESSION[$username] = $username;
  if(isset($id) && isset($_SESSION[$username]) && $usertype == 3){


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>SisEvento</title>

    <!-- Bootstrap core CSS -->
    <link href="componentes/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="componentes/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="componentes/assets/js/gritter/css/jquery.gritter.css" />
        
    <!-- Custom styles for this template -->
    <link href="componentes/assets/css/style.css" rel="stylesheet">
    <link href="componentes/assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="componentes/assets/css/to-do.css">

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
            <a href="participante.php" class="logo"><b>SisEvento</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                
                <!--  notification end -->
            </div>
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../view">Logout</a></li>
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
              
                  <p class="centered"><a href="participante.php"><img src="componentes/assets/img/default-user.png" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $username; ?> </h5>
                  
                  <li class="mt">
                      <a href="participante.php" class="<?php echo $_GET['sub'] == ''?'active':'' ?>">
                          <i class="fa fa-home"></i>
                          <span>Inicio</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a  href="javascript:;" class="<?php echo $_GET['sub'] == 'even'?'active':'' ?>">
                          <i class="fa fa-calendar"></i>
                          <span>Eventos</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="?view=listaEventos&sub=even&item=addE">Meus</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="<?php echo $_GET['sub'] == 'cert'?'active':'' ?>" >
                          <i class="fa fa-certificate"></i>
                          <span>Certificados</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="?view=certificadoParticipante&sub=cert&item=addE">Todos</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="<?php echo $_GET['sub'] == 'cog'?'active':'' ?>">
                          <i class="fa fa-cogs"></i>
                          <span>Configuração</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="?view=certificado&sub=cog&item=addE">Conta</a></li>
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
          
            <!--<h3><i class="fa fa-angle-right"></i>Main</h3> -->
           
            <div class="row mt">
              <div class="col-lg-12">
              
                <?php
                    

                    if(isset($_GET['view'])){
                        $file = $_GET["view"] . ".php";
                        include_once $file; 
                    }else {
                        $file = "inicioPart.php";
                        include_once $file; 
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
              <a href="blank.html#" class="go-top">
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

    <script type="text/javascript" src="componentes/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="componentes/assets/js/gritter-conf.js"></script>


    <!--common script for all pages-->
    <script src="componentes/assets/js/common-scripts.js"></script>

   
    <!--script for this page-->


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

}else{
    header('location: ../view');
}
?>
