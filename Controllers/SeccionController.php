<?php
	require_once("../Models/SeccionModel.php");
	
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

			case 'ConsultPorAnio':
				GetSeccionesPorAnio($_GET['anio']);
			break;
		}
	}

	function SaveData(){
		$SeccionModel = new SeccionModel();
		$SeccionModel->SetData($_POST);
		$SeccionModel->SaveDatos();
	}

	function ChangeStatusData(){
		$SeccionModel = new SeccionModel();
		$SeccionModel->SetData($_POST);
		$SeccionModel->ChangeStatus();	
	}

	function GetDatas(){
		$SeccionModel = new SeccionModel();
		$SeccionModel->GetAll();		
	}

	function GetData($id){
		$SeccionModel = new SeccionModel();
		$SeccionModel->GetOne($id);			
	}

	function GetSeccionesPorAnio($anio){
		$SeccionModel = new SeccionModel();
		$SeccionModel->GetByAnio($anio);	
	}