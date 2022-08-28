<?php 
	require("db.php");

	class PeriodoModel extends DB{
		private $id, $periodoescolar, $fecha_inicio, $fecha_cierre, $estatus;

		public function __construct(){
			parent::__construct();
		}

		public function SetData($datos){
			$this->id = isset($datos['id']) ? $datos['id'] : null;
			$this->periodoescolar = isset($datos['periodoescolar']) ? $datos['periodoescolar'] : null;
			$this->fecha_inicio = isset($datos['fecha_inicio']) ? $datos['fecha_inicio'] : null;
			$this->fecha_cierre = isset($datos['fecha_cierre']) ? $datos['fecha_cierre'] : null;
			$this->estatus = isset($datos['estatus']) ? $datos['estatus'] : null;
		}

		public function SaveDatos(){
			try{

				$result = $this->consult("SELECT * FROM periodo_escolar WHERE estatus_periodo_escolar = 1;");
				if(!isset($result[0])) $estatus = 1; else $estatus = 0;

				$result2 = $this->consult("SELECT * FROM periodo_escolar WHERE '$this->fecha_inicio' >= fecha_inicio AND '$this->fecha_inicio' <= fecha_cierre; ");

				if(isset($result2[0])){
					return $this->ResJSON("Las fechas de los periodos colisionan","error");
				}

				$pdo = $this->driver->prepare("INSERT INTO periodo_escolar(periodoescolar, fecha_inicio, fecha_cierre, estatus_periodo_escolar) VALUES(:periodo, :fecha_inicio, :fecha_cierre, :estatus);");

				$pdo->bindParam(':periodo', $this->periodoescolar);
				$pdo->bindParam(':fecha_inicio', $this->fecha_inicio);
				$pdo->bindParam(':fecha_cierre', $this->fecha_cierre);
				$pdo->bindParam(':estatus', $estatus);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");

			}catch(PDOException $e){
				error_log("PeriodoModel(line0------) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida!", "error");
			}
		}

		public function UpdateDatos(){
			try{
				$pdo = $this->driver->prepare("UPDATE periodo_escolar SET des_materia = :descripcion WHERE id_periodo_escolar = :id ;");
				$pdo->bindParam(':descripcion', $this->des_materia);
				$pdo->bindParam(':id', $this->id);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");

			}catch(PDOException $e){
				error_log("PeriodoModel(line1------) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida!", "error");
			}	
		}

		public function ChangeStatus(){
			try{
				$pdo = null;
				$result = $this->consult("SELECT estatus_periodo_escolar FROM periodo_escolar WHERE id_periodo_escolar = '$this->id' ");
				if($result['estatus_periodo_escolar'] == 0){
					$result = $this->consult("SELECT * FROM periodo_escolar WHERE estatus_periodo_escolar = 1 AND id_periodo_escolar != '$this->id' ");

					if(!isset($result[0])){
						$pdo = $this->driver->prepare("UPDATE periodo_escolar SET estatus_periodo_escolar = 1 WHERE id_periodo_escolar = :id ;");
						$pdo->bindParam(':id', $this->id);
						if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
						else $this->ResJSON("Operacion Fallida!", "error");
					}else $this->ResJSON("No se pueden tener dos periodos escolares activos!", "error");
					
				}else{
					$pdo = $this->driver->prepare("UPDATE periodo_escolar SET estatus_periodo_escolar = 0 WHERE id_periodo_escolar = :id ;");
					$pdo->bindParam(':id', $this->id);
					if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
					else $this->ResJSON("Operacion Fallida!", "error");
				}
				
			}catch(PDOException $e){
				error_log("PeriodoModel(58) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");
			}
		}

		public function GetAll(){
			try{
				$result = $this->consultAll("SELECT * FROM periodo_escolar");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("PeriodoModel(70) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}
		}

		public function GetOne($id){
			try{
				$result = $this->consult("SELECT * FROM periodo_escolar WHERE id_periodo_escolar = '$id' ;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("SeccionModel(82) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}	
		}

		public function GetActivo(){
			try{
				$result = $this->consult("SELECT * FROM periodo_escolar WHERE estatus_periodo_escolar = 1;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("SeccionModel(94) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}	
		}
	}