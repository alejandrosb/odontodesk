<?php
/*session_start();
echo $_SESSION["nombre"];*/
require 'pool/Conexion.php';

require 'pool/Crud.php';
$mensaje=null;


if(isset($_POST['Newing'])){
  $pci=htmlspecialchars($_POST['not']);
  $pa=htmlspecialchars($_POST['monto']);
  $hoy = date("Y-m-d");
  $phistorial=new Crud;
  $phistorial->insertInto='movimientos';
  $phistorial->insertColumns='abono,tipo,fecha';
  $phistorial->insertValues="$pa, UPPER('$pci'),'$hoy'";
  //"UPPER('$datouno'),".$_GET['id_ficha'].",UPPER('$datodos')";
  $phistorial->Creahistorial();
  $mensaje=$phistorial->detalle;

}

if(isset($_POST['Newe'])){
  $pci=htmlspecialchars($_POST['nota']);
  $pa=htmlspecialchars($_POST['mont']);
  $fec = date("Y-m-d");
  $phistorial=new Crud;
  $phistorial->insertInto='movimientos';
  $phistorial->insertColumns='cargo,tipo,fecha';
  $phistorial->insertValues="$pa, UPPER('$pci'),'$fec'";
  //"UPPER('$datouno'),".$_GET['id_ficha'].",UPPER('$datodos')";
  $phistorial->Creahistorial();
  $mensaje=$phistorial->detalle;

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
        <li><a data-toggle="modal" data-target="#myNew"><span class="glyphicon glyphicon-chevron-up"></span> Ingresos</a></li>
        <li><a data-toggle="modal" data-target="#myNewEg"><span class="glyphicon glyphicon-chevron-down"></span> Egresos</a></li>
          <li><a href="panel.php"><span class="glyphicon glyphicon-home"></span>  Inicio</a></li>
        <li><a href="pool/logout.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
      </ul>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-9  col-md-12 main">
        <strong><?php echo $mensaje;?></strong>

        <h2 class="sub-header">Informes</h2>
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                  Balance de Movimientos de Pacientes
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
              <div class="panel-body">
                <form name="uno" id="uno" method="post" action="rp/Infu.php" >


                  <div class="row">
                    <div class="col-xs-4">
                      <label for="date-picker-6" class="control-label">Inicio</label>
                      <div class="input-group">
                        <label for="date-picker-6" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                        <input id="date-picker-6" type="text" class="date-pickera form-control" required></div>
                      </div></div>
                      <br>
                      <div class="row">
                        <div class="col-xs-4">
                          <label for="date-picker-7" class="control-label">Fin</label>
                          <div class="input-group">
                            <label for="date-picker-7" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                            <input id="date-picker-7" type="text" class="date-pickerb form-control" required></div>
                          </div></div>
                          <br>
                          <button class="btn btn-primary" type="submit" name="action" value="EX" formtarget="_blank">
                            <span class="glyphicon glyphicon-export"></span> Excel
                          </button>
                          <input type="hidden" name="fi" id="fi" value="" >
                          <input type="hidden" name="ff" id="ff" value="" >
                        </form>
                      </div>
                      <script type="text/javascript">
                      $(".date-pickera").datepicker({ dateFormat: "yy-mm-dd", altField: '#fi', altFormat: 'yy-mm-dd'});


                      var monthNames = $( ".date-pickera" ).datepicker( "option", "monthNames" );
                      // setter
                      $( ".date-pickera" ).datepicker( "option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ] );
                      // getter
                      var dayNamesMin = $( ".date-pickera" ).datepicker( "option", "dayNamesMin" );
                      // setter
                      $( ".date-pickera" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );

                      $(".date-pickerb").datepicker({ dateFormat: "yy-mm-dd", altField: '#ff', altFormat: 'yy-mm-dd'});

                      var monthNames = $( ".date-pickerb" ).datepicker( "option", "monthNames" );
                      // setter
                      $( ".date-pickerb" ).datepicker( "option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ] );
                      // getter
                      var dayNamesMin = $( ".date-pickerb" ).datepicker( "option", "dayNamesMin" );
                      // setter
                      $( ".date-pickerb" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );
                    </script>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Listado de Pacientes
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">

                      <div class="form-group">
                        <form name="feselc" id="feselc" method="post" action="rp/Infd.php" >

                              <div class="row">
                                <div class="col-xs-4">
                                  <br>
                                    <button class="btn btn-primary" type="submit" name="action" value="EX" formtarget="_blank">
                                      <span class="glyphicon glyphicon-export"></span> Excel
                                    </button>

                                  </form>
                                </div>

                              </div>

                            </div>
                            <script type="text/javascript">
                              $(".date-picker").datepicker({ dateFormat: "yy-mm-dd", altField: '#fu', altFormat: 'yy-mm-dd'});


                              var monthNames = $( ".date-picker" ).datepicker( "option", "monthNames" );
                              // setter
                              $( ".date-picker" ).datepicker( "option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ] );
                              // getter
                              var dayNamesMin = $( ".date-picker" ).datepicker( "option", "dayNamesMin" );
                              // setter
                              $( ".date-picker" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );

                              $(".date-pickers").datepicker({ dateFormat: "yy-mm-dd", altField: '#fd', altFormat: 'yy-mm-dd'});

                              var monthNames = $( ".date-pickers" ).datepicker( "option", "monthNames" );
                              // setter
                              $( ".date-pickers" ).datepicker( "option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ] );
                              // getter
                              var dayNamesMin = $( ".date-pickers" ).datepicker( "option", "dayNamesMin" );
                              // setter
                              $( ".date-pickers" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );

                            </script>
                          </div>
                        </div>
                      </div>


                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                              Consulta de Ingresos y Egresos
                            </a>
                          </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                          <div class="panel-body">

                            <div class="form-group">
                              <form name="fcom" id="fcom" method="post" action="rp/Infut.php" >
                                <div class="row">
                                  <div class="col-xs-4">
                                    <label for="date-picker-10" class="control-label">Inicio</label>

                                    <div class="input-group">
                                      <label for="date-picker-10" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                                      <input id="date-picker-10" type="text" class="date-pickerf form-control" required></div></div>
                                    </div>
                                    <div class="row">
                                      <br>
                                      <div class="col-xs-4">
                                        <label for="date-picker-11" class="control-label">Fin</label>
                                        <div class="input-group">
                                          <label for="date-picker-11" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                                          <input id="date-picker-11" type="text" class="date-pickerg form-control" required></div><br>
                                          <button class="btn btn-primary" type="submit" name="action" value="EX" formtarget="_blank">
                                            <span class="glyphicon glyphicon-export"></span> Excel
                                          </button>
                                          <script type="text/javascript">
                                            $(".date-pickerf").datepicker({ dateFormat: "yy-mm-dd", altField: '#au', altFormat: 'yy-mm-dd'});

                                            var monthNames = $( ".date-pickerf" ).datepicker( "option", "monthNames" );
                                            // setter
                                            $( ".date-pickerf" ).datepicker( "option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ] );
                                            // getter
                                            var dayNamesMin = $( ".date-pickerf" ).datepicker( "option", "dayNamesMin" );
                                            // setter
                                            $( ".date-pickerf" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );

                                            $(".date-pickerg").datepicker({ dateFormat: "yy-mm-dd", altField: '#bd', altFormat: 'yy-mm-dd'});

                                            var monthNames = $( ".date-pickerg" ).datepicker( "option", "monthNames" );
                                            // setter
                                            $( ".date-pickerg" ).datepicker( "option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ] );
                                            // getter
                                            var dayNamesMin = $( ".date-pickerg" ).datepicker( "option", "dayNamesMin" );
                                            // setter
                                            $( ".date-pickerg" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );

                                          </script>
                                          <input type="hidden" name="au" id="au" value="" >
                                          <input type="hidden" name="bd" id="bd" value="" >
                                        </form>
                                      </div>

                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- panel empieza -->



                            <!-- panel termina -->

                              </div>
      </div>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <div class="modal fade" id="myNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Ingresos</h4>
        </div>
        <div class="modal-body">
          <form name="formNew" id="formNew" role="form" acton="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="form-group">
              <label for="nombrecliente">Nota</label>
              <input class="form-control" type="text" name="not" id="not" placeholder="Nota" required autofocus>
            </div>
            <div class="form-group">
              <label for="dircliente">Monto</label>
              <input class="form-control" type="text" name="monto" id="monto" placeholder="Monto" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            <input type="hidden" name="Newing" id="Newing">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myNewEg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Egresos</h4>
        </div>
        <div class="modal-body">
          <form name="formNew" id="formNew" role="form" acton="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="form-group">
              <label for="nombrecliente">Nota</label>
              <input class="form-control" type="text" name="nota" id="not" placeholder="Nota" required autofocus>
            </div>
            <div class="form-group">
              <label for="dircliente">Monto</label>
              <input class="form-control" type="text" name="mont" id="monto" placeholder="Monto" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            <input type="hidden" name="Newe" id="Newe">
          </form>
        </div>
      </div>
    </div>
  </div>


</body>
</html>
