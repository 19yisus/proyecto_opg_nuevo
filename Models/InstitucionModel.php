<?php
require("db.php");

class InstitucionModel extends DB
{
  private $id_institucion, $des_institucion, $codigo_institucion, $direccion_institucion, $estatus;

  public function __construct()
  {
    parent::__construct();
  }

  public function SetData($datos)
  {
    $this->id_institucion = isset($datos['id_institucion']) ? $datos['id_institucion'] : null;
    $this->des_institucion = isset($datos['des_institucion']) ? $datos['des_institucion'] : null;
    $this->codigo_institucion = isset($datos['codigo_institucion']) ? $datos['codigo_institucion'] : null;
    $this->direccion_institucion = isset($datos['direccion_institucion']) ? $datos['direccion_institucion'] : null;
    $this->estatus = isset($datos['estatus']) ? $datos['estatus'] : null;
  }

  public function SaveDatos()
  {
    try {
      $result2 = $this->consult("SELECT * FROM institucion");

      if(isset($result2[0])){
      	return $this->ResJSON("Ya existen datos registrado de la institución","error");
      }

      $pdo = $this->driver->prepare("INSERT INTO institucion(
          des_institucion, 
          codigo_institucion, 
          direccion_institucion) VALUES(:descripcion, :codigo, :direccion);");

      $pdo->bindParam(':descripcion', $this->des_institucion);
      $pdo->bindParam(':codigo', $this->codigo_institucion);
      $pdo->bindParam(':direccion', $this->direccion_institucion);

      if ($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
      else $this->ResJSON("Operacion Fallida!", "error");
    } catch (PDOException $e) {
      error_log("InstitucionModel(line0------) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida!", "error");
    }
  }

  public function UpdateDatos()
  {
    try {
      $pdo = $this->driver->prepare("UPDATE institucion SET 
          des_institucion = :descripcion ,
          codigo_institucion = :codigo,
          direccion = :direccion
          WHERE id_institucion = :id_institucion ;");

      $pdo->bindParam(':descripcion', $this->des_institucion);
      $pdo->bindParam(':id_institucion', $this->id_institucion);
      $pdo->bindParam(':codigo', $this->codigo_institucion);
      $pdo->bindParam(':direccion', $this->direccion_institucion);

      if ($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
      else $this->ResJSON("Operacion Fallida!", "error");
    } catch (PDOException $e) {
      error_log("InstitucionModel(line1------) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida!", "error");
    }
  }

  public function GetAll()
  {
    try {
      $result = $this->consultAll("SELECT * FROM institucion;");
      if (isset($result[0])) $this->ResDataJSON($result);
      else $this->ResDataJSON([]);
    } catch (PDOException $e) {
      error_log("InstitucionModel(66) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida! (error_log)", "error");
    }
  }

  public function GetOne()
  {
    try {
      $result = $this->consult("SELECT * FROM institucion;");

      if (isset($result[0])) $this->ResDataJSON($result);
      else $this->ResDataJSON([]);
    } catch (PDOException $e) {
      error_log("InstitucionModel(82) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida! (error_log)", "error");
    }
  }
}
