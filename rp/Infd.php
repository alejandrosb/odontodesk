<?php
if ($_POST["action"] == 'PDF') {

error_reporting(E_ALL);
ini_set('display_errors', '1');

} else if ($_POST['action'] == 'EX') {
$fe=date("Y-m-d");
$u = $_POST["fu"];
$d = $_POST["fd"];
$t="'".$u."'";
$c="'".$d."'";


header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=ListadoPacientes".$fe.".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
//echo "Some Text"; //no ending ; here



echo '<!DOCTYPE html>
<html>
<head>
<style>
table,th,td
{
border:1px solid black;
border-collapse:collapse;
}
th,td
{
padding:5px;
}
</style>
</head>
<body>';

include ("../pool/conectar.php");
$consulta = mysqli_query($con,"SELECT descripcion FROM configuracion LIMIT 1");
$nom = mysqli_fetch_array($consulta);
echo '<h4>'.$nom['descripcion'].'</h4>';
echo '<h4>FECHA: '.$fe.'</h4>';
echo '<h4>LISTADO DE PACIENTES</h4>
<table style="width:300px">
<tr>
  <th>Id</th>
  <th>Nombre</th>
  <th>Celular</th>
	<th>Telefono</th>
	<th>Correo</th>
</tr>';




$result = mysqli_query($con,"SELECT id,nombre,celular,telefono,correo FROM pacientes order by id ASC");
$tg=0;
while($row = mysqli_fetch_array($result)) {
	echo "<br>";
	echo '<tr>';
	echo '<td>'.$row['id'].'</td>';
	echo '<td>'.$row['nombre'].'</td>';
	echo '<td>'.$row['celular'].'</td>';
	echo '<td>'.$row['telefono'].'</td>';
	echo '<td>'.$row['correo'].'</td>';
	$tg++;
	echo '</tr>';
}

mysqli_close($con);
echo '</table>';
echo '<h4>Total General: '.$tg.'</h4>';
echo'</body>
</html>';




} else {
    //invalid action!
echo "nada";
}
?>
