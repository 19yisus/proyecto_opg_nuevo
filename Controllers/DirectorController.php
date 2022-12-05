<?php
	require_once("../Models/PersonasModel.php");
	require_once("../Models/DirectorModel.php");
	

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

			case 'DirectorModel':
				GetData($_GET['id']);
			break;

			case 'DirectorModel';
				ConsultarRepetidas();
			break;
		}
	}

	function SaveData(){
		$PersonasModel = new PersonasModel();
		$PersonasModel->SetData($_POST);
		
		if($PersonasModel->SaveDatos()){
			$DirectorModel = new DirectorModel();
			$DirectorModel->SetData($_POST);
			$DirectorModel->SaveDatos();
		}		
	}

	function UpdateData(){
		$DirectorModel = new DirectorModel();
		$DirectorModel->SetData($_POST);
		$DirectorModel->UpdateDatos();	
	}

	function ChangeStatusData(){
		$DirectorModel = new DirectorModel();
		$DirectorModel->SetData($_POST);
		$DirectorModel->ChangeStatus();	
	}

	function GetDatas(){
		$DirectorModel = new DirectorModel();
		if(isset($_GET['id_periodo'])) $periodo = $_GET['id_periodo']; else $periodo = null;
		$DirectorModel->GetAll($periodo);		
	}

	function GetData($id){
		$DirectorModel = new DirectorModel();
		$DirectorModel->GetOne($id);			
	}