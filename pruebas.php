<?php
//archivo para realizar las pruebas de la Conexion

//Funcion para cargar las clases automaticamente
spl_autoload_register(function ($nombre_clase) {
    include $nombre_clase . '.php';
});

$db = new Conexion('db'); // el parametro puede ser 'db' o 'json', para que se puedan hacer las dos tipo de conexiones
//no me queda claro por que la clase Usuario recibe un objeto de tipo Conexion.

$usuario = new Usuario($db, 'Leonel', 'Nardelli', 'leonchis', '123', 'leo@gmail.com', 'localhost/misfotos/');

echo $usuario -> getNombre();
echo "<br>";
echo $usuario -> getApellido();
echo "<br>";
echo $usuario -> getUsuario();
echo "<br>";
echo $usuario -> getPass();
echo "<br>";
echo $usuario -> getRutaAvatar();
echo"<br>";
echo "<br>Imprimo objeto Usuario<br>";

echo "<pre>";
var_dump($usuario);
echo "<br><br><br>";
$sql = $usuario -> getConn() -> getDb() -> prepare("SELECT* FROM actors WHERE first_name LIKE 'J____Y';");
//esto deberia devolver 3 nombres.

$sql -> execute();
$resultado = $sql -> fetchAll();
print_r($resultado);

echo $sql-> rowCount();
echo "<br>";

//$nuevaConsulta -> execute();

 ?>
