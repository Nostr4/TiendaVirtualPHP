<?php
include ("includes/seguridadUser.php");
include("includes/clases.php");
include ("funciones/cabeceraTablas.php");
include ("funciones/funciones_varias.php");
$title = "Artículos";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                $dir = 'ASC';
                $dni = $_SESSION['DNI'];

                if (isset($_SESSION['sort']) && $_SESSION['sort'] == 'ASC'){
                    $_SESSION['sort'] = 'DESC';
                    $dir= 'DESC';
                } else {
                    $_SESSION['sort'] = 'ASC';
                }

                ?>
                <div class="buscar">
                    <form action="pedidos.php" method="POST">
                        <input type="text" name="id" value="Nº Pedido" required>
                        <input type="submit" name="search" value="Buscar">
                    </form>
                </div>
                    <?php
                    if (isset($_POST['search'])) {
                        include("includes/conectar_bd.php");
                        $id = $_POST['id'];
                        try {    
                            $stmt = $con->prepare("SELECT * FROM pedidos WHERE dni_user = '$dni' AND id like '%$id%'");
                            $stmt->execute();
                            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (count($resultados) > 0) {
                                echo "<table class='table'>";
                                echo "<tr><th>Nº Pedido</th>
                                <th>Nº Productos</th>
                                <th>Precio Total</th>
                                <th>Dirección</th>
                                <th>Correo</th>
                                <th>Fecha Pedido</th>
                                <th>Estado del pedido</th></tr>";
                                foreach ($resultados as $fila) {
                                    echo "<tr>";
                                    echo "<td>".$fila['id']."</td>";
                                    echo "<td>".$fila['cantidad_productos']."</td>";
                                    echo "<td>".$fila['precio_total'].' €'."</td>";
                                    echo "<td>".$fila['direccion_envio']."</td>";
                                    echo "<td>".$fila['correo_pedido']."</td>";
                                    echo "<td>".$fila['fecha_pedido']."</td>";
                                    echo "<td>".$fila['estado_pedido']."</td>";
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
                          <input type="button" value="Volver" onClick="window.location.href='pedidos.php'">
                        </div>
                        <?php

                } else {

                    try {    
                        $stmt = $con->prepare("SELECT * FROM pedidos WHERE dni_user = '$dni'");
                            if (isset($_GET['orden'])) {
                                $orden = $_GET['orden'];
                                if ($orden == "id") {
                                    $campo = "id";
                                } elseif ($orden == "cantidad_productos") {
                                    $campo = "cantidad_productos";
                                } elseif ($orden == "precio_total") {
                                    $campo = "precio_total";
                                } else {
                                    $campo = "fecha_pedido";
                                }
                            
                                $stmt = $con->prepare("SELECT * FROM pedidos where dni_user = '$dni' ORDER BY $campo $dir");
                            } else {
                                $stmt = $con->prepare("SELECT * FROM pedidos WHERE dni_user = '$dni'");
                            }
                        
                        $stmt->execute();
                        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (count($resultados) > 0) {
                            echo "<table class='table'>";
                            echo "<tr><th><a href='?orden=id&dir=<?php echo ($dir == 'ASC') ? 'DESC' : 'ASC'; ?>Nº Pedido ↕</a></th>
                            <th><a href='?orden=cantidad_productos&dir=<?php echo ($dir == 'ASC') ? 'DESC' : 'ASC'; ?>Nº Productos ↕</a></th>
                            <th><a href='?orden=precio_total&dir=<?php echo ($dir == 'ASC') ? 'DESC' : 'ASC'; ?>Precio Total ↕</a></th>
                            <th>Dirección</th>
                            <th>Correo</th>
                            <th><a href='?orden=fecha_pedido&dir=<?php echo ($dir == 'ASC') ? 'DESC' : 'ASC'; ?>Fecha Pedido ↕</a></th>
                            <th>Estado del pedido</th></tr>";
                            foreach ($resultados as $fila) {
                                echo "<tr>";
                                echo "<td>".$fila['id']."</td>";
                                echo "<td>".$fila['cantidad_productos']."</td>";
                                echo "<td>".$fila['precio_total'].' €'."</td>";
                                echo "<td>".$fila['direccion_envio']."</td>";
                                echo "<td>".$fila['correo_pedido']."</td>";
                                echo "<td>".$fila['fecha_pedido']."</td>";
                                echo "<td>".$fila['estado_pedido']."</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    } catch (PDOException $e){
                        echo 'Error: '.$e->getMessage();
                    }
                }
                ?>
            </body>
    <?php
include("bloques/footer.php");
?>