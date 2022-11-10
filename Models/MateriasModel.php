<?php 
	require("db.php");

	class MateriasModel extends DB{
		private $id, $des_materia, $estatus, $id_periodo_ma, $id_pensum_ma;

		public function __construct(){
			parent::__construct();
		}

		public function SetData($datos){
			$this->id = isset($datos['id']) ? $datos['id'] : null;
			$this->des_materia = isset($datos['des_materia']) ? $datos['des_materia'] : null;
			$this->estatus = isset($datos['estatus']) ? $datos['estatus'] : null;
			$this->id_periodo_ma = isset($datos['id_periodo']) ? $datos['id_periodo'] : null;
			$this->id_pensum_ma = isset($datos['id_pensum']) ? $datos['id_pensum'] : null;
		}

		public function SaveDatos(){
			try{
				$result = $this->consult("SELECT * FROM materia WHERE id_pensum_ma = $this->id_periodo_ma AND des_materia = '$this->des_materia' ;");

				if(isset($result[0])){
					return $this->ResJSON("No se pueden duplicar las materias","error");
				}

				$pdo = $this->driver->prepare("INSERT INTO materia(des_materia, estatus_materia, id_periodo_ma, id_pensum_ma) 
				VALUES(:descripcion, 1, :periodo, :pensum);");
				$pdo->bindParam(':descripcion', $this->des_materia);
				$pdo->bindParam(':periodo', $this->id_periodo_ma);
				$pdo->bindParam(':pensum', $this->id_pensum_ma);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");

			}catch(PDOException $e){
				error_log("MateriasModel(line0------) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida!", "error");
			}
		}

		public function UpdateDatos(){
			try{
				$pdo = $this->driver->prepare("UPDATE materia SET des_materia = :descripcion, id_pensum_ma = :pensum WHERE id_materia = :id ;");
				$pdo->bindParam(':descripcion', $this->des_materia);
				$pdo->bindParam(':pensum', $this->id_pensum_ma);
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
				$result = $this->consultAll("SELECT * FROM materia 
					INNER JOIN pensum ON pensum.id = materia.id_pensum_ma
					INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = pensum.periodo_id
					WHERE periodo_escolar.estatus_periodo_escolar = 1;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("MateriasModel(66) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}
		}

		public function GetOne($id){
			try{
				$result = $this->consult("SELECT * FROM materia INNER JOIN pensum ON pensum.id = materia.id_pensum_ma WHERE id_materia = '$id' ;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("SeccionModel(78) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}	
		}
	}