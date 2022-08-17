<?php
	require_once("../Models/NotasModel.php");
	
	if(isset($_POST['ope'])){
		$PostOperacion = $_POST['ope'];
		switch($PostOperacion){
			case 'Save':
				SaveData();
			break;

			case 'Aprobar':
				PromocionEstudiante();
			break;

			case 'ChangeStatus':
				ChangeStatusData();
			break;

			default:
				die("No hay datos");
			break;
		}	
	}
	
	if(isset($_GET['ope'])){
		$GetOperacion = $_GET['ope'];
		switch($GetOperacion){
			case 'ConsulAll':
				GetDatas();
			break;

			case 'ConsultOne':
				GetData($_GET['id']);
			break;

			case 'ConsultDatosAcademicos':
				GetDatosAcademicos($_GET['cedula']);
			break;
		}
	}

	function SaveData(){
		$NotasModel = new NotasModel();
		$datos = OrderPost();
		$NotasModel->SetData($datos[0],$datos[1]);
		$NotasModel->SaveDatos();
	}

	function PromocionEstudiante(){
		$NotasModel = new NotasModel();
		$datos = OrderPost();
		$NotasModel->SetData($datos[0],$datos[1]);
		$NotasModel->promocion();	
	}

	function ChangeStatusData(){
		$NotasModel = new NotasModel();
		$NotasModel->SetData($_POST);
		$NotasModel->ChangeStatus();	
	}

	function GetDatas(){
		$NotasModel = new NotasModel();
		if(isset($_GET['id_seccion'])){
			$NotasModel->GetAll($_GET['id_seccion']);
		}else $NotasModel->GetAll();
	}

	function GetData($id){
		$NotasModel = new NotasModel();
		$NotasModel->GetOne($id);			
	}

	function OrderPost(){
	    $materias = [];
	    $estudiante = [];
	    for($i = 0; $i < sizeof($_POST['id_materia']); $i++){
	      array_push($materias, [
	        'id_nota' => isset($_POST['id_nota'][$i]) ? $_POST['id_nota'][$i] : null,
	        'id_materia' => $_POST['id_materia'][$i],
	        'des_materia' => $_POST['des_materia'][$i],
	        'nota1' => $_POST['nota1'][$i],
	        'nota2' => $_POST['nota2'][$i],
	        'nota3' => $_POST['nota3'][$i],
	        'nota4' => $_POST['nota4'][$i],
	        'rp1' => isset($_POST['rp1'][$i]) ? $_POST['rp1'][$i] : null,
	        'rp2' => isset($_POST['rp2'][$i]) ? $_POST['rp2'][$i] : null,
	        'rp3' => isset($_POST['rp3'][$i]) ? $_POST['rp3'][$i] : null,
	        'rp4' => isset($_POST['rp4'][$i]) ? $_POST['rp4'][$i] : null,
	      ]);
	    }

	    array_push($estudiante, [
	      "ced" => $_POST['cedula'],
	      "seccion" => $_POST['id_seccion'],
	      "periodo" => $_POST['id_periodo'],
	      "estatus" => $_POST['estatus_notas'],
	      "observacion" => $_POST['observacion']
	    ]);

	    return [
	      $estudiante, $materias
	    ];
	}

	function GetDatosAcademicos($cedula){
		$NotasModel = new NotasModel();
		$NotasModel->ConsultaDatosAcademicos($cedula);
	}