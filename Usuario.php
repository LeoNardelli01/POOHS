<?php
class Usuario{

   private $conn;
   private $nombre;
   private $apellido;
   private $alias;
   private $pass;
   private $email;
   private $rutaAvatar;
   private $confirmarPass;


   public function __construct(Conexion $conn, $datos){

      $this->conn = $conn;
      $this->nombre = $datos['nombre'];
      $this->apellido = $datos['apellido'];
      $this->alias = $datos['alias'];
      $this->pass = password_hash($datos['pass'], PASSWORD_DEFAULT);//pasword encriptada tiene que ser
      $this->email = $datos['email'];
      $this->rutaAvatar = $datos['rutaAvatar']; // <-- la ruta del avatar tiene que ir encriptada como la hice en registro
      $this->confirmarPass = $datos['confirmar-pass'];
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
   public function getAlias(){
      return $this->alias;
   }
   public function setAlias($alias){
      $this->alias = $alias;
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
      $datos = $this->toArray();
      $sql = $this->conn->getDb()
      ->prepare("INSERT INTO usuarios(nombre, apellido, alias, password, email, rutaAvatar)
                  VALUES ('$datos[nombre]', '$datos[apellido]', '$datos[alias]', '$datos[pass]', '$datos[email]', '$datos[rutaAvatar]');");
      $sql->execute();
   }
   private function toArray(){
      return [
         'nombre' => $this->getNombre(),
         'apellido' => $this->getApellido(),
         'alias' => $this->getAlias(),
         'pass' => $this->getPass(),
         'email' => $this->getEmail(),
         'rutaAvatar' =>$this->getRutaAvatar()
      ];
   }
   public function destruirSession(){
      session_destroy();
   }
}

?>
