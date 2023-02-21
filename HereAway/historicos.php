<?php
include ("includes/seguridadAdmin.php");
include("includes/conectar_bd.php");
$title = "Menú Histórico";
include ("bloques/doctype.php");
            include ("bloques/header.php");
            include ("bloques/nav.php");
            ?>
            <h2>Histórico</h2>
            <div id="btn-menu">
                <input type="button" value="Clientes" onClick="window.location.href='statsClientes.php'">
                <input type="button" value="Artículos" onClick="window.location.href='statsArticulos.php'">
                <input type="button" value="Estadísticas" onClick="window.location.href='stats.php'">
            </div>
    <?php
include("bloques/footer.php");
?>