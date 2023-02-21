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
                $stmt = $con->prepare("SELECT * FROM categorias where id='$id'");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();

                while($fila = $stmt->fetch()){
                $nom = $fila["nombre"];
                $des = $fila["descripcion"];
                }
                ?>
                    </form>


                    <form id="submit" name="formulario" method="post" action="editarCategoria.php?id=<?php echo $id; ?>"  enctype="multipart/form-data"> 
                        <table class="editArticulo">
                            <tr>
                                <td>Nombre</td>
                                <td><input type="text" name="nombre" value="<?php echo $nom; ?>" minlength="1" maxlength="40" required pattern="^(jg_|per_).+"></td>
                            </tr>
                            <tr>
                                <td>Descripción</td>
                                <td><input type="text" name="descripcion" value="<?php echo $des; ?>" minlength="1" maxlength="200" required></td>
                            </tr>
                        </table>
                        <br>
                            <input type="submit" name="submit" value="Enviar">
                            <input type="button" value="Volver" onClick="window.location.href='zonaCategorias.php'">
                    </form>

                <?php
                    if (isset($_POST['submit'])){
                        $id = $_REQUEST['id'];
                        $nom = strtolower($_REQUEST['nombre']);
                        $des = strtoupper($_REQUEST['descripcion']);
               
                    if(!empty($nom) && !empty($des)) {

                        try {
                            $stmt = $con->prepare("UPDATE categorias SET nombre=:nombre, descripcion=:descripcion where id='$id'");
                            $stmt->execute(array(':nombre'=>$nom, ':descripcion'=>$des));
                            echo "<br><h3>Categoria editada correctamente</h3><br>";
                            ?>
                            <script>
                                $(document).ready(function() {
                                    $("#submit").hide();                               
                                });
                            </script>
                                <input type="button" value="Volver" onClick="window.location.href='zonaCategorias.php'">
                            <?php

                        } catch (PDOException $e){
                                echo "<br><h3>Ya hay una categoría con ese nombre</h3>";
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