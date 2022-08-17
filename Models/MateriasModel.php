<?php 
	require("db.php");

	class MateriasModel extends DB{
		private $id, $des_materia, $estatus;

		public function __construct(){
			parent::__construct();
		}

		public function SetData($datos){
			$this->id = isset($datos['id']) ? $datos['id'] : null;
			$this->des_materia = isset($datos['des_materia']) ? $datos['des_materia'] : null;
			$this->estatus = isset($datos['estatus']) ? $datos['estatus'] : null;
		}

		public function SaveDatos(){
			try{
				$result = $this->consult("SELECT * FROM materia WHERE des_materia = '$this->des_materia' ;");

				if(isset($result[0])){
					return $this->ResJSON("No se pueden duplicar las materias","error");
				}

				$pdo = $this->driver->prepare("INSERT INTO materia(des_materia, estatus_materia) VALUES(:descripcion, 1);");
				$pdo->bindParam(':descripcion', $this->des_materia);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");

			}catch(PDOException $e){
				error_log("MateriasModel(line0------) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida!", "error");
			}
		}

		public function UpdateDatos(){
			try{
				$pdo = $this->driver->prepare("UPDATE materia SET des_materia = :descripcion WHERE id_materia = :id ;");
				$pdo->bindParam(':descripcion', $this->des_materia);
				$pdo->bindParam(':id', $this->id);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");

			}catch(PDOException $e){
				error_log("MateriasModel(line0------) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida!", "error");
			}	
		}

		public function ChangeStatus(){
			try{
				$pdo = $this->driver->prepare("UPDATE materia SET estatus_materia = !estatus_materia WHERE id_materia = :id ;");
				$pdo->bindParam(':id', $this->id);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");
			}catch(PDOException $e){
				error_log("MateriasModel(54) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");
			}
		}

		public function GetAll(){
			try{
				$result = $this->consultAll("SELECT * FROM materia");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("MateriasModel(66) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}
		}

		public function GetOne($id){
			try{
				$result = $this->consult("SELECT * FROM materia WHERE id_materia = '$id' ;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("SeccionModel(78) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}	
		}
	}