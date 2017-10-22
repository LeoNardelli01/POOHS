<?php
class Usuario{

   private $conn;
   private $nombre;
   private $apellido;
   private $usuario;
   private $pass;
   private $email;
   private $rutaAvatar;

   public function __construct(Conexion $conn, $nombre, $apellido, $usuario, $pass, $email, $rutaAvatar){
      $this ->conn = $conn;
      $this ->nombre = $nombre;
      $this ->apellido = $apellido;
      $this ->usuario = $usuario;
      $this ->pass = $pass;//pasword encriptada tiene que ser
      $this ->email = $email;
      $this ->rutaAvatar = $rutaAvatar; // <-- la ruta del avatar tiene que ir encriptada como la hice en registro
   }


   public function getConn(){
      return $this->conn;
   }
   //ver si necesito el setConn para setear la nueva conexion

   public function getNombre(){
      return $this->nombre;
   }
   public function setNombre($nombre){
      $this->nombre = $nombre;
   }
   public function getApellido(){
      return $this->apellido;
   }
   public function setApellido($apellido){
      $this->apellido = $apellido;
   }
   public function getUsuario(){
      return $this->usuario;
   }
   public function setUsuario($usuario){
      $this->usuario = $usuario;
   }
   public function getPass(){
      return $this->pass;
   }
   public function setPass($pass){
      $this->pass = $pass;
   }
   public function getEmail(){
      return $this->email;
   }
   public function setEmail($email){
      $this->email = $email;
   }
   public function getRutaAvatar(){
      return $this->rutaAvatar;
   }
   public function setRutaAvatar($rutaAvatar){
      $this->rutaAvatar = $rutaAvatar;
   }


   public function guardarEnDb(){
      //

   }

   public function destruirSession(){
      session_destroy();
   }
}

?>
