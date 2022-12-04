<?php
require_once("../Models/InstitucionModel.php");

if (isset($_POST['ope'])) {
  $PostOperacion = $_POST['ope'];
  switch ($PostOperacion) {
    case 'Save':
      SaveData();
      break;

    case 'Update':
      UpdateDatos();
      break;

    case 'ChangeStatus':
      ChangeStatusData();
      break;

    case 'save_externo':
      Save_externa();
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
      GetData();
      break;

    case 'externas':
      GetDatasExternas();
    break;

    case 'ConsulAll_bitacora':
      GetBitacora();
      break;
  }
}

function SaveData()
{
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->SetData($_POST);
  $InstitucionModel->SaveDatos();
}
function Save_externa(){
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->SetData($_POST);
  $InstitucionModel->SaveDatos_externa();
}
function UpdateDatos()
{
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->SetData($_POST);
  $InstitucionModel->UpdateDatos();
}

function GetDatas()
{
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->GetAll();
}
function GetDatasExternas()
{
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->GetExternas();
}

function ChangeStatusData()
{
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->SetData($_POST);
  $InstitucionModel->ChangeStatus();
}

function GetData()
{
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->GetOne();
}

function GetBitacora()
{
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->GetBitacora();
}
