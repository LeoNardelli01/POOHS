<?php
require_once('config.php');

class Conexion{
   private $db;
   private $json; // esta variable va a guardar el archivo json;
   private $host = DB_HOST;
   private $dbNombre = "hs_db";   //aca va el nombre de la base de datos.
   private $user = DB_USUARIO;
   private $pass = DB_PASS;

   public function __construct($tipoConexion){
      try {
         switch ($tipoConexion) {
            case 'json':
               echo "JSON";
               //aca deberia ir la conexion al archivo .json
               //ver la posibilidad de hacer una class Json y tratarlo como un objeto

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
      //este metodo no funciona bien, revisar!!
      $resultado = $this->db->prepare($querySql);
      return $resultado;
   }

   public function getDb(){
      return $this->db;
   }
   
}
?>
