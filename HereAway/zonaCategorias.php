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
                <h2>Categorías</h2>
                <div class="buscar">
                    <form action="zonaCategorias.php" method="POST">
                        <input type="text" name="cat" minlength="2" maxlength="50" value="Categoria" required>
                        <input type="submit" name="search" value="Buscar">
                    </form>
                </div>
                    <?php
                    if (isset($_POST['search'])) {
                        include("includes/conectar_bd.php");
                        $nombre = $_POST['cat'];
                        try {    
                            $stmt = $con->prepare("SELECT * FROM categorias where nombre like '%$nombre%'");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_CLASS, 'categorias');
                            //cabecera
                            echo cabeceraCategorias();
                                while($fila = $stmt->fetch())
                                echo $fila->categorias().'<br/>';
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
                          <input type="button" value="Volver" onClick="window.location.href='zonaCategorias.php'">
                        </div>
                        <?php                        
                    } else if (isset($_POST['nombre'])) {
                        tablaCategoriasOrder('nombre',$orden);

                    } else if (isset($_POST['descripcion'])) {
                        tablaCategoriasOrder('descripcion',$orden);

                    } else if (isset($_GET['action']) && $_GET['action'] == "delete") {
                        include("includes/conectar_bd.php");
                        $id = $_REQUEST['id'];
                        $stmt1 = $con->prepare("SELECT * FROM categorias WHERE id like '%{$_REQUEST["id"]}%'");
                        $stmt1->execute();
                        $results = $stmt1->fetchAll(PDO::FETCH_OBJ);
                        $stmt = $con->prepare("DELETE FROM categorias WHERE id like '%{$_REQUEST["id"]}%'");
                        if($stmt->execute()){
                                echo "<h2>La categoría se ha borrado correctamente</h2>";
                                $stmt2 = $con->prepare("UPDATE articulos SET catalogado='No' WHERE categoria=:categoria");
                                $stmt2->bindParam(":categoria", $results[0]->nombre);
                                $stmt2->execute();
                                ?>
                                <script>
                                    $(document).ready(function() {
                                    $(".buscar").hide();                               
                                    });
                                </script>
                                <div>
                                <input type="button" value="Volver" onClick="window.location.href='zonaCategorias.php'">
                                </div>
                                <?php    
                    } else {
                        echo "<h2>Algo ha fallado, vuelva a intentarlo o contacte con el administrador.</h2>";?>
                        <div class="buscar">
                          <input type="button" value="Volver" onClick="window.location.href='zonaCategorias.php'">
                        </div>
                        <?php
                    }

                } else {
                    echo cabeceraCategorias();
                    tablaCategorias();
                }
                ?>
                <div class="buscar"><br>
                    <input type="button" value="Nueva Categoría" onClick="window.location.href='formularioCategoria.php'">
                </div>
            </body>
    <?php
include("bloques/footer.php");
?>