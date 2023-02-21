<?php
function selector($rol){

    if ($rol == "Admin") {
        echo "
        <select id='rol' name='rol_id2' required>
            <option value='Admin' selected>Admin</option>
            <option value='Editor'>Editor</option>
            <option value='Usuario'>Usuario</option>
        </select> ";
    } else if ($rol == "Editor") {
        echo "
        <select id='rol' name='rol_id2' required>
            <option value='Admin'>Admin</option>
            <option value='Editor' selected>Editor</option>
            <option value='Usuario'>Usuario</option>
        </select> ";   
    } else if ($rol == "Usuario") {
        echo "
        <select id='rol' name='rol_id2' required>
            <option value='Admin'>Admin</option>
            <option value='Editor'>Editor</option>
            <option value='Usuario' selected>Usuario</option>
        </select> ";
    }
}

function activa($activa){

    if ($activa == "Sí") {
        echo "
        <select id='activa' name='activa' required>
            <option value='Sí' selected>Sí</option>
            <option value='No'>No</option>
        </select> ";
    } else {
        echo "
        <select id='activa' name='activa' required>
            <option value='Sí' >Sí</option>
            <option value='No' selected>No</option>
        </select> ";
    }
}

function catalogado($catalogado){

    if ($catalogado == "Sí") {
        echo "
        <select id='catalogado' name='catalogado' required>
            <option value='Sí' selected>Sí</option>
            <option value='No'>No</option>
        </select> ";
    } else {
        echo "
        <select id='catalogado' name='catalogado' required>
            <option value='Sí' >Sí</option>
            <option value='No' selected>No</option>
        </select> ";
    }
}

function tablaAdminOrder($atributo, $orden){

    include("./includes/conectar_bd.php");
    $registros_por_pagina = 5;

    $consulta = "SELECT COUNT(*) FROM clientes";
    $stmt = $con->prepare($consulta);
    $stmt->execute();
    $num_total_registros = $stmt->fetchColumn();
    
    $total_paginas = ceil($num_total_registros / $registros_por_pagina);
    
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    $registro_inicio = ($page - 1) * $registros_por_pagina;
    $consulta = "SELECT * FROM clientes ORDER BY $atributo $orden LIMIT :registro_inicio, :registros_por_pagina";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':registro_inicio', $registro_inicio, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll();
    echo cabecera();
    echo "<table class='table'>";
        foreach ($resultados as $registro) {
            if ($registro['DNI'] == $_SESSION['DNI']){
            echo "<tr>";
            echo "<td>" . $registro['DNI'] . "</td>";
            echo "<td>" . $registro['nombre'] . "</td>";
            echo "<td>" . $registro['direccion'] . "</td>";
            echo "<td>" . $registro['localidad'] . "</td>";
            echo "<td>" . $registro['provincia'] . "</td>";
            echo "<td>" . $registro['telefono'] . "</td>";
            echo "<td>" . $registro['email'] . "</td>";
            echo "<td>" . $registro['activa'] . "</td>";
            echo "<td>X</td>";
            echo "<td>X</td>";
            echo "</tr>";
        } else {
            echo "<tr>";
            echo "<td>" . $registro['DNI'] . "</td>";
            echo "<td>" . $registro['nombre'] . "</td>";
            echo "<td>" . $registro['direccion'] . "</td>";
            echo "<td>" . $registro['localidad'] . "</td>";
            echo "<td>" . $registro['provincia'] . "</td>";
            echo "<td>" . $registro['telefono'] . "</td>";
            echo "<td>" . $registro['email'] . "</td>";
            echo "<td>" . $registro['activa'] . "</td>";
            echo "<td><a href='editarcliente.php?id=" . $registro['DNI'] . "'><i class='fas fa-edit'></i></a></td>";
            echo "<td><a href='zona.php?id=" . $registro['DNI'] . "&action=delete' onclick='confirmDelete(this.href); return false;'><i class='fas fa-ban'></i></a></td>";
            echo "</tr>";
        }            
    }
    echo "</table>";
    

    for ($page=1;$page<=$total_paginas;$page++) {
        echo '<a href="zona.php?page=' . $page . '">' . $page . '</a> ';
        }

    }  

function tablaArticulosOrder($atributo, $orden){
    include("./includes/conectar_bd.php");
    $registros_por_pagina = 5;

    $consulta = "SELECT COUNT(*) FROM articulos";
    $stmt = $con->prepare($consulta);
    $stmt->execute();
    $num_total_registros = $stmt->fetchColumn();
    
    $total_paginas = ceil($num_total_registros / $registros_por_pagina);
    
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    $registro_inicio = ($page - 1) * $registros_por_pagina;
    $consulta = "SELECT * FROM articulos ORDER BY $atributo $orden LIMIT :registro_inicio, :registros_por_pagina";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':registro_inicio', $registro_inicio, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll();

    echo cabeceraArticulos();
    echo "<table class='table'>";
        foreach ($resultados as $registro) {
            echo "<tr>";
            echo "<td>" . $registro['codigo'] . "</td>";
            echo "<td>" . $registro['nombre'] . "</td>";
            echo "<td>" . $registro['descripcion'] . "</td>";
            echo "<td>" . $registro['categoria'] . "</td>";
            echo "<td>" . $registro['precio'] . "</td>";
            echo "<td><img src='" . $registro['imagen'] . "'</td>";
            echo "<td>" . $registro['stock'] . "</td>";
            echo "<td>" . $registro['catalogado'] . "</td>";
            echo "<td><a href='editarArticulo.php?id=" . $registro['id'] . "'><i class='fas fa-edit'></i></a></td>";
            echo "<td><a href='zonaArticulos.php?id=" . $registro['id'] . "&action=delete' onclick='confirmDelete(this.href); return false;'><i class='fas fa-ban'></i></a></td>";
            echo "</tr>";           
    }
    echo "</table>";
    

    for ($page=1;$page<=$total_paginas;$page++) {
        echo '<a href="zonaArticulos.php?page=' . $page . '">' . $page . '</a> ';
        }

    }  

function ordenarUser($atributo, $orden){
    include("./includes/conectar_bd.php");
    $registros_por_pagina = 5;

    $consulta = "SELECT COUNT(*) FROM articulos WHERE catalogado = 'Sí'";
    $stmt = $con->prepare($consulta);
    $stmt->execute();
    $num_total_registros = $stmt->fetchColumn();
    
    $total_paginas = ceil($num_total_registros / $registros_por_pagina);
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    $registro_inicio = ($page - 1) * $registros_por_pagina;
    $consulta = "SELECT * FROM articulos WHERE catalogado = 'Sí' ORDER BY $atributo $orden LIMIT :registro_inicio, :registros_por_pagina";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':registro_inicio', $registro_inicio, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll();

    echo cabeceraArticulosUser();
    echo "<table class='table'>";
        foreach ($resultados as $registro) {
            echo "<tr>";
            echo "<td>" . $registro['nombre'] . "</td>";
            echo "<td>" . $registro['descripcion'] . "</td>";
            echo "<td><img src='" . $registro['imagen'] . "'</td>";
            echo "<td>" . $registro['precio'] . "</td>";
            echo "<td>" . $registro['stock'] . "</td>";
            echo "<td>  <form method='post' action='cart.php'>
                            <input type='hidden' name='id' value='" . $registro['id'] . "'>
                            <input type='hidden' name='nombre' value='" . $registro['nombre'] . "'>
                            <input type='hidden' name='descripcion' value='" . $registro['descripcion'] . "'>
                            <input type='hidden' name='imagen' value='" . $registro['imagen'] . "'>
                            <input type='hidden' name='precio' value='" . $registro['precio'] . "'>
                            <input type='hidden' name='stock' value='" . $registro['stock'] . "'>
                            <button type='submit'><i class='fas fa-cart-plus'></i></button>
                        </form></td>";
            echo "</tr>";              
    }
    echo "</table>";
    

    for ($page=1;$page<=$total_paginas;$page++) {
        echo '<a href="zonaUserArticulos.php?page=' . $page . '">' . $page . '</a> ';
        }
}

function ordenarUserId($atributo, $orden, $cadenaid){
    include("./includes/conectar_bd.php");
    $registros_por_pagina = 5;

    $consulta = "SELECT COUNT(*) FROM articulos WHERE catalogado = 'Sí' AND categoria = '$cadenaid'";
    $stmt = $con->prepare($consulta);
    $stmt->execute();
    $num_total_registros = $stmt->fetchColumn();
    
    $total_paginas = ceil($num_total_registros / $registros_por_pagina);
    
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    if ($cadenaid == "jg_"){
            $consulta = "SELECT * FROM articulos WHERE catalogado = 'Sí' AND categoria like '%$cadenaid%' ORDER BY $atributo $orden";
            $stmt = $con->prepare($consulta);
            $stmt->execute();
            $resultados = $stmt->fetchAll();
            $cadenaid = 'v';
    
            echo cabeceraMostrarArticulos($cadenaid);
            echo "<table class='table'>";
                foreach ($resultados as $registro) {
                    echo "<tr>";
                    echo "<td>" . $registro['nombre'] . "</td>";
                    echo "<td>" . $registro['descripcion'] . "</td>";
                    echo "<td><img src='" . $registro['imagen'] . "'</td>";
                    echo "<td>" . $registro['precio'] . "</td>";
                    echo "<td>" . $registro['stock'] . "</td>";
                    echo "<td>  <form method='post' action='cart.php'>
                                    <input type='hidden' name='id' value='" . $registro['id'] . "'>
                                    <input type='hidden' name='nombre' value='" . $registro['nombre'] . "'>
                                    <input type='hidden' name='descripcion' value='" . $registro['descripcion'] . "'>
                                    <input type='hidden' name='imagen' value='" . $registro['imagen'] . "'>
                                    <input type='hidden' name='precio' value='" . $registro['precio'] . "'>
                                    <input type='hidden' name='stock' value='" . $registro['stock'] . "'>
                                    <button type='submit'><i class='fas fa-cart-plus'></i></button>
                                </form></td>";
                    echo "</tr>";           
            }
            echo "</table>";
    
    } else if ($cadenaid == "per_") {
            $consulta = "SELECT * FROM articulos WHERE catalogado = 'Sí' AND categoria like '%$cadenaid%' ORDER BY $atributo $orden";
            $stmt = $con->prepare($consulta);
            $stmt->execute();
            $resultados = $stmt->fetchAll();
            $cadenaid = 's';
    
            echo cabeceraMostrarArticulos($cadenaid);
            echo "<table class='table'>";
                foreach ($resultados as $registro) {
                    echo "<tr>";
                    echo "<td>" . $registro['nombre'] . "</td>";
                    echo "<td>" . $registro['descripcion'] . "</td>";
                    echo "<td><img src='" . $registro['imagen'] . "'</td>";
                    echo "<td>" . $registro['precio'] . "</td>";
                    echo "<td>" . $registro['stock'] . "</td>";
                    echo "<td>  <form method='post' action='cart.php'>
                                    <input type='hidden' name='id' value='" . $registro['id'] . "'>
                                    <input type='hidden' name='nombre' value='" . $registro['nombre'] . "'>
                                    <input type='hidden' name='descripcion' value='" . $registro['descripcion'] . "'>
                                    <input type='hidden' name='imagen' value='" . $registro['imagen'] . "'>
                                    <input type='hidden' name='precio' value='" . $registro['precio'] . "'>
                                    <input type='hidden' name='stock' value='" . $registro['stock'] . "'>
                                    <button type='submit'><i class='fas fa-cart-plus'></i></button>
                                </form></td>";
                    echo "</tr>";           
            }
            echo "</table>";
    
    } else {
    
    $registro_inicio = ($page - 1) * $registros_por_pagina;
    $consulta = "SELECT * FROM articulos WHERE catalogado = 'Sí' AND categoria like '%$cadenaid%' ORDER BY $atributo $orden LIMIT :registro_inicio, :registros_por_pagina";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':registro_inicio', $registro_inicio, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll();

    echo cabeceraMostrarArticulos($cadenaid);
    echo "<table class='table'>";
        foreach ($resultados as $registro) {
            echo "<tr>";
            echo "<td>" . $registro['nombre'] . "</td>";
            echo "<td>" . $registro['descripcion'] . "</td>";
            echo "<td><img src='" . $registro['imagen'] . "'</td>";
            echo "<td>" . $registro['precio'] . "</td>";
            echo "<td>" . $registro['stock'] . "</td>";
            echo "<td>  <form method='post' action='cart.php'>
                            <input type='hidden' name='id' value='" . $registro['id'] . "'>
                            <input type='hidden' name='nombre' value='" . $registro['nombre'] . "'>
                            <input type='hidden' name='descripcion' value='" . $registro['descripcion'] . "'>
                            <input type='hidden' name='imagen' value='" . $registro['imagen'] . "'>
                            <input type='hidden' name='precio' value='" . $registro['precio'] . "'>
                            <input type='hidden' name='stock' value='" . $registro['stock'] . "'>
                            <button type='submit'><i class='fas fa-cart-plus'></i></button>
                        </form></td>";
            echo "</tr>";           
    }
    echo "</table>";
    

    for ($page=1;$page<=$total_paginas;$page++) {
        echo '<a href="mostrarArticulo.php?id='.$cadenaid.'&page=' . $page . '">' . $page . '</a> ';
        }
    }
}

function cat_selector(){
    include("./includes/conectar_bd.php");
    try {
        $query = "SELECT nombre FROM categorias";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $nombres = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($nombres as $nombre) {
            echo "<option value='$nombre'>$nombre</option>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function cat_selector2($cat){
    include("./includes/conectar_bd.php");
    try {
        $query = "SELECT nombre FROM categorias";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $nombres = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($nombres as $nombre) {
            if (strtoupper($nombre) == $cat || $nombre == $cat){
                echo "<option value='$nombre' selected>$nombre</option>";
            } else {
                echo "<option value='$nombre'>$nombre</option>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function tablaCategoriasOrder($atributo, $orden){

    include("./includes/conectar_bd.php");
    $registros_por_pagina = 5;

    $consulta = "SELECT COUNT(*) FROM categorias";
    $stmt = $con->prepare($consulta);
    $stmt->execute();
    $num_total_registros = $stmt->fetchColumn();
    
    $total_paginas = ceil($num_total_registros / $registros_por_pagina);
    
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    $registro_inicio = ($page - 1) * $registros_por_pagina;
    $consulta = "SELECT * FROM categorias ORDER BY $atributo $orden LIMIT :registro_inicio, :registros_por_pagina";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':registro_inicio', $registro_inicio, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll();
    echo cabeceraCategorias();
    echo "<table class='table'>";
        foreach ($resultados as $registro) {
            echo "<tr>";
            echo "<td>" . $registro['nombre'] . "</td>";
            echo "<td>" . $registro['descripcion'] . "</td>";
            echo "<td><a href='editarCategoria.php?id=" . $registro['id'] . "'><i class='fas fa-edit'></i></a></td>";
            echo "<td><a href='zonaCategorias.php?id=" . $registro['id'] . "&action=delete' onclick='confirmDelete(this.href); return false;'><i class='fas fa-ban'></i></a></td>";
            echo "</tr>";
        }            
    echo "</table>";
    

    for ($page=1;$page<=$total_paginas;$page++) {
        echo '<a href="zonaCategorias.php?page=' . $page . '">' . $page . '</a> ';
        }
}
  
?>
