<?php
    $title = "Entrar";
    include ("includes/seguridadSessionStart.php");
    include ("bloques/doctype.php");
                    include ("bloques/header.php");
                    include ("bloques/nav.php");
                    ?>
    <form action="login.php" method="post"> 
        <table class="table-login">
                <tr> <td colspan="2">
                    <span>Correo Electrónico:</span><br/>
                    <input class="cajas" type="text" name="user"> </td> 
                </tr>
                <tr> <td colspan="2">
                    <span>Password:</span><br/>
                    <input class="cajas" type="password" name="key"> </td> 
                </tr>
                <tr>
                    <td colspan="2"><a href="passrecovery.php">Recuperar Contraseña</a></td>
                </tr>
                <tr>
                    <td> <br/><input type="submit" value="Entrar"></td>
                    <td> <br/><input type="button" value="Registrarse" onClick="window.location.href='formulario.php'"></td>
                </tr>
        </table>
    </form>
<?php
include("bloques/footer.php");
?>
