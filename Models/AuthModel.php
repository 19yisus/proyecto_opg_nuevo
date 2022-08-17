<?php 
  require_once("db.php");
  
  class AuthModel extends DB{
    private $id, $usuario, $password, $pregunta1, $pregunta2, $respuesta1, $respuesta2, $id_rol, $estatus_usuario;

    public function __construct(){
      parent::__construct();
      $this->id = $this->usuario = $this->password = $this->pregunta1 = $this->pregunta2 = $this->respuesta1 = $this->respuesta2 = $this->id_rol = $this->estatus_usuario = null;
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
              'view' => "VisInicio",
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
      $result = $this->ejecutar($sql);

      if($result->num_rows == 0){
        $this->password = password_hash($this->password,PASSWORD_BCRYPT,['cost' => 12]);
        $sqlRegistro = "INSERT INTO usuario(usuario,password,pregunta1,pregunta2,respuesta1,respuesta2,id_rol,estatus_usuario)
        VALUES('$this->usuario','$this->password',$this->pregunta1,$this->pregunta2,'$this->respuesta1','$this->respuesta2',1,1)";
        
        $this->ejecutar($sqlRegistro);
        if(!$this->ObtenerResultadoQuery()){
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

    public function GetPreguntas(){
      $sql = "SELECT * FROM preguntas";
      return $this->ObtenerResultados($this->ejecutar($sql));
    }

    public function GetPregunta($id){
      $sql = "SELECT des_pregun FROM preguntas WHERE id_pregun = $id";
      return $this->ObtenerResultado($this->ejecutar($sql))['des_pregun'];
    }

    public function Consultar(){
      $sql = "SELECT usuario.id,usuario.usuario,usuario.pregunta1,usuario.pregunta2 FROM usuario WHERE usuario = '$this->usuario' ;";
      return $this->ObtenerResultado($this->ejecutar($sql));
    }

    public function ValidaRespuestas(){
      $sql = "SELECT usuario.id,usuario.usuario FROM usuario WHERE usuario.id = $this->id AND usuario.respuesta1 =  '$this->respuesta1' AND usuario.respuesta2 = '$this->respuesta2';";
      return $this->ObtenerResultado($this->ejecutar($sql));
    }

    public function ChangePassword(){
      $this->password = password_hash($this->password,PASSWORD_BCRYPT,['cost' => 12]);
      $result = $this->ejecutar("UPDATE usuario SET usuario.password = '$this->password' WHERE id = $this->id ;");
      return $this->ObtenerResultadoQuery();
    }
  }
?>