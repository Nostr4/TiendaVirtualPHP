<?php
session_start();
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !="Admin" || $_SESSION['rol'] !="Editor")){
    header ("Location: zonaUserArticulos.php");    
} else if ($_SESSION['rol'] =="Admin" || $_SESSION['rol'] =="Editor"){
    header ("Location: zonaArticulos.php");
}

// session_start();
// if (!isset($_SESSION['rol']) || ($_SESSION['rol'] =="Admin" || $_SESSION['rol'] =="Editor")){
//     header ("Location: zonaArticulos.php");    
// } else if ($_SESSION['rol'] =="Usuario"){
//     header ("Location: zonaUserArticulos.php");
// } else {
//     header ("Location: error.php");
//     exit();
// }
?>