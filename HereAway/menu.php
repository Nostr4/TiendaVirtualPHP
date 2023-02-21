<?php
include ("includes/seguridadEditor.php");
include("includes/conectar_bd.php");
$title = "Menú";
include ("bloques/doctype.php");
            include ("bloques/header.php");
            include ("bloques/nav.php");

            if ($_SESSION['rol'] == 'Admin'){
            ?>
            <h2>Menú Administrador</h2>
            <div id="btn-menu">
                <input type="button" value="Usuarios" onClick="window.location.href='zonaSwitch.php'">
                <input type="button" value="Artículos" onClick="window.location.href='zonaArticulos.php'">
                <input type="button" value="Categorias" onClick="window.location.href='zonaCategorias.php'">
                <input type="button" value="Pedidos" onClick="window.location.href='zonaPedidos.php'">
                <input type="button" value="Históricos" onClick="window.location.href='historicos.php'">
            </div>
    <?php
            } else {
                ?>
                <h2>Menú Editor</h2>
                <div id="btn-menu">
                    <input type="button" value="Artículos" onClick="window.location.href='zonaArticulos.php'">
                    <input type="button" value="Categorias" onClick="window.location.href='zonaCategorias.php'">
                </div>
                <?php
            }
include("bloques/footer.php");
?>
