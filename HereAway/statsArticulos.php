<?php
include ("includes/seguridadAdmin.php");
include("includes/conectar_bd.php");
$title = "Histórico de Artículos";
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
            <h2>Histórico de Artículos</h2>
            <div class="buscar">
                    <form action="statsArticulos.php" method="POST">
                        <input type="text" name="dni" minlength="2" maxlength="50" value="Código" required>
                        <input type="submit" name="search" value="Buscar">
                    </form>
                </div>
            <?php
            if (isset($_POST['search'])) {
                    $id = $_REQUEST['dni'];
                    include("includes/conectar_bd.php");
                        try {    
                            $stmt = $con->prepare("SELECT * FROM log_articulos WHERE focus like '%$id%'");
                            $stmt->execute();
                            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (count($resultados) > 0) {
                                echo "<table class='table'>";
                                echo "<tr><th>Artículo</th>
                                <th>Acción</th>
                                <th>Gestor</th>
                                <th>Fecha</th></tr>";
                                foreach ($resultados as $fila) {
                                    echo "<tr>";
                                    echo "<td>".$fila['focus']."</td>";
                                    echo "<td>".$fila['accion']."</td>";
                                    echo "<td>".$fila['gestor']."</td>";
                                    echo "<td>".$fila['fecha']."</td>";
                                    echo "</tr>";
                                }
                                echo "</table><br>";
                            }
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
                          <input type="button" value="Volver" onClick="window.location.href='statsArticulos.php'">
                        </div>
                        <?php

                } else {

                    try {    
                        $stmt = $con->prepare("SELECT * FROM log_articulos");
                            if (isset($_GET['orden'])) {
                                $orden = $_GET['orden'];
                                if ($orden == "focus") {
                                    $campo = "focus";
                                } elseif ($orden == "gestor") {
                                    $campo = "gestor";
                                } else {
                                    $campo = "fecha";
                                }
                            
                                $stmt = $con->prepare("SELECT * FROM log_articulos ORDER BY $campo $dir");
                            } else {
                                $stmt = $con->prepare("SELECT * FROM log_articulos");
                            }
                        
                        $stmt->execute();
                        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (count($resultados) > 0) {
                            echo "<table class='table'>";
                            echo "<tr><th><a href='?orden=focus&dir=<?php echo ($dir == 'ASC') ? 'DESC' : 'ASC'; ?>Artículo ↕</a></th>
                            <th>Acción</th>
                            <th><a href='?orden=gestor&dir=<?php echo ($dir == 'ASC') ? 'DESC' : 'ASC'; ?>Gestor ↕</a></th>
                            <th><a href='?orden=fecha&dir=<?php echo ($dir == 'ASC') ? 'DESC' : 'ASC'; ?>Fecha ↕</a></th></tr>";
                            foreach ($resultados as $fila) {
                                echo "<tr>";
                                echo "<td>".$fila['focus']."</td>";
                                echo "<td>".$fila['accion']."</td>";
                                echo "<td>".$fila['gestor']."</td>";
                                echo "<td>".$fila['fecha']."</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    } catch (PDOException $e){
                        echo 'Error: '.$e->getMessage();
                    }
                }
                ?>
                <div>
                    <br><input type="button" value="Volver" onClick="window.location.href='historicos.php'">
                </div>
            </body>
    <?php
include("bloques/footer.php");
?>