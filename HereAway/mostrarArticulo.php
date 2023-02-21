<?php
include ("includes/seguridadSessionStart.php");
include ("includes/clases.php");
include ("funciones/cabeceraTablas.php");
include ("funciones/funciones_varias.php");
$cadenaid = $_REQUEST['id'];
$title = "";
 if (substr($cadenaid, 0, 1)  === "j"){
    $cadenaid2 = ucfirst(substr($cadenaid, 3));
    $title = "Juegos de " .$cadenaid2;
 } else if (substr($cadenaid, 0, 1)  === "p") {
    $cadenaid2 = ucfirst(substr($cadenaid, 4));
    $title = "Periféricos de " .$cadenaid2;
 } else if (substr($cadenaid, 0, 1)  === "v"){
    $cadenaid2 = "jg_";
    $cadenaid = $cadenaid2;
    $title = "Videojuegos";
 } else if (substr($cadenaid, 0, 1)  === "s"){
    $cadenaid2 = "per_";
    $cadenaid = $cadenaid2;
    $title = "Periféricos";
 }
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                // Ordenación de resultados
                $orden = 'ASC';

                if (isset($_SESSION['sort']) && $_SESSION['sort'] == 'ASC'){
                    $_SESSION['sort'] = 'DESC';
                    $orden = 'DESC';
                } else {
                    $_SESSION['sort'] = 'ASC';
                }
              
                ?>
                <div class="buscar">
                    <h2><?php echo $title;?></h2>
                    <form id="submit" action="mostrarArticulo.php?id=<?php echo "$cadenaid";?>" method="POST">
                        <input type="text" name="nombre" value="Artículo">
                        <input type="submit" name="search" value="Buscar">
                    </form>
                </div>
                <?php
                if (isset($_POST['search'])) {
                    include ("includes/conectar_bd.php");
                    $nombre = $_POST['nombre'];
                    try {    
                            $stmt = $con->prepare("SELECT * FROM articulos WHERE catalogado = 'Sí' AND categoria like '%$cadenaid%' AND nombre like '%$nombre%'");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_CLASS, 'articulos');
                            //cabecera
                            echo cabeceraMostrarArticulos($cadenaid);
                            while($fila = $stmt->fetch())    
                                echo $fila->articulosUser().'<br/>';
                            } catch (PDOException $e){
                                echo 'Error: '.$e->getMessage();
                            }
                            echo "</table><br/>";              

                } else if (isset($_POST['nombre'])) {
                    ordenarUserId('nombre',$orden , $cadenaid);

                } else if (isset($_POST['precio'])) {
                    ordenarUserId('precio',$orden, $cadenaid);

                } else if (isset($_POST['stock'])) {
                    ordenarUserId('stock',$orden, $cadenaid);

                } else {
                        try {    
                            $stmt = $con->prepare("SELECT * FROM articulos WHERE categoria like '%$cadenaid%' AND catalogado = 'Si'");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_CLASS, 'articulos');
                            //cabecera
                            echo cabeceraMostrarArticulos($cadenaid);
                        while($fila = $stmt->fetch())    
                            echo $fila->articulosUser();
                        } catch (PDOException $e){
                            echo 'Error: '.$e->getMessage();
                        }
                    }
                ?>
                <br>
            </body>
    <?php
include("bloques/footer.php");
?>