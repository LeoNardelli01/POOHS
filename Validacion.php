<?php

trait Validacion{
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
         $this->erorres['aliasRegistrado'] = "Este Alias ya fue tomado, por favor elige otro";
      }
   }//fin funcion validarRegistro
   

   private function buscarAlias(){
      $resultado;

      $sql = $this->conn->getDb()-> prepare("SELECT * FROM usuarios WHERE alias LIKE '$this->alias';");
      $sql->execute();
      $resultado = $sql->fetchAll();
      if($resutlado !=NULL){
         return true;
      }
   }

   private function buscarEmail(){
      $resultado;

      $sql = $this->conn-> getDb() -> prepare("SELECT * FROM usuarios WHERE email LIKE '$this->email';");
      $sql -> execute();
      $resultado = $sql->fetchAll();
      if ($resultado !=NULL) {
         return true;
      }
   }

}//fin trait
?>
