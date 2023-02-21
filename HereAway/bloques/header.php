<div id="header">
    <header class="header-bg">
        <div id="logo">
            <a href="index.php"></a>
        </div>
        <div id="menu-login">
            <?php
                    if (isset($_SESSION['nombre'])) {
                        ?>  
                        <div id="datos-sesion">
                            <?php
                                $nombreusuario= $_SESSION['nombre'];
                                echo "<h4>".$nombreusuario." (".$_SESSION['rol'].")</h4>";?>
                                <br>
                                <a href='salir.php'><i class="fas fa-sign-out"></i></a>
                        </div>
                        <?php
                    } else {
                        echo "
                        <div id='header-icons'>
                            <a href='entrar.php'>
                                <i class='fa-solid fa-play'></i>
                                <span class='tooltiptext'>Log-in</span>
                            </a>
                            <a href='formulario.php'>
                                <i class='fa-solid fa-user-plus'></i>                        
                                <span class='tooltiptext'>Sign-up</span>
                            </a>
                        </div>";
                    }
                    ?>
        </div>   
    </header>
</div> 
    <div id="main-container">