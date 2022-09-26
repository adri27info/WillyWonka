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
    if (isset($_POST["btnVerificacionRegistro"])) {
        if (isset($_SESSION["ran"])) {
            $codigoResultate = $_POST["cod_1"] . $_POST["cod_2"] . $_POST["cod_3"] . $_POST["cod_4"] . $_POST["cod_5"];
    ?>
            <div class="contenedor">
                <div class="contenedorVerificacionRegistro2">
                    <div class="imagenVerificacionRegistro2">
                        <img src="img/logo.png" alt="Logo WillyWonka">
                    </div>
                    <?php
                    if ($_SESSION["ran"] == $codigoResultate) {
                        //Realizar el registro del usuario a la bbdd
                        $idUsuario = registroUsuario(0, 2, 1, 1, 1, 0,  $_SESSION["usuario"], $_SESSION["correo"], $_SESSION["password"], "user.jpg", 0);
                        //Compruebo si se ha realizado una inserccion en la BBDD
                        if ($idUsuario != 0) {
                            $asunto = "Registro realizado correctamente";
                            $cuerpo = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>WillyWonka</title></head><body><p style='font-weight: bolder;'> Bienvenido/a " . $_SESSION['usuario'] . " a la tienda WillyWonka, su registro se ha relizado correctamente, por favor inice sesión en al siguiente enlace: <br> <a href='http://localhost/Cursos/apps/WillyWonka/index.php' target='_blank'> WillyWonka </a> </p></body></html>";
                            $headers = "MIME-Version: 1.0\r\n";
                            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                            mail($_SESSION["correo"], $asunto, $cuerpo, $headers);
                            echo "<span style='color: green;'> Registro realizado correctamente </span>";
                        } else {
                            echo "<span style='color: red;'> Error al realizar el registro </span> <br>";
                        }
                    } else {
                        echo "<span style='color: red;'> Te has equivocado al introducir la combinacion </span> <br>";
                    }
                    session_destroy();
                    echo "<span> Volviendo a la pagina principal ... </span>";
                    header("refresh:3;url=index.php");
                    ?>
                </div>
            </div>
            <?php
        } else {
            header("registro.php");
        }
    } else if (isset($_POST["btnRegistro"])) {
        $correo = buscarUsuarioRegistrado($_POST["correo"]);
        if ($correo == false) {
            //Si el correo del usuario que se ha registrado no existe en la BBDD procedemos a realizar el registro del nuevo usuario     
            $ran = (rand(11111, 99999));
            $usuario = $_POST["usuario"];
            $correo = $_POST["correo"];
            $password = md5($_POST["password"]);
            $_SESSION["ran"] = $ran;
            $_SESSION["usuario"] = $usuario;
            $_SESSION["correo"] = $correo;
            $_SESSION["password"] = $password;
            $asunto = "Registro";
            $cuerpo = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>WillyWonka</title></head><body><p style='font-weight: bolder;'> Hola $usuario, por favor introduce la siguiente combinacion de numeros en la pagina del registro para finalizar con el mismo. <br>Combinacion: $ran</p></body></html>";
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            if (mail($correo, $asunto, $cuerpo, $headers)) {
            ?>
                <div class="contenedor">
                    <div class="contenedorVerificacionRegistro">
                        <div class="imagenVerificacionRegistro">
                            <img src="img/logo.png" alt="Logo WillyWonka">
                        </div>
                        <span>Por favor, introduce la combinación de numeros que se le ha enviado a su correo</span>
                        <div class="formularioVerificacionRegistro">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="formularioVerificacionRegistro">
                                <div class="contenedor_verificacion_usuario" id="contenedor_verificacion_usuario">
                                    <input type="text" name="cod_1" maxlength="1" minlength="1">
                                    <input type="text" name="cod_2" maxlength="1" minlength="1">
                                    <input type="text" name="cod_3" maxlength="1" minlength="1">
                                    <input type="text" name="cod_4" maxlength="1" minlength="1">
                                    <input type="text" name="cod_5" maxlength="1" minlength="1">
                                </div>
                                <input type="submit" value="Enviar" name="btnVerificacionRegistro" id="btnVerificacionRegistro">
                            </form>
                        </div>
                        <div class="registro">
                            <span>¿Te has equivocado?</span>
                            <a href="registro.php">Registrarse</a>
                        </div>
                    </div>
                </div>
        <?php
            } else {
                echo "<p style='font-weight: bolder;'> Error al realizar el registro, por favor comprueba el correo introducido</p>";
                header("Location: registro.php");
            }
        } else {
            //Si el correo del usuario que se quiere registrar ya existe en la BBDD, creamos mensaje de error mediante variable de sesion
            $_SESSION["usuario_registrado"] = true;
            header("Location: registro.php");
        }
    } else {
        ?>
        <div class="contenedor">
            <div class="contenedorRegistro">
                <div class="imagenRegistro">
                    <img src="img/logo.png" alt="Logo WillyWonka">
                    <span>Regístrate</span>
                </div>
                <div class="formularioRegistro">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="formularioRegistro">
                        <input type="text" name="usuario" placeholder="Introduce tu nombre">
                        <div class="contenedor_icono_usuario" id="contenedor_icono_usuario">
                            <img src="img/iconos/user.png" alt="Icono de usuario">
                            <span>Error (min 1 - max 30 caracteres) </span>
                        </div>
                        <input type="text" name="correo" placeholder="Introduce el correo">
                        <div class="contenedor_icono_correo" id="contenedor_icono_correo">
                            <img src="img/iconos/correo.png" alt="Icono del correo">
                            <span>Error al escribir el correo </span>
                        </div>
                        <input type="password" name="password" placeholder="Introduce la password">
                        <div class="contenedor_icono_password" id="contenedor_icono_password">
                            <img src="img/iconos/password.png" alt="Icono de la password">
                            <span>Error (min 4 - max 10 caracteres) </span>
                        </div>
                        <input type="submit" value="Enviar" name="btnRegistro" id="btnRegistro">
                    </form>
                    <?php
                    if (isset($_SESSION["usuario_registrado"])) {
                        echo "<span style='color: red;'> El correo introducido ya existe </span> <br>";
                        session_destroy();
                    }
                    ?>
                </div>
                <div class="login">
                    <span>¿Tienes una cuenta?</span>
                    <a href="index.php">Iniciar sesión</a>
                </div>
            </div>
        </div>
    <?php
    }
    cerrarConexion();
    ?>
    <script src="js/verificacionRegistro.js"></script>
</body>
</html>