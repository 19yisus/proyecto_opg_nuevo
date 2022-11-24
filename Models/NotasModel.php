<?php
require("db.php");

class NotasModel extends DB
{
  private $id, $cedula_estudiante, $id_materia, $materias, $id_periodo, $id_seccion, $estatus, $observacion, $usuario;

  public function __construct()
  {
    parent::__construct();
  }

  public function SetData($estu, $materias = [])
  {
    $this->cedula_estudiante = isset($estu[0]['ced']) ? $estu[0]['ced'] : Null;
    $this->id_periodo = isset($estu[0]['periodo']) ? $estu[0]['periodo'] : Null;
    $this->id_seccion = isset($estu[0]['seccion']) ? $estu[0]['seccion'] : Null;
    $this->estatus = isset($estu[0]['estatus']) ? $estu[0]['estatus'] : 1;
    $this->observacion = isset($estu[0]['observacion']) ? $estu[0]['observacion'] : Null;
    $this->usuario_id = 1;
    $this->materias = $materias;
  }

  public function SaveDatos()
  {
    $idNota = null;
    $operacion = "Registro";
    try {
      $this->StartTransaction();
      foreach ($this->materias as $materia) {

        $idMateria = $materia['id_materia'];
        $nt1 = $materia['nota1'];
        $nt2 = $materia['nota2'];
        $nt3 = $materia['nota3'];
        // $nt4 = $materia['nota4'];
        $nt4 = ((intval($materia['nota1']) + intval($materia['nota2']) + intval($materia['nota3'])) / 3);

        $rp1 = $materia['rp1'];
        $rp2 = $materia['rp2'];
        $rp3 = $materia['rp3'];
        $rp4 = $materia['rp4'];

        if (isset($materia['id_nota']) && $materia['id_nota'] != null && $materia['id_nota']  != '') {
          $idNota = $materia['id_nota'];
          $operacion = "Modificacion";

          $sqlNotas = "SELECT nota_lapso1,nota_lapso2,nota_lapso3,nota_final,recuperativo_1,recuperativo_2,recuperativo_3,recuperativo_4 FROM nota WHERE idNota = $idNota ;";
          $notasAcomparar = $this->consult($sqlNotas);

          $array_lista = [
            0 => ['name' => 'nota_lapso1', 'result' => $notasAcomparar['nota_lapso1'] != $nt1, 'new' => $nt1, 'old' => $notasAcomparar['nota_lapso1']],
            1 => ['name' => 'nota_lapso2', 'result' => $notasAcomparar['nota_lapso2'] != $nt2, 'new' => $nt2, 'old' => $notasAcomparar['nota_lapso2']],
            2 => ['name' => 'nota_lapso3', 'result' => $notasAcomparar['nota_lapso3'] != $nt3, 'new' => $nt3, 'old' => $notasAcomparar['nota_lapso3']],
            3 => ['name' => 'nota_final', 'result' => $notasAcomparar['nota_final'] != $nt4, 'new' => $nt4, 'old' => $notasAcomparar['nota_final']],
            4 => ['name' => 'recuperativo_1', 'result' => $notasAcomparar['recuperativo_1'] != $rp1, 'new' => $rp1, 'old' => $notasAcomparar['recuperativo_1']],
            5 => ['name' => 'recuperativo_2', 'result' => $notasAcomparar['recuperativo_2'] != $rp2, 'new' => $rp2, 'old' => $notasAcomparar['recuperativo_2']],
            6 => ['name' => 'recuperativo_3', 'result' => $notasAcomparar['recuperativo_3'] != $rp3, 'new' => $rp3, 'old' => $notasAcomparar['recuperativo_3']],
            7 => ['name' => 'recuperativo_4', 'result' => $notasAcomparar['recuperativo_4'] != $rp4, 'new' => $rp4, 'old' => $notasAcomparar['recuperativo_4']]
          ];

          $notasAntiguas = "Actualizacion de notas: ";
          $actualizar = false;
          foreach ($array_lista as $item) {
            if ($item['result']) {
              $notasAntiguas .= $item['name'] . " = " . (isset($item['old']) ? $item['old'] : "Sin nota") . " => " . $item['new'] . " | ";
              $actualizar = true;
            }
          }
          if ($actualizar) {

            $sql_nota = "UPDATE nota SET nota_lapso1 = $nt1, nota_lapso2 = $nt2, nota_lapso3 = $nt3, nota_final = $nt4,recuperativo_1 = $rp1, recuperativo_2 = $rp2, recuperativo_3 = $rp3, recuperativo_4 = $rp4. WHERE idNota = $idNota";
            $sql_nota = str_ireplace("= ,", "= NULL,", $sql_nota);
            $sql_nota = str_ireplace("= .", "= NULL", $sql_nota);

            $this->driver->query($sql_nota);

            if (!$this->GetResultRow()) {
              $this->driver->rollback();
              var_dump("Fallo numero 1");
              break;
            }

            $sql_bitacora = "INSERT INTO bitacora_notas(id_bitacora,usuario_id,nota_id,fecha_bitacora,observacion_bitacora, notas_antiguas)
              VALUES(Null,$this->usuario_id,$idNota,NOW(), '$this->observacion','$notasAntiguas')";
            $sql_bitacora = str_ireplace("''", "NULL", $sql_bitacora);

            $this->driver->query($sql_bitacora);

            if (!$this->GetResultRow()) {
              $this->driver->rollback();
              var_dump("Fallo numero 2");
              break;
            }
          }
        } else {
          $operacion = "Registro";

          $sql_nota = "INSERT INTO nota(idNota, cedula_estudiante, periodo_escolar_id, seccion_id, materia_id, nota_lapso1, 
            nota_lapso2, nota_lapso3, nota_final, recuperativo_1, recuperativo_2, recuperativo_3, recuperativo_4, estatusNotas) 
            VALUES(NULL,'$this->cedula_estudiante',$this->id_periodo,$this->id_seccion,$idMateria,$nt1,$nt2,$nt3,$nt4,$rp1,$rp2,$rp3,$rp4,$this->estatus);";

          $sql_nota = str_ireplace(",,", ",NULL,", $sql_nota);
          $sql_nota = str_ireplace(",,", ",NULL,", $sql_nota);
          $sql_nota = str_ireplace(",,", ",NULL,", $sql_nota);
          $sql_nota = str_ireplace(",,", ",NULL,", $sql_nota);

          $this->driver->query($sql_nota);
          if (!$this->GetResultRow()) {
            $this->driver->rollback();
            var_dump("Fallo numero 3");
            break;
          }
        }
        if ($operacion == "Registro") {
          $id = $this->driver->lastInsertId();
          $sql_bitacora = "INSERT INTO bitacora_notas(id_bitacora,usuario_id,nota_id,fecha_bitacora,observacion_bitacora,notas_antiguas)
            VALUES(Null,$this->usuario_id,$id,NOW(), '$this->observacion','Nuevo Registro')";
          $sql_bitacora = str_ireplace("''", "NULL", $sql_bitacora);

          $this->driver->query($sql_bitacora);
          if (!$this->GetResultRow()) {
            $this->driver->rollback();
            var_dump("Fallo numero 4");
            break;
          }
        }
      }

      if (!$this->GetResultRow()) {
        $this->ResJSON("Registro de notas fallido!", "error");
      } else {
        $this->driver->commit();
        $this->ResJSON("Operacion Exitosa!", "success");
      }
    } catch (PDOException $e) {
      $this->driver->rollback();
      var_dump("Algo grave pasó");
      error_log("NotasModel(line0------) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida!", "error");
    }
  }

  public function promocion()
  {

    try {
      $this->StartTransaction();

      foreach ($this->materias as $materia) {
        $idNota = $materia['id_nota'];
        $sql_estado_notas = "UPDATE nota SET estatusNotas = 0 WHERE idNota = $idNota ;";

        $this->driver->query($sql_estado_notas);
        if (!$this->GetResultRow()) {
          $this->driver->rollback();
          break;
        }
      }

      if (!$this->GetResultRow()) {
        $this->ResJSON("Error al promocionar!", "error");
      }

      $sql = "SELECT seguimiento_estudiante FROM estudiante WHERE seguimiento_estudiante < 6 AND cedula_estudiante = '$this->cedula_estudiante' ";
      $consulta = $this->consult($sql);

      if (!isset($consulta[0])) {
        $this->desactiva_asignacion_seccion();
        $this->driver->commit();
        return $this->ResJSON("Este estudiante ya esta graduado!", "success");
      }
      // Promociona al estudiante al siguiente seccion
      $sql_seguimiento_estudiante = "UPDATE estudiante SET seguimiento_estudiante = (seguimiento_estudiante + 1) 
        WHERE cedula_estudiante = '$this->cedula_estudiante' ";
      // Desactiva la asignación de sección antigua
      $this->driver->query($sql_seguimiento_estudiante);
      $this->desactiva_asignacion_seccion();

      if (!$this->GetResultRow()) {
        $this->driver->rollback();
        return $this->ResJSON("Error al promocionar al estudiante!", "error");
      } else {
        $this->driver->commit();
        return $this->ResJSON("El estudiante con la cedula: $this->cedula_estudiante, ah aprobado el periodo escolar!", "success");
      }
    } catch (PDOException $e) {
      // error_log("NotasModel(54) => ".$e->getMessages());
      $this->ResJSON("Operacion Fallida! (error_log)", "error");
    }
  }

  private function desactiva_asignacion_seccion()
  {
    $slq_asignacion_seccion = "UPDATE asignacion_estudiante_seccion SET estatus_asig_estu = 0
        WHERE cedula_estu_asignacion = '$this->cedula_estudiante' ";

    $this->driver->query($slq_asignacion_seccion);
  }

  public function ChangeStatus()
  {
    try {
      $pdo = $this->driver->prepare("UPDATE materia SET estatus_materia = !estatus_materia WHERE id_materia = :id ;");
      $pdo->bindParam(':id', $this->id);

      if ($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
      else $this->ResJSON("Operacion Fallida!", "error");
    } catch (PDOException $e) {
      error_log("NotasModel(54) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida! (error_log)", "error");
    }
  }

  public function GetAll($idSeccion = '')
  {
    try {
      if ($idSeccion == '') $result = [];
      else $result = $this->consultAll("SELECT DISTINCT * FROM estudiante INNER JOIN asignacion_estudiante_seccion ON asignacion_estudiante_seccion.cedula_estu_asignacion = estudiante.cedula_estudiante 
          INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = asignacion_estudiante_seccion.id_periodo 
          INNER JOIN personas ON personas.cedula_persona = estudiante.cedula_estudiante
          WHERE periodo_escolar.estatus_periodo_escolar = '1' AND asignacion_estudiante_seccion.id_seccion = '$idSeccion'");

      if (isset($result[0])) $this->ResDataJSON($result);
      else $this->ResDataJSON([]);
    } catch (PDOException $e) {
      error_log("NotasModel(66) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida! (error_log)", "error");
    }
  }

  public function GetOne($cedula)
  {
    try {
      $result = $this->consult("SELECT * FROM nota WHERE cedula_estudiante = '$cedula' ;");

      if (isset($result[0])) $this->ResDataJSON($result);
      else $this->ResDataJSON([]);
    } catch (PDOException $e) {
      error_log("NotasModel(78) => " . $e->getMessages());
      $this->ResJSON("Operacion Fallida! (error_log)", "error");
    }
  }

  public function ConsultaDatosAcademicos($cedula)
  {
    $this->cedula_estudiante = $cedula;
    $periodo = $seccion = null;
    $sql_cedula_estudiante = "SELECT * FROM estudiante WHERE cedula_estudiante = '$this->cedula_estudiante' ";
    $result_cedula_estudiante = $this->consult($sql_cedula_estudiante);

    if (!isset($result_cedula_estudiante)) {
      $this->ResJSON("La cédula del estudiante no esta registrada", "error");
    }

    $sql_consulta_estudiante = "SELECT 
      personas.cedula_persona,
      personas.nombre_persona,
      personas.apellido_persona,
      seccion.idSeccion,seccion.ano_seguimiento,
      periodo_escolar.id_periodo_escolar,
      periodo_escolar.periodoescolar FROM personas
          INNER JOIN estudiante ON estudiante.cedula_estudiante = personas.cedula_persona
          INNER JOIN asignacion_estudiante_seccion ON asignacion_estudiante_seccion.cedula_estu_asignacion = estudiante.cedula_estudiante
          INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = asignacion_estudiante_seccion.id_periodo
          INNER JOIN seccion ON seccion.idSeccion = asignacion_estudiante_seccion.id_seccion WHERE
          periodo_escolar.estatus_periodo_escolar = 1 AND estudiante.cedula_estudiante = '$this->cedula_estudiante' ;";

    $result_consulta_estudiante = $this->consult($sql_consulta_estudiante);

    if (!isset($result_consulta_estudiante)) {
      $this->ResJSON("Operacion Fallida! El estudiante no esta registrado en una seccion en el periodo actual", "error");
    }

    $periodo = $result_consulta_estudiante['id_periodo_escolar'];
    $seccion = $result_consulta_estudiante['idSeccion'];
    $seguimiento = $result_consulta_estudiante['ano_seguimiento'];
    $seguimiento = intval($seguimiento);
    if ($seguimiento < 4){
      if($seguimiento == 1) $string = "materia.primero = 1";
      if($seguimiento == 2) $string = "materia.segundo = 1";
      if($seguimiento == 3) $string = "materia.tercero = 1";
      $clasificacion = 'B';
    }else{
      $clasificacion = 'D';
      if($seguimiento == 4) $string = "materia.cuarto = 1";
      if($seguimiento == 5) $string = "materia.quinto = 1";
      if($seguimiento == 6) $string = "materia.sexto = 1";
    }
    // $sql_pensum = "SELECT * FROM pensum WHERE anios_abarcados = '$clasificacion' ;";
    $resultPensum = $this->consultAll("SELECT materia.* FROM materia 
    INNER JOIN pensum ON pensum.id = materia.id_pensum_ma
    INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = materia.id_periodo_ma
    WHERE periodo_escolar.estatus_periodo_escolar = 1 AND pensum.anios_abarcados = '$clasificacion' AND $string;");

    if ($resultPensum == false) {
      $this->ResJSON("Operacion Fallida! No hay pensum para el año a trabajar", "error");
      return false;
    }

    $listaMaterias = [];
    foreach ($resultPensum as $materia) {
      array_push($listaMaterias, [
        'materia_id' => $materia['id_materia'],
        'des_materia' => $materia['des_materia'],
      ]);
    }

    $materias_estudiante = [];
    foreach ($listaMaterias as $materia) {
      $id_materia = $materia['materia_id'];
      $sql_notas_estudiante = "SELECT nota.idNota, nota.materia_id, materia.des_materia,nota.nota_lapso1,nota.nota_lapso2,
            nota.nota_lapso3,nota.nota_final,nota.recuperativo_1,nota.recuperativo_2,nota.recuperativo_3,nota.recuperativo_4
            ,nota.estatusNotas FROM nota INNER JOIN materia ON materia.id_materia = nota.materia_id WHERE
            nota.periodo_escolar_id = $periodo AND nota.materia_id = $id_materia AND nota.cedula_estudiante = '$this->cedula_estudiante';";
      $resultado = $this->consult($sql_notas_estudiante);

      if (isset($resultado['idNota'])) {
        array_push($materias_estudiante, [
          'idNota' => $resultado['idNota'],
          'materia_id' => $resultado['materia_id'],
          'des_materia' => $resultado['des_materia'],
          'estatus_nota' => $resultado['estatusNotas'],
          'nota_lapso1' => $resultado['nota_lapso1'],
          'nota_lapso2' => $resultado['nota_lapso2'],
          'nota_lapso3' => $resultado['nota_lapso3'],
          'nota_final' => $resultado['nota_final'],
          'recuperativo_1' => $resultado['recuperativo_1'],
          'recuperativo_2' => $resultado['recuperativo_2'],
          'recuperativo_3' => $resultado['recuperativo_3'],
          'recuperativo_4' => $resultado['recuperativo_4']
        ]);
      } else {
        array_push($materias_estudiante, [
          'idNota' => null,
          'materia_id' => $materia['materia_id'],
          'des_materia' => $materia['des_materia'],
          'estatus_nota' => 1,
          'nota_lapso1' => null,
          'nota_lapso2' => null,
          'nota_lapso3' => null,
          'nota_final' => null,
          'recuperativo_1' => null,
          'recuperativo_2' => null,
          'recuperativo_3' => null,
          'recuperativo_4' => null
        ]);
      }
    }
    $this->ResDataJSON([
      'materias' => $materias_estudiante,
      'estudiante' => $result_consulta_estudiante
    ]);
  }

  public function ConsultaParaPdf($cedula)
  {
    $sqlDatos = "SELECT * FROM estudiante
        INNER JOIN personas ON personas.cedula_persona = estudiante.cedula_estudiante 
        WHERE estudiante.cedula_estudiante = '$cedula';";

    $sqlNotasHistoricas = "SELECT *,pensum.cod_pensum FROM nota 
        INNER JOIN materia ON materia.id_materia = nota.materia_id 
        INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = nota.periodo_escolar_id 
        INNER JOIN seccion ON seccion.id_seccion = nota.seccion_id
        LEFT JOIN pensum ON pensum.periodo_id = periodo_escolar.id_periodo_escolar
        WHERE nota.estatusNotas = 0 AND nota.cedula_estudiante = '$cedula' GROUP BY nota.idNota ORDER BY nota.seccion_id;";
    
    $result_datos_estudiante = $this->consult($sqlDatos);
    $result_datos_notas = $this->consultAll($sqlNotasHistoricas);

    return [
      'datos' => $result_datos_estudiante,
      'notas' => $result_datos_notas
    ];
  }

  public function reportePorseccion($id_seccion, $id_periodo)
  {
    $datos = [];

    $sql = "SELECT * FROM nota 
      INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = nota.periodo_escolar_id
      INNER JOIN estudiante ON estudiante.cedula_estudiante = nota.cedula_estudiante
      INNER JOIN personas ON personas.cedula_persona = estudiante.cedula_estudiante
      WHERE nota.seccion_id = '$id_seccion' AND nota.periodo_escolar_id = '$id_periodo' 
      GROUP BY estudiante.cedula_estudiante;";
    $result = $this->consultAll($sql);

    foreach ($result as $estu) {
      $cedula = $estu['cedula_estudiante'];

      $sql2 = "SELECT * FROM nota INNER JOIN materia ON materia.id_materia = nota.materia_id WHERE 
        nota.seccion_id = '$id_seccion' AND 
        nota.periodo_escolar_id = '$id_periodo' AND 
        nota.estatusNotas = FALSE AND 
        nota.cedula_estudiante = '$cedula' GROUP BY nota.idNota";

      $result2 = $this->consultAll($sql2);
      array_push($datos, [
        'cedula' => $estu['nacionalidad_persona'] . '-' . $estu['cedula_estudiante'],
        'nombre' => $estu['nombre_persona'],
        'apellido' => $estu['apellido_persona'],
        'fec' => $estu['fecha_n_persona'],
        'lugar' => $estu['direccion_n_persona'],
        'notas' => $result2
      ]);
    }

    return $datos;
  }
}
