<?php
require_once("../Models/SeccionModel.php");

if (isset($_POST['ope'])) {
	$PostOperacion = $_POST['ope'];
	switch ($PostOperacion) {
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

if (isset($_GET['ope'])) {
	$GetOperacion = $_GET['ope'];
	switch ($GetOperacion) {
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

function SaveData()
{
	$SeccionModel = new SeccionModel();
	$letras = explode(",", $_POST['letras']);
	$inicio = array_search($_POST['seccion_inicial'], $letras);
	$final = array_search($_POST['seccion_final'], $letras);

	for ($i = $inicio; $i <= $final; $i++) {
		$SeccionModel->SetData([
			'seccion' => $letras[$i],
			'anio' => $_POST['anio'],
			'id_periodo' => $_POST['id_periodo'],
			'estatus' => 1
		]);
		$result = $SeccionModel->SaveDatos();
		if(!$result) break;
	}

	$SeccionModel->ResJSON("Operacion Exitosa!","success");
}

function ChangeStatusData()
{
	$SeccionModel = new SeccionModel();
	$SeccionModel->SetData($_POST);
	$SeccionModel->ChangeStatus();
}

function GetDatas()
{
	$SeccionModel = new SeccionModel();
	$SeccionModel->GetAll();
}

function GetData($id)
{
	$SeccionModel = new SeccionModel();
	$SeccionModel->GetOne($id);
}

function GetSeccionesPorAnio($anio)
{
	$SeccionModel = new SeccionModel();
	$SeccionModel->GetByAnio($anio);
}
