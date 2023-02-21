<?php
include ("includes/seguridadEditor.php");
include ("includes/conectar_bd.php");
include ("funciones/funciones_varias.php");
$title = "Nuevo Artículo";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                ?>
                <h2>Nuevo Artículo</h2>
                <form id="submit" name="formulario" method="post" action="formularioArticulo.php" enctype="multipart/form-data"> 
                        <table class="registro">
                            <tr>
                                <td>Código</td>
                                <td><input type="text" name="codigo" minlength="4" maxlength="8" value="<?php if(isset($_POST['codigo'])) { echo $_POST['codigo']; } ?>" required pattern="[A-Za-z]{3}[0-9]{,5}"></td>
                            </tr>
                            <tr>
                                <td>Nombre</td>
                                <td><input type="text" name="nombre" minlength="1" maxlength="40" value="<?php if(isset($_POST['nombre'])) { echo $_POST['nombre']; } ?>" required></td>
                            </tr>
                            <tr>
                                <td>Descripción</td>
                                <td><input type="text" name="descripcion" minlength="1" maxlength="200" value="<?php if(isset($_POST['descripcion'])) { echo $_POST['descripcion']; } ?>" required></td>
                            </tr>
                            <tr>
                                <td>Categoría</td>
                                <td> 
                                    <select name='categoria' required>
                                        <?php
                                        cat_selector();
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Precio</td>
                                <td><input type="text" step="any" name="precio" minlength="1" maxlength="6" value="<?php if(isset($_POST['precio'])) { echo $_POST['precio']; } ?>" required pattern="^([1-9][0-9]{0,3}|[0-9])(\.[0-9]{1,2})?$"></td>
                            </tr>
                            <tr>
                                <td>Imagen</td>
                                <td><input type="file" name="imagen" required></td>
                            </tr>
                            <tr>
                                <td>Stock</td>
                                <td><input type="text" name="stock" required pattern="^(10000|[1-9][0-9]{0,3}|[0-9])$"></td>
                            </tr>
                        </table>
                        <br>
                            <input type="submit" name="submit" value="Enviar">
                            <input type="button" value="Volver" onClick="window.location.href='zonaArticulos.php'">
                    </form>

                    <?php

                if (isset($_POST['submit'])){
                    include("funciones/redimensionar.php");
                    $cod = strtoupper($_REQUEST['codigo']);
                    $nom = strtoupper($_REQUEST['nombre']);
                    $des = strtoupper($_REQUEST['descripcion']);
                    $cat = strtolower($_REQUEST['categoria']);
                    $pre = ($_REQUEST['precio']);
                    $image = $_FILES['imagen']['tmp_name'];
                    $tamano = $_FILES['imagen']['size'];
                    $name = time().basename($_FILES['imagen']['name']);
                    $id=0;
                    $catalogado = "Sí";
                    $stock = ($_REQUEST['stock']);
                    $unidadesV = 0;
                    $beneficio = 0;

                        if(!empty($cod) &&!empty($nom) &&!empty($des) &&!empty($cat) &&!empty($pre) &&!empty($image)) {

                            $size = getimagesize($image);
                            if ($size[0] > 200 || $size[1] > 200 ){

                                echo "<h3>La imagen sobrepasa las dimesiones establecidas (200*200).</h3>";

                                } else if ( $size[2] != 1 && $size[2] != 2 && $size[2] != 3){

                                    echo "<h3>La imagen no es de un formato correcto (jpg,jpeg,gif o png).</h3>"; 

                                } else if ( $tamano > 300000 ){

                                    echo "<h3>La imagen ocupa demasiado. (Max weight = 300kbs)</h3>"; 
                                    
                                } else {

                                    try {
                                        $image_redimensionada = resizeImage($image);
                                        $uploaddir = 'Imgs/';
                                        $uploadfile = $uploaddir . $name;
                                        file_put_contents($uploadfile, $image_redimensionada);
                                        $stmt = $con->prepare("INSERT INTO articulos VALUES (:id, :catalogado, :codigo, :nombre, :descripcion, :categoria, :precio, :imagen, :stock, :UnidadesV, :beneficio)");
                                        $stmt->execute(array(':id'=>$id,':catalogado'=>$catalogado,':codigo'=>$cod, ':nombre'=>$nom, ':descripcion'=>$des, ':categoria'=>$cat,':precio'=>$pre,
                                        ':imagen'=>$uploadfile, ':stock'=>$stock, ':UnidadesV'=>$unidadesV, ':beneficio'=>$beneficio));

                                        if ($stmt->rowCount() > 0) {
                                            $stmt2 = $con->prepare("INSERT INTO log_articulos VALUES (:dni, 'Alta', :s, NOW())");
                                            $stmt2->execute(array(':dni'=>$cod, 's'=>$_SESSION['DNI']));
                                        }    
                                        echo "<br><h3>Artículo añadido Correctamente</h3><br>";
                                    ?>
                                    <script>
                                        $(document).ready(function() {
                                            $("#submit").hide();                               
                                        });
                                    </script>
                                    <input type="button" value="Volver" onClick="window.location.href='zonaArticulos.php'">
                                    <?php

                                    } catch (PDOException $e){
                                            echo "<br><h3>Código de producto repetido.</h3>"; 
                                    }
                                }

                        } else {
                            echo "<br><h3>Faltan datos por rellenar.</h2>";
                        }
                    }
                ?>                   
            </body>
<?php
include("bloques/footer.php");
?>