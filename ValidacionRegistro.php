<?php
require_once('funciones.php');

class ValidacionRegistro extends Validacion {
   private $conn;


   public function __construct(Conexion $conn){
      $this ->conn = $conn;
   }

   public function validar($datos){
      //recibe un array ($_POST) y devuelve otro llamado $errores

     $errores = [];
     if($data['nombre'] == ""){
        $errores['nombre'] = "El nombre es requerido";
     }
     if($data['apellido'] == ""){
        $errores['apellido'] = "El apellido es requerido";
     }
     if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
        $errores['email'] = "El E-mail no es valido";
     }

     if( buscarPorEmail($data['email']) ){
             $errores['email'] = "El Email ya está Registrado <br><br>Por favor <a href='ingresar.php'>INICIA SESION</a>";
     }
     if(empty($data['usuario'])){
        $errores['usuario'] = NULL;
        if(is_null($errores['usuario'])){
           $errores['usuario'] = "Elije un nombre de usuario";
        }
    }
     if(buscarPorUsuario($data['usuario'])){
        $errores['usuario'] = "Ese Alias ya fue tomado, por favor ingresa otro";
    }

     if(strlen($data['password']) < 6){
        $errores['password'] = "La contraseña debe tener 6 digitos";
     }
     if($data['confirmar-pass'] !=$data['password']){
        $errores['confirmar-pass'] = "Las contraseñas no coinciden";
     }

     if(!empty($_FILES['avatar']['name'])){
         //$ruta = 'proyecto-dh-ultimo/img/';
        $ruta = dirname(__FILE__).'/img/';
        crearDirectorio($ruta);

        $_POST['avatar'] = guardarImagen($ruta, 'avatar', md5($_FILES['avatar']['name']).time());

     }elseif (empty($_FILES['avatar']['name'])) {

        $_POST['avatar'] = NULL;
     }
          elseif (isset($archivo['error'])) {
              $errores['avatar'] = $archivo['error'];
     }

     return $errores;

   }



}
?>
