<?php
include ("includes/seguridadAdmin.php");
include ("includes/clases.php");
include ("funciones/cabeceraTablas.php");
include ("funciones/funciones_varias.php");
$title = "Usuarios";
include ("bloques/doctype.php");
                include ("bloques/header.php");
                include ("bloques/nav.php");
                // Ordenación de resultados
                $orden = 'ASC';

                if (isset($_SESSION['sort']) && $_SESSION['sort'] == 'ASC'){
                    $_SESSION['sort'] = 'DESC';
                    $orden = 'DESC';
                } else {
                    $_SESSION['sort'] = 'ASC';
                }
              
                ?>
                <div class="buscar">
                    <h2>Usuarios</h2>
                    <form id="submit" action="zona.php" method="POST">
                        <input type="text" name="dni" value="DNI" required>
                        <input type="submit" name="search" value="Buscar">
                    </form>
                </div>
                <?php
                if (isset($_POST['search'])) {
                    include ("includes/conectar_bd.php");
                    $dni = $_POST['dni'];
                    try {    
                            $stmt = $con->prepare("SELECT * FROM clientes where DNI like '%$dni%'");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_CLASS, 'cliente');
                            //cabecera
                            echo cabecera();
                            echo "<table class='table'";
                        while($fila = $stmt->fetch())    
                            echo $fila->tablaBuscaUser();
                        } catch (PDOException $e){
                            echo 'Error: '.$e->getMessage();
                        }
                            echo "</table><br/>";                        
                        ?>
                        <script>
                            $(document).ready(function() {
                            $(".buscar").hide();                               
                            });
                        </script>
                        <input type="button" value="Volver" onClick="window.location.href='zona.php'">
                        <?php
                } else if (isset($_POST['nombre'])) {
                    tablaAdminOrder('nombre',$orden);

                } else if (isset($_POST['DNI'])) {
                    tablaAdminOrder('DNI',$orden);

                } else if (isset($_POST['direccion'])) {
                    tablaAdminOrder('direccion',$orden);

                } else if (isset($_POST['localidad'])) {
                    tablaAdminOrder('localidad',$orden);

                } else if (isset($_POST['provincia'])) {
                    tablaAdminOrder('provincia',$orden);

                } else if (isset($_POST['telefono'])) {
                    tablaAdminOrder('telefono',$orden);

                } else if (isset($_POST['email'])) {
                    tablaAdminOrder('email',$orden);

                } else if (isset($_POST['activa'])) {
                    tablaAdminOrder('activa',$orden);

                } else if (isset($_GET['action']) && $_GET['action'] == "delete") {
                    include("includes/conectar_bd.php");
                    $id = $_REQUEST['id'];
                    $dni = $_SESSION['DNI'];
                    $stmt = $con->prepare("DELETE FROM clientes WHERE DNI like '%{$_REQUEST["id"]}%'");

                    if ($stmt->execute()) {
                        $stmt2 = $con->prepare("INSERT INTO log_clientes VALUES (:dni, 'Baja', :s, NOW())");
                        $stmt2->execute(array(':dni'=>$id, 's'=>$_SESSION['DNI']));
                    }  
                    if($stmt->execute()){
                        if ($user_rol == "Administrador"){
                            if ($id == $dni){
                                session_destroy();
                                echo "<h2>Su usuario ha sido borrado correctamente</h2>"?>
                                    <div class="buscar">
                                        <input type="button" value="Volver" onClick="window.location.href='index.php'">
                                    </div>
                                <?php
                            } else {
                            echo "<h2>El cliente se ha borrado correctamente</h2>";?>
                                    <script>
                                        $(document).ready(function() {
                                        $(".buscar").hide();                               
                                        });
                                    </script>
                                <div>
                                    <input type="button" value="Volver" onClick="window.location.href='zona.php'">
                                </div>
                            <?php
                            }
                        } else {
                            session_destroy();
                            echo "<h2>Su usuario ha sido borrado correctamente</h2>";?>
                                <div class="buscar">
                                    <input type="button" value="Volver" onClick="window.location.href='index.php'">
                                </div>
                            <?php
                        }
                    } else {
                        session_destroy();
                        echo "<h2>Algo ha fallado, vuelva a intentarlo o contacte con el administrador.</h2>";?>
                        <div class="buscar">
                            <input type="button" value="Volver" onClick="window.location.href='index.php'">
                        </div>
                        <?php
                    }

                } else {
                    echo cabecera();
                    tablaAdmin();
                }
                ?>
                <div class="buscar"><br>
                    <input type="button" value="Nuevo Usuario" onClick="window.location.href='formularioAdmin.php'">
                </div>
            </body>
    <?php
include("bloques/footer.php");
?>