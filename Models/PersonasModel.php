<?php
require("db.php");

class PersonasModel extends DB
{
	public $cedula_persona, $nombre_persona, $apellido_persona, $nacionalidad_persona, $sexo_persona, $fecha_n_persona, $direccion_persona, $telefono_persona, $direccion_n_persona, $correo_persona;
	public $pais, $entidad, $municipio;

	public function __construct()
	{
		parent::__construct();
	}

	public function SetData($datos)
	{
		$this->cedula_persona = isset($datos['cedula']) ? $datos['cedula'] : null;
		$this->nombre_persona = isset($datos['nombre']) ? $datos['nombre'] : null;
		$this->apellido_persona = isset($datos['apellido']) ? $datos['apellido'] : null;
		$this->nacionalidad_persona = isset($datos['nacionalidad']) ? $datos['nacionalidad'] : null;
		$this->sexo_persona = isset($datos['sexo']) ? $datos['sexo'] : null;
		$this->fecha_n_persona = isset($datos['fecha_n_persona']) ? $datos['fecha_n_persona'] : null;
		$this->direccion_persona = isset($datos['direccion']) ? $datos['direccion'] : "nohay";
		$this->telefono_persona = isset($datos['telefono_persona']) ? $datos['telefono_persona'] : null;
		$this->direccion_n_persona = isset($datos['direccion_n_persona']) ? $datos['direccion_n_persona'] : null;
		$this->correo_persona = isset($datos['correo_persona']) ? $datos['correo_persona'] : null;
		$this->pais = isset($datos['pais']) ? $datos['pais'] : null;
		$this->entidad = isset($datos['estado']) ? $datos['estado'] : null;
		$this->municipio = isset($datos['municipio']) ? $datos['municipio'] : null;
	}

	public function SaveDatos()
	{
		try {
			$pdo = $this->driver->prepare("
				INSERT INTO personas(cedula_persona, nombre_persona, apellido_persona, 
				nacionalidad_persona, sexo_persona, correo_persona, fecha_n_persona, direccion_persona, 
				telefono_persona, direccion_n_persona, pais, entidad_federal, municipio) 
				
				VALUES(:cedula, :nombre, :apellido, :nacionalidad, :sexo, 
				:correo, :fecha_nacimiento, :direccion_persona, :telefono, :direccion_nacimiento,
				:pais, :entidad, :municipio)");

			$pdo->bindParam(':cedula', $this->cedula_persona);
			$pdo->bindParam(':nombre', $this->nombre_persona);
			$pdo->bindParam(':apellido', $this->apellido_persona);
			$pdo->bindParam(':nacionalidad', $this->nacionalidad_persona);
			$pdo->bindParam(':direccion_nacimiento', $this->direccion_n_persona);
			$pdo->bindParam(':sexo', $this->sexo_persona);
			$pdo->bindParam(':correo', $this->correo_persona);
			$pdo->bindParam(':fecha_nacimiento', $this->fecha_n_persona);
			$pdo->bindParam(':direccion_persona', $this->direccion_persona);
			$pdo->bindParam(':telefono', $this->cedula_persona);
			$pdo->bindParam(':pais', $this->pais);
			$pdo->bindParam(':entidad', $this->entidad);
			$pdo->bindParam(':municipio', $this->municipio);


			if ($pdo->execute()) {
				$this->registrar_bitacora_sistema([
					'table' => "personas",
					'descripcion' => "REGISTRO",
					'id_registro' => $this->cedula_persona
				]);
				return true;
			} else return false;
		} catch (PDOException $e) {
			error_log("PersonasModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function UpdateDatos()
	{
		try {
			$pdo = $this->driver->prepare("UPDATE personas SET 
					nombre_persona = :nombre, apellido_persona = :apellido, direccion_persona = :direccion, direccion_n_persona = :nacimiento_persona, fecha_n_persona = :fecha_nacimiento, correo_persona = :correo, sexo_persona = :sexo, telefono_persona = :telefono  WHERE cedula_persona = :cedula ;");
			$pdo->bindParam(':cedula', $this->cedula_persona);
			$pdo->bindParam(':nombre', $this->nombre_persona);
			$pdo->bindParam(':apellido', $this->apellido_persona);
			$pdo->bindParam(':direccion', $this->direccion_persona);
			$pdo->bindParam(':nacimiento_persona', $this->direccion_n_persona);
			$pdo->bindParam(':fecha_nacimiento', $this->fecha_n_persona);
			$pdo->bindParam(':correo', $this->correo_persona);
			$pdo->bindParam(':sexo', $this->sexo_persona);
			$pdo->bindParam(':telefono', $this->telefono_persona);

			if ($pdo->execute()) {
				$this->registrar_bitacora_sistema([
					'table' => "personas",
					'descripcion' => "ACTUALIZACION",
					'id_registro' => $this->cedula_persona
				]);
				$this->ResJSON("Operacion Exitosa!", "success");
			} else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("PersonasModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function ChangeStatus()
	{
		try {
			$pdo = $this->driver->prepare("UPDATE materia SET estatus_materia = !estatus_materia WHERE id_materia = :id ;");
			$pdo->bindParam(':id', $this->id);

			if ($pdo->execute()) {
				// $this->registrar_bitacora_sistema([
				// 	'table' => "personas",
				// 	'descripcion' => "CAMBIO DE ESTATUS",
				// 	'id_registro' => $this->cedula_persona
				// ]);
				$this->ResJSON("Operacion Exitosa!", "success");
			} else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("PersonasModel(54) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetAll()
	{
		try {
			$result = $this->consultAll("SELECT * FROM materia");

			if (isset($result[0])) $this->ResDataJSON($result);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("PersonasModel(66) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetOne($id)
	{
		try {
			$result = $this->consult("SELECT * FROM personas WHERE cedula_persona = '$id';");

			if (isset($result[0])) $this->ResDataJSON($result);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("SeccionModel(78) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}
}
