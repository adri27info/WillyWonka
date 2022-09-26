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
    ?>
    <div class="contenedor">
        <div class="contenedorReestablecer">
            <div class="imagenReestablecer">
                <img src="img/logo.png" alt="Logo WillyWonka">
                <span>Reestablecer contraseña</span>
                <?php
                if (isset($_POST["btnReestablecer"])) {
                    $correo = $_POST["correo"];
                    $usuarioRegistrado = buscarUsuarioRegistrado($correo);
                    if ($usuarioRegistrado != false) {
                        $correoAdmin = "willywonka.es.tienda@gmail.com";
                        $asunto = "Reestablecer contraseña al usuario $correo";
                        $cuerpo = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title> WillyWonka </title></head><body><p style='font-weight: bolder;'> Hola buenas administrador, el usuario $correo necesita cambiar la contraseña para poder acceder a la pagina, gracias.</p></body></html>";
                        $headers = "MIME-Version: 1.0\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                        if (mail($correoAdmin, $asunto, $cuerpo, $headers)) {
                            echo "<p style='font-weight: bolder; color: green;'> Correo enviado al administrador para cambiar su contraseña, por favor espere la respuesta del mismo</p>";
                        } else {
                            echo "<p style='font-weight: bolder; color: red;'> Error al enviar el correo al administrador</p>";
                        }
                    } else {
                        echo "<p style='font-weight: bolder; color: red;'> El usuario que has introducido, no existe </p>";
                    }
                }
                ?>
            </div>
            <div class="formularioReestablecer">
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="formularioReestablecer">
                    <input type="text" name="correo" placeholder="Introduce el correo para reestablecer la contraseña">
                    <div class="contenedor_icono_correo" id="contenedor_icono_correo">
                        <img src="img/iconos/correo.png" alt="Icono del correo">
                        <span>Error al escribir el correo </span>
                    </div>
                    <input type="submit" value="Enviar" name="btnReestablecer">
                </form>
            </div>
            <div class="login">
                <span>¿Tienes una cuenta?</span>
                <a href="index.php">Iniciar sesión</a>
            </div>
        </div>
    </div>
    <?php
    cerrarConexion();
    ?>
    <script src="js/verificacionReestablecer.js"></script>
</body>
</html>