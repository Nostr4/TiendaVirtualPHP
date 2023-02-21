<?php
include ("includes/seguridadSessionStart.php");

unset($_SESSION['carrito']);

header("Location: carrito.php");
exit();
?>