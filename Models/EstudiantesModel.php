<?php
// require("db.php");

class EstudiantesModel extends DB
{
	private $cedula_estudiante, $estatus_estudiante, $seguimiento_estudiante, $id_seccion, $id_periodo;

	public function __construct()
	{
		parent::__construct();
		session_start();
	}

	public function SetData($datos)
	{
		$this->cedula_estudiante = isset($datos['cedula']) ? $datos['cedula'] : null;
		$this->estatus_estudiante = isset($datos['estatus_estudiante']) ? $datos['estatus_estudiante'] : null;
		$this->seguimiento_estudiante = isset($datos['seguimiento_estudiante']) ? $datos['seguimiento_estudiante'] : 0;
		$this->id_seccion = isset($datos['id_seccion']) ? $datos['id_seccion'] : null;
		$this->id_periodo = isset($datos['id_periodo']) ? $datos['id_periodo'] : null;
	}

	public function SaveDatos()
	{
		try {
			$pdo = $this->driver->prepare("INSERT INTO estudiante(cedula_estudiante, seguimiento_estudiante, estatus_estudiante) VALUES(:cedula_estudiante, :seguimiento, 1);");
			$pdo->bindParam(':cedula_estudiante', $this->cedula_estudiante);
			$pdo->bindParam(':seguimiento', $this->seguimiento_estudiante);

			// if ($pdo->execute()) return true;
			// else return false;
			if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
			else $this->ResJSON("Operacion Fallida!", "error");

		} catch (PDOException $e) {
			error_log("MateriasModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function AsignarEstudiante()
	{
		try {

			if ($_SESSION["id_rol"] != "1") {
				$consult_fecha = $this->consult("SELECT id_periodo_escolar FROM periodo_escolar WHERE fecha_inicio >= (SELECT MAX(fecha_inicio) FROM periodo_escolar)");

				if ($consult_fecha["id_periodo_escolar"] != $this->id_periodo) {
					return $this->ResJSON("No se puede asignar al estudiante a un perido escolar anterior!", "error");
				}
			}

			$consult = $this->consult("SELECT * FROM asignacion_estudiante_seccion WHERE id_periodo = '$this->id_periodo' AND cedula_estu_asignacion = '$this->cedula_estudiante'");

			if (!isset($consult[0])) {
				$pdo = $this->driver->prepare("INSERT INTO asignacion_estudiante_seccion(cedula_estu_asignacion, id_seccion, id_periodo, estatus_asig_estu) VALUES(:cedula_estudiante, :id_seccion, :id_periodo, 1)");
				$pdo->bindParam(':cedula_estudiante', $this->cedula_estudiante);
				$pdo->bindParam(':id_seccion', $this->id_seccion);
				$pdo->bindParam(':id_periodo', $this->id_periodo);

				if ($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");
			} else {
				$this->ResJSON("Operacion Fallida! No se pueden realizar dos asignaciones en un mismo periodo escolar", "error");
			}
		} catch (PDOException $e) {
			error_log("MateriasModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function UpdateDatos()
	{
		try {
			$pdo = $this->driver->prepare("UPDATE estudiante SET des_materia = :descripcion WHERE id_materia = :id ;");
			$pdo->bindParam(':descripcion', $this->des_materia);
			$pdo->bindParam(':id', $this->id);

			if ($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
			else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("MateriasModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function ChangeStatus()
	{
		try {
			$pdo = $this->driver->prepare("UPDATE estudiante SET estatus_estudiante = !estatus_estudiante WHERE cedula_estudiante = :cedula ;");
			$pdo->bindParam(':cedula', $this->cedula_estudiante);

			if ($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
			else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("MateriasModel(54) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetAll($periodo)
	{
		try {
			if ($periodo != null) {
				$result = $this->consultAll("SELECT  
						estudiante.*, personas.*,
						asignacion_estudiante_seccion.estatus_asig_estu,
						seccion.id_seccion
							FROM estudiante 
						INNER JOIN personas ON estudiante.cedula_estudiante = personas.cedula_persona
						INNER JOIN asignacion_estudiante_seccion ON asignacion_estudiante_seccion.cedula_estu_asignacion = estudiante.cedula_estudiante
						INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = asignacion_estudiante_seccion.id_periodo 
						INNER JOIN seccion ON seccion.idSeccion = asignacion_estudiante_seccion.id_seccion
						WHERE periodo_escolar.id_periodo_escolar = $periodo;");
			} else {
				$result = $this->consultAll("SELECT  
						estudiante.*, personas.*,
						asignacion_estudiante_seccion.estatus_asig_estu,
						seccion.id_seccion
						FROM estudiante 
						INNER JOIN personas ON estudiante.cedula_estudiante = personas.cedula_persona
						LEFT JOIN asignacion_estudiante_seccion ON asignacion_estudiante_seccion.cedula_estu_asignacion = estudiante.cedula_estudiante
						LEFT JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = asignacion_estudiante_seccion.id_periodo 
						LEFT JOIN seccion ON seccion.idSeccion = asignacion_estudiante_seccion.id_seccion
						;");
						// WHERE periodo_escolar.estatus_periodo_escolar = 1
			}


			if (isset($result[0])) $this->ResDataJSON($result);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("MateriasModel(66) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetOne($id)
	{
		try {
			$result = $this->consult("SELECT * FROM estudiante
			INNER JOIN personas ON estudiante.cedula_estudiante = personas.cedula_persona
			LEFT JOIN asignacion_estudiante_seccion ON asignacion_estudiante_seccion.cedula_estu_asignacion = estudiante.cedula_estudiante
			WHERE estudiante.cedula_estudiante = '$id';");
			// asignacion_estudiante_seccion.cedula_estu_asignacion = '$id' AND 
			// personas.cedula_persona = '$id' AND 
			// 	estudiante.cedula_estudiante = '$id'
			if (isset($result[0])) $this->ResDataJSON($result);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("SeccionModel(78) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}
}
