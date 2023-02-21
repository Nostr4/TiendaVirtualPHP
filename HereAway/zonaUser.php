<?php
include ("includes/seguridadUser.php");
include("includes/conectar_bd.php");
include ("includes/clases.php");
include ("funciones/cabeceraTablas.php");
$title = "Tus Datos";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                
                if (isset($_GET['action']) && $_GET['action'] == "delete") {
                    $id = $_REQUEST['id'];
                    $dni = $_SESSION['DNI'];
                    $stmt = $con->prepare("UPDATE clientes SET activa = 'No' WHERE DNI like '%{$_REQUEST["id"]}%'");
                    $resultado = $stmt->fetch();
                    
                    if ($stmt->execute()) {
                        $stmt2 = $con->prepare("INSERT INTO log_clientes VALUES (:id, 'Desactivado', :dni, NOW())");
                        $stmt2->execute(array(':id'=>$_REQUEST['id'], ':dni'=>$_SESSION['DNI']));
                    }

                    if($stmt->execute()){
                        if ($user_rol == "Admin"){
                            if ($id == $dni){
                                session_destroy();;
                                echo "<h2>Su usuario ha sido borrado correctamente<h2>"?>
                                    <div class="buscar">
                                        <input type="button" value="Volver" onClick="window.location.href='index.php'">
                                    </div>
                                <?php
                            } else {
                            echo "<h2>El cliente se ha borrado correctamente<h2>";?>
                                <div class="buscar">
                                    <input type="button" value="Volver" onClick="window.location.href='zona.php'">
                                </div>
                            <?php
                            }
                        } else {
                            session_destroy();
                            echo "<h2>Su usuario ha sido borrado correctamente<h2>";?>
                                <div class="buscar">
                                    <input type="button" value="Volver" onClick="window.location.href='index.php'">
                                </div>
                            <?php
                        }
                    } else {
                        session_destroy();
                        echo "<h3>Algo ha fallado, vuelva a intentarlo o contacte con el administrador.<h3>";?>
                        <div class="buscar">
                            <input type="button" value="Volver" onClick="window.location.href='index.php'">
                        </div>
                        <?php
                    }

                } else {
                    try {    
                        $stmt = $con->prepare("SELECT * FROM clientes where email='$nombreusuario'");
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_CLASS, 'cliente');
                        //cabecera
                        ?>
                        <div>
                            <h2>Mi Perfil</h2>
                        </div>
                        <?php
                        echo cabeceraUser();
                        while($fila = $stmt->fetch())    
                            echo $fila->tablaUser().'<br/>';
                        } catch (PDOException $e){
                            echo 'Error: '.$e->getMessage();
                        }
                }
                ?>
            </body>
    <?php
include("bloques/footer.php");
?>