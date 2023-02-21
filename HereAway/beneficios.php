<?php
include ("includes/seguridadAdmin.php");
include("includes/conectar_bd.php");
$title = "Más Beneficios";
include ("bloques/doctype.php");
            include ("bloques/header.php");
            include ("bloques/nav.php");
            $dir = 'ASC';

            if (isset($_SESSION['sort']) && $_SESSION['sort'] == 'ASC'){
                $_SESSION['sort'] = 'DESC';
                $dir= 'DESC';
            } else {
                $_SESSION['sort'] = 'ASC';
            }

            ?>
            <h2>Productos con más beneficio</h2>
            <?php
                try {    
                    $stmt = $con->prepare("SELECT * FROM articulos where beneficio > 0 ORDER BY beneficio DESC");
                        if (isset($_GET['orden'])) {
                            $orden = $_GET['orden'];
                            if ($orden == "beneficio") {
                                $campo = "beneficio";
                            }
                        
                            $stmt = $con->prepare("SELECT * FROM articulos where beneficio > 0 ORDER BY $campo $dir");
                        } else {
                            $stmt = $con->prepare("SELECT * FROM articulos where beneficio > 0 ORDER BY beneficio DESC");
                        }
                    
                    $stmt->execute();
                    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (count($resultados) > 0) {
                        echo "<table class='table'>";
                        echo "<tr><th>codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Unidades Vendidas</th>
                        <th><a href='?orden=beneficio&dir=".($dir == 'ASC' ? 'DESC' : 'ASC')."'>Beneficio ↕</a></th>";
                        foreach ($resultados as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila['codigo']."</td>";
                            echo "<td>".$fila['nombre']."</td>";
                            echo "<td>".$fila['precio']."</td>";
                            echo "<td>".$fila['stock']."</td>";
                            echo "<td>".$fila['UnidadesV']."</td>";
                            echo "<td>".$fila['beneficio']."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                } catch (PDOException $e){
                    echo 'Error: '.$e->getMessage();
                }
            ?>
            <div>
                <br><input type="button" value="Volver" onClick="window.location.href='stats.php'">
            </div>
            </body>
    <?php
include("bloques/footer.php");
?>