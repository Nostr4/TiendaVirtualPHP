<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function agregarProducto($producto) {
    $producto_encontrado = false;
    if(isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $key => $prod) {
            if ($prod['id'] == $producto['id']) {
                if ($_SESSION['carrito'][$key]['cantidad'] + 1 <= $producto['stock']) {
                    $_SESSION['carrito'][$key]['cantidad'] += 1;
                    $producto_encontrado = true;
                } else {
                    $producto_encontrado = true;
                }
                break;
            }
        }
        if (!$producto_encontrado && $producto['stock'] > 0) {
            $_SESSION['carrito'][] = array(
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'imagen' => $producto['imagen'],
                'precio' => $producto['precio'],
                'stock' => $producto['stock'],
                'cantidad' => 1
            );
        }
    } else {
        if ($producto['stock'] > 0) {
            $_SESSION['carrito'][] = array(
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'imagen' => $producto['imagen'],
                'precio' => $producto['precio'],
                'stock' => $producto['stock'],
                'cantidad' => 1
            );
        }
    }
}

if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['imagen']) && isset($_POST['precio']) && isset($_POST['stock'])) {
    $producto = array(
        'id' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'imagen' => $_POST['imagen'],
        'precio' => $_POST['precio'],
        'stock' => $_POST['stock']
    );
    agregarProducto($producto);
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>