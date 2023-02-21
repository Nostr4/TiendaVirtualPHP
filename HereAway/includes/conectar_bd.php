<?php
    if (!defined('USER_DB')) {
        define ("USER_DB","juanmav");
        define ("PASSWORD","0000");
    }
    try {
        $dsn = "mysql:host=localhost;dbname=clientes_db";
        $con = new PDO($dsn, USER_DB, PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo 'Error: '.$e->getMessage();
    }
?>