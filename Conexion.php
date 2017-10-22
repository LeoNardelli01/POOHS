<?php
require_once('config.php');
require_once('funciones.php');

class Conexion{
   private $db;
   private $json; // esta variable va a guardar el archivo json;
   private $host = "localhost";
   private $dbNombre = "movies_db";   //aca va el nombre de la base de datos.
   private $user = "root";
   private $pass = "root";

public function __construct($tipoConexion){
   try {
      switch ($tipoConexion) {
         case 'json':
            echo "JSON";

            break;
         case 'db':
               $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbNombre",
                                    $this->user, $this->pass, array(
                                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,));


            break;
         default:
            echo "Elige entre DB y JSON para almacenamiento";
            break;
      }


   } catch (PDOException $e) {

      throw new Exception("Error al conectar a la base de datos: " . $e -> getMessage(), 1);
   }



}

public function consulta($querySql){
   $resultado = $this->db->prepare($querySql);
   return $resultado;
}

public function getDb(){
   return $this->db;
}
}
?>
