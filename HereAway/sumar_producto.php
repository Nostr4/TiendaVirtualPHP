<?php
include ("includes/seguridadSessionStart.php");

if(isset($_SESSION['carrito']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    foreach ($_SESSION['carrito'] as &$producto) {
        if ($producto['id'] == $id && $producto['cantidad'] < $producto['stock']) {
            $producto['cantidad'] += 1;
            break;
        }
    }
}

header("Location: carrito.php");
?>