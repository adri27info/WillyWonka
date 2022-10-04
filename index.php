<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WillyWonka</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php
    include_once("recursos/utilidades.php");
    if (isset($_SESSION["usuarioLogin"]) && $_SESSION["usuarioLogin"] != false) {
        if (isset($_SESSION["rol"])) {
            if ($_SESSION["rol"] == 1) {
                header("Location: config/admin.php");
            } else if ($_SESSION["rol"] == 2) {
                header("Location: main.php");
            }
        }
    } else {
        if (isset($_POST["btnLogin"])) {
            $correo = $_POST["correo"];
            $password = md5($_POST["password"]);
            if ($correo != "" && $password != "") {
                $usuario = loginUsuario($correo, $password);
                if ($usuario == false) {
                    $_SESSION["usuarioLogin"] = false;
                    header("Location: index.php");
                } else {
                    $_SESSION["usuarioLogin"] = $usuario[0]->nombre;
                    $_SESSION["correo"] = $usuario[0]->correo;
                    $_SESSION["idUsuario"] = $usuario[0]->id_usuario;
                    $_SESSION["rol"] = $usuario[0]->id_rol;
                    //Administrador
                    if ($usuario[0]->id_rol == 1) {
                        header("Location: config/admin.php");
                        //Usuario
                    } else if ($usuario[0]->id_rol == 2) {
                        header("Location: main.php");
                    }
                }
            } else {
                $_SESSION["error_datos"] = true;
                header("Location: index.php");
            }
        } else {
    ?>
    <div class="contenedor">
        <div class="contenedorLogin">
            <div class="imagenLogin">
                <img src="img/logo.png" alt="Logo WillyWonka">
                <span>Inicia sesión</span>
            </div>
            <div class="formularioLogin">
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="formularioLogin">
                    <input type="text" name="correo" placeholder="Introduce el correo" value="test@gmail.com">
                    <input type="password" name="password" placeholder="Introduce la password" value="1234">
                    <input type="submit" value="Enviar" name="btnLogin">
                </form>
                <?php
                        if (isset($_SESSION["usuarioLogin"]) && $_SESSION["usuarioLogin"] == false) {
                            echo "<span style='color: red;'> Error, datos incorrectos </span> <br>";
                            unset($_SESSION["usuarioLogin"]);
                        } else if (isset($_SESSION["error_datos"])) {
                            echo "<span style='color: red;'> Tienes que rellenar ambos campos </span> <br>";
                            unset($_SESSION["error_datos"]);
                        }
                        ?>
            </div>
            <div class="registro">
                <span>¿No tienes cuenta?</span>
                <a href="registro.php">Registrarse</a> <br>
                <span>¿Has olvidado la contraseña?</span>
                <a href="reestablecer.php">Reestablecer contraseña</a> <br>
            </div>
        </div>
    </div>
    <?php
        }
    }
    cerrarConexion();
    ?>
</body>

</html>