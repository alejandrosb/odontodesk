<?php

require 'pool/Conexion.php';
require 'pool/Crud.php';
$model=new Crud;
$model->select="*";
$model->from="pacientes";
$model->condition='id='.$_GET['id_ficha'];
$model->Read();
$filas=$model->rows;
$total=count($filas);
$ard=array();
$i=0;
foreach ($filas as $fila){
  $nombre=$fila['nombre'];
  $ci=$fila['ci'];
  $fe=$fila['fechanac'];
  $ce=$fila['celular'];
  $te=$fila['telefono'];
  $co=$fila['correo'];
  $di=$fila['direccion'];
  $an=$fila['antecedentes'];
  $su=$fila['sosu'];
  $sd=$fila['sosd'];
  //$ard[$i]=$fila['nombre'];
  $i++;
}
//print_r ($ard);
$histo=new Crud;
$histo->select="*";
$histo->from="historial";
$histo->condition='idpa='.$_GET['id_ficha'].' ORDER BY ID ASC';
$histo->Read();
$filas=$histo->rows;
$totalapci=count($filas);
foreach ($filas as $fila){
  $tit=$fila['titulo'];
  $desc=$fila['nota'];
}

/*crea historial*/
$detalle=null;
if(isset($_POST['chistorial'])){
  $datouno=htmlspecialchars($_POST['valoruno']);
  $datodos=htmlspecialchars($_POST['valordos']);
  if($datouno == ""){
    $detalle='<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>Campo requerido</div>';
  }else if($datodos == ""){
    $detalle='<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>Campo requerido</div>';

  }else{
    $hoyh = date("Y-m-d");
    $phistorial=new Crud;
    $phistorial->insertInto='historial';
    $phistorial->insertColumns='titulo,idpa,nota,fecha';
    $phistorial->insertValues="UPPER('$datouno'),".$_GET['id_ficha'].",UPPER('$datodos'),'$hoyh'";
    $phistorial->Creahistorial();
    $detalle=$phistorial->detalle;
  }

}
/*crea tratamiento*/
if(isset($_POST['ctra'])){
  $datotres=htmlspecialchars($_POST['tu']);
  $datocuatro=htmlspecialchars($_POST['tuno']);
  $datocinco=htmlspecialchars($_POST['ntra']);
  if($datotres == ""){
    $detalle='<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>Campo requerido</div>';
  }else if($datocuatro == ""){
    $detalle='<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>Campo requerido</div>';

  }else{
    $psal=new Crud;
    $hoy = date("Y-m-d");
    $psal->insertInto='saldos';
    $psal->insertColumns='idpaciente,cargo,tipo,fecha';
    $psal->insertValues=$_GET['id_ficha'].",".$datocuatro.","."'$datocinco'".",'$hoy'";
    $psal->Creahistorial();
    $detalle=$psal->detalle;
  }

}
/*crea abono tratamiento*/
if(isset($_POST['cpago'])){
  $datoa=htmlspecialchars($_POST['valorcuatro']);
  $datob=htmlspecialchars($_POST['valortres']);
  if($datoa == ""){
    $detalle='<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>Campo requerido</div>';
  }else if($datob == ""){
    $detalle='<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>Campo requerido</div>';

  }else{
    $pabo=new Crud;
    $hoy = date("Y-m-d");
    $pabo->insertInto='saldos';
    $pabo->insertColumns='idpaciente,abono,tipo,fecha';
    $pabo->insertValues=$_GET['id_ficha'].",".$datoa.","."'ABONO'".",'$hoy'";
    $pabo->Creahistorial();
    $detalle=$pabo->detalle;
  }

}
/*grafico de saldo*/
/*cargo*/
$cargo=new Crud;
$cargo->select="idpaciente,sum(cargo)as monto";
$cargo->from="saldos";
/*SELECT idpaciente,sum(monto)as monto FROM `saldos`
WHERE idpaciente="1003" and tipo NOT LIKE "%ABONO%"*/
$cargo->condition="idpaciente='".$_GET['id_ficha']."'"."and tipo NOT LIKE '%ABONO%'";
$cargo->Read();
$filas=$cargo->rows;
foreach ($filas as $fila){
  $carga= $fila['monto'];
}
/*abono*/
$abonos=new Crud;
$abonos->select="idpaciente,sum(abono)as monto";
$abonos->from="saldos";
/*SELECT idpaciente,sum(monto)as monto FROM `saldos`
WHERE idpaciente="1003" and tipo NOT LIKE "%ABONO%"*/
$abonos->condition="idpaciente='".$_GET['id_ficha']."'"."and tipo LIKE '%ABONO%'";
$abonos->Read();
$filas=$abonos->rows;
foreach ($filas as $fila){
  $abona=$fila['monto'];
}
/*calculo para grafico*/
//echo $carga.$abona;
$vuno=$abona*100;
//echo $vuno;
$vdos=$vuno/$carga;
//echo round($vdos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OdontoDesk</title>

  <!-- Bootstrap -->
  <script src="js/jquery.min.js"></script>

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/dashboard.css">

  <link rel="stylesheet" href="css/jquery-ui.css">
  <script type="text/javascript" src="js/jquery-ui.js"></script>

  <link rel="text/javascript" href="js/bootstrap.js">

  <script type="text/javascript">
  function myTra(selTag) {
    var x = selTag.options[selTag.selectedIndex].text;
    var q=selTag.options[selTag.selectedIndex].value;
    $('input[name=tuno]').val(q);
    $('input[name=ntra]').val(x);

  }
  </script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="adm.php">OdontoDesk</a>

      </div>

      <div class="navbar-collapse collapse">

        <ul class="nav navbar-nav navbar-right">
          <li><a href="panel.php"><span class="glyphicon glyphicon-home"></span>  Inicio</a></li>
          <li><a href="conexion/logout.php"><span class="glyphicon glyphicon-off"></span>  Salir</a></li>
        </ul>
      </div>
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-9  col-md-12 main">
        <strong><?php echo $detalle; ?></strong>


        <br>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#home" role="tab" data-toggle="tab">Datos Personales</a></li>
          <li><a href="#profile" role="tab" data-toggle="tab">Detalles</a></li>
          <li><a href="#messages" role="tab" data-toggle="tab">Nueva Cita</a></li>
          <li><a href="#settings" role="tab" data-toggle="tab">Settings</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="home">

            <div class="row">
              <div class="col-md-6">
                <br>
                  <address>
                  <strong>Nombre</strong><br>
                  <?php echo $nombre ?><br>
                </address>
                <address>
                  <strong>Contacto</strong><br>
                  <?php echo $di ?><br>
                  <abbr title="Phone">Tel:</abbr> <?php echo $te ?><br>
                  <abbr title="Phone">Cel:</abbr> <?php echo $ce ?>
                </address>

                <address>
                  <strong>Correo</strong><br>
                  <a href="mailto:#"><?php echo $co ?></a>
                </address>
                <address>
                  <strong>Antecedentes</strong><br>
                  <?php echo $an ?><br>
                </address>
              </div>
              <div class="col-md-6">
                <br>
                <address>
                  <strong>En caso de emergencia contactar a:</strong><br>
                  <?php echo $su ?><br>
                  <?php echo $sd ?><br>
                </address>
                <address>
                  <strong>Ultima Historia Clinica</strong><br>
                  <?php echo $tit ?><br>
                  <?php echo $desc ?><br>
                </address>
              </div>
            </div>
            <div class="row">

              <div class="col-md-6">
                <h3 class="sub-header">Historial Clinico</h3>
                <form class="form-horizontal" role="form" acton="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
                    <div class="col-sm-10">
                      <input type="text" name="valoruno" id="valoruno" class="form-control" placeholder="Titulo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nota</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="3" placeholder="Nota" name="valordos" id="valordos"></textarea>
                    </div>
                  </div>
                  <input type="hidden" id="chistorial" name="chistorial">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-6">
                <h3 class="sub-header">Pagos</h3>
                <form class="form-horizontal" role="form" acton="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
                    <div class="col-sm-10">
                      <select id="valortres" name="valortres" class="form-control">
                        <?php

                        $selpa=new Crud;
                        $selpa->select="*";
                        $selpa->from="tratamientos ORDER BY id DESC";
                        //$selpa->condition="order by id ASC";
                        $selpa->Read();
                        $filas=$selpa->rows;
                        foreach ($filas as $fila){
                          echo '<option value='.$fila['id'].'>'.$fila['tipo'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Monto</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="valorcuatro" name="valorcuatro" placeholder="Monto">
                    </div>
                  </div>
                  <input type="hidden" id="cpago" name="cpago">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>

           <div class="row">
              <div class="col-md-6">
                <h3 class="sub-header">Tratamientos</h3>
                <form class="form-horizontal" id="frmtra" name="frmtra" role="form" acton="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
                    <div class="col-sm-10">
                      <select name="tu" id="tu" class="form-control" onchange="myTra(this)">
                        <?php
                        $seltra=new Crud;
                        $seltra->select="*";
                        $seltra->from="tratamientos  ORDER BY id DESC";
                        //$seltra->condition='idpa='.$_GET['id_ficha'].' ORDER BY ID ASC';
                        $seltra->Read();
                        $filas=$seltra->rows;

                        foreach ($filas as $fila){
                          /*$ti=$fila['tipo'];
                          $not=$fila['costo'];*/
                          echo '<option value='.$fila['costo'].'>'.$fila['tipo'].'</option>';
                        }
                        ?>

                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Costo</label>
                    <div class="col-sm-10">
                      <input type="text" name="tuno" id="tuno" class="form-control" id="inputEmail3" placeholder="Costo">
                    </div>
                  </div>
                  <input type="hidden" id="ctra" name="ctra">
                  <input type="hidden" id="ntra" name="ntra">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="col-md-6">
                <h3 class="sub-header">Saldo</h3>
                <h4>Cargos: <?php echo $carga;?></h4>
                <div class="progress">
                  <?php
                  if(empty($carga)){
                    echo '<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">0% Completo</span></div>';
                  }else{

                    echo '<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    <span class="sr-only">100% Completo</span>
                    </div>';
                  }
                    ?>

                </div>
                <h4>Abonos: <?php echo $abona;?></h4>
                <div class="progress">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $vdos;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $vdos;?>%">
                    <span class="sr-only">40% Complete</span>
                  </div>
                </div>
              </div>



            </div>





          </div>

          <div class="tab-pane" id="profile">

              <div class="row">
              <div class="col-md-6">
                <h2 class="sub-header">Historial</h2>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Titulo</th>
                        <th>Nota</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $bupa=new Crud;
                      $bupa->select='*';
                      $bupa->from='historial';
                      $bupa->condition="idpa='".$_GET['id_ficha']."' order by id desc";
                      $bupa->Read();
                      $pafilas=$bupa->rows;
                      $patotal=count($pafilas);
                      foreach($pafilas as $lispabu):

                        ?>
                        <tr>
                          <td><?=$lispabu['titulo']?></td>
                          <td><?=$lispabu['nota']?></td>
                          <td><?=$lispabu['fecha']?></td>
                        </tr>
                        <?php
                      endforeach;
                      ?>
                    </tbody>
                  </table>
                </div>

              </div>
              <div class="col-md-6">.col-md-6</div>
            </div>

          </div>

          <div class="tab-pane" id="messages">...</div>
          <div class="tab-pane" id="settings">...</div>
        </div>


      </div>
    </div>
  </div>

  <!-- Button trigger modal -->


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
          <form name="formedit" id="formedit">
            <input type="hidden" name="bookId" id="bookId" value="" >
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



  <div class="modal fade" id="myUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Editar</h4>
        </div>
        <div class="modal-body">
          <form name="formUp" id="formUp" role="form">
            <div class="form-group">
              <label for="nombrecliente">Nombre</label>
              <input class="form-control" type="text" name="aa" id="aa" value="" readonly>
            </div>
            <div class="form-group">
              <label for="dircliente">Correo</label>
              <input class="form-control" type="text" name="ab" id="ab" value="" required>
            </div>
            <div class="form-group">
              <label for="ruccliente">Celular</label>
              <input class="form-control" type="text" name="ac" id="ac" value="" required>
            </div>
            <div class="form-group">
              <label for="tecliente">Telefono</label>
              <input class="form-control" type="text" name="ad" id="ad" value="" required>
            </div>
            <div id="resultado"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            <input type="hidden" name="upId" id="upId" value="" >
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="myNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Nuevo</h4>
        </div>
        <div class="modal-body">
          <form name="formNew" id="formNew" role="form">
            <div class="form-group">
              <label for="nombrecliente">C.I</label>
              <input class="form-control" type="text" name="a" id="a" placeholder="Cedula de Identidad" required autofocus>
            </div>
            <div class="form-group">
              <label for="dircliente">Nombre</label>
              <input class="form-control" type="text" name="b" id="b" placeholder="Nombre" required>
            </div>
            <div class="form-group">
              <label for="dircliente">Fecha Nac.</label>
              <input id="date-picker-6" type="text" class="date-pickera form-control" required>
            </div>
            <script type="text/javascript">
              $(".date-pickera").datepicker({ dateFormat: "yy-mm-dd", altField: '#g', altFormat: 'yy-mm-dd'});


              var monthNames = $( ".date-pickera" ).datepicker( "option", "monthNames" );
              // setter
              $( ".date-pickera" ).datepicker( "option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ] );
              // getter
              var dayNamesMin = $( ".date-pickera" ).datepicker( "option", "dayNamesMin" );
              // setter
              $( ".date-pickera" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );

            </script>
            <div class="form-group">
              <label for="dircliente">Celular</label>
              <input class="form-control" type="text" name="c" id="c" placeholder="Celular" required>
            </div>
            <div class="form-group">
              <label for="dircliente">Telefono</label>
              <input class="form-control" type="text" name="d" id="d" placeholder="Telefono" required>
            </div>
            <div class="form-group">
              <label for="dircliente">Correo</label>
              <input class="form-control" type="text" name="e" id="e" placeholder="Correo" required>
            </div>
            <div class="form-group">
              <label for="dircliente">Direccion</label>
              <input class="form-control" type="text" name="f" id="f" placeholder="Direccion" required>
            </div>
            <div id="resultado"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            <input type="hidden" name="g" id="g" value="" >
            <input type="hidden" name="Newcli" id="Newcli" value="Newcli" >
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
            <input type="hidden" name="bookId" id="bookId" value="" >
            <div id="resultado"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>




  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/modal.js"></script>
  <script src="js/tab.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->

</body>
</html>
