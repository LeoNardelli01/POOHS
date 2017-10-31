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

      echo "<br><br><br>";
      /*
      //imprimo la ultima fila de la base de datos para verificar que se guardo correctamente
      $sql = $usuario->getConn()->getDb()->prepare("SELECT*FROM usuarios ORDER BY id_usuarios DESC LIMIT 1 ;");
      $sql->execute();
      $resultado = $sql->fetchAll();
      var_dump($resultado);
      */
   }else{
      echo "Los errores son estos: <br>";
      var_dump($validar->getErrores());
      $conn = NULL;
      $validar = NULL;
   }

}

echo "<br>PRUEBAS<br>";


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


       <?php
       if(isset($usuario)){
          echo "Bienvenido " . $usuario->getNombre() . "(" . $usuario->getAlias() . ") " . $usuario->getApellido() . "<br>";
          echo "Tu email es: " . $usuario->getEmail() . "<br>";


       }
       ?>
    </body>
 </html>
