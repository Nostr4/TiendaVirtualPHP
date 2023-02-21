<?php
$title = "Forbidden";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                session_start();
                $_SESSION = array(); 
                session_destroy();
                ?>
                <h3>Usuario no registrado o acceso incorrecto</h3><br>
                <button class="button" onclick="location.href='entrar.php'">Volver</button>
            </body>
    <?php
    include("bloques/footer.php");
?>