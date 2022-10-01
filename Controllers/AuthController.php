<?php
  require_once("../Models/AuthModel.php");
  // require_once("../models/configuracion.php");

  if(isset($_POST['ope'])){
    switch($_POST['ope']){
      case 'Registro':
        Registro();
      break;

      case 'Login';
        Login();
      break;

      case 'Update':
        Modificacion();
      break;

      case 'Exit_sesion':
        cerrarSesion();
      break;
    }
  }

  if(isset($_GET['ope'])){
    switch($_GET['ope']){
      case 'ConsultOne':
        ConsultaEspecifica();
      break;

      case 'ConsulAll':
        ConsultaGeneral();
      break;
    }
  }

  function Registro(){
    $AuthModel = new AuthModel();
    $AuthModel->SetDatos($_POST);
    $resultado = $AuthModel->Registro();
    header("Location: ../".$resultado['view']."?codigo=".$resultado['codigo']."&mensaje=".$resultado['mensaje']);
  }

  function Login(){
    $AuthModel = new AuthModel();
    $AuthModel->SetDatos($_POST);
    $resultado = $AuthModel->Login();

    header("Location: ../".$resultado['view']."?codigo=".$resultado['codigo']."&mensaje=".$resultado['mensaje']);
  }

  function cerrarSesion(){
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../VisLogin");
  }

  function Modificacion(){
    $AuthModel = new AuthModel();
    $AuthModel->SetDatos($_POST);
    $AuthModel->Modificar();
  }

  // function Desactivar(){
  //   $AuthModel = new AuthModel();
  //   $AuthModel->SetDatos($_POST);
  //   $resultado = $AuthModel->Desactivar();

  //   echo json_encode(['data' => $resultado], false);
  // }

  function ConsultaEspecifica(){
    $AuthModel = new AuthModel();
    $AuthModel->SetDatos(['id' => $_GET['id']]);
    $AuthModel->Consultar();
  }

  function ConsultaGeneral(){
    $AuthModel = new AuthModel();
    $AuthModel->ConsultarTodos();
  }
  
?>