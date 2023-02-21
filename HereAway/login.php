<?php
// Conexión a la base de datos
include("includes/conectar_bd.php");

// Obtención de los valores proporcionados en el formulario
$usu = strtoupper($_POST['user']);
$pwd = $_POST['key'];

// Preparación de la consulta SELECT
$stmt = $con->prepare("SELECT * FROM clientes WHERE email = :email");

// Ejecución de la consulta con los parámetros proporcionados
$stmt->execute(['email' => $usu]);

// Obtención de los resultados de la consulta
$resultado = $stmt->fetch();

// Comprobación de la contraseña

if ($resultado !== false && password_verify($pwd, $resultado['password'])) { 
    // Inicio de sesión y redirección
    if ($resultado['activa'] != "Sí"){
        header("Location: error2.php");
    } else {
        session_start();
        $_SESSION['direccion'] = $resultado['direccion'];
        $_SESSION['nombre'] = $usu;
        $_SESSION['activa'] = $resultado['activa'];
        $_SESSION['nick'] = $resultado['nombre'];
        $_SESSION['rol'] = $resultado['rol_id2'];
        $_SESSION['DNI'] = $resultado['DNI'];
        header("Location: zonaUser.php");
    }
} else {
    // Redirección en caso de error
    header("Location: error.php");
}