<?php
require("db.php");

class PensumModel extends DB
{
	public $id, $anios_abarcados, $materias, $code_pecod_pensumnsum, $id_periodo, $id_materia1, $id_materia2, $id_materia3, $id_materia4, $id_materia5, $id_materia6, $id_materia7, $id_materia8, $id_materia9, $id_materia10, $id_materia11, $id_materia12;

	public function __construct()
	{
		parent::__construct();
	}

	public function SetData($datos, $materias = [])
	{
		$this->id = isset($datos['id']) ? $datos['id'] : null;
		$this->id_periodo = isset($datos['id_periodo']) ? $datos['id_periodo'] : null;
		$this->cod_pensum = isset($datos['cod_pensum']) ? strtoupper($datos['cod_pensum']) : null;
		$this->anios_abarcados = isset($datos['anios_abarcados']) ? $datos['anios_abarcados'] : null;
		$this->materias = $materias;
	}

	public function SaveDatos()
	{
		try {
			$this->StartTransaction();
			$result = $this->consult("SELECT * FROM pensum WHERE periodo_id = '$this->id_periodo' AND 
				anios_abarcados = '$this->anios_abarcados' AND estatus_pensum = 1;");
			if (isset($result[0])) return $this->ResJSON("No se pueden duplicar las pensums en el mismo periodo", "error");

			$sql = "INSERT INTO pensum(cod_pensum,anios_abarcados,periodo_id,estatus_pensum) 
					VALUES('$this->cod_pensum','$this->anios_abarcados',$this->id_periodo,1);";

			$pdo = $this->driver->prepare($sql);
			$pdo->execute();
			$id_pensum = $this->driver->lastInsertId();

			foreach ($this->materias as $item) {
				$pdo2 = $this->driver->prepare("INSERT INTO materia(
					des_materia, estatus_materia, id_periodo_ma, id_pensum_ma,primero,segundo,tercero,cuarto,quinto,sexto) 
				VALUES(
					:descripcion, 1, :periodo, :pensum, :pri, :seg, :ter, :cuar, :quin, :sext
					);");
				$pdo2->bindParam(':descripcion', $item['des']);
				$pdo2->bindParam(':periodo', $this->id_periodo);
				$pdo2->bindParam(':pensum', $id_pensum);
				$pdo2->bindParam(':pri', $item['primero']);
				$pdo2->bindParam(':seg', $item['segundo']);
				$pdo2->bindParam(':ter', $item['tercero']);
				$pdo2->bindParam(':cuar', $item['cuarto']);
				$pdo2->bindParam(':quin', $item['quinto']);
				$pdo2->bindParam(':sext', $item['sexto']);

				$res = $pdo2->execute();
			}

			if ($res) {
				$this->driver->commit();
				$this->ResJSON("Operacion Exitosa!", "success");
			} else {
				$this->driver->rollback();
				$this->ResJSON("Operacion Fallida!", "error");
			}
		} catch (PDOException $e) {
			error_log("PensumModel(line 58------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function UpdateDatos()
	{
		try {
			$pdo = $this->driver->prepare("UPDATE pensum SET des_materia = :descripcion WHERE id_materia = :id ;");
			$pdo->bindParam(':descripcion', $this->des_materia);
			$pdo->bindParam(':id', $this->id);

			if ($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
			else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("PensumModel(line0------) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida!", "error");
		}
	}

	public function ChangeStatus()
	{
		try {
			$pdo = $this->driver->prepare("UPDATE pensum SET estatus_pensum = !estatus_pensum WHERE id = :id ;");
			$pdo->bindParam(':id', $this->id);

			if ($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
			else $this->ResJSON("Operacion Fallida!", "error");
		} catch (PDOException $e) {
			error_log("PensumModel(54) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetAll()
	{
		try {
			$result = $this->consultAll("SELECT * FROM pensum 
			INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = pensum.periodo_id WHERE periodo_escolar.estatus_periodo_escolar = 1");

			if (isset($result[0])) $this->ResDataJSON($result);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("PensumModel(66) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetOne($id)
	{
		try {
			$result = $this->consult("SELECT * FROM pensum INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = pensum.periodo_id WHERE id = '$id' ;");

			if (isset($result[0])) $this->ResDataJSON($result);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("PensumModel(78) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}

	public function GetPensumPorAnio($anio)
	{
		try {
			$lista_materias = [];
			if ($anio < 4) $anio = "B";
			else if ($anio < 6) $anio = "D";
			else $anio = "E";
			$lista_materias = $this->consultAll("SELECT materia.* FROM materia INNER JOIN pensum ON pensum.id = materia.id_pensum_ma WHERE pensum.anios_abarcados = '$anio' ;");

			if (isset($lista_materias[0]) && $lista_materias[0]) $this->ResDataJSON($lista_materias);
			else $this->ResDataJSON([]);
		} catch (PDOException $e) {
			error_log("PensumModel(78) => " . $e->getMessages());
			$this->ResJSON("Operacion Fallida! (error_log)", "error");
		}
	}
}
