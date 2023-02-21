<?php
session_start();
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !="Admin" && $_SESSION['rol'] !="Usuario" && $_SESSION['rol'] !="Editor")){
    header ("Location: error.php");
    exit();
} else if ($_SESSION['rol'] == "Admin") {
    $user_rol = "Administrador";
} else if ($_SESSION['rol'] == "Editor") {
    $user_rol = "Editor";    
} else if ($_SESSION['rol'] == "Usuario") {
    $user_rol = "Usuari@";
}

?>
