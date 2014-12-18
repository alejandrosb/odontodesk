<?php
/*session_start();
echo $_SESSION["nombre"];*/
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OdontoDesk</title>
    <!-- calendario -->
    <link href='fullcalendar.css' rel='stylesheet' />
    <link href='fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='lib/moment.min.js'></script>
    <script src='lib/jquery.min.js'></script>
    <script src='fullcalendar.min.js'></script>
    <script src='fullcalendar.js'></script>
    <script src='lang-all.js'></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dashboard.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>

    $(document).ready(function() {
      var currentLangCode = 'es';
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();

      calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        lang: currentLangCode,
        events: "events.php",

        // Convert the allDay from string to boolean
        eventRender: function(event, element, view) {
          if (event.allDay === 'true') {
            event.allDay = true;
          } else {
            event.allDay = false;
          }
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
          var title = prompt('Event Title:');
          //var url = prompt('Type Event url, if exits:');
          if (title) {
            start = moment(start).format( "YYYY-MM-DD HH:mm:ss");
            end = moment(end).format("YYYY-MM-DD HH:mm:ss");

            $.ajax({
              url: 'add_events.php',
              data:'title='+ title+'&start='+ start +'&end='+ end,
              type: "POST",
              success: function(json) {
                alert('Added Successfully'+start+ title);
              }
            });
            calendar.fullCalendar('renderEvent',
            {
              title: title,
              start: start,
              end: end,
              allDay: allDay
            },
            true // make the event "stick"
            );
          }
          calendar.fullCalendar('unselect');
        },

        editable: true,
        eventDrop: function(event, delta) {
          start = moment(start).format( "YYYY-MM-DD HH:mm:ss");
          end = moment(end).format("YYYY-MM-DD HH:mm:ss");

          $.ajax({
            url: 'update_events.php',
            data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
            type: "POST",
            success: function(json) {
              alert("Updated Successfully");
            }
          });
        },
        eventClick: function(event) {
          var decision = confirm("Do you really want to do that?");
          if (decision) {
            $.ajax({
              type: "POST",
              url: "delete_event.php",
              data: "&id=" + event.id,
              success: function(json) {
                $('#calendar').fullCalendar('removeEvents', event.id);
                alert("Updated Successfully");}
              });



            }

          },
          eventResize: function(event) {
            start = moment(start).format( "YYYY-MM-DD HH:mm:ss");
            end = moment(end).format("YYYY-MM-DD HH:mm:ss");
            $.ajax({
              url: 'update_events.php',
              data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
              type: "POST",
              success: function(json) {
                alert("Updated Successfully");
              }
            });

          }

        });

      });

    </script>
    <style>

    body {
      margin: 40px 10px;
      padding: 0;
      font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
      font-size: 14px;
    }

    #calendar {
      max-width: 900px;
      margin: 0 auto;
    }

    </style>
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
    <ul class="nav navbar-nav">

    <li><a href="pacientes.php"><span class="glyphicon glyphicon-user"></span> Pacientes</a></li>
    <li><a href="admin.php"><span class="glyphicon glyphicon-stats"></span>  Administracion</a></li>
    <li><a href="local.php"><span class="glyphicon glyphicon-cog"></span>  Configuracion</a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">

      <li><a href="pool/logout.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
    </ul>
  </div>
</div>

    <div class="container-fluid">
      <div class="row">

        <div class="col-sm-9  col-md-12 main">

          <h2 class="sub-header"></h2>
          <div class="table-responsive">
            <div id='calendar'></div>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
