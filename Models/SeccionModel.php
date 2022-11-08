<?php
	require("db.php");

	class SeccionModel extends DB{
		private $id, $id_seccion, $anio, $status, $id_sec_periodo;

		public function __construct(){
			parent::__construct();
		}

		public function SetData($datos){
			$this->id = isset($datos['id']) ? $datos['id'] : null;
			$this->id_seccion = isset($datos['id_seccion']) ? $datos['id_seccion'] : $datos['anio'].strtoupper($datos['seccion']);
			$this->anio = isset($datos['anio']) ? intval($datos['anio']) : null;
			$this->status = isset($datos['estatus']) ? $datos['estatus'] : 1;
			$this->id_sec_periodo = isset($datos['id_periodo']) ?  $datos['id_periodo'] : null;
		}

		public function SaveDatos(){
			try{
				
				$result = $this->consult("SELECT * FROM seccion WHERE id_sec_periodo = $this->id_sec_periodo AND id_seccion = '$this->id_seccion';");

				if(!isset($result[0])){
					$pdo = $this->driver->prepare("
						INSERT INTO seccion(id_seccion,ano_seguimiento,estatus_seccion,id_sec_periodo) 
						VALUES(:id, :anio, :estatus, :id_periodo);");
					$pdo->bindParam(':id', $this->id_seccion);
					$pdo->bindParam(':anio', $this->anio);
					$pdo->bindParam(':estatus', $this->status);
					$pdo->bindParam(':id_periodo', $this->id_sec_periodo);

					if($pdo->execute()) $this->ResJSON("Operacion Exitosa!","success");
					else $this->ResJSON("Operacion Fallida!", "error");	
				}else $this->ResJSON("La seccion ingresada ya ha sido registrada", "error");

				
			}catch(PDOException $e){
				error_log("SeccionModel(28) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");
			}
		}

		// public function UpdateDatos(){
		// 	try{

		// 		$pdo = $this->driver->prepare("UPDATE seccion SET ")
		// 	}
		// }

		public function ChangeStatus(){
			try{
				$pdo = $this->driver->prepare("UPDATE seccion SET estatus_seccion = !estatus_seccion WHERE idSeccion = :id ;");
				$pdo->bindParam(':id', $this->id);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");
			}catch(PDOException $e){
				error_log("SeccionModel(54) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");
			}
		}

		public function GetAll(){
			try{
				$result = $this->consultAll("SELECT * FROM seccion 
					INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = seccion.id_sec_periodo 
					WHERE periodo_escolar.estatus_periodo_escolar = 1");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("SeccionModel(66) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}
		}

		public function GetOne($id){
			try{
				$result = $this->consult("SELECT * FROM seccion
				INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = seccion.id_sec_periodo WHERE id = '$id' ;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("SeccionModel(78) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}	
		}

		public function GetByAnio($anio){
			try{
				$result = $this->consultAll("SELECT * FROM seccion
					INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = seccion.id_sec_periodo 
					WHERE estatus_seccion = 1 AND ano_seguimiento = $anio ;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);

			}catch(PDOException $e){
				error_log("SeccionModel(78) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}
		}
	}