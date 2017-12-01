<!DOCTYPE html>
<html>
<head>
	<title>Instalação</title>
	<style type="text/css">
		body{
			font-family: arial, helvetica;
			background: #eee;
		}
		.box{
			width: 250px;
			height: 300px;
			margin-left: auto;
			margin-right: auto;
			margin-top: 10%;
			background: #fff;
			padding: 1%;
			text-align: center;
			box-shadow: 1px 2px 1px #ccc;


		}
		.head, .body{
			width: 100%;
		}
		.head{

		}
		.body{
			color: #555;
		}
	</style>
</head>
<body>
	<div class="box">
		<div class="head">
			<h2>Instalção</h2>
		</div>
		<div class="body">
			<p>Para instalar o sisevento basta editar o arquivo install.php, que está localidado no diretório database. Após isso entre no diretórivio view para configurar a conta de administrador. Depois disso, você pode apagar este arquivo e iniciar o sistema diretamente do diretório view</p>
			<form action="view/index.php">
				<button type="submit">Iniciar</button>
			</form>
		</div>
	</div>
</body>
</html>