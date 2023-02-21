<?php
include ("includes/seguridadSessionStart.php");

if(isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $key => $prod) {
        if ($prod['id'] == $_POST['id']) {
            $_SESSION['carrito'][$key]['cantidad'] -= 1;
            // Si la cantidad llega a cero, eliminamos el producto del carrito
            if ($_SESSION['carrito'][$key]['cantidad'] == 0) {
                unset($_SESSION['carrito'][$key]);
            }
            break;
        }
    }
}

header("Location: carrito.php");
exit();
?>