<?php
include ("includes/seguridadEditor.php");
include("includes/clases.php");
include ("funciones/cabeceraTablas.php");
include ("funciones/funciones_varias.php");
$title = "Artículos";
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
                <h2>Artículos</h2>
                <div class="buscar">
                    <form action="zonaArticulos.php" method="POST">
                        <input type="text" name="nombre" minlength="2" maxlength="50" value="Artículo" required>
                        <input type="submit" name="search" value="Buscar">
                    </form>
                </div>
                    <?php
                    if (isset($_POST['search'])) {
                        include("includes/conectar_bd.php");
                        $nombre = $_POST['nombre'];
                        try {    
                            $stmt = $con->prepare("SELECT * FROM articulos where nombre like '%$nombre%'");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_CLASS, 'articulos');
                            //cabecera
                            echo cabeceraArticulos();
                            while($fila = $stmt->fetch())    
                            echo $fila->articulos().'<br/>';
                        } catch (PDOException $e){
                            echo 'Error: '.$e->getMessage();
                        }
                        ?>
                        <script>
                            $(document).ready(function() {
                            $(".buscar").hide();                               
                            });
                        </script>
                        <div>
                          <input type="button" value="Volver" onClick="window.location.href='zonaArticulos.php'">
                        </div>
                        <?php                        
                    } else if (isset($_POST['codigo'])) {
                        tablaArticulosOrder('codigo',$orden);

                    } else if (isset($_POST['nombre'])) {
                        tablaArticulosOrder('nombre',$orden);

                    } else if (isset($_POST['descripcion'])) {
                        tablaArticulosOrder('descripcion',$orden);

                    } else if (isset($_POST['categoria'])) {
                        tablaArticulosOrder('categoria',$orden);

                    } else if (isset($_POST['precio'])) {
                        tablaArticulosOrder('precio',$orden);

                    } else if (isset($_POST['catalogado'])) {
                        tablaArticulosOrder('catalogado',$orden);

                    } else if (isset($_POST['stock'])) {
                        tablaArticulosOrder('stock',$orden);

                    } else if (isset($_GET['action']) && $_GET['action'] == "delete") {
                        include("includes/conectar_bd.php");
                        $id = $_REQUEST['id'];
                        $stmt1 = $con->prepare("SELECT * FROM articulos WHERE id like '%{$_REQUEST["id"]}%'");
                        $stmt1->execute();
                        $results = $stmt1->fetchAll(PDO::FETCH_OBJ);
                        $cod = $results[0]->codigo;

                        $stmt = $con->prepare("DELETE FROM articulos WHERE id like '%{$_REQUEST["id"]}%'");

                        if ($stmt->execute()) {
                            $stmt2 = $con->prepare("INSERT INTO log_articulos VALUES (:dni, 'Baja', :s, NOW())");
                            $stmt2->execute(array(':dni'=>$cod, 's'=>$_SESSION['DNI']));
                        }  
                        if($stmt->execute()){
                            foreach($results as $result){
                                unlink($result->imagen);
                            }
                                echo "<h2>El Artículo se ha borrado correctamente</h2>";?>
                                <script>
                                    $(document).ready(function() {
                                    $(".buscar").hide();                               
                                    });
                                </script>
                                <div>
                                <input type="button" value="Volver" onClick="window.location.href='zonaArticulos.php'">
                                </div>
                                <?php    
                    } else {
                        echo "<h2>Algo ha fallado, vuelva a intentarlo o contacte con el administrador.</h2>";?>
                        <div class="buscar">
                          <input type="button" value="Volver" onClick="window.location.href='zonaArticulos.php'">
                        </div>
                        <?php
                    }

                } else {
                    echo cabeceraArticulos();
                    tablaArticulos();
                }
                ?>
                <div class="buscar"><br>
                    <input type="button" value="Nuevo Artículo" onClick="window.location.href='formularioArticulo.php'">
                </div>
            </body>
    <?php
include("bloques/footer.php");
?>