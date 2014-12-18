<?php
class Crud{

  public $insertInto;
  public $insertColumns;
  public $insertValues;

  public $select;
  public $from;
  public $condition;

  public $detalle;
  public $rows;
  public $deleteFrom;
  public $mensaje;

  public $update;
  public $set;

  public function Creahistorial(){
    $model=	new Conexion();
    $conexion=$model->conectar();
    $insertInto=$this->insertInto;
    $insertColumns=$this->insertColumns;
    $insertValues=$this->insertValues;
    $sql="INSERT INTO $insertInto ($insertColumns ) VALUES ($insertValues)";
    $consulta=$conexion->prepare($sql);
    if (!$consulta){
      $this->detalle='Error en el proceso';
    }else{

      $consulta->execute();
      $this->detalle='<div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Registro creado</div>';
    }
  }
  /*eliminar*/
  public function Eliminarc(){
    $model=	new Conexion();
    $conexion=$model->conectar();
    $deleteFrom=$this->deleteFrom;
    $condition=$this->condition;
    if($condition !=''){

      $condition="WHERE ".$condition;

    }
    $sql="DELETE FROM $deleteFrom $condition";
    $consulta=$conexion->prepare($sql);
    if(!$consulta){
      $this->mensaje='<div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Error al eliminar el registro</div>';
    }else{
      $consulta->execute();
      $this->mensaje='<div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Registro eliminado</div>';

    }
  }


  public function Read (){
    $model=	new Conexion();
    $conexion=$model->conectar();
    $select=$this->select;
    $from=$this->from;
    $condition=$this->condition;
    if($condition!=''){
      $condition=" WHERE ".$condition;
    }
    $sql="SELECT $select FROM $from $condition";
    $consulta=$conexion->prepare($sql);
    $consulta->execute();
    while($filas = $consulta->fetch()){
      $this->rows[]=$filas;
    }
  }

  public function Update(){
    $model=	new Conexion();
    $conexion=$model->conectar();
    $update=$this->update;
    $set=$this->set;
    $condition=$this->condition;
    if($condition !=""){
      $condition=" WHERE ".$condition;

    }
    $sql="UPDATE $update SET $set $condition";
    $consulta=$conexion->prepare($sql);
    if(!$consulta){
      $this->mensaje='<div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Error al actualizar el registro</div>';
    }else{
      $consulta->execute();
      $this->mensaje='<div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Registro actualizado</div>';
    }
  }

}
