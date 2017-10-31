<?php

class validarRegistro extends Validacion{
   private $conn;
   private $nombre; //este atributo deberia estar en abstract validacion
   private $apellido;
   private $email; //este atributo deberia estar en abstract validacion
   private $pass;//este atributo deberia estar en abstract validacion
   private $confirmarPass;
   private $alias;
   private $rutaAvatar;

   private $errores = [];

   public function __construct($conn, $datos){
      $this->nombre = $datos['nombre'];
      $this->apellido = $datos['apellido'];
      $this->alias = $datos['alias'];
      $this->pass = $datos['pass'];
      //$this->confirmarPass = $datos['confirmar-pass']; //crearlo en el formulario para uqe no de errores
      $this->email = $datos['email'];
      //crear la funcion crearRuta()
      $this->conn = $conn;
      $this->rutaAvatar = $datos['rutaAvatar'];
   }

   public function validarRegistro(){
      if ($this->nombre == "") {
         $this->errores['nombre'] = "El nombre es requerido";
      }
      if($this->apellido == ""){
         $this->errores['apellido'] = "El apellido es requerido";
      }
      if(empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
         $this->errores['email'] = "El email no es valido";
      }
      if($this->buscarEmail()){
         $this->errores['emailRegistrado'] = "El Email ya está Registrado <br><br>Por favor <a href='ingresar.php'>INICIA SESION</a>";
      }
      if(empty($this->alias)){
         $this->errores['alias'] = "Debes Colocar un alias";
      }
      if($this->buscarAlias()){
         $this->errores['alias'] = "Este Alias ya fue tomado, por favor elige otro";
      }
      if (strlen($this->pass) < 6) {
         $this->errores['pass'] = "La contraseña debe tener 6 digitos";
      }
      // NOTE: falta el if para confirmar-pass
      // NOTE: falta encriptar la ruta de la IMG AVATAR y guardarla en la DB

   }//fin funcion validarRegistro
   private function buscarAlias(){
      $resultado;

      $sql = $this->conn->getDb()-> prepare("SELECT alias FROM usuarios WHERE alias = '$this->alias';");
      $sql->execute();
      $resultado = $sql->fetchAll();
   //   var_dump($resultado);
      if($resultado!=NULL){
         return true;
      }
   }

   private function buscarEmail(){
      $resultado;

      $sql = $this->conn->getDb()->prepare("SELECT email FROM usuarios WHERE email = '$this->email';");
      $sql->execute();
      $resultado = $sql->fetchAll();
      if ($resultado !=NULL) {
         return true;
      }
   }

   public function getErrores(){
      return $this->errores;
   }
}
?>
