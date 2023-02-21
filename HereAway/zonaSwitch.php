<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] == "Admin"){
    header("Location: zona.php");    
} else if ($_SESSION['rol'] == "Usuario"){
    header("Location: zonaUser.php");
} else if ($_SESSION['rol'] == "Editor"){
    header("Location: zonaUser.php");
} else {
    header("Location: error.php");
    exit();
}
?>
