<?php
/*session_start();
echo $_SESSION["nombre"];*/
require 'pool/Conexion.php';

require 'pool/Crud.php';
$mensaje=null;
$mensajeup=null;

if(isset($_POST['update'])){
  $nroup=htmlspecialchars($_POST['upId']);
  $no=htmlspecialchars($_POST['nome']);
  $telefono=htmlspecialchars($_POST['tele']);
  $correo=htmlspecialchars($_POST['cor']);

  $model=new Crud;
  $model->update="configuracion";
  $model->set="descripcion= UPPER('$no'),telefono='".$telefono."',direccion= UPPER('$pa')";
  $model->condition="id=".$nroup;
  $model->Update();
  $mensajeup=$model->mensaje;

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
  <script type="text/javascript"  src="js/jquery.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/jquery-ui.css">

  <script type="text/javascript" src="js/jquery-ui.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <script type="text/javascript">

    $(document).on("click", ".open-EditRow", function () {
      var mypacId = $(this).data('id');
      $(".modal-body #pId").val( mypacId );
      // As pointed out in comments,
      // it is superfluous to have to manually call the modal.
      // $('#addBookDialog').modal('show');
    });
  </script>
  <script type="text/javascript">

    $(document).on("click", ".open-Up", function () {
      var Idup = $(this).data('id');
      $(".modal-body #upId").val( Idup );

      var nombre = $("#b" + Idup).html();
      $(".modal-body #nome").val( nombre );

      var rucli = $("#e" + Idup).html();
      $(".modal-body #tele").val( rucli );

      var telcli = $("#f" + Idup).html();
      $(".modal-body #cor").val( telcli );

    });
  </script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->


</head>
<body>
  <?php
  //validar tipo de nivel para mostrar el menu

  ?>
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">OdontoDesk</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="panel.php"><span class="glyphicon glyphicon-home"></span>  Inicio</a></li>
        <li><a href="pool/logout.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
      </ul>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-9  col-md-12 main">
        <strong><?php echo $mensaje;?></strong>
        <strong><?php echo $mensajeup;?></strong>
        <h2 class="sub-header">Configuración</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>

                <th>Nombre</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $bupa=new Crud;
                $bupa->select='*';
                $bupa->from='configuracion';
                $bupa->Read();
                $pafilas=$bupa->rows;
                $patotal=count($pafilas);            
                foreach($pafilas as $lispabu):

                ?>
                <tr>
                  <td ><a href="ficha.php?id_ficha=<?=$lispabu['id']?>"><span id="b<?=$lispabu['id']?>" class="glyphicon glyphicon-ok"> <?=$lispabu['descripcion']?></span></a></td>
                  <td id="e<?=$lispabu['id']?>"><?=$lispabu['telefono']?></td>
                  <td id="f<?=$lispabu['id']?>"><?=$lispabu['direccion']?></td>
                  <td id="editar"><button class="open-Up btn btn-warning btn-xs" data-toggle="modal" data-target="#myUp" data-id="<?=$lispabu['id']?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                  </button></td>
                </tr>
                <?php
                endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>





  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
        </div>
        <div class="modal-body">
          Desea eliminar el registro?
          <form name="formedit" id="formedit" acton="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <input type="hidden" name="pId" id="pId" value="" >
            <input type="hidden" name="delete" id="delete">
            <div id="resultado"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="myMens" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
        </div>
        <div class="modal-body">
          Cambios Realizados.
          <form name="formedit" id="formedit">

            <div id="resultado"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="myUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Editar</h4>
        </div>
        <div class="modal-body">
          <form name="formUp" id="formUp" role="form" acton="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="form-group">
              <label for="nombrecliente">Nombre</label>
              <input class="form-control" type="text" name="nome" id="nome" value="" required autofocus>
            </div>
            <div class="form-group">
              <label for="ruccliente">Telefono</label>
              <input class="form-control" type="text" name="tele" id="tele" value="" required>
            </div>
            <div class="form-group">
              <label for="tecliente">Direccion</label>
              <input class="form-control" type="text" name="cor" id="cor" value="" required>
            </div>
            <div id="resultado"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            <input type="hidden" name="update" id="update">
            <input type="hidden" name="upId" id="upId" value="" >
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

  <!-- Include all compiled plugins (below), or include individual files as needed -->




</body>
</html>
