<?php
//archivo para realizar las pruebas de la Conexion

//Funcion para cargar las clases automaticamente
spl_autoload_register(function ($nombre_clase) {
    include $nombre_clase . '.php';
});

echo "<pre>";
if(isset($_POST['enviar'])){
   $conn = new Conexion('db');
   $validar = new ValidarRegistro($conn ,$_POST);
   $validar->validarRegistro();
   if($validar->getErrores() == NULL){
      $usuario = new Usuario($conn, $_POST);
      $usuario->guardarEnDb();
      $conn = NULL;
      $validar = NULL;
      echo "Datos guardados Exitosamente";

   }else{
      echo "Los errores son estos: <br>";
      var_dump($validar->getErrores());
      $conn = NULL;
      $validar = NULL;
   }
   /*
   $conn = new Conexion('db'); // el parametro puede ser 'db' o 'json', para que se puedan hacer las dos tipo de conexiones
   $usuario = new Usuario($conn, $_POST);
   $usuario -> validarRegistro();

   if ( $usuario->getErrores() == NULL) {
      $usuario->guardarEnDb();
      $conn = NULL;
      //esto es para comprobar que se guardo en la base de datos, y trae el ultimo registro
      /*
      $sql = $usuario->getConn()->getDb()->prepare("SELECT*FROM usuarios ORDER BY id_usuarios DESC LIMIT 1 ;");
      $sql->execute();
      $resultado = $sql->fetchAll();
      var_dump($resultado);
      */


}

echo "<br>PRUEBAS<br>";

echo "<br><br>";

 ?>

 <!DOCTYPE html>
 <html>
    <head>
       <meta charset="utf-8">
       <title>PRUEBAS</title>
    </head>
    <body>
       <form class="" action="pruebas.php" method="post">

          NOMBRE : <input type="text" name="nombre" value=""><br>
          APELLIDO : <input type="text" name="apellido" value=""><br>
          ALIAS : <input type="text" name="alias" value="">
          Email : <input type="text" name="email" value=""><br>
          PASS : <input type="password" name="pass" value="">
          CONFIRMAR PASS: <input type="password" name="confirmar-pass" value="">
          RUTA AVATAR :  <input type="text" name="rutaAvatar" value="">
          <input type="submit" name="enviar" value="ENVIAR">
       </form>
    </body>
 </html>
