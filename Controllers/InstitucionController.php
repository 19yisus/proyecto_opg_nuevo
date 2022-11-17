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
  }
}

function SaveData()
{
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->SetData($_POST);
  $InstitucionModel->SaveDatos();
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

function GetData()
{
  $InstitucionModel = new InstitucionModel();
  $InstitucionModel->GetOne();
}
