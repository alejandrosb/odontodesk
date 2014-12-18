<?php
class Conexion{
	public function conectar(){
		$root='root';
		$password='';
		$host='localhost';
		$dbname='dbodonto';
		return $conexion =new PDO("mysql:host=$host;dbname=$dbname;",$root,$password);
		}

}
?>
