<?php
	require_once("../Models/PersonasModel.php");
	require_once("../Models/EstudiantesModel.php");
	

	if(isset($_POST['ope'])){
		$PostOperacion = $_POST['ope'];
		switch($PostOperacion){
			case 'Save':
				SaveData();
			break;

			case 'Update':
				UpdateData();
			break;

			case 'ChangeStatus':
				ChangeStatusData();
			break;

			case 'Asignacion':
				asignacionEstudiante();
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

			case 'VerificarCedula':
				Verificar_cedula($_GET['id']);
			break;
		}
	}

	function SaveData(){

		var_dump($_POST);
		die("FF");
		$EstudiantesModel = new EstudiantesModel();
		$PersonasModel = new PersonasModel();
		$PersonasModel->SetData($_POST);
		
		if($PersonasModel->SaveDatos()){
			$EstudiantesModel->SetData($_POST);
			$EstudiantesModel->SaveDatos();

			// if($EstudiantesModel->SaveDatos()){
			// 	$EstudiantesModel->AsignarEstudiante();	
			// }else{
			// 	$PersonasModel->ResJSON("Operacionn Fallida!", "error");	
			// }
			
		}else{
			$PersonasModel->ResJSON("Operacionn Fallida!", "error");
		}
	}

	function asignacionEstudiante(){
		$EstudiantesModel = new EstudiantesModel();
		$EstudiantesModel->SetData($_POST);
		$EstudiantesModel->AsignarEstudiante();	
	}

	function UpdateData(){
		$PersonasModel = new PersonasModel();
		$PersonasModel->SetData($_POST);
		$PersonasModel->UpdateDatos();	
	}

	function ChangeStatusData(){
		$EstudiantesModel = new EstudiantesModel();
		$EstudiantesModel->SetData($_POST);
		$EstudiantesModel->ChangeStatus();	
	}

	function GetDatas(){
		if(isset($_GET['id_periodo'])) $periodo = $_GET['id_periodo']; else $periodo = null;
		$EstudiantesModel = new EstudiantesModel();
		$EstudiantesModel->GetAll($periodo);		
	}

	function GetData($id){
		$EstudiantesModel = new EstudiantesModel();
		$EstudiantesModel->GetOne($id);			
	}

	function Verificar_cedula($id){
		$PersonasModel = new PersonasModel();
		$PersonasModel->GetOne($id);			
	}
	
