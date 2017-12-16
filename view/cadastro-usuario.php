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
	  		<div class="row">
	  			<div class="col-md-6 col-md-offset-3">
	  				<h1 align="center"><span class="fa fa-calendar" style=""></span> SisEvento</h1>
	  			<form class="" method="POST" style="background-color: #fff; padding: 3px; ">
		        
		        

		        <div class="login-wrap">
		        	<?php  

						if(isset($_POST['user']) && isset($_POST['password']) && isset($_POST['email'])){
							require_once '../model/UsuarioModel.php';
							require_once '../model/TipoUsuarioModel.php';
							$nomeCompleto = $_POST['pNome'] . " " . $_POST['sNome'];

							$user = new UsuarioModel();
							$user->setNome($_POST['user']);
							$user->setSenha($_POST['password']);
							$user->setEmail($_POST['email']);
							$user->setNomeCompleto($nomeCompleto);
							$user->setTipo(2);
							$flag = true;
							$listaNome = $user->listByNameUser($user->getNome());
							foreach ($listaNome as $value) {
								if ($value->getNome() == $user->getNome() && $value->getSenha() == $user->getSenha()) {
									$flag = false;
								}
							}
							if($flag){
								$user->save();
								$idUser = 0;
								$listaNome = $user->listByNameUser($user->getNome());
								foreach ($listaNome as $value) {
									if ($value->getNome() == $user->getNome() && $value->getSenha() == $user->getSenha()) {
										$idUser = $value->getId();
									}
								}
								$_SESSION['id'] = $idUser;
								$_SESSION['type'] = $user->getTipo();
								$_SESSION['user'] = $user->getNome();
								$_SESSION['password'] = $user->getSenha();
								header('Location: usuario.php');
							}else{
								echo "<p class='alert alert-danger'  align='center'>Nome de usuario já está sendo usado</p>";
							}
							

					}
		      	?>
		        	<label class="checkbox">
		        		Nome de Usuario
		        	</label>
		            <input type="text" name="user" class="form-control"  required="user" autofocus>
		            <br>
		            <label class="checkbox">
		        		Primeiro Nome
		        	</label>
		            <input type="text" name="pNome" class="form-control"  required="user" autofocus>
		            <br>
		            <label class="checkbox">
		        		Sobrenome
		        	</label>
		            <input type="text" name="sNome" class="form-control"   autofocus>
		            <br>
		            <label class="checkbox">
		        		Senha
		        	</label>
		            <input type="password" name="password" class="form-control"  required="password"><br>
		            <label class="checkbox">
		        		Email
		        	</label>
		            <input type="email" name="email" class="form-control"  required="email"><br>
		            <button class="btn btn-theme btn-block"  type="submit"><i class="fa fa-lock"></i> Entrar</button>

		           
		
		        </div>

		
		      </form>	  	
		      <div>
		      	
		      	
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
        $.backstretch("componentes/assets/img/bg-sisevento5.png", {speed: 500});
    </script>
    -->


  </body>
</html>
