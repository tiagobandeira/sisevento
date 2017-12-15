<?php
	require_once '../control/controllerIndex.php';
	$ci = new ControllerIndex();
	$ci->redirect();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Login SisEvento</title>

    <!-- Bootstrap core CSS -->
    <link href="componentes/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="componentes/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="componentes/assets/css/style2.css" rel="stylesheet">
    <link href="componentes/assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
    
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <form id="login-form" action="#" method="post" role="form" style="display: block;">
                      <h2>LOGIN</h2>
                        <div class="form-group">
                          <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                        </div>
                        <div class="form-group">
                          <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                        </div>
                        <div class="col-xs-6 form-group pull-left checkbox">
                          <input id="checkbox1" type="checkbox" name="remember">
                          <label for="checkbox1">Remember Me</label>   
                        </div>
                        <div class="col-xs-6 form-group pull-right">     
                      
                              <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                        </div>
                    </form>
                    <form id="register-form" action="#" method="post" role="form" style="display: none;">
                      <h2>VALIDAR CERTIFICADO</h2>
                        <div class="form-group">
                          <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Código" value="">
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                              <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Confirmar">
                            </div>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6 tabs">
                    
                    <a href="#" class="active" id="login-form-link"><div id="L" class="login">LOGIN</div></a>
                  </div>
                  <div class="col-xs-6 tabs">
                    <a href="#" id="register-form-link"><div id="R" class="register">REGISTER</div></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="componentes/assets/js/jquery.js"></script>
    <script src="componentes/assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="componentes/assets/js/jquery.backstretch.min.js"></script>
    <!--
    <script>
        $.backstretch("componentes/assets/img/bbg-sisevento6.jpg", {speed: 500});
    </script>
    -->

    <script>
      $(function() {

          $('#login-form-link').click(function(e) {
          $("#login-form").delay(100).fadeIn(100);
          $("#register-form").fadeOut(100);
          $('#R').removeClass('ativar');
          $('#L').addClass('ativar');
          e.preventDefault();
        });
        $('#register-form-link').click(function(e) {
          $("#register-form").delay(100).fadeIn(100);
          $("#login-form").fadeOut(100);
          $('#L').removeClass('ativar');
          $('#R').addClass('ativar');
          e.preventDefault();
        });

      });
      
  </script>
  </body>
</html>
