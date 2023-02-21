<?php
$title = "Bienvenido";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                ?>
                <h2>Únete al club</h2>
                <form id="submit" name="formulario" method="post" action="formulario.php" enctype="multipart/form-data"> 
                        <table class="registro">
                            <tr>
                                <td>DNI</td>
                                <td><input type="text" name="DNI" minlength="9" maxlength="9" value="<?php if(isset($_POST['DNI'])) { echo $_POST['DNI']; } ?>" required></td>
                            </tr>
                            <tr>
                                <td>Nombre</td>
                                <td><input type="text" name="nombre" minlength="1" maxlength="30" value="<?php if(isset($_POST['nombre'])) { echo $_POST['nombre']; } ?>" required></td>
                            </tr>
                            <tr>
                                <td>Dirección</td>
                                <td><input type="text" name="direccion" minlength="1" maxlength="50" value="<?php if(isset($_POST['direccion'])) { echo $_POST['direccion']; } ?>" required></td>
                            </tr>
                            <tr>
                                <td>Localidad</td>
                                <td><input type="text" name="localidad" minlength="1" maxlength="40" value="<?php if(isset($_POST['localidad'])) { echo $_POST['localidad']; } ?>" required></td>
                            </tr>
                            <tr>
                               <td>Provincia</td>
                               <td><input type="text" name="provincia" minlength="1" maxlength="40" value="<?php if(isset($_POST['provincia'])) { echo $_POST['provincia']; } ?>" required></td>
                            </tr>
                            <tr>
                               <td>Teléfono</td>
                               <td><input type="text" name="telefono" minlength="9" maxlength="9" value="<?php if(isset($_POST['telefono'])) { echo $_POST['telefono']; } ?>" required pattern="^\d{9}$"></td>
                            </tr>
                            <tr>
                                <td>e-mail</td>
                                <td><input type="email" name="email" minlength="5" maxlength="40" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : '@';?>" required></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="text" name="password" minlength="4" maxlength="16" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>" required></td>
                            </tr>
                        </table>
                        <br>
                            <input type="submit" name="submit" value="Enviar">
                            <input type="button" value="Volver" onClick="window.location.href='entrar.php'">
                    </form>

                    <?php
                    if (isset($_POST['submit'])){
                        include("includes/conectar_bd.php");
                        include("funciones/verifica-dni.php");
                        $dni = strtoupper($_REQUEST['DNI']);
                        $nombre = strtoupper($_REQUEST['nombre']);
                        $dir = strtoupper($_REQUEST['direccion']);
                        $loc = strtoupper($_REQUEST['localidad']);
                        $prov = strtoupper($_REQUEST['provincia']);
                        $tele = strtoupper($_REQUEST['telefono']);
                        $email = strtoupper($_REQUEST['email']);
                        $pass_enc = $_REQUEST['password'];
                        $pass = password_hash($pass_enc,PASSWORD_DEFAULT);
                        $id= "";
                        $rd = "Usuario";
                        $activa = "Sí";

                        
                        if(!empty($dni) &&!empty($nombre) &&!empty($dir) &&!empty($loc) &&!empty($prov) &&!empty($tele) &&!empty($email) &&!empty($pass)) {

                            $posicion_arroba = strpos($email, "@");
                            $posicion_punto = strpos($email, ".", $posicion_arroba);
                            if (!$posicion_arroba || !$posicion_punto) {
                                echo "<br><h3>Email Incorrecto.</h3>";

                            } else if (verificaDNI($dni) == false ) {
                                echo "<br><h3>DNI Incorrecto.</h3>";
                                
                            } else {
                                try {
                                    $stmt = $con->prepare("INSERT INTO clientes VALUES (:id, :activa, :DNI, :nombre, :direccion, :localidad, :provincia, :telefono, :email, :password, :rol_id2)");
                                    $stmt->execute(array(':id'=>$id, ':activa'=>$activa, ':DNI'=>$dni, ':nombre'=>$nombre, ':direccion'=>$dir, ':localidad'=>$loc,':provincia'=>$prov,
                                    ':telefono'=>$tele,':email'=>$email,':password'=>$pass, ':rol_id2'=>$rd));

                                    if ($stmt->rowCount() > 0) {
                                        $stmt2 = $con->prepare("INSERT INTO log_clientes VALUES (:dni, 'Alta', :dni, NOW())");
                                        $stmt2->execute(array(':dni'=>$dni));
                                    }    

                                    echo "<br><h3>Registrado Correctamente</h3><br>";
                                    ?>
                                    <script>
                                    $(document).ready(function() {
                                        $("#submit").hide();                               
                                    });
                                </script>
                                    <input type="button" value="Login" onClick="window.location.href='entrar.php'">
                                    <?php

                                } catch (PDOException $e){
                                        echo "<br><h3>DNI o Email duplicado.</h3>";
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