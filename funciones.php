<?php
// FUNCIONES

function validarDatos($data){
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

}//fin funcion validarDatos


function buscarPorEmail($email){
   //busca en el json si el email ya fue ingresado

  $recurso = abrirArchivo('usuarios.json');
  while( $linea = fgets($recurso)){
    $decode = json_decode($linea, true);
    if($decode['email'] == $email){
      return $decode;
    }
  }
  return false;
}

function guardarImagen($ruta, $input, $nombreDeseado){
   if($_FILES[$input]['error'] == UPLOAD_ERR_OK){

      $nombre = $_FILES[$input]["name"];
      $archivo = $_FILES[$input]["tmp_name"];
      $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION)); //hasta aca bien
      $miArchivo = $ruta;
      $miArchivo = $miArchivo . $nombreDeseado.'.'.$ext;


      move_uploaded_file($archivo, $miArchivo);
      return ['ruta' => $nombreDeseado.'.'.$ext];
   }
   return ['error' => $_FILES[$input]['error']];
}

function abrirArchivo($nombre){
  if(!empty($nombre)){
    if(file_exists($nombre)){
      $recurso = fopen($nombre, 'r+');
    }else{
      $recurso = fopen($nombre, 'w+');
    }
  }
  return $recurso;
}

function prepararRegistro($datos){
  return [
     'nombre' => $datos['nombre'],
     'apellido' => $datos['apellido'],
     'email' => $datos['email'],
     'password' => password_hash($datos['password'], PASSWORD_DEFAULT),
     'usuario' => $datos['usuario'],
     'avatar' => $datos['avatar'],
     'id' => $datos['id']
  ];
}

function limpiarDatos($datos){
   //si hay espacion delante de los campos, los elimina con la funcion trim()
  foreach ($datos as $key => $value) {
      $limpios[$key] = trim($value);
  }
  return $limpios;
}

function buscarUltimoId(){
   //busca el ultimo ID y te lo devuelve
   //Cuando se crea un nuevo registro solo tenemos que
   //buscar el ultimo ID y sumarle 1
   $id=0;
   $recurso = abrirArchivo('usuarios.json');
   while( $linea = fgets($recurso)){
      $decode = json_decode($linea, true);
      $id = $decode['id'];
   }
   return $id;
}

function buscarPorUsuario($usuario){
   //busca en el json si el alias ya fue ingresado

  $recurso = abrirArchivo('usuarios.json');
  while( $linea = fgets($recurso)){
    $decode = json_decode($linea, true);
    if(isset($decode['usuario'])){
      if($decode['usuario'] == $usuario){
         return $decode;
      }
    }
  }
  return false;
}


function crearDirectorio($ruta){
    if(!file_exists($ruta)){
      mkdir($ruta, 0777);
    }
}

function iniciarSession($datos)
{
  $_SESSION['nombre']=$datos;
}





function enviarEmailBienvenida(){
   /*funcion sin terminar!!!
   la idea es que cuando alguien se registre, se le envie un email de bienvenida al sitio
   errores hasta ahora:
      No tengo un servidor STMP para enviar correos desde php
      Tengo que llenar el encabezado con otros datos importantes como:
         los caracteres raros
         ver como enviar una plantilla html (foto, logo, descripcion, agradecimiento)

   */
   $destinatario = "{$_POST['email']}";
   $nombre = $_POST['nombre'];
   $usuario = $_POST['usuario'];
   $tema = "Bienvenido $nombre";
   //$mensaje = abrirArchivo('mail.php');
   $mensaje = "$nombre, muchas gracias por registrarte! Tu nombre de usuario es $usuario.";

   $encabezado = "From: Hugo Sajama";

   mail($destinatario, $tema, $mensaje, $encabezado);
}

function verificarUsuario($email, $password) {
   $puntero= fopen ('usuarios.json', 'r');
   while ($linea= fgets($puntero)){
     $arrayJson= json_decode($linea, true);
     if ($arrayJson["email"]== $email && password_verify($password, $arrayJson["password"]) ||
         $arrayJson["usuario"]== $email && password_verify($password, $arrayJson["password"])){ //En el 2do valor va el Pas HASH
      return $arrayJson;
     }
   }
   return $arrayJson;
 }
?>
