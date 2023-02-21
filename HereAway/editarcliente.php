<?php
include ("includes/seguridadUser.php");
include ("includes/conectar_bd.php");
include ("includes/clases.php");
include ("funciones/funciones_varias.php");
$title = "Modificación de Usuarios";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                $id = $_REQUEST['id'];
                $stmt = $con->prepare("SELECT * FROM clientes where DNI='$id'");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();

                while($fila = $stmt->fetch()){
                $nom = $fila["nombre"];
                $dir = $fila["direccion"];
                $loc = $fila["localidad"];
                $prov = $fila["provincia"];
                $tel = $fila["telefono"];
                $rol = $fila["rol_id2"];
                $activa = $fila["activa"];
                }


                if ($user_rol == "Administrador"){
                    echo "</form>
                    <form id='submit' name='formulario' method='post' action='editarcliente.php?id=$id' enctype='multipart/form-data'> 
                        <table class='editarUser'>
                            <tr>
                                <td>Nombre</td>
                                <td><input type='text' name='nombre' value='$nom' minlength='1' maxlength='30' required></td>
                            </tr>
                            <tr>
                                <td>Dirección</td>
                                <td><input type='text' name='direccion' value='$dir' minlength='1' maxlength='50' required></td>
                            </tr>
                            <tr>
                                <td>Localidad</td>
                                <td><input type='text' name='localidad' value='$loc' minlength='1' maxlength='40' required></td>
                            </tr>
                            <tr>
                                <td>Provincia</td>
                                <td><input type='text' name='provincia' value='$prov' minlength='1' maxlength='40' required></td>
                            </tr>
                            <tr>
                                <td>Teléfono</td>
                                <td><input type='text' name='telefono' value='$tel' minlength='9' maxlength='9' required pattern='^\d{9}$'></td>
                            </tr>
                            <tr>
                                <td>Rol</td>
                                <td>";
                                selector($rol); 
                                echo "</td>
                            </tr>
                            <tr>
                                <td>¿Cuenta Activa?</td>
                                <td>";
                                activa($activa); 
                                echo "</td>
                            </tr>
                        </table>
                        <br>
                            <input type='submit' name='submit' value='Enviar'>
                            <input type='button' onclick='history.back()' name='volver' value='Volver'>
                    </form>";

                } else {
                    echo "</form>
                    <form id='submit' name='formulario' method='post' action='editarcliente.php?id=$id' enctype='multipart/form-data'> 
                        <table class='editarUser'>
                            <tr>
                                <td>Nombre</td>
                                <td><input type='text' name='nombre' value='$nom' minlength='1' maxlength='30' required></td>
                            </tr>
                            <tr>
                                <td>Dirección</td>
                                <td><input type='text' name='direccion' value='$dir' minlength='1' maxlength='50' required></td>
                            </tr>
                            <tr>
                                <td>Localidad</td>
                                <td><input type='text' name='localidad' value='$loc' minlength='1' maxlength='40' required></td>
                            </tr>
                            <tr>
                                <td>Provincia</td>
                                <td><input type='text' name='provincia' value='$prov' minlength='1' maxlength='40' required></td>
                            </tr>
                            <tr>
                                <td>Teléfono</td>
                                <td><input type='text' name='telefono' value='$tel' minlength='9' maxlength='9' required pattern='^\d{9}$'></td>
                            </tr>
                            <tr>
                                <td>Rol</td>
                                <td>$rol</td>
                            </tr>
                        </table>
                        <br>
                            <input type='submit' name='submit' value='Enviar'>
                            <input type='button' value='Volver' onClick='window.location.href=\"zonaSwitch.php\"'>
                    </form>";
                }

                if (isset($_POST['submit'])){
                    $id = $_REQUEST['id'];
                    $nombre = strtoupper($_REQUEST['nombre']);
                    $dir = strtoupper($_REQUEST['direccion']);
                    $loc = strtoupper($_REQUEST['localidad']);
                    $prov = strtoupper($_REQUEST['provincia']);
                    $tele = strtoupper($_REQUEST['telefono']);
                    if ($user_rol == "Administrador"){
                        $rol = ($_REQUEST['rol_id2']);
                        $activa = ($_REQUEST['activa']);
                    } else {
                        $rol = $rol;
                        $activa = $activa;
                    }

                
                    if(!empty($nombre) &&!empty($dir) &&!empty($loc) &&!empty($prov) &&!empty($tele) &&!empty($rol)) {

                            try {
                                $stmt = $con->prepare("UPDATE clientes SET activa=:activa, nombre=:nombre, direccion=:direccion, localidad=:localidad, provincia=:provincia, telefono=:telefono, rol_id2=:rol_id2 where DNI='$id'");
                                $stmt->execute(array(':activa'=>$activa, ':nombre'=>$nombre, ':direccion'=>$dir, ':localidad'=>$loc,':provincia'=>$prov,
                                ':telefono'=>$tele,':rol_id2'=>$rol));

                                if ($activa == 'No') {
                                    $stmt2 = $con->prepare("INSERT INTO log_clientes VALUES (:id, 'Desactivado', :dni, NOW())");
                                    $stmt2->execute(array(':id'=>$_REQUEST['id'], ':dni'=>$_SESSION['DNI']));
                                } else if ($activa == 'Sí'){
                                    $stmt2 = $con->prepare("INSERT INTO log_clientes VALUES (:id, 'Reactivado', :dni, NOW())");
                                    $stmt2->execute(array(':id'=>$_REQUEST['id'], ':dni'=>$_SESSION['DNI']));
                                }                  
                                ?>
                                <script>
                                    $(document).ready(function() {
                                        $("#submit").hide();                               
                                    });
                                </script>
                                <?php
                                echo "<br><h3>User editado correctamente</h3><br>";
                                ?>
                                <input type="button" value="Volver" onClick="window.location.href='zonaSwitch.php'">
                                <?php
                                
                            } catch (PDOException $e){
                                        echo "<br><h3>DNI o Email duplicado.</h3>"; 
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