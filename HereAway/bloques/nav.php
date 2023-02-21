    <?php
    include ("./includes/conectar_bd.php");
    $consulta = "SELECT * FROM categorias WHERE nombre LIKE 'jg_%'";
    $stmt = $con->prepare($consulta);
    $stmt->execute();
    $resultados = $stmt->fetchAll();

    $consulta2 = "SELECT * FROM categorias WHERE nombre LIKE 'per_%'";
    $stmt = $con->prepare($consulta2);
    $stmt->execute();
    $resultados2 = $stmt->fetchAll();
    ?>
    <div class="left-column">
        <nav>
            <ul>
            <li>
            <a href='./zonaUserArticulos.php'>Catálogo</a>
            </li>
            <li>
                <a href='./mostrarArticulo.php?id=v'>VideoJuegos</a>
                <ul>
                    <?php
                    foreach ($resultados as $registro) {
                        $cadena = $registro['nombre'];
                        $cadena2 = ucfirst(substr($cadena, 3));
                        echo "<li><a href='./mostrarArticulo.php?id=$cadena'>$cadena2</a></li>";
                    }
                    ?>
                </ul>
            </li>
            <li>
                <a href='./mostrarArticulo.php?id=s'>Periféricos</a>
                <ul>
                    <?php
                    foreach ($resultados2 as $registro) {
                        $cadena = $registro['nombre'];
                        $cadena2 = ucfirst(substr($cadena, 4));
                        echo "<li><a href='./mostrarArticulo.php?id=$cadena'>$cadena2</a></li>";
                    }
                    ?>
                </ul>
            </li>
            </ul>
        </nav>
    </div>
<div class="center-column">
    <div id="main">
