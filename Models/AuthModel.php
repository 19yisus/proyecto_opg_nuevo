<?php 
  require_once("db.php");
  
  class AuthModel extends DB{
    private $id, $usuario, $password, $pregunta1, $pregunta2, $respuesta1, $respuesta2, $id_rol, $estatus_usuario;

    public function __construct(){
      parent::__construct();
      $this->id = $this->usuario = $this->password = $this->pregunta1 = $this->pregunta2 = $this->respuesta1 = $this->respuesta2 = $this->id_rol = $this->estatus_usuario = '';
    }

    public function SetDatos($post){
      $this->id = isset($post['id']) ? $post['id'] : null;
      $this->usuario = isset($post['usuario']) ? $post['usuario'] : null;
      $this->password = isset($post['password']) ? $post['password'] : null;
      $this->pregunta1 = isset($post['pregunta1']) ? $post['pregunta1'] : null;
      $this->pregunta2 = isset($post['pregunta2']) ? $post['pregunta2'] : null;
      $this->respuesta1 = isset($post['respuesta1']) ? $post['respuesta1'] : null;
      $this->respuesta2 = isset($post['respuesta2']) ? $post['respuesta2'] : null;
      $this->id_rol = isset($post['id_rol']) ? $post['id_rol'] : null;
      $this->estatus_usuario = isset($post['estatus']) ? $post['estatus'] : null;
    }

    public function Login(){
      session_start();
      $sql = "SELECT usuario.id,usuario.password,usuario.id_rol,roles.rol,usuario.estatus_usuario FROM usuario
       INNER JOIN roles ON roles.id = usuario.id_rol
       WHERE usuario.usuario = '$this->usuario' ;";

      $data = $this->consult($sql);

      if(isset($data[0])){
        
        if($data['estatus_usuario'] == 1){

          if(is_null($this->password) || $this->password == ""){
            return [
              'view' => 'VisLogin',
              'codigo' => 400,
              'mensaje' => "Debes de ingresar la clave"
            ];
          }

          if(password_verify($this->password, $data['password'])){
            $_SESSION['id_user'] = $data['id'];
            $_SESSION['ced_usuario'] = $this->usuario;
            $_SESSION['id_rol'] = $data['id_rol'];
            $_SESSION['des_rol'] = $data['rol'];

            return [
              'view' => "VisPrincipal",
              'codigo' => 200,
              'mensaje' => "Bienvenido/a"
            ];
          }else{
            return [
              'view' => "VisLogin",
              'codigo' => 400,
              'mensaje' => "La clave ingesada es invalida"
            ];
          }
        }else{
          return [
            'view' =>  "VisLogin",
            'codigo' => 400,
            'mensaje' => "Su usuario esta desactivado"
          ];
        }
      }else{
        return [
          'view' => "VisLogin",
          'codigo' => 400,
          'mensaje' => "El usuario ingresado no existe"
        ];
      }
    }

    public function Registro(){
      $sql = "SELECT * FROM usuario WHERE usuario = '$this->usuario' ;";
      $result = $this->consult($sql);

      if($result->num_rows == 0){
        $this->password = password_hash($this->password,PASSWORD_BCRYPT,['cost' => 12]);
        $sqlRegistro = "INSERT INTO usuario(usuario,password,pregunta1,pregunta2,respuesta1,respuesta2,id_rol,estatus_usuario)
        VALUES('$this->usuario','$this->password',$this->pregunta1,$this->pregunta2,'$this->respuesta1','$this->respuesta2',1,1)";
        
        if(!$this->driver->query($sqlRegistro)){
          return [
            'codigo' => 400,
            'mensaje' => "Error, el usuario no ha sido registrado"
          ];
        }else{
          return [
            'codigo' => 200,
            'mensaje' => "El usuario ha sido registrado"
          ];
        }
      }else{
        return [
          'codigo' => 400,
          'mensaje' => "Este usuario ya esta registrado"
        ];
      }
    }

    public function Modificar(){
      try{
        $this->password = password_hash($this->password,PASSWORD_BCRYPT,['cost' => 12]);

        $pdo = $this->driver->prepare("UPDATE usuario SET 
        usuario = :user, pregunta1 = :pg1, pregunta2 = :pg2, respuesta1 = :rp1, respuesta2 = :rp2, password = :passw 
        WHERE id = :id");
        $pdo->bindParam(":id", $this->id);
        $pdo->bindParam(":user", $this->usuario);
        $pdo->bindParam(":pg1", $this->pregunta1);
        $pdo->bindParam(":pg2", $this->pregunta2);
        $pdo->bindParam(":rp1", $this->respuesta1);
        $pdo->bindParam(":rp2", $this->respuesta2);
        $pdo->bindParam(":passw", $this->password);

        if($pdo->execute()) $this->ResJSON("Operacion Exitosa!, se cerrará la sesión en 3segundos", "success");
				else $this->ResJSON("Operacion Fallida!", "error");

      }catch(PDOException $e){
        error_log("MateriasModel(line0------) => ".$e->getMessages());
				$this->ResJSON("Operacion Fallida!", "error");
      }
    }

    public function ConsultarTodos(){
      $sql = "SELECT roles.*,usuario.id,usuario.usuario,usuario.respuesta1,usuario.estatus_usuario FROM usuario INNER JOIN roles ON roles.id = usuario.id_rol;";
      $result = $this->consultAll($sql);
      if(isset($result[0])) $this->ResDataJSON($result);
      else $this->ResDataJSON([]);
    }

    public function GetPreguntas(){
      $sql = "SELECT * FROM preguntas";
      return $this->consultAll($sql);
    }

    public function GetPregunta($id){
      $sql = "SELECT des_pregun FROM preguntas WHERE id_pregun = $id";
      return $this->consult($sql)['des_pregun'];
    }

    public function Consultar(){
      $sql = "SELECT usuario.id,usuario.usuario,usuario.pregunta1,usuario.pregunta2,usuario.id_rol FROM usuario WHERE usuario.id = '$this->id' ;";
      $result = $this->consult($sql);
      if(isset($result[0])) $this->ResDataJSON($result);
      else $this->ResDataJSON([]);
    }

    public function ValidaRespuestas(){
      $sql = "SELECT usuario.id,usuario.usuario FROM usuario WHERE usuario.id = $this->id AND usuario.respuesta1 =  '$this->respuesta1' AND usuario.respuesta2 = '$this->respuesta2';";
      return $this->driver->consult($sql);
    }

    public function ChangePassword(){
      $this->password = password_hash($this->password,PASSWORD_BCRYPT,['cost' => 12]);
      $sql = "UPDATE usuario SET usuario.password = '$this->password' WHERE id = $this->id ;";
      return $this->driver->query($sql);
    }
  }
?>