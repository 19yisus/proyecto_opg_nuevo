<?php
	require_once("../Models/PensumModel.php");
	
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

			case 'ConsultPorAnio':
				GetPemsun();
			break;
		}
	}

	function SaveData(){
		$PensumModel = new PensumModel();
		$PensumModel->SetData($_POST);
		$PensumModel->SaveDatos();
	}

	function UpdateData(){
		$PensumModel = new PensumModel();
		$PensumModel->SetData($_POST);
		$PensumModel->UpdateDatos();	
	}

	function ChangeStatusData(){
		$PensumModel = new PensumModel();
		$PensumModel->SetData($_POST);
		$PensumModel->ChangeStatus();	
	}

	function GetDatas(){
		$PensumModel = new PensumModel();
		$PensumModel->GetAll();		
	}

	function GetData($id){
		$PensumModel = new PensumModel();
		$PensumModel->GetOne($id);			
	}

	function GetPemsun(){
		$PensumModel = new PensumModel();
		$PensumModel->GetPensumPorAnio($_GET['anio']);				
	}