<?php
	require_once("../Models/PersonasModel.php");
	require_once("../Models/ProfesorModel.php");
	

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

			case 'Asignar':
				Asignar();
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

			case 'MateriasRepetidas';
				ConsultarRepetidas();
			break;
		}
	}

	function SaveData(){
		$PersonasModel = new PersonasModel();
		$PersonasModel->SetData($_POST);
		
		if($PersonasModel->SaveDatos()){
			$ProfesorModel = new ProfesorModel();
			$ProfesorModel->SetData($_POST);
			$ProfesorModel->SaveDatos();
		}		
	}

	function Asignar(){
		$ProfesorModel = new ProfesorModel();
		$ProfesorModel->SetData($_POST);
		$ProfesorModel->AsignarProfesor();
	}

	function UpdateData(){
		$PersonasModel = new PersonasModel();
		$PersonasModel->SetData($_POST);
		$PersonasModel->UpdateDatos();	
	}

	function ChangeStatusData(){
		$ProfesorModel = new ProfesorModel();
		$ProfesorModel->SetData($_POST);
		$ProfesorModel->ChangeStatus();	
	}

	function GetDatas(){
		$ProfesorModel = new ProfesorModel();
		if(isset($_GET['id_periodo'])) $periodo = $_GET['id_periodo']; else $periodo = null;
		$ProfesorModel->GetAll($periodo);		
	}

	function GetData($id){
		$ProfesorModel = new ProfesorModel();
		$ProfesorModel->GetOne($id);			
	}

	function ConsultarRepetidas(){
		$ProfesorModel = new ProfesorModel();
		$ProfesorModel->VerificarMateriasRepetidas($_GET['cedula'],$_GET['materia'],$_GET['seccion']);
	}