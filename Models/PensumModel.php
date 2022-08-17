<?php 
	require("db.php");

	class PensumModel extends DB{
		private $id, $anio, $estatus, $id_periodo, $id_materia1,$id_materia2,$id_materia3,$id_materia4,$id_materia5,$id_materia6,$id_materia7,$id_materia8,$id_materia9,$id_materia10,$id_materia11,$id_materia12;

		public function __construct(){
			parent::__construct();
		}

		public function SetData($datos){
			$this->id = isset($datos['id']) ? $datos['id'] : null;
			$this->id_periodo = isset($datos['id_periodo']) ? $datos['id_periodo'] : null;
			$this->estatus = isset($datos['estatus']) ? $datos['estatus'] : null;
			$this->anio = isset($datos['anio']) ? $datos['anio'] : null;
			$this->id_materia1 = isset($datos['id_materia1']) ? $datos['id_materia1'] : null;
			$this->id_materia2 = isset($datos['id_materia2']) ? $datos['id_materia2'] : null;
			$this->id_materia3 = isset($datos['id_materia3']) ? $datos['id_materia3'] : null;
			$this->id_materia4 = isset($datos['id_materia4']) ? $datos['id_materia4'] : null;
			$this->id_materia5 = isset($datos['id_materia5']) ? $datos['id_materia5'] : null;
			$this->id_materia6 = isset($datos['id_materia6']) ? $datos['id_materia6'] : null;
			$this->id_materia7 = isset($datos['id_materia7']) ? $datos['id_materia7'] : null;
			$this->id_materia8 = isset($datos['id_materia8']) ? $datos['id_materia8'] : null;
			$this->id_materia9 = isset($datos['id_materia9']) ? $datos['id_materia9'] : null;
			$this->id_materia10 = isset($datos['id_materia10']) ? $datos['id_materia10'] : null;
			$this->id_materia11 = isset($datos['id_materia11']) ? $datos['id_materia11'] : null;
			$this->id_materia12 = isset($datos['id_materia12']) ? $datos['id_materia12'] : null;
		}

		public function SaveDatos(){
			try{
				$result = $this->consult("SELECT * FROM pensum WHERE periodo_id = '$this->id_periodo' AND ano = '$this->anio' AND estatus_pensum = 1;");

				if(isset($result[0])) return $this->ResJSON("No se pueden duplicar las pensums en el mismo periodo","error");

				$pdo = $this->driver->prepare("INSERT INTO pensum(ano,periodo_id,estatus_pensum,id_materia1,id_materia2,id_materia3,id_materia4,id_materia5,id_materia6,id_materia7,id_materia8,id_materia9,id_materia10,id_materia11,id_materia12) 
					VALUES(:anio,:periodo,1,:id_materia1,:id_materia2,:id_materia3,:id_materia4,:id_materia5,:id_materia6,:id_materia7,:id_materia8,:id_materia9,:id_materia10,:id_materia11,:id_materia12);");

				$pdo->bindParam(':anio', $this->anio);
				$pdo->bindParam(':periodo', $this->id_periodo);
				$pdo->bindParam(':id_materia1', $this->id_materia1);
				$pdo->bindParam(':id_materia2', $this->id_materia2);
				$pdo->bindParam(':id_materia3', $this->id_materia3);
				$pdo->bindParam(':id_materia4', $this->id_materia4);
				$pdo->bindParam(':id_materia5', $this->id_materia5);
				$pdo->bindParam(':id_materia6', $this->id_materia6);
				$pdo->bindParam(':id_materia7', $this->id_materia7);
				$pdo->bindParam(':id_materia8', $this->id_materia8);
				$pdo->bindParam(':id_materia9', $this->id_materia9);
				$pdo->bindParam(':id_materia10', $this->id_materia10);
				$pdo->bindParam(':id_materia11', $this->id_materia11);
				$pdo->bindParam(':id_materia12', $this->id_materia12);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");

			}catch(PDOException $e){
				error_log("PensumModel(line 58------) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida!", "error");
			}
		}

		public function UpdateDatos(){
			try{
				$pdo = $this->driver->prepare("UPDATE pensum SET des_materia = :descripcion WHERE id_materia = :id ;");
				$pdo->bindParam(':descripcion', $this->des_materia);
				$pdo->bindParam(':id', $this->id);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");

			}catch(PDOException $e){
				error_log("PensumModel(line0------) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida!", "error");
			}	
		}

		public function ChangeStatus(){
			try{
				$pdo = $this->driver->prepare("UPDATE pensum SET estatus_pensum = !estatus_pensum WHERE id = :id ;");
				$pdo->bindParam(':id', $this->id);

				if($pdo->execute()) $this->ResJSON("Operacion Exitosa!", "success");
				else $this->ResJSON("Operacion Fallida!", "error");
			}catch(PDOException $e){
				error_log("PensumModel(54) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");
			}
		}

		public function GetAll(){
			try{
				$result = $this->consultAll("SELECT * FROM pensum INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = pensum.periodo_id");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("PensumModel(66) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}
		}

		public function GetOne($id){
			try{
				$result = $this->consult("SELECT * FROM pensum WHERE id = '$id' ;");

				if(isset($result[0])) $this->ResDataJSON($result);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("PensumModel(78) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}	
		}

		public function GetPensumPorAnio($anio){
			try{
				$lista_materias = [];
				$encabezados = ["id_materia1","id_materia2","id_materia3","id_materia4","id_materia5","id_materia6","id_materia7","id_materia8","id_materia9","id_materia10","id_materia11","id_materia12"];

				foreach($encabezados as $item){
					$result = $this->consult("SELECT materia.* FROM pensum INNER JOIN materia ON materia.id_materia = pensum.$item WHERE ano = '$anio' ;");
					array_push($lista_materias, $result);
				}
				
				if(isset($lista_materias[0]) && $lista_materias[0]) $this->ResDataJSON($lista_materias);
				else $this->ResDataJSON([]);
			}catch(PDOException $e){
				error_log("PensumModel(78) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida! (error_log)", "error");	
			}	
		}
	}