<?php
	require_once("../Models/MateriasModel.php");
	
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
		}
	}

	function SaveData(){
		$MateriasModel = new MateriasModel();
		$MateriasModel->SetData($_POST);
		$MateriasModel->SaveDatos();
	}

	function UpdateData(){
		$MateriasModel = new MateriasModel();
		$MateriasModel->SetData($_POST);
		$MateriasModel->UpdateDatos();	
	}

	function ChangeStatusData(){
		$MateriasModel = new MateriasModel();
		$MateriasModel->SetData($_POST);
		$MateriasModel->ChangeStatus();	
	}

	function GetDatas(){
		$MateriasModel = new MateriasModel();
		$MateriasModel->GetAll();		
	}

	function GetData($id){
		$MateriasModel = new MateriasModel();
		$MateriasModel->GetOne($id);			
	}