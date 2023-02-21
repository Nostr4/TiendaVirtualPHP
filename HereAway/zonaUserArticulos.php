<?php
include ("includes/seguridadSessionStart.php");
include("includes/clases.php");
include ("funciones/cabeceraTablas.php");
include ("funciones/funciones_varias.php");
$title = "HereAway";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");

                $orden = 'ASC';

                if (isset($_SESSION['sort']) && $_SESSION['sort'] == 'ASC'){
                    $_SESSION['sort'] = 'DESC';
                    $orden = 'DESC';
                } else {
                    $_SESSION['sort'] = 'ASC';
                }

                ?>
                <?php
                        echo"<h2>Bienvenido a HereAway</h2>";  
                        echo "<h3>Este es nuestro catálogo:</h3><br>";
                ?>
                <div class="buscar">
                    <form action="zonaUserArticulos.php" method="POST">
                        <input type="text" name="nombre" minlength="2" maxlength="50" value="Artículo" required>
                        <input type="submit" name="search" value="Buscar">
                    </form>
                </div>
                    <?php
                    if (isset($_POST['search'])) {
                        include("includes/conectar_bd.php");
                        $nombre = $_POST['nombre'];
                        try {    
                            $stmt = $con->prepare("SELECT * FROM articulos WHERE catalogado = 'Sí' AND nombre like '%$nombre%'");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_CLASS, 'articulos');
                            //cabecera
                            echo cabeceraArticulosUser();
                        while($fila = $stmt->fetch())    
                            echo $fila->articulosUser().'<br/>';
                        } catch (PDOException $e){
                            echo 'Error: '.$e->getMessage();
                        }
                        ?>
                        <div class="buscar">
                            <input type="button" value="Volver" onClick="window.location.href='zonaUserArticulos.php'">
                        </div>
                    <?php
                } else if (isset($_POST['codigo'])) {
                    ordenarUser('codigo',$orden);

                } else if (isset($_POST['nombre'])) {
                    ordenarUser('nombre',$orden);

                } else if (isset($_POST['descripcion'])) {
                    ordenarUser('descripcion',$orden);

                } else if (isset($_POST['categoria'])) {
                    ordenarUser('categoria',$orden);

                } else if (isset($_POST['precio'])) {
                    ordenarUser('precio',$orden);

                } else if (isset($_POST['stock'])) {
                    ordenarUser('stock',$orden);

            } else {

                echo cabeceraArticulosUser();
                tablaUserArticulos()
                ?>
                <?php
        }
                ?>
            </body>
    <?php
include("bloques/footer.php");
?>