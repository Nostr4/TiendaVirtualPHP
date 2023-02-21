<?php
include ("includes/seguridadEditor.php");
include ("includes/conectar_bd.php");
include ("includes/clases.php");
include ("funciones/funciones_varias.php");
$title = "Modificación de Artículos";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                $id = $_REQUEST['id'];
                $stmt = $con->prepare("SELECT * FROM articulos where id='$id'");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();

                while($fila = $stmt->fetch()){
                $cod = $fila["codigo"];
                $nom = $fila["nombre"];
                $des = $fila["descripcion"];
                $cat = $fila["categoria"];
                $pre = $fila["precio"];
                $img = $fila["imagen"];
                $catalogado = $fila["catalogado"];
                $stock = $fila["stock"];
                }
                ?>
                    </form>


                    <form id="submit" name="formulario" method="post" action="editarArticulo.php?id=<?php echo $id; ?>"  enctype="multipart/form-data"> 
                        <table class="editArticulo">
                            <tr>
                                <td>Código</td>
                                <td><?php echo $cod; ?></td>
                            </tr>
                            <tr>
                                <td>Nombre</td>
                                <td><input type="text" name="nombre" value="<?php echo $nom; ?>" minlength="1" maxlength="40" required></td>
                            </tr>
                            <tr>
                                <td>Descripción</td>
                                <td><input type="text" name="descripcion" value="<?php echo $des; ?>" minlength="1" maxlength="200" required></td>
                            </tr>
                            <tr>
                            <td>Categoría</td>
                                <td> 
                                    <select name='categoria' required>
                                        <?php
                                        cat_selector2($cat);
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Precio</td>
                                <td><input type="text" name="precio" value="<?php echo $pre; ?>" minlength="1" maxlength="6" required pattern="^[0-9]+(\.[0-9]{1,2})?$|^10000$"></td>
                            </tr>
                            <tr>
                                <td>Catalogado</td>
                                <td><?php catalogado($catalogado); ?></td>
                            </tr>
                            <tr>
                                <td>Imagen</td>
                                <td><input type="file" name="imagen" required></td>
                            </tr>
                            <tr>
                                <td>Stock</td>
                                <td><input type="text" name="stock" value="<?php echo $stock; ?>" required pattern="^([1-9][0-9]{0,3}|[0-9])(\.[0-9]{1,2})?$"></td>
                            </tr>
                        </table>
                        <br>
                            <input type="submit" name="submit" value="Enviar">
                            <input type="button" value="Volver" onClick="window.location.href='zonaArticulos.php'">
                    </form>

                <?php
                    if (isset($_POST['submit'])){
                        include("funciones/redimensionar.php");
                        $id = $_REQUEST['id'];
                        $nom = strtoupper($_REQUEST['nombre']);
                        $des = strtoupper($_REQUEST['descripcion']);
                        $cat = strtolower($_REQUEST['categoria']);
                        $pre = ($_REQUEST['precio']);
                        $image = $_FILES['imagen']['tmp_name'];
                        $tamano = $_FILES['imagen']['size'];
                        $name = time().basename($_FILES['imagen']['name']);
                        $catalogado = ($_REQUEST['catalogado']);
                        $stock = $_REQUEST['stock'];

                
                    if(!empty($nom) &&!empty($des) &&!empty($cat) &&!empty($pre) &&!empty($image)) {

                        $size = getimagesize($image);
                        if ($size[0] > 200 || $size[1] > 200 ){

                            echo "<br><h3>La imagen sobrepasa las dimesiones establecidas (200*200). </h3>";

                            } else if ( $size[2] != 1 && $size[2] != 2 && $size[2] != 3){

                                echo "<br><h3>La imagen no es de un formato correcto (jpg,jpeg,gif o png). </h3>";

                            } else if ( $tamano > 300000 ){

                                echo "<br><h3>La imagen ocupa demasiado. (Max weight = 300kbs) </h3>";
                                
                            } else {
                                $stmt1 = $con->prepare("SELECT * FROM articulos WHERE id like '%{$_REQUEST["id"]}%'");
                                $stmt1->execute();
                                $results = $stmt1->fetchAll(PDO::FETCH_OBJ);
                                if($stmt1->execute()){
                                    foreach($results as $result){
                                        unlink($result->imagen);
                                    }
                                }
                                $image_redimensionada = resizeImage($image);
                                $uploaddir = 'Imgs/';
                                $uploadfile = $uploaddir . $name;
                                file_put_contents($uploadfile, $image_redimensionada);
                                try {
                                    $stmt = $con->prepare("UPDATE articulos SET catalogado=:catalogado, nombre=:nombre, descripcion=:descripcion, categoria=:categoria, precio=:precio, imagen=:imagen, stock=:stock where id='$id'");
                                    $stmt->execute(array(':catalogado'=>$catalogado,':nombre'=>$nom, ':descripcion'=>$des, ':categoria'=>$cat,':precio'=>$pre,
                                    ':imagen'=>$uploadfile, ':stock'=>$stock));

                                    if ($catalogado == 'No') {
                                        $stmt2 = $con->prepare("INSERT INTO log_articulos VALUES (:cod, 'Descatalogado', :dni, NOW())");
                                        $stmt2->execute(array(':cod'=>$cod, ':dni'=>$_SESSION['DNI']));
                                    } else if ($catalogado == 'Sí'){
                                        $stmt2 = $con->prepare("INSERT INTO log_articulos VALUES (:cod, 'Recatalogado', :dni, NOW())");
                                        $stmt2->execute(array(':cod'=>$cod, ':dni'=>$_SESSION['DNI']));
                                    }    
                                    echo "<br><h3>Artículo editado Correctamente</h3><br>";
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
                        echo "<br><h3>Faltan datos por rellenar.</h3>";
                    }
                }
                ?>
            </body>
    <?php
include("bloques/footer.php");
?>