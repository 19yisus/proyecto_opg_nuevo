<?php
require("db.php");

class InstitucionModel extends DB
{
  private $id_institucion, $des_institucion, $codigo_institucion, $direccion_institucion, $estatus;
  private $zona_educativa, $entidad_federal, $municipio, $telefono;

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
    $this->zona_educativa = isset($datos['zona_educativa']) ? $datos['zona_educativa'] : null;
    $this->entidad_federal = isset($datos['entidad_federal']) ? $datos['entidad_federal'] : null;
    $this->municipio = isset($datos['municipio']) ? $datos['municipio'] : null;
    $this->telefono = isset($datos['telefono']) ? $datos['telefono'] : null;

    $this->estatus = isset($datos['estatus']) ? $datos['estatus'] : null;
  }

  public function SaveDatos()
  {
    try {
      $result2 = $this->consult("SELECT * FROM institucion WHERE estatus_institucion = 1");

      if (isset($result2[0])) {
        $pdo = $this->driver->prepare("INSERT INTO institucion(
          des_institucion, 
          codigo_institucion, 
          direccion_institucion,
          municipio,
          entidad_federal,
          zona_educativa,
          telefono, estatus_institucion
          ) VALUES(:descripcion, :codigo, :direccion, :municipio, :entidad, :zona, :telefono,0);");
      } else {
        $pdo = $this->driver->prepare("INSERT INTO institucion(
          des_institucion, 
          codigo_institucion, 
          direccion_institucion,
          municipio,
          entidad_federal,
          zona_educativa,
          telefono
          ) VALUES(:descripcion, :codigo, :direccion, :municipio, :entidad, :zona, :telefono);");
      }
      $pdo->bindParam(':descripcion', $this->des_institucion);
      $pdo->bindParam(':codigo', $this->codigo_institucion);
      $pdo->bindParam(':direccion', $this->direccion_institucion);
      $pdo->bindParam(':municipio', $this->municipio);
      $pdo->bindParam(':entidad', $this->entidad_federal);
      $pdo->bindParam(':zona', $this->zona_educativa);
      $pdo->bindParam(':telefono', $this->telefono);

      // var_dump("INSERT INTO institucion(
      //   des_institucion, 
      //   codigo_institucion, 
      //   direccion_institucion,
      //   municipio,
      //   entidad_federal,
      //   zona_educativa,
      //   telefono, estatus_institucion
      //   ) VALUES('$this->des_institucion', '$this->codigo_institucion','$this->direccion_institucion','$this->municipio,'$this->entidad_federal','$this->zona_educativa','$this->telefono',0);");

      if ($pdo->execute()) {
        $id = $this->driver->lastInsertId();
        $this->registrar_bitacora_sistema([
          'table' => "Institucion",
          'descripcion' => "REGISTRO",
          'id_registro' => $id
        ]);
        $this->ResJSON("Operacion Exitosa!", "success");
      } else $this->ResJSON("Operacion Fallida!", "error");
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
          direccion_institucion = :direccion,
          municipio = :municipio,
          entidad_federal = :entidad,
          zona_educativa = :zona,
          telefono = :telefono
          WHERE id_institucion = :id_institucion ;");

      $pdo->bindParam(':descripcion', $this->des_institucion);
      $pdo->bindParam(':id_institucion', $this->id_institucion);
      $pdo->bindParam(':codigo', $this->codigo_institucion);
      $pdo->bindParam(':direccion', $this->direccion_institucion);
      $pdo->bindParam(':municipio', $this->municipio);
      $pdo->bindParam(':entidad', $this->entidad_federal);
      $pdo->bindParam(':zona', $this->zona_educativa);
      $pdo->bindParam(':telefono', $this->telefono);

      if ($pdo->execute()) {
        $this->registrar_bitacora_sistema([
          'table' => "institucion",
          'descripcion' => "ACTUALIZACION",
          'id_registro' => $this->id_institucion
        ]);

        $this->ResJSON("Operacion Exitosa!", "success");
      } else $this->ResJSON("Operacion Fallida!", "error");
    } catch (PDOException $e) {
      error_log("InstitucionModel(line1------) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida!", "error");
    }
  }

  public function ChangeStatus()
  {
    try {
      $pdo = null;
      $result = $this->consult("SELECT estatus_institucion FROM institucion WHERE id_institucion = $this->id_institucion ");
      
      if ($result['estatus_institucion'] == 0) {
        $result = $this->consult("SELECT * FROM institucion WHERE estatus_institucion = 1 AND id_institucion != $this->id_institucion ");

        if (!isset($result[0])) {
          $pdo = $this->driver->prepare("UPDATE institucion SET estatus_institucion = 1 WHERE id_institucion = :id ;");
          $pdo->bindParam(':id', $this->id_institucion);
          if ($pdo->execute()) {
            $this->registrar_bitacora_sistema([
              'table' => "institucion",
              'descripcion' => "CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)",
              'id_registro' => $this->id_institucion
            ]);

            $this->ResJSON("Operacion Exitosa!", "success");
          } else $this->ResJSON("Operacion Fallida!", "error");
        } else $this->ResJSON("No se pueden tener dos periodos escolares activos!", "error");
      } else {
        $pdo = $this->driver->prepare("UPDATE institucion SET estatus_institucion = 0 WHERE id_institucion = :id ;");
        $pdo->bindParam(':id', $this->id_institucion);
        if ($pdo->execute()) {
          $this->registrar_bitacora_sistema([
            'table' => "institucion",
            'descripcion' => "CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)",
            'id_registro' => $this->id_institucion
          ]);

          $this->ResJSON("Operacion Exitosa!", "success");
        } else $this->ResJSON("Operacion Fallida!", "error");
      }
    } catch (PDOException $e) {
      error_log("PeriodoModel(58) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida! (error_log)", "error");
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
  public function GetActivo()
  {
    try {
      $result = $this->consult("SELECT * FROM institucion WHERE estatus_institucion = 1;");

      if (isset($result[0])) return $result;
      else [];
    } catch (PDOException $e) {
      error_log("InstitucionModel(82) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida! (error_log)", "error");
    }
  }

  public function GetBitacora()
  {
    try {
      $result = $this->consultAll("SELECT * FROM bitacora_sistema 
      INNER JOIN usuario ON usuario.id = bitacora_sistema.user_id
      INNER JOIN roles ON roles.id = usuario.id_rol
      ;");

      if (isset($result[0])) $this->ResDataJSON($result);
      else $this->ResDataJSON([]);
    } catch (PDOException $e) {
      error_log("InstitucionModel(82) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida! (error_log)", "error");
    }
  }
}
