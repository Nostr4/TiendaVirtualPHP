<?php
$title = "Lost Password";
include ("bloques/doctype.php");
include ("bloques/header.php");
include ("bloques/nav.php");
                ?>
                <form method="post" action="passrecovery.php" enctype="multipart/form-data"> 
                    <table align="center">
                        <caption>Recupere su contraseña</caption>
                            <tr></tr>
                            <tr></tr>
                            <tr> <td colspan="2">
                                <span>Correo Electrónico:</span><br/>
                                <input class="cajas" type="email" name="email" minlength="5" minlength="40" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>"> </td> 
                            </tr>
                            <tr> <td colspan="2">
                                <span>DNI:</span><br/>
                                <input class="cajas" type="text" name="DNI" minlength="9" maxlength="9" value="<?php if(isset($_POST['DNI'])) { echo $_POST['DNI']; } ?>"> </td> 
                            </tr>
                            <tr>
                                <td align="center"> <br/><input type="submit" name="submit" value="Recuperar"></td>
                                <td align="center"> <br/><input type="button" value="Volver" onClick="window.location.href='entrar.php'"></td>
                            </tr>
                    </table>
                </form>
                <?php
                $dni;
                $email;
                if (isset($_POST['submit'])){
                    include("includes/conectar_bd.php");
                    $dni = strtoupper($_REQUEST['DNI']);
                    $email = strtoupper($_REQUEST['email']);

                    if(!empty($dni) &&!empty($email)) {
                                $stmt = $con->prepare("SELECT * from clientes where email='$email' and DNI='$dni'");
                                $stmt->execute();

                            if ($stmt->rowCount() != 0){
                                session_start();
                                $_SESSION['DNI']= $dni;

                                echo '<form method="post" action="passrecovery.php?id='.$dni.'" enctype="multipart/form-data"> 
                                        <table align="center">
                                                <tr></tr>
                                                <tr></tr>
                                                <tr> <td colspan="2">
                                                    <span>Nueva Contraseña:</span><br/>
                                                    <input class="cajas" type="text" name="pass" minlength="4" minlength="16"> </td> 
                                                </tr>
                                                <tr>
                                                    <td align="center"> <br/><input type="submit" name="submit2" value="Modificar Contraseña"></td>
                                                </tr>
                                        </table>
                                    </form>';

                            } else {
                                echo " <center><h2>Email o DNI no registrados. </h3></center>";
                                    
                            }

                        } else {
                            echo "<center><h2>Has dejado campos vacíos</h2></center>";
                    }
                }

                if (isset($_POST['submit2'])){
                    include("includes/conectar_bd.php");
                    session_start();
                    $dni = $_SESSION['DNI'];
                    $pass_enc = ($_REQUEST['pass']);
                    $pass = password_hash($pass_enc, PASSWORD_DEFAULT);    
                    if(!empty($pass)) {
                                try {
                                    $stmt = $con->prepare("UPDATE `clientes` SET `password` = '$pass' WHERE `clientes`.`DNI` = '$dni'");
                                    $stmt->execute();
                                    echo "<center><h2>Contraseña modificada correctamente.</h2></center>";?>
                                    <center><button class="button" onclick="location.href='entrar.php'">Iniciar Sesión</button></center>
                                    <?php
                                } catch (PDOException $e){
                                    echo "<center><h2>Error al modificar constraseña, contacte con el administrador.</h2></center>";
                                }
                    
                        } else {
                            echo "<center><h2>No has introducido contraseña.</h2></center>";
                        }                
                }

            ?>
        </body>
    <?php
include("bloques/footer.php");
?>