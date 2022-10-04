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
    if (isset($_POST["btnActualizarUsuario"])) {
        $id = $_POST["idUsuario"];
        $nombre = $_POST["nombreUsuario"];
        $password = $_POST["password"];
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
        <section class="actualizar">
            <div class="contenedorUpdate">
                <span>Actualizar datos</span>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="formularioUpdate">
                    <input type="text" value="<?php echo $id; ?>" disabled>
                    <input type="text" value="<?php echo $nombre; ?>" disabled>
                    <input type="password" name="password" placeholder="Introduce la nueva password" required>
                    <input type="hidden" value="<?php echo $id; ?>" name="idUsuario">
                    <input type="hidden" value="<?php echo $nombre; ?>" name="nombreUsuario">
                    <input type="submit" value="Enviar" name="btnActualizarUsuario">
                </form>
            </div>
            <?php
                if (actualizarPasswordUsuario(md5($password), $id, $nombre) != 0) {
                    echo "<span style='font-weight: bolder; color: green; text-align: center; display: block;'> Usuario actualizado correctamente</span>";
                } else {
                    echo "<span style='font-weight: bolder; color: red; text-align: center; display: block;'> Error al actualizar el usuario </span>";
                }
                ?>
        </section>
    </div>
    <?php
    } else {
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
        <section class="actualizar">
            <div class="contenedorUpdate">
                <span>Actualizar datos</span>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="formularioUpdate">
                    <input type="text" value="<?php echo $id; ?>" disabled>
                    <input type="text" value="<?php echo $nombre; ?>" disabled>
                    <input type="password" name="password" placeholder="Introduce la nueva password" required>
                    <input type="hidden" value="<?php echo $id; ?>" name="idUsuario">
                    <input type="hidden" value="<?php echo $nombre; ?>" name="nombreUsuario">
                    <input type="submit" value="Enviar" name="btnActualizarUsuario">
                </form>
            </div>
        </section>
    </div>
    <?php
            } else {
                header("Location: ../admin.php");
            }
        } else {
            header("Location: ../admin.php");
        }
    }
    cerrarConexion();
    ?>
</body>

</html>