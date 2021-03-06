
<?php  
  /*
  @About
  Autor: Tiago Bandeira
  SisEvento 
  Versão: 1.0
*/

  $id = $_SESSION['id'];
  $type = $_SESSION['type'];
  require_once '../model/UsuarioModel.php';
  require_once 'itemFunction.php';
  $o_user = new UsuarioModel();
  $user = $o_user->readById($id);
  $username = $user->getNome();
  $usertype = $user->getTipo();
  $_SESSION[$username] = $username;
  if(isset($id) && isset($_SESSION[$username]) && $usertype > 1){


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

    
    <script type="text/javascript">
    /*
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Codigo Inválido',
            // (string | mandatory) the text inside the notification
            text: 'O código que você digitou não confere com o código deste certificado',
            // (string | optional) the image to display on the left
            image: 'componentes/assets/img/default-user.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
        */
        $(document).ready(function(){

        $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: '<p style="font-family: helvetica;">Codigo Inválido</p>',
            // (string | mandatory) the text inside the notification
            text: ' ',

            // (string | optional) the image to display on the left
            image: 'componentes/assets/img/default-user.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '1500'
        });

        return false;

    });
  </script>


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
