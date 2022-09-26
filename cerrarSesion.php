<?php
    include("recursos/utilidades.php");
    session_start();
    if (!isset($_SESSION["usuarioLogin"])) {
        header("Location: index.php");
    }else{
        cerrarConexion();
        session_destroy();
        header("Location: index.php");
    }
?>