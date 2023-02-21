<?php
include ("includes/seguridadSessionStart.php");
include ("includes/clases.php");
include ("funciones/cabeceraTablas.php");
include ("funciones/funciones_varias.php");
$title = "Carrito";
include ("bloques/doctype.php");
include ("bloques/header.php");
include ("bloques/nav.php");
?>
    <script>
    $(document).ready(function() {
        $("#carrito2").hide();                               
    });
    </script>
                <?php
                echo "<h2>Cesta de la Compra</h2><br>";
                    if (isset($_SESSION['carrito'])) {
                        echo "<div id='carrito'>";
                        echo "<table id='carritoFinal'><thead><tr>";
                        echo "<th>Artículo</th><th></th><th>€</th><th>Ud/s</th><th>Total</th></tr>";
                        echo "</thead><tbody>";
                        $maxtotal= 0;
                        $maxcantidad = 0;
                        foreach ($_SESSION['carrito'] as $producto) {                           
                            $total=$producto['precio']*$producto['cantidad'];
                            $maxtotal= $maxtotal + $total;
                            $maxcantidad= $maxcantidad + $producto['cantidad'];
                            echo "<tr>";
                            echo "<td>" . $producto['nombre'] . "</td>";

                            echo "<td><img src='" . $producto['imagen'] . "'></td>";
                            echo "<td>" . $producto['precio'] . "</td>";
                            echo "<td>";
                                if ($producto['cantidad'] < $producto['stock']) {
                                    echo "<form method='POST' action='sumar_producto.php'><input type='hidden' name='id' value='" . $producto['id'] . "'/><button type='submit'>+</button></form>";
                                }
                                    echo $producto['cantidad'];
                                if ($producto['cantidad'] > 0) {
                                    echo "<form method='POST' action='restar_producto.php'><input type='hidden' 
                                    name='id' value='" . $producto['id'] . "'/><button type='submit'>-</button></form>";
                                }
                            echo "</td>";
                            echo "<td>" . $total . "</td>";
                            echo "</tr>";
                        }
                            echo "<tr></tr><tr><td></td><td></td><td></td><td>Total:</td><td>$maxtotal €</td></tr>";
                            echo "</tbody></table><br>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' onclick=\"location.href='vaciar_carrito.php'\" value='Vaciar Carrito'/>&nbsp;&nbsp;&nbsp;&nbsp;";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"Continuar Comprando\" onclick=\"location.href='zonaUserArticulos.php'\" /><br>&nbsp;&nbsp;&nbsp;&nbsp;<br>";
                            if (isset($_SESSION['rol'])){
                                echo    "<form action='carrito.php' method='POST'>
                                        <input type='submit' name='guardar_carrito' value='Finalizar Compra'>
                                        </form>";
                            } else {
                                echo "<input type=\"button\" value=\"Inicia sesión para continuar\" onclick=\"location.href='entrar.php'\" />";
                            }
                            echo  "</div>";
                    } else {
                        echo "<h2>No hay artículos que mostrar</h2>";
                    }

                    if (isset($_POST['guardar_carrito'])) {
                        include("includes/conectar_bd.php");
                    
                        // Obtener los datos del carrito almacenados en la variable de sesión
                        $carrito = $_SESSION['carrito'];
                        $pedido_status = "Completado";
                    
                        // Obtener la hora exacta en el momento actual
                        $hora_actual = date("Y-m-d H:i:s");
                    
                        try {
                            $query = "INSERT INTO pedidos (dni_user, cantidad_productos, precio_total, direccion_envio, correo_pedido, fecha_pedido, estado_pedido) VALUES (:dni_user, :cantidad_productos, :precio_total, :direccion_envio, :correo_pedido, :fecha_pedido, :estado_pedido)";
                            $stmt = $con->prepare($query);
                            $stmt->bindParam(':dni_user', $_SESSION['DNI']);
                            $stmt->bindParam(':cantidad_productos', $maxcantidad);
                            $stmt->bindParam(':precio_total', $maxtotal);
                            $stmt->bindParam(':direccion_envio', $_SESSION['direccion']);
                            $stmt->bindParam(':correo_pedido', $_SESSION['nombre']);
                            $stmt->bindParam(':fecha_pedido', $hora_actual);
                            $stmt->bindParam(':estado_pedido', $pedido_status);
                            $stmt->execute();

                                foreach ($carrito as $producto) {
                                    $id_producto = $producto['id'];
                                    $cantidad = $producto['cantidad'];
                                    $bene = $producto['cantidad'] * $producto['precio'];
                                
                                    $query = "UPDATE articulos SET stock = stock - :cantidad WHERE id = :id_producto";
                                    $stmt = $con->prepare($query);
                                    $stmt->bindParam(':cantidad', $cantidad);
                                    $stmt->bindParam(':id_producto', $id_producto);
                                    $stmt->execute();

                                    $query2 = "UPDATE articulos SET UnidadesV = unidadesV + :cantidad WHERE id = :id_producto";
                                    $stmt2 = $con->prepare($query2);
                                    $stmt2->bindParam(':cantidad', $cantidad);
                                    $stmt2->bindParam(':id_producto', $id_producto);
                                    $stmt2->execute();

                                    $query2 = "UPDATE articulos SET beneficio = beneficio + :bene WHERE id = :id_producto";
                                    $stmt2 = $con->prepare($query2);
                                    $stmt2->bindParam(':bene', $bene);
                                    $stmt2->bindParam(':id_producto', $id_producto);
                                    $stmt2->execute();
                                }

                            unset($_SESSION['carrito']);

                            ?>
                                <script>
                                    $(document).ready(function() {
                                        $("#carrito").hide();                               
                                    });
                                </script>
                            <?php

                        } catch (PDOException $e) {
                            echo "Error al enviar el pedido: " . $e->getMessage();
                            exit();
                        }

                        echo "<h2>Pedido realizado con éxito</h2>";
                    }
              
            ?>
        </body>
    <?php
include("bloques/footer.php");
?>