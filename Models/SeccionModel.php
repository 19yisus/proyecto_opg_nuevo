<?php
	require("db.php");

	class SeccionModel extends DB{
		private $id, $anio, $status;

		public function __construct(){
			parent::__construct();
		}

		public function SetData($datos){
			$this->id = isset($datos['id']) ? $datos['id'] : $datos['anio'].strtoupper($datos['seccion']);
			$this->anio = isset($datos['anio']) ? intval($datos['anio']) : null;
			$this->status = isset($datos['estatus']) ? $datos['estatus'] : 1;
		}

		public function SaveDatos(){
			try{
				
				$result = $this->consult("SELECT * FROM seccion WHERE id_seccion = '$this->id';");

				if(!isset($result[0])){
					$pdo = $this->driver->prepare("INSERT INTO seccion(id_seccion,ano_seguimiento,estatus_seccion) VALUES(:id, :anio, :estatus);");
					$pdo->bindParam(':id', $this->id);
					$pdo->bindParam(':anio', $this->anio);
					$pdo->bindParam(':estatus', $this->status);

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
				$pdo = $this->driver->prepare("UPDATE seccion SET estatus_seccion = !estatus_seccion WHERE id_seccion = :id ;");
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
				$result = $this->consultAll("SELECT * FROM seccion");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("SeccionModel(66) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}
		}

		public function GetOne($id){
			try{
				$result = $this->consult("SELECT * FROM seccion WHERE id = '$id' ;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("SeccionModel(78) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}	
		}

		public function GetByAnio($anio){
			try{
				$result = $this->consultAll("SELECT * FROM seccion WHERE estatus_seccion = 1 AND ano_seguimiento = $anio ;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);

			}catch(PDOException $e){
				error_log("SeccionModel(78) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}
		}
	}