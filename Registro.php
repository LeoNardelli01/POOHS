<?php
class Registro{
   private $usuario;
   private $sql;

   public function __construct(Usuario $usuario){
   $this ->usuario = $usuario;

   }

   public function prepararRegistro(){

         $this->sql = $this ->usuario ->getConn() -> getDb()
         ->prepare("INSERT INTO usuarios(nombre, apellido, alias,
                    password, email, rutaAvatar)
                    VALUES('leonel', 'nardelli', :alias, :password, :email, :rutaAvatar);");


         /*
         $this->usuario ->getConn()-> getDb() ->bindValue(":nombre", $this->usuario ->getNombre(), PDO::PARAM_STR);
         //var_dump($sql);
         $this->usuario ->getConn()-> getDb() ->bindValue(":apellido", $this->usuario -> getApellido(), PDO::PARAM_STR);
         $this->usuario ->getConn()-> getDb() ->bindValue(":alias", $this->usuario -> getAlias(), PDO::PARAM_STR);
         $this->usuario ->getConn()-> getDb() ->bindValue(":password", $this->usuario -> getPass(), PDO::PARAM_STR);
         $this->usuario ->getConn()-> getDb() ->bindValue(":email", $this->usuario -> getEmail(), PDO::PARAM_STR);
         $this->usuario ->getConn()-> getDb() ->bindValue(":rutaAvatar", $this->usuario -> getRutaAvatar(), PDO::PARAM_STR);
         */
         //echo $this->usuario ->getApellido();

   }
   public function guardarEnDb(){
      $this ->usuario -> getConn()-> getDb() -> execute($this->sql);
   }

}

?>
