<?php
if ($_POST["action"] == 'PDF') {

error_reporting(E_ALL);
ini_set('display_errors', '1');

} else if ($_POST['action'] == 'EX') {
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
$fe=date("Y-m-d");
$u = $_POST["au"];
$d = $_POST["bd"];
$t="'".$u."'";
$c="'".$d."'";


header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=IngresosEgresos".$fe.".xls");  //File name extension was wrong
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
echo '<h4>LISTADO DE INGRESOS -  EGRESOS DEL '.$u.' al '.$d.'</h4>
<table style="width:300px">
<tr>
  <th>Id</th>
  <th>Egresos</th>
  <th>Ingresos</th>
	<th>Tipo</th>
	<th>Fecha</th>
</tr>';
$result = mysqli_query($con,"SELECT id,cargo,abono,tipo,fecha from movimientos where date(fecha) BETWEEN ".$t." AND ".$c);
$tg=0;
while($row = mysqli_fetch_array($result)) {
	echo "<br>";
	echo '<tr>';
	echo '<td>'.$row['id'].'</td>';
	echo '<td>'.$row['cargo'].'</td>';
	echo '<td>'.$row['abono'].'</td>';
	echo '<td>'.$row['tipo'].'</td>';
	echo '<td>'.$row['fecha'].'</td>';
	$tg++;
	echo '</tr>';
}
//cargos



echo '</table>';
echo '<h4>Total General: '.$tg.'</h4>';
$ccargos = mysqli_query($con,"select SUM(cargo) AS cargo,sum(abono) as abono from movimientos where date(fecha) BETWEEN".$t." AND ".$c);
$tcargos = mysqli_fetch_array($ccargos);
echo '<h4>Total Egresos: '.$tcargos['cargo'].'</h4>';
echo '<h4>Total Ingresos: '.$tcargos['abono'].'</h4>';
echo'</body>
</html>';
mysqli_close($con);



} else {
    //invalid action!
echo "nada";
}
?>
