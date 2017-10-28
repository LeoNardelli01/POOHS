<?php
//archivo para realizar las pruebas de la Conexion

//Funcion para cargar las clases automaticamente
spl_autoload_register(function ($nombre_clase) {
    include $nombre_clase . '.php';
});


if(isset($_POST['enviar'])){
   $conn = new Conexion('db'); // el parametro puede ser 'db' o 'json', para que se puedan hacer las dos tipo de conexiones
   echo "<pre>";

   $usuario = new Usuario($conn, $_POST);
   $usuario -> validarRegistro();
   echo "<br><br><br><br>";
   //echo "<pre>";
   var_dump($usuario);


  /*
   $sql = $conn-> getDb() -> prepare("INSERT INTO usuarios(nombre, apellido, alias, password, email, rutaAvatar)
                        VALUES('Leonel', 'Nardelli', 'Leonchis', '123', 'ricosur@gmail.com', 'ruta/miruta')");
   $sql ->execute();
   //$resultado = $sql ->fetch();
   //var_dump($resultado);
   */


   /*
   $erroresValidacion = $usuario -> validarRegistro()
   if ($erroresValidacion == 0) {
      $usuario -> registrar();
   }else{
      $errores = $usuario -> getErrores();
   }*/
}

echo "<br>PRUEBAS<br>";

echo "<br><br><br>";


//$registro -> getConn() -> getDb() -> execute();
//$registro -> getConn() -> getDb() -> prepare("SELECT * FROM usuarios");
//$registro -> getConn() -> getDb() -> execute();
//$resultado = $registro -> fetchAll();
//var_dump($resultado);



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
          RUTA AVATAR :  <input type="text" name="rutaAvatar" value="">
          <input type="submit" name="enviar" value="ENVIAR">
       </form>
    </body>
 </html>
