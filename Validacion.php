<?php
/*
este Trait tiene que ser una clase abstracta para que hereden las clases
ValidarRegistro y validarLogin

*/

abstract class Validacion{

   abstract function validarRegistro();

  function __destruc(){}

}
?>
