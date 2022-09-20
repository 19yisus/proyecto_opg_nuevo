<?php
	// TODO:
	// - camibios en la vista
	// 	- Indicar en la vista donde se encuentra el ususario
	// 	- El contenido tiene que estar en español y debe llevar con su respectivo acento
	
	
	error_reporting(E_ALL);
	ini_set("ignore_repeated_errors", true);
	ini_set("display_errors", false);
	ini_set("log_errors", true);
	ini_set("error_log", "./php_error.log");
	
	class App{
		private $vistasPublicas = ['VisLogin'];
		private $vistasPrivadas = ['VisEstudiantes','VisInicio','VisMaterias','VisNotas','VisPensum','VisPeriodo','VisProfesor','VisSeccion','VispdfNotas','VisCreatePdfNotas'];

		public function __construct(){
			$url = $this->GetURL();
			$this->GetView($url);
		}

		private function GetURL(){
			if($this->SessionActive()) $vistaDefault = "VisInicio"; else $vistaDefault = "VisLogin";

			$url = isset($_GET['url']) ? $_GET['url'] : $vistaDefault;
			$url = rtrim($url,'/');
			$url = explode("/", $url);

			return $url;
		}

		private function GetView($url){
			$file = "./Views/Contents/".$url[0].".php";
			if(file_exists($file)){
				if($this->validarVistasPrivadas($url[0])) require_once $file; else header("Location: ./VisLogin");
			}
		}

		private function validarVistasPrivadas($vista){
			if(in_array($vista, $this->vistasPublicas)) return true;
			if(in_array($vista, $this->vistasPrivadas) && $this->SessionActive()) return true; else return false;			
		}

		private function Head(){ require("./Views/includes/Header.php"); }
		private function Script(){ require("./Views/includes/Script.php"); }
		private function Navbar(){ require("./Views/includes/Navbar.php"); }

		private function SessionActive(){
			session_start();
			if(isset($_SESSION['id_user'])) return true; return false;
		}
	}

	$app = new App();
