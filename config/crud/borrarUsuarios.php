<?php
session_start();
if (!isset($_SESSION["usuarioLogin"])) {
    header("Location: ../../index.php");
}
if (isset($_SESSION["rol"]) && $_SESSION["rol"] == 2) {
    header("Location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WillyWonka</title>
    <link rel="stylesheet" href="../../css/estilos.css">
</head>

<body>
    <?php
    include("../../recursos/utilidades.php");
    if (isset($_GET["id"]) && isset($_GET["nombre"])) {
        $id = $_GET["id"];
        $nombre = $_GET["nombre"];
        if (buscarUsuarioCriterios($id, $nombre) != false) {
    ?>
    <div class="contenedorCrud" id="contenedorCrud">
        <div class="info">
            <div class="imagen">
                <a href="../admin.php">
                    <img src="../../img/logo.png" alt="Logo">
                </a>
            </div>
            <a href="../../cerrarSesion.php">Cerrar sesion</a>
        </div>
        <section class="borrar">
            <?php
                    if (borrarUsuario($id, $nombre) != 0) {
                        echo "<span style='font-weight: bolder; color: green; text-align: center; display: block;'> Usuario borrado correctamente</span>";
                    } else {
                        echo "<span style='font-weight: bolder; color: red; text-align: center; display: block;'> Error al borrar el usuario </span>";
                    }
                    header("Refresh:3; url=../admin.php");
                    ?>
        </section>
    </div>
    <?php
        } else {
            header("Location: ../admin.php");
        }
    } else {
        header("Location: ../admin.php");
    }
    cerrarConexion();
    ?>
</body>

</html>