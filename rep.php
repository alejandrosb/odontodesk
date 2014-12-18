<?php
/*echo '<script>
if (sessionStorage.getItem("tipo") === null || sessionStorage.getItem("tipo") === undefined ){
window.location.href = "index.php";
}
</script>';*/
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Káva Express</title>

    <!-- Bootstrap -->

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/jquery-ui.css">

    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript">

$(document).on("click", ".open-Up", function () {

//    window.parent.document.getElementById('id_del_input').value='valor';
//     var myBookId = $(this).data('id');
     var nombre = document.getElementById('fu').value;
     $(".modal-body #ft").val( nombre );

     var direcci = document.getElementById("fd").value;
     $(".modal-body #fc").val( direcci );

//console.log(nombre);
//console.log(Idup);
     // As pointed out in comments,
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
<script type="text/javascript">
$(document).ready(function() {
$("#formUp").submit(function(event) {

    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#result").html('');

    /* Get some values from elements on the page: */
    var valNew = $(this).serialize();

    /* Send the data using post and put the results in a div */
    $.ajax({
        url: 'report/dt.php',
        type: 'post',
        data: valNew,
        success: function(){
	$('#myMens').modal('hide');
	alert("Exito en el procesamiento de datos!");
	//$('#myMens').modal('show');
        /*setTimeout(function() {
        window.location.href = "rep.php";
        }, 2000);*/


        },
        error:function(){
            alert("Error en el procesamiento de datos!");
            $("#resultado").html('There is error while submit');
        }
    });
});
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
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Káva Express</a>
        </div>
        <div class="navbar-collapse collapse">

	  <ul class="nav navbar-nav navbar-right">

     <li><a href="adm.php">Inicio</a></li>

            <li><a href="conexion/logout.php">Salir</a></li>
          </ul>
        </div>
      </div>
    </div>
    <br>
    <div class="container-fluid">
      <div class="row">


	<!-- inicio -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main">
			<div class="panel-group" id="accordion">
			  <div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					  Volumen de ventas por cliente
					</a>
				  </h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse">
				  <div class="panel-body">
					<form name="uno" id="uno" method="post" action="report/ru.php" >


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
						</button> <button class="btn btn-primary" type="submit" name="action" value="PDF" formtarget="_blank">
						  <span class="glyphicon glyphicon-floppy-save"></span> PDF
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
					  Ventas por fecha
					</a>
				  </h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse">
				  <div class="panel-body">

						<div class="form-group">
	 <form name="feselc" id="feselc" method="post" action="report/dt.php" >
 <div class="row">
 <div class="col-xs-4">
							  <label for="date-picker-3" class="control-label">Inicio</label>

<div class="input-group">
                <label for="date-picker-3" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                <input id="date-picker-3" type="text" class="date-picker form-control" required></div></div>
            	</div>
            	<br>
 <div class="row">
 <div class="col-xs-4">
						 <label for="date-picker-4" class="control-label">Fin</label>
						<div class="input-group">
                <label for="date-picker-4" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                <input id="date-picker-4" type="text" class="date-pickers form-control" required></div><br>
<button class="btn btn-primary" type="submit" name="action" value="EX" formtarget="_blank">
  <span class="glyphicon glyphicon-export"></span> Excel
</button> <button class="btn btn-primary" type="submit" name="action" value="PDF" formtarget="_blank">
  <span class="glyphicon glyphicon-floppy-save"></span> PDF
</button>
<input type="hidden" name="fu" id="fu" value="" >
<input type="hidden" name="fd" id="fd" value="" >
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
					  Consulta de egresos
					</a>
				  </h4>
				</div>
				<div id="collapseFive" class="panel-collapse collapse">
				  <div class="panel-body">

					<div class="form-group">
						 <form name="fcom" id="fcom" method="post" action="report/shop.php" >
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
				</button> <button class="btn btn-primary" type="submit" name="action" value="PDF" formtarget="_blank">
				  <span class="glyphicon glyphicon-floppy-save"></span> PDF
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
<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
					  Consulta de Ingresos
					</a>
				  </h4>
				</div>
				<div id="collapseSeven" class="panel-collapse collapse">
				  <div class="panel-body">
					<div class="row">
 <div class="col-xs-4">
	 <form name="fegreso" id="fegreso" method="post" action="report/inrp.php" >
					<label for="date-picker-e" class="control-label">Inicio</label>
											<div class="input-group">
									<label for="date-picker-e" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
									<input id="date-picker-e" type="text" class="date-pi form-control" required></div><br>
									<label for="date-picker-ep" class="control-label">Fin</label>
											<div class="input-group">
									<label for="date-picker-ep" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
									<input id="date-picker-ep" type="text" class="date-ci form-control" required></div><br>
					<button class="btn btn-primary" type="submit" name="action" value="EX" formtarget="_blank">
					  <span class="glyphicon glyphicon-export"></span> Excel
					</button> <button class="btn btn-primary" type="submit" name="action" value="PDF" formtarget="_blank">
					  <span class="glyphicon glyphicon-floppy-save"></span> PDF
					</button>
<script type="text/javascript">
$(".date-pi").datepicker({ dateFormat: "yy-mm-dd", altField: '#vuno', altFormat: 'yy-mm-dd'});
		//bloque 1
			var monthNames = $( ".date-pi" ).datepicker( "option", "monthNames" );
			// setter
			$( ".date-pi" ).datepicker( "option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ] );
			// getter
			var dayNamesMin = $( ".date-pi" ).datepicker( "option", "dayNamesMin" );
			// setter
			$( ".date-pi" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );
			//bloque 2
			$(".date-ci").datepicker({ dateFormat: "yy-mm-dd", altField: '#ciuno', altFormat: 'yy-mm-dd'});
			var monthNames = $( ".date-ci" ).datepicker( "option", "monthNames" );
			// setter
			$( ".date-ci" ).datepicker( "option", "monthNames", [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ] );
			// getter
			var dayNamesMin = $( ".date-ci" ).datepicker( "option", "dayNamesMin" );
			// setter
			$( ".date-ci" ).datepicker( "option", "dayNamesMin", [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] );
</script>
					<input type="hidden" name="vuno" id="vuno" value="" >
					<input type="hidden" name="ciuno" id="ciuno" value="" >
						 </form>
						</div>
					</div>

				  </div>
				</div>
			  </div>
<!-- panel termina -->

			</div>
		</div>
	<!-- fin -->
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
        Desea generar el archivo?
		 <form name="formRe" id="formUp" role="form">
          <input type="hidden" name="bookId" id="bookId" value="rf" >
          <input type="hidden" name="ft" id="ft" value="" >
          <input type="hidden" name="fc" id="fc" value="" >
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="js/modal.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

  </body>
</html>
