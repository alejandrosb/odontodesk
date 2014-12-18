<?php
class Pbusca{

  public $produc;
  public $rows;
  public function buscando(){
    $model=new Conexion;
    $conexion=$model->conectar();
    $sql="SELECT * FROM pacientes WHERE ";
    $sql.="nombre like :produc or id like :produc";
    $consulta=$conexion->prepare($sql);
    $consulta->bindParam(':produc',$this->produc,PDO::PARAM_STR);
    $consulta->execute();

    $total=$consulta->rowCount();


    if($total==0){
      $this->mensaje='<div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>No existe registros</div>';
      $this->me='<script>
      function setFocusToTextBox(){
        document.getElementById("bpac").focus();
      }
      </script>';
    }else{
      $fila = $consulta->fetch();

      $oid_prod=$fila['id'];
      $n_prod=$fila['nombre'];
      //se carga los datos
      $this->mensaje=null;
      /*echo '<script>
      //window.parent.tot.location.reload();
      </script>';*/
      $this->me='<div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong><a href="ficha.php?id_ficha='.$oid_prod=$fila['id'].'" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-ok"></span> Ver ficha</a> '.$n_prod=$fila['nombre'].'</div>';
    }
  }

}
