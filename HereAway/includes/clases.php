<script>
    function confirmDelete(url) {
        if (confirm("¿Está seguro de que desea borrar este registro?")) {
        window.location.href = url;
        }
    }
</script>

<!-- Clase Clientes -->

<?php

class cliente{
    private $dni;
    private $nom;
    private $dir;
    private $loc;
    private $pro;
    private $tel;
    private $email;
    private $pass;
    private $rol_id2;
    private $activa;

    public function tablaUser(){
        $table = "<table class='table'".
        "<tr>".
            "<td>$this->DNI</td>".
            "<td>$this->nombre</td>".
            "<td>$this->direccion</td>".
            "<td>$this->localidad</td>".
            "<td>$this->provincia</td>".
            "<td>$this->telefono</td>".
            "<td>$this->email</td>".
            "<td><a href='editarcliente.php?id=$this->DNI'><i class='fas fa-edit'></i></a></a></td>".
            "<td><a href='zonaUser.php?id=$this->DNI&action=delete' onclick='confirmDelete(this.href); return false;'>
            <i class='fas fa-ban'></i></a></td>".
        "</tr>". "</table>";
    
    return $table;
    }  
    public function tablaBuscaUser(){
        $table =
        "<tr>".
            "<td>$this->DNI</td>".
            "<td>$this->nombre</td>".
            "<td>$this->direccion</td>".
            "<td>$this->localidad</td>".
            "<td>$this->provincia</td>".
            "<td>$this->telefono</td>".
            "<td>$this->email</td>".
            "<td>$this->activa</td>".
            "<td><a href='editarcliente.php?id=$this->DNI'><i class='fas fa-edit'></i></a></a></td>".
            "<td><a href='zonaUser.php?id=$this->DNI&action=delete' onclick='confirmDelete(this.href); return false;'>
            <i class='fas fa-ban'></i></a></td>".
        "</tr>";
    
    return $table;
    }  
  
}

function tablaAdmin(){

    include("conectar_bd.php");
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
    $consulta = "SELECT * FROM clientes LIMIT :registro_inicio, :registros_por_pagina";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':registro_inicio', $registro_inicio, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll();
    
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

?>

<!-- Clase Artículos -->
<?php
class articulos{
    private $cod;
    private $nom;
    private $des;
    private $cat;
    private $precio;
    private $img;
    private $catalogado;
    private $stock;

    public function articulos(){
      $table = "<table class='table'".
            "<tr>".
                "<td>$this->codigo</td>".
                "<td>$this->nombre</td>".
                "<td>$this->descripcion</td>".
                "<td>$this->categoria</td>".
                "<td>$this->precio</td>".
                "<td><img src='$this->imagen'</td>".
                "<td>$this->stock</td>".
                "<td>$this->catalogado</td>".
                "<td><a href='editarArticulo.php?id=$this->id'><i class='fas fa-edit'></i></a></a></td>".
                "<td><a href='zonaArticulos.php?id=$this->id&action=delete' onclick='confirmDelete(this.href); return false;'>
            <i class='fas fa-ban'></i></a></td>"."</tr>".
            "</table>";
        return $table;
    }

    public function articulosUser(){

        if ($this->catalogado == "No") {
        } else {
            $table = "<table class='table'".
            "<tr>".
                "<td>$this->nombre</td>".
                "<td>$this->descripcion</td>".
                "<td><img src='$this->imagen'</td>".
                "<td>$this->precio</td>".
                "<td>$this->stock</td>".
                "<td>  <form method='post' action='cart.php'>
                            <input type='hidden' name='id' value='$this->id'>
                            <input type='hidden' name='nombre' value='$this->nombre'>
                            <input type='hidden' name='descripcion' value='$this->descripcion'>
                            <input type='hidden' name='imagen' value='$this->imagen'>
                            <input type='hidden' name='precio' value='$this->precio'>
                            <input type='hidden' name='stock' value='$this->stock'>
                            <button type='submit'><i class='fas fa-cart-plus'></i></button>
                        </form></td>".
            "</tr>"."</table>";
            return $table;
            }
        }
}

function tablaArticulos(){

    include("conectar_bd.php");
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
    $consulta = "SELECT * FROM articulos LIMIT :registro_inicio, :registros_por_pagina";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':registro_inicio', $registro_inicio, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll();
    
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


function tablaUserArticulos(){
    include("conectar_bd.php");
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
    $consulta = "SELECT * FROM articulos WHERE catalogado = 'Sí' LIMIT :registro_inicio, :registros_por_pagina";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':registro_inicio', $registro_inicio, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll();
    
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


// Clase Categorias
class categorias{
    private $nombre;
    private $des;

    public function categorias(){
      $table = "<table class='table'".
            "<tr>".
                "<td>$this->nombre</td>".
                "<td>$this->descripcion</td>".
                "<td><a href='editarCategoria.php?id=$this->id'><i class='fas fa-edit'></i></a></a></td>".
                "<td><a href='zonaCategorias.php?id=$this->id&action=delete' onclick='confirmDelete(this.href); return false;'>
            <i class='fas fa-ban'></i></a></td>"."</tr>".
            "</table>";
        return $table;
    }
}

function tablaCategorias(){

    include("conectar_bd.php");
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
    $consulta = "SELECT * FROM categorias LIMIT :registro_inicio, :registros_por_pagina";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':registro_inicio', $registro_inicio, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll();
    
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
