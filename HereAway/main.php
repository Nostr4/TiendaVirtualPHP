<?php
  if (isset($_SESSION['nombre'])) {
        $nombreusuario= $_SESSION['nombre'];
        echo "<h2>BIENVENID@ A HEREAWAY ".$nombreusuario."</h2>";
  } else {
        echo"<h2>BIENVENID@ A HEREAWAY</h2>";      
  }
?>

