<?php
include ("includes/seguridadSessionStart.php");
$title = "HereAway";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                ?>
                <div id="principal">
                    <img src="estilos/imgs/logo.png" alt="HereAway">
                <p>Bienvenido a la tienda virtual para la asignatura Desarrollo Web en entorno Servidor.</p><br>

                <p>Durante las últimas 4 semanas he intentado transformar una pequeña página que mostraba resultados
                    de una base de datos que incluía clientes y artículos para que se convirtiera en lo más parecido a una tienda virutal</p><br>

                    <p>A mano izquierda está la barra de navegación con el catálogo completo, y las distintas categorías con sus subcategorías editables
                        con un usuario con rol adecuado.<br>En el lado derecho, tenemos el carrito, en el que veremos aparecer los productos que añadamos en él, estemos
                    logueados o no. Una vez nos logueemos aparecerán nuevas funciones en base al rol que tengamos con el usuario logueado.</p><br>

                    <p>En el header, arriba a la derecha tenemos un mini menú de inicio de sesión o de registro. Un vez estemos logueados nos aparecerá nuestra identidad y nuestro rol.</p><br>

                    <p>Debajo, el footer es solo visual.</p><br>

                    <p>El autor de esta "tienda virtual" es Juan Manuel Vázquez, alumno de Desarrollo de Aplicaciones Web en el IES Severo Ochoa de Elche.</p>
                </div>
            </body>
    <?php
include("bloques/footer.php");
?>
