<?php 
	require("db.php");

	class PensumModel extends DB{
		public $id, $anios_abarcados, $code_pecod_pensumnsum, $id_periodo, $id_materia1,$id_materia2,$id_materia3,$id_materia4,$id_materia5,$id_materia6,$id_materia7,$id_materia8,$id_materia9,$id_materia10,$id_materia11,$id_materia12;

		public function __construct(){
			parent::__construct();
		}

		public function SetData($datos){
			$this->id = isset($datos['id']) ? $datos['id'] : null;
			$this->id_periodo = isset($datos['id_periodo']) ? $datos['id_periodo'] : null;
			$this->cod_pensum = isset($datos['cod_pensum']) ? $datos['cod_pensum'] : null;
			$this->anios_abarcados = isset($datos['anios_abarcados']) ? $datos['anios_abarcados'] : null;
			$this->id_materia1 = isset($datos['id_materia'][0]) ? $datos['id_materia'][0] : null;
			$this->id_materia2 = isset($datos['id_materia'][1]) ? $datos['id_materia'][1] : "NO";
			$this->id_materia3 = isset($datos['id_materia'][2]) ? $datos['id_materia'][2] : "NO";
			$this->id_materia4 = isset($datos['id_materia'][3]) ? $datos['id_materia'][3] : "NO";
			$this->id_materia5 = isset($datos['id_materia'][4]) ? $datos['id_materia'][4] : "NO";
			$this->id_materia6 = isset($datos['id_materia'][5]) ? $datos['id_materia'][5] : "NO";
			$this->id_materia7 = isset($datos['id_materia'][6]) ? $datos['id_materia'][6] : "NO";
			$this->id_materia8 = isset($datos['id_materia'][7]) ? $datos['id_materia'][7] : "NO";
			$this->id_materia9 = isset($datos['id_materia'][8]) ? $datos['id_materia'][8] : "NO";
			$this->id_materia10 = isset($datos['id_materia'][9]) ? $datos['id_materia'][9] : "NO";
			$this->id_materia11 = isset($datos['id_materia'][10]) ? $datos['id_materia'][10] : "NO";
			$this->id_materia12 = isset($datos['id_materia'][11]) ? $datos['id_materia'][11] : "NO";
		}

		public function SaveDatos(){
			try{
				$result = $this->consult("SELECT * FROM pensum WHERE periodo_id = '$this->id_periodo' AND anios_abarcados = '$this->anios_abarcados' AND estatus_pensum = 1;");
				if(isset($result[0])) return $this->ResJSON("No se pueden duplicar las pensums en el mismo periodo","error");

				$sql = "INSERT INTO pensum(cod_pensum,anios_abarcados,periodo_id,estatus_pensum,id_materia1,id_materia2,id_materia3,id_materia4,id_materia5,id_materia6,id_materia7,id_materia8,id_materia9,id_materia10,id_materia11,id_materia12) 
					VALUES($this->cod_pensum,'$this->anios_abarcados',$this->id_periodo,1,
					$this->id_materia1,$this->id_materia2,$this->id_materia3,$this->id_materia4,$this->id_materia5,$this->id_materia6,
					$this->id_materia7,$this->id_materia8,$this->id_materia9,$this->id_materia10,$this->id_materia11,$this->id_materia12);";
				$sql = str_replace("NO",'NULL', $sql);
				$pdo = $this->driver->prepare($sql);
				
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
				$result = $this->consult("SELECT * FROM pensum INNER JOIN periodo_escolar ON periodo_escolar.id_periodo_escolar = pensum.periodo_id WHERE id = '$id' ;");

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