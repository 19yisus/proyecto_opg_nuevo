<?php 
	class DB{
		private $host;
		private $username;
		private $password;
		private $dbname;
		private $charset;
		protected $driver;
		private $dbManagment;

		public function __construct(){
			$this->host = "localhost";
			$this->username = "root";
			$this->password = "";
			$this->dbname = "proyecto_opg2";
			$this->charset = "utf8mb4";
			$this->dbManagment = "mysql";
			$this->connect_driver();
		}

		protected function connect_driver(){
			$this->driver = new PDO("$this->dbManagment:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
		}

		protected function registrar_bitacora_sistema($datos){
			if(!isset($_SESSION)) session_start();

			$user = $_SESSION['id_user'];
			$pdo = $this->driver->prepare("INSERT INTO bitacora_sistema(name_tabla, descripcion, registro_id, fecha_hora, user_id	)
			VALUES(:name_tabla, :descripcion, :registro_id, NOW(), :user)");
			$pdo->bindParam(':name_tabla', $datos['table']);
			$pdo->bindParam(':registro_id', $datos['id_registro']);
			$pdo->bindParam(':user', $user);
			$pdo->bindParam(':descripcion', $datos['descripcion']);
			$pdo->execute();

		}

		protected function StartTransaction(){
			// $this->driver->setAtribute(PDO::ATTR_ERRMODE, PDO::ERRDOME_EXCEPTION);
			$this->driver->beginTransaction();
		}

		protected function GetResultRow(){
			// if($this->driver->rowCount() > 0) return true; else return false;
			return true;
		}

		public function ResJSON($sms, $status){
			echo json_encode(["mensaje" => $sms, "estado" => $status], false);
		}

		protected function ResDataJSON($data){
			echo json_encode(["data" => $data], false);
		}

		protected function consult($sql){
			return $this->driver->query($sql)->fetch();
		}

		protected function consultAll($sql){
			return $this->driver->query($sql)->fetchAll();
		}

		
	}