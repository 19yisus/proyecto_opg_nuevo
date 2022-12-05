<?php
// require("db.php");

class DirectorModel extends DB
{
	private $cedula_director, $estatus_director, $id_seccion, $id_periodo, $id_materia;

	public function __construct()
	{
		parent::__construct();
	}

	public function SetData($datos)
	{
		$this->cedula_director = isset($datos['cedula']) ? $datos['cedula'] : null;
		$this->estatus_director = isset($datos['estatus_director']) ? $datos['estatus_director'] : null;
	}

	public function SaveDatos()
	{
		try {
			$result = $this->consult("SELECT * FROM director WHERE estatus_director = 1;");
			if (!isset($result[0])) $estatus = 1;
			else $estatus = 0;

			$pdo = $this->driver->prepare("INSERT INTO director(cedula_director, estatus_director) VALUES(:cedula_director, :estatus);");
			$pdo->bindParam(':cedula_director', $this->cedula_director);
			$pdo->bindParam(':estatus', $estatus);

			// if($pdo->execute()) return true; else return false;
			if ($pdo->execute()) {
				$this->registrar_bitacora_sistema([
					'table' => "director",
					'descripcion' => "REGISTRO",
					'id_registro' => $this->cedula_director
				]);
				$this->ResJSON("Operacion Exitosa!", "success");
			} else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("ProfesorModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function UpdateDatos()
	{
		try {
			$pdo = $this->driver->prepare("UPDATE director SET des_materia = :descripcion WHERE id_materia = :id ;");
			$pdo->bindParam(':descripcion', $this->des_materia);
			$pdo->bindParam(':id', $this->id);

			if ($pdo->execute()) {
				$this->registrar_bitacora_sistema([
					'table' => "director",
					'descripcion' => "CAMBIO DE ESTATUS",
					'id_registro' => $this->cedula_director
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



			// if ($pdo->execute()) {
			// 	$this->registrar_bitacora_sistema([
			// 		'table' => "director",
			// 		'descripcion' => "CAMBIO DE ESTATUS",
			// 		'id_registro' => $this->cedula_director
			// 	]);
			// 	$this->ResJSON("Operacion Exitosa!", "success");
			// } else $this->ResJSON("Operacion Fallida!", "error");

			$result = $this->consult("SELECT estatus_director FROM director WHERE cedula_director = '$this->cedula_director' ");
			if ($result['estatus_director'] == 0) {
				$result2 = $this->consult("SELECT estatus_director FROM director WHERE estatus_director = 1 AND cedula_director != '$this->cedula_director' ");
				if (!isset($result2[0])) {
					$pdo = $this->driver->prepare("UPDATE director SET estatus_director = 1 WHERE cedula_director = :cedula ;");
					$pdo->bindParam(':cedula', $this->cedula_director);
					if ($pdo->execute()) {
						$this->registrar_bitacora_sistema([
							'table' => "director",
							'descripcion' => "CAMBIO DE ESTATUS",
							'id_registro' => $this->cedula_director
						]);
						$this->ResJSON("Operacion Exitosa!", "success");
					} else $this->ResJSON("Operacion Fallida!", "error");
				} else $this->ResJSON("No se pueden tener a dos directores activos!", "error");
			} else {
				$pdo = $this->driver->prepare("UPDATE director SET estatus_director = 0 WHERE cedula_director = :cedula ;");
				$pdo->bindParam(':cedula', $this->cedula_director);

				if ($pdo->execute()) {
					$this->registrar_bitacora_sistema([
						'table' => "director",
						'descripcion' => "CAMBIO DE ESTATUS",
						'id_registro' => $this->cedula_director
					]);
					$this->ResJSON("Operacion Exitosa!", "success");
				} else $this->ResJSON("Operacion Fallida!", "error");
			}
		} catch (PDOException $e) {
			error_log("ProfesorModel(54) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetAll()
	{
		try {
			$result = $this->consultAll("SELECT * FROM director 
					INNER JOIN personas ON personas.cedula_persona = director.cedula_director;");

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
			$datosProfesor = $this->consult("SELECT * FROM director
					INNER JOIN personas ON personas.cedula_persona = director.cedula_director WHERE cedula_director = '$id' ;");

			if (isset($datosProfesor[0])) $this->ResDataJSON(['profesor' => $datosProfesor]);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("ProfesorModel(78) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}
}
