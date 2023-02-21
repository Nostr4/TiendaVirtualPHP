<?php
include ("includes/seguridadAdmin.php");
include("includes/conectar_bd.php");
$title = "Estadísticas";
include ("bloques/doctype.php");
            include ("bloques/header.php");
            include ("bloques/nav.php");
            ?>
            <h2>Estadísticas</h2>
            <div id="btn-menu">
                <input type="button" value="Más vendidos" onClick="window.location.href='vendidos.php'">
                <input type="button" value="Más beneficios" onClick="window.location.href='beneficios.php'">
            </div>
            <div>
                <br><input type="button" value="Volver" onClick="window.location.href='historicos.php'">
            </div>
    <?php
include("bloques/footer.php");
?>