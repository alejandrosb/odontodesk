<?php
class Seleccionar{
	public $user;
	public $password;
	public $mensaje;

	public function login(){
		$model= new Conexion;
		$conexion=$model->conectar();
		$sql="SELECT * FROM usuarios WHERE ";
		$sql.="usuario=:user AND pass=:password";
		$consulta= $conexion->prepare($sql);
		$consulta->bindParam(':user',$this->user,PDO::PARAM_STR);
		$consulta->bindParam(':password',$this->password,PDO::PARAM_STR);
		$consulta->execute();
		$total=$consulta->rowCount();
		if($total== 0){
			$this->mensaje='Error al iniciar sesion';
			}else{
				$fila=$consulta->fetch();
				/*session_start();
				$_SESSION['nombre']=$fila['nivel'];*/
				/*$levelu=$_SESSION["nivel"];*/
				/*$_SESSION['login']=true;*/

				header('location: panel.php');
				}

		}

	}
