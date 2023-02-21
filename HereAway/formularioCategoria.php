<?php
include ("includes/seguridadEditor.php");
include ("includes/conectar_bd.php");
include ("includes/clases.php");
include ("funciones/funciones_varias.php");
$title = "Nueva Categoría";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                ?>
                    <h2>Nueva Categoría</h2>
                    <form id="submit" name="formulario" method="post" action="formularioCategoria.php"  enctype="multipart/form-data"> 
                        <table class="editCategoria">
                            <tr>
                                <td>Nombre (jg_categoria | per_sistema)</td>
                                <td><input type="text" name="nombre" value="<?php if(isset($_POST['nombre'])) { echo $_POST['nombre']; } ?>" minlength="3" maxlength="40" required pattern="^(jg_|per_).+"></td>
                            </tr>
                            <tr>
                                <td>Descripción</td>
                                <td><input type="text" name="descripcion" value="<?php if(isset($_POST['descripcion'])) { echo $_POST['descripcion']; } ?>" minlength="1" maxlength="200" required></td>
                            </tr>
                        </table>
                        <br>
                            <input type="submit" name="submit" value="Enviar">
                            <input type="button" value="Volver" onClick="window.location.href='zonaCategorias.php'">
                    </form>

                <?php
                    if (isset($_POST['submit'])){
                        $nom = strtolower($_REQUEST['nombre']);
                        $des = strtoupper($_REQUEST['descripcion']);
               
                    if(!empty($nom) && !empty($des)) {

                        try {
                            $stmt = $con->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (:nombre, :descripcion)");
                            $stmt->execute(array(':nombre'=>$nom, ':descripcion'=>$des));
                            echo "<br><h3>Categoria creada correctamente</h3><br>";
                            ?>
                            <script>
                                $(document).ready(function() {
                                    $("#submit").hide();                               
                                });
                            </script>
                                <input type="button" value="Volver" onClick="window.location.href='zonaCategorias.php'">
                            <?php

                        } catch (PDOException $e){
                                echo $e;
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