<?php  
	session_start();
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
    <link href="componentes/assets/css/style.css" rel="stylesheet">
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
	  	
		      <form class="form-login" action="processaCadastro.php" method="POST">
		        <h2 class="form-login-heading">Cadastrar</h2>
		        <div class="login-wrap">
		        	<label class="checkbox">
		        		Nome de usuário
		        	</label>
		            <input type="text" name="user" class="form-control" placeholder="Nome de Usuário" required="user" autofocus>
		            <br>
		            <label class="checkbox">
		        		Email
		        	</label>
		            <input type="e-mail" name="email" class="form-control" placeholder="Email" required="email" autofocus>
		            <label class="checkbox">
		        		Senha
		        	</label>
		            <input type="password" name="password" class="form-control" placeholder="senha" required="password"><br>
		            <button class="btn btn-theme btn-block"  type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		           
		
		        </div>
		
		          <!-- Modal -->
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="componentes/assets/js/jquery.js"></script>
    <script src="componentes/assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="componentes/assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("componentes/assets/img/", {speed: 500});
    </script>


  </body>
</html>
