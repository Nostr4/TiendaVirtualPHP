<?php
session_start();
$title = "Cuenta inactiva";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                $_SESSION = array(); 
                session_destroy();
                ?>
                <h3>Usuario inactivo, póngase en contacto con el Administrador.</h3><br>
                <button class="button" onclick="location.href='index.php'">Volver</button>
            </body>
    <?php
    include("bloques/footer.php");
?>
