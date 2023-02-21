<div class="right-column">
    <?php 
        if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 'Usuario')) {
            echo "<div id='aside-icons'>
                    <a href='zonaUser.php'>
                        <i class='fa-solid fa-user'></i>                     
                        <span class='tooltiptext'>Perfil</span>
                    </a>
                    <a href='pedidos.php'>
                        <i class='fas fa-luggage-cart'></i>
                        <span class='tooltiptext'>Mis Pedidos</span>
                    </a>
                    <a href='carrito.php'>
                        <i class='fa-solid fa-cart-shopping'></i>
                        <span class='tooltiptext'>Carrito</span>
                    </a>
                  </div>";
        } else if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 'Admin')) {
            echo "<div id='aside-icons'>
                    <a href='zonaUser.php'>
                        <i class='fa-solid fa-user'></i>                     
                        <span class='tooltiptext'>Perfil</span>
                    </a>
                    <a href='menu.php'>
                        <i class='fa-sharp fa-solid fa-pen'></i>
                        <span class='tooltiptext'>Administrar</span>
                    </a>
                    <a href='pedidos.php'>
                        <i class='fas fa-luggage-cart'></i>
                        <span class='tooltiptext'>Mis Pedidos</span>
                    </a>
                    <a href='carrito.php'>
                        <i class='fa-solid fa-cart-shopping'></i>
                        <span class='tooltiptext'>Carrito</span>
                    </a>
                </div>";
        } else if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 'Editor')){
            echo "<div id='aside-icons'>
                    <a href='zonaUser.php'>
                        <i class='fa-solid fa-user'></i>                     
                        <span class='tooltiptext'>Perfil</span>
                    </a>
                    <a href='menu.php'>
                        <i class='fa-sharp fa-solid fa-pen'></i>
                        <span class='tooltiptext'>Editar</span>
                    </a>
                    <a href='pedidos.php'>
                        <i class='fas fa-luggage-cart'></i>
                        <span class='tooltiptext'>Mis Pedidos</span>
                    </a>
                    <a href='carrito.php'>
                        <i class='fa-solid fa-cart-shopping'></i>
                        <span class='tooltiptext'>Carrito</span>
                    </a>
                </div>";
        } else {
            echo" <div id='aside-icons'>
                        <a href='carrito.php'>
                            <i class='fa-solid fa-cart-shopping'></i>
                            <span class='tooltiptext'>Carrito</span>
                        </a> 
                  </div>";
        }
            echo "<div id='carrito'>";
                    if (isset($_SESSION['carrito'])) {
                        echo "<table id='carrito2'><thead><tr>";
                        echo "<th>Artículo</th><th></th><th>€</th><th>Ud/s</th><th>Total</th></tr>";
                        echo "</thead><tbody>";
                        $maxtotal= 0;
                        foreach ($_SESSION['carrito'] as $producto) {                           
                            $total=$producto['precio']*$producto['cantidad'];
                            $maxtotal= $maxtotal + $total;
                            echo "<tr>";
                            echo "<td>" . $producto['nombre'] . "</td>";
                            echo "<td><img src='" . $producto['imagen'] . "'></td>";
                            echo "<td>" . $producto['precio'] . "</td>";
                            echo "<td>" . $producto['cantidad'] . "</td>";
                            echo "<td>" . $total . "</td>";
                            echo "</tr>";
                        }
                            echo "<tr></tr><tr><td></td><td></td><td></td><td>Total:</td><td>$maxtotal €</td></tr>";
                            echo "</tbody></table>";
                    }
            echo  "</div>";
    ?>
</div>