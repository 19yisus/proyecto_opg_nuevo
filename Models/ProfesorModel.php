<?php
// require("db.php");

class ProfesorModel extends DB
{
	private $cedula_profesor, $estatus_profesor, $id_seccion, $id_periodo, $id_materia;

	public function __construct()
	{
		parent::__construct();
	}

	public function SetData($datos)
	{
		$this->cedula_profesor = isset($datos['cedula']) ? $datos['cedula'] : null;
		$this->estatus_profesor = isset($datos['estatus_profesor']) ? $datos['estatus_profesor'] : null;
		$this->id_periodo = isset($datos['id_periodo']) ? $datos['id_periodo'] : null;
		$this->id_seccion = isset($datos['id_seccion']) ? $datos['id_seccion'] : null;
		$this->id_materia = isset($datos['id_materia']) ? $datos['id_materia'] : null;
	}

	public function SaveDatos()
	{
		try {
			// $result = $this->consult("SELECT * FROM profesor WHERE estatus_profesor = 1;");
			// if (!isset($result[0])) $estatus = 1;
			// else $estatus = 0;

			$pdo = $this->driver->prepare("INSERT INTO profesor(cedula_profesor, estatus_profesor) VALUES(:cedula_profesor, 1);");
			$pdo->bindParam(':cedula_profesor', $this->cedula_profesor);
			// $pdo->bindParam(':estatus', 1);

			// if($pdo->execute()) return true; else return false;
			if ($pdo->execute()) {
				$this->registrar_bitacora_sistema([
					'table' => "profesor",
					'descripcion' => "REGISTRO",
					'id_registro' => $this->cedula_profesor
				]);
				$this->ResJSON("Operacion Exitosa!", "success");
			} else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("ProfesorModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function AsignarProfesor()
	{
		try {
			$status = true;
			$this->driver->query("UPDATE asignacion_profesor_seccion SET estatus_asignacion = 0 
				WHERE profesor_cedula = '$this->cedula_profesor' AND periodo_id != '$this->id_periodo' ;");

			$this->driver->query("DELETE FROM asignacion_profesor_seccion WHERE periodo_id = '$this->id_periodo' AND profesor_cedula = '$this->cedula_profesor' ;");

			for ($i = 0; $i < sizeof($this->id_materia); $i++) {

				// var_dump($this->id_materia, $this->id_materia[$i]);

				$pdo = $this->driver->prepare("INSERT INTO asignacion_profesor_seccion(profesor_cedula, materia_id, seccion_id, periodo_id, estatus_asignacion) 
					VALUES(:cedula_profesor, :id_materia, :id_seccion, :id_periodo, 1)");
				$pdo->bindParam(':cedula_profesor', $this->cedula_profesor);
				$pdo->bindParam(':id_materia', $this->id_materia[$i]);
				$pdo->bindParam(':id_seccion', $this->id_seccion[$i]);
				$pdo->bindParam(':id_periodo', $this->id_periodo);
				$result = $pdo->execute();
				$this->registrar_bitacora_sistema([
					'table' => "asignacion_profesor_seccion",
					'descripcion' => "ASIGNACIÓN DEL PROFESOR CON LA CEDULA '$this->cedula_profesor' ",
					'id_registro' => $this->cedula_profesor
				]);

				if (!$result) {
					// var_dump($this->id_seccion[$i]);
					// var_dump($this->id_materia[$i]);
					// var_dump("INSERT INTO asignacion_profesor_seccion(profesor_cedula, materia_id, seccion_id, periodo_id, estatus_asignacion) 
					// VALUES(:cedula_profesor, :id_materia, :id_seccion, :id_periodo, 1)");
					// die("HUBO un fallo");
					$estatus = false;
					break;
				}
			}

			if ($status) $this->ResJSON("Operacion Exitosa!", "success");
			else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("ProfesorModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function UpdateDatos()
	{
		try {
			$pdo = $this->driver->prepare("UPDATE profesor SET des_materia = :descripcion WHERE id_materia = :id ;");
			$pdo->bindParam(':descripcion', $this->des_materia);
			$pdo->bindParam(':id', $this->id);

			if ($pdo->execute()) {
				$this->registrar_bitacora_sistema([
					'table' => "director",
					'descripcion' => "CAMBIO DE ESTATUS",
					'id_registro' => $this->cedula_profesor
				]);
				$this->ResJSON("Operacion Exitosa!", "success");
			} else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("ProfesorModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function ChangeStatus()
	{
		try {

			$pdo = $this->driver->prepare("UPDATE profesor SET estatus_profesor = !estatus_profesor WHERE cedula_profesor = :cedula ;");
			$pdo->bindParam(':cedula', $this->cedula_profesor);

			if ($pdo->execute()) {
				$this->registrar_bitacora_sistema([
					'table' => "director",
					'descripcion' => "CAMBIO DE ESTATUS",
					'id_registro' => $this->cedula_profesor
				]);
				$this->ResJSON("Operacion Exitosa!", "success");
			} else $this->ResJSON("Operacion Fallida!", "error");

			// $result = $this->consult("SELECT estatus_profesor FROM profesor WHERE cedula_profesor = '$this->cedula_profesor' ");
			// if ($result['estatus_profesor'] == 0) {
			// 	$result2 = $this->consult("SELECT estatus_profesor FROM profesor WHERE estatus_profesor = 1 AND cedula_profesor != '$this->cedula_profesor' ");
			// 	if (!isset($result2[0])) {
			// 	} else $this->ResJSON("No se pueden tener a dos directores activos!", "error");
			// } else {
			// 	$pdo = $this->driver->prepare("UPDATE profesor SET estatus_profesor = 0 WHERE cedula_profesor = :cedula ;");
			// 	$pdo->bindParam(':cedula', $this->cedula_profesor);

			// 	if ($pdo->execute()) {
			// 		$this->registrar_bitacora_sistema([
			// 			'table' => "director",
			// 			'descripcion' => "CAMBIO DE ESTATUS",
			// 			'id_registro' => $this->cedula_profesor
			// 		]);
			// 		$this->ResJSON("Operacion Exitosa!", "success");
			// 	} else $this->ResJSON("Operacion Fallida!", "error");
			// }
		} catch (PDOException $e) {
			error_log("ProfesorModel(54) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetAll($id_periodo)
	{
		try {
			// if($id_periodo != null){
			// 	$result = $this->consultAll("SELECT * FROM profesor 
			// 	INNER JOIN personas ON profesor.cedula_profesor = personas.cedula_persona
			// 	INNER JOIN asignacion_profesor_seccion ON asignacion_profesor_seccion.profesor_cedula = profesor.cedula_profesor
			// 	INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = asignacion_profesor_seccion.periodo_id 
			// 	INNER JOIN materia  ON asignacion_profesor_seccion.materia_id = materia.id_materia
			// 	WHERE periodo_escolar.id_periodo_escolar = $id_periodo;");
			// }else{
			// 	$result = $this->consultAll("SELECT * FROM profesor 
			// 	INNER JOIN personas ON profesor.cedula_profesor = personas.cedula_persona
			// 	INNER JOIN asignacion_profesor_seccion ON asignacion_profesor_seccion.profesor_cedula = profesor.cedula_profesor
			// 	INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = asignacion_profesor_seccion.periodo_id 
			// 	INNER JOIN materia  ON asignacion_profesor_seccion.materia_id = materia.id_materia
			// 	WHERE periodo_escolar.estatus_periodo_escolar = 1;");
			// }

			$result = $this->consultAll("SELECT * FROM profesor 
					INNER JOIN personas ON personas.cedula_persona = profesor.cedula_profesor
					LEFT JOIN asignacion_profesor_seccion ON asignacion_profesor_seccion.profesor_cedula = profesor.cedula_profesor 
					GROUP BY  profesor.cedula_profesor;");

			if (isset($result[0])) $this->ResDataJSON($result);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("ProfesorModel(66) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetOne($id)
	{
		try {
			$datosProfesor = $this->consult("SELECT * FROM profesor
					INNER JOIN personas ON personas.cedula_persona = profesor.cedula_profesor WHERE cedula_profesor = '$id' ;");

			$datosAsignaciones = $this->consultAll("SELECT * FROM profesor
					INNER JOIN asignacion_profesor_seccion ON asignacion_profesor_seccion.profesor_cedula = profesor.cedula_profesor
					INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = asignacion_profesor_seccion.periodo_id
					INNER JOIN materia ON materia.id_materia = asignacion_profesor_seccion.materia_id
					INNER JOIN seccion ON seccion.id_seccion = asignacion_profesor_seccion.seccion_id
					WHERE profesor.cedula_profesor = '$id' AND periodo_escolar.estatus_periodo_escolar = 1 GROUP BY asignacion_profesor_seccion.id_asignacion;");

			if (isset($datosProfesor[0])) $this->ResDataJSON(['profesor' => $datosProfesor, 'Asignaciones' => $datosAsignaciones]);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("ProfesorModel(78) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function VerificarMateriasRepetidas($cedula, $id_materia, $id_seccion)
	{
		try {

			$result = $this->consult("SELECT * FROM asignacion_profesor_seccion 
					INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = asignacion_profesor_seccion.periodo_id 
					WHERE asignacion_profesor_seccion.materia_id = '$id_materia' AND asignacion_profesor_seccion.seccion_id = '$id_seccion' AND asignacion_profesor_seccion.profesor_cedula != '$cedula' AND periodo_escolar.id_periodo_escolar = asignacion_profesor_seccion.periodo_id");

			if (isset($result[0])) $this->ResDataJSON($result);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("ProfesorModel(78) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}
}
