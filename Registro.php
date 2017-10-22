<?php
class Registro{
   private $conn;


   public function __construct(Conexion $conn, $user){
      $this ->conn = $conn;
      

   }

   public function guardarEnDb(){
      //

   }

   public function crearSession(){
      $_SESSION['nombre'] = $this ->nombre;
      //asi con todos menos con la pass

   }
}

?>
