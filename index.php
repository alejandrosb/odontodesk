<?php

require 'pool/Conexion.php';
require 'pool/Seleccionar.php';
$mensaje=null;

if(isset($_POST['login'])){
	$model=new Seleccionar;
	$model->user=htmlspecialchars($_POST['nick']);
	$model->password=sha1(htmlspecialchars($_POST['password']));
	$model->login();
	$mensaje=$model->mensaje; 
	
	} 

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OdontoDesk</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/signin.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <form class="form-signin" name="flog" id="flog" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" role="form">
        <h2 class="form-signin-heading" align="center">OdontoDesk</h2>
        <input type="text" name="nick" id="nick" class="form-control" placeholder="Usuario" required autofocus>
        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
		<input type="hidden" name="login" id="login">
        <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
		<strong><?php echo $mensaje;?></strong>  
      </form>
    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

