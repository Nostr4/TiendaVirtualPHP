<?php
//Inicio la sesión 
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !="Admin"){
    header ("Location: error.php");
    exit();
} else {
    $user_rol = "Administrador";
}
?>
