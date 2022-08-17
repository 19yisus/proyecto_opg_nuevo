<?php
	require_once("../Models/PeriodoModel.php");

	if(isset($_POST['ope'])){
		$PostOperacion = $_POST['ope'];
		switch($PostOperacion){
			case 'Save':
				SaveData();
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

			case 'ConsultPeriodoActivo':
				GetPeriodoActivo();
			break;
		}
	}

	function SaveData(){
		$PeriodoModel = new PeriodoModel();
		$PeriodoModel->SetData($_POST);
		$PeriodoModel->SaveDatos();
	}

	function ChangeStatusData(){
		$PeriodoModel = new PeriodoModel();
		$PeriodoModel->SetData($_POST);
		$PeriodoModel->ChangeStatus();	
	}

	function GetDatas(){
		$PeriodoModel = new PeriodoModel();
		$PeriodoModel->GetAll();		
	}

	function GetData($id){
		$PeriodoModel = new PeriodoModel();
		$PeriodoModel->GetOne($id);			
	}

	function GetPeriodoActivo(){
		$PeriodoModel = new PeriodoModel();
		$PeriodoModel->GetActivo();			
	}
