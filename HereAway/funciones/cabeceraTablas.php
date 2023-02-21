<?php
function cabecera(){
        $table = "<table class='table-cabecera'".
            "<tr>".
                "<td><form id='submit' action='zona.php' method='POST'><button type='submit' name='DNI' value='DNI'>DNI</button></form></td>".
                "<td><form id='submit' action='zona.php' method='POST'><button type='submit' name='nombre' value='Nombre'>Nombre</button></form></td>".
                "<td><form id='submit' action='zona.php' method='POST'><button type='submit' name='direccion' value='Dirección'>Dirección</button></form></td>".
                "<td><form id='submit' action='zona.php' method='POST'><button type='submit' name='localidad' value='Localidad'>Localidad</button></form></td>".
                "<td><form id='submit' action='zona.php' method='POST'><button type='submit' name='provincia' value='Provincia'>Provincia</button></form></td>".
                "<td><form id='submit' action='zona.php' method='POST'><button type='submit' name='telefono' value='Teléfono'>Teléfono</button></form></td>".
                "<td><form id='submit' action='zona.php' method='POST'><button type='submit' name='email' value='E-mail'>E-mail</button></form></td>".
                "<td><form id='submit' action='zona.php' method='POST'><button type='submit' name='activa' value='¿Activ@?'>¿Activ@?</button></form></td>".
                "<td class='tdedit'>Editar</td>".
                "<td class='tdborrar'>Borrar</td>".
            "</tr>"."</table>";

        return $table;
}

function cabeceraUser(){
    $table = "<table class='table-cabecera'".
        "<tr>".
            "<td>DNI</td>".
            "<td>Nombre</td>".
            "<td>Dirección</td>".
            "<td>Localidad</td>".
            "<td>Provincia</td>".
            "<td>Teléfono</td>".
            "<td>e-mail</td>".
            "<td class='tdedit'>Editar</td>".
            "<td class='tdborrar'>Borrar</td>".
        "</tr>"."</table>";

    return $table;
}

function cabeceraArticulos(){
        $table = "<table class='table-cabeceraArticulos'>".
            "<tr>".
                "<td><form id='submit' action='zonaArticulos.php' method='POST'><button type='submit' name='codigo' value='Código'>Código</button></form></td>".
                "<td><form id='submit' action='zonaArticulos.php' method='POST'><button type='submit' name='nombre' value='Nombre'>Nombre</button></form></td>".
                "<td><form id='submit' action='zonaArticulos.php' method='POST'><button type='submit' name='descripcion' value='Descripción'>Descripción</button></form></td>".
                "<td><form id='submit' action='zonaArticulos.php' method='POST'><button type='submit' name='categoria' value='Categoría'>Categoría</button></form></td>".
                "<td><form id='submit' action='zonaArticulos.php' method='POST'><button type='submit' name='precio' value='Precio'>Precio</button></form></td>".
                "<td>Imagen</td>".
                "<td><form id='submit' action='zonaArticulos.php' method='POST'><button type='submit' name='stock' value='stock'>Stock</button></form></td>".
                "<td><form id='submit' action='zonaArticulos.php' method='POST'><button type='submit' name='catalogado' value='Catalogado'>Catalogado</button></form></td>".
                "<td class='tdedit'>Editar</td>".
                "<td class='tdborrar'>Borrar</td>".
            "</tr>"."</table>";

        return $table;
}

function cabeceraArticulosUser(){
        $table = "<table class='table-cabeceraArticulosUser'>".
            "<tr>".
            "<td><form id='submit' action='zonaUserArticulos.php' method='POST'><button type='submit' name='nombre' value='Nombre'>Nombre</button></form></td>".
            "<td><form id='submit' action='zonaUserArticulos.php' method='POST'><button type='submit' name='descripcion' value='Descripción'>Descripción</button></form></td>".
            "<td>Imagen</td>".
            "<td><form id='submit' action='zonaUserArticulos.php' method='POST'><button type='submit' name='precio' value='Precio'>Precio</button></form></td>".
            "<td><form id='submit' action='zonaUserArticulos.php' method='POST'><button type='submit' name='stock' value='Stock'>Stock</button></form></td>".
            "<td>Agregar al carrito</td>".
            "</tr>"."</table>";

        return $table;
}

function cabeceraMostrarArticulos($cadenaid){
    if ($cadenaid === "jg_") {
        $cadenaid = "v";
    } else if ($cadenaid === "per_") {
        $cadenaid = "s";
    }
    $table = "<table class='table-cabeceraArticulosUser'>".
        "<tr>".
        "<td><form id='submit' action='mostrarArticulo.php?id=$cadenaid' method='POST'><button type='submit' name='nombre' value='Nombre'>Nombre</button></form></td>".
        "<td>Descripción</td>".
        "<td>Imagen</td>".
        "<td><form id='submit' action='mostrarArticulo.php?id=$cadenaid' method='POST'><button type='submit' name='precio' value='Precio'>Precio</button></form></td>".
        "<td><form id='submit' action='mostrarArticulo.php?id=$cadenaid' method='POST'><button type='submit' name='stock' value='Stock'>Stock</button></form></td>".
        "<td>Agregar al carrito</td>".
        "</tr>"."</table>";

    return $table;
}


function cabeceraCategorias(){
    $table = "<table class='table-cabeceraArticulosUser'>".
        "<tr>".
        "<td><form id='submit' action='zonaCategorias.php' method='POST'><button type='submit' name='nombre' value='Nombre'>Nombre</button></form></td>".
        "<td><form id='submit' action='zonaCategorias.php' method='POST'><button type='submit' name='descripcion' value='Descripción'>Descripción</button></form></td>".
        "<td class='tdedit'>Editar</td>".
        "<td class='tdborrar'>Borrar</td>".
        "</tr>"."</table>";

    return $table;
}
?>