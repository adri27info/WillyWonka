<?php
session_start();
if (!isset($_SESSION["usuarioLogin"])) {
    header("Location: index.php");
}
if (isset($_SESSION["rol"]) && $_SESSION["rol"] == 1) {
    header("Location: index.php");
}
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
    include("recursos/utilidades.php");
    if (isset($_POST["btnUpdate"])) {
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        if ($nombre != "" && $correo != "") {
            $directorio = "img/perfil/";
            $directorioImagen = $directorio . basename($_FILES["imagen"]["name"]);
            $semaforo = 1;
            $imagenTipo = strtolower(pathinfo($directorioImagen, PATHINFO_EXTENSION));
            // Checkeo si es una imagen fake o no
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);
            if ($check !== false) {
                $semaforo = 1;
                // Checkeo la longitud de la img
                if ($_FILES["imagen"]["size"] > 500000) {
                    $_SESSION["imagenLongitud"] = false;
                    $semaforo = 0;
                }
                // Checkeo el formato de la imagen
                if (
                    $imagenTipo != "jpg" && $imagenTipo != "png" && $imagenTipo != "jpeg"
                    && $imagenTipo != "gif"
                ) {
                    $_SESSION["imagenFormato"] = false;
                    $semaforo = 0;
                }
                // Checkeo si la imagen se va a subir finalmente al directorio o no
                if ($semaforo == 0) {
                    header("Location: perfil.php");
                } else {
                    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorioImagen)) {
                        if (actualizarImagenUsuario($nombre, $correo, $_FILES["imagen"]["name"], $_SESSION["correo"]) != 0) {
                            $_SESSION["imagenServer"] = true;
                            $_SESSION["usuarioLogin"] = $nombre;
                            $_SESSION["correo"] = $correo;
                        } else {
                            $_SESSION["imagenServer"] = false;
                        }
                    } else {
                        $_SESSION["imagenSubida"] = false;
                    }
                    header("Location: perfil.php");
                }
            } else {
                $_SESSION["imagenFake"] = false;
                header("Location: perfil.php");
            }
        } else {
    ?>
            <div class="contenedorAncla">
                <a href="#header"> <img src="img/iconos/subir.png" alt="Subir top"> </a>
            </div>
            <div class="contenedorGeneral" id="contenedorGeneral">
                <?php
                include("recursos/header.php");
                ?>
                <div class="contenedorGeneralPerfil">
                    <div class="contenedorEditPerfil">
                        <div class="imagenEditPerfil">
                            <span>Actualizar datos </span>
                        </div>
                        <div class="formularioEditarPerfil">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="formularioEditarPerfil" enctype="multipart/form-data">
                                <input type="text" name="nombre" value="<?php echo $_SESSION["usuarioLogin"]; ?>">
                                <input type="text" name="correo" value="<?php echo $_SESSION["correo"]; ?>">
                                <input type="file" name="imagen" id="imagen" required>
                                <input type="submit" value="Enviar" name="btnUpdate">
                            </form><br>
                            <span style="color: red">Error, para actualizar los datos debes rellenar tanto el nombre como el correo</span><br>
                        </div>
                        <div class="atras">
                            <a href="ajustes.php">Volver atrás</a>
                        </div>
                    </div>
                </div>
                <?php
                include("recursos/footer.php");
                ?>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="contenedorAncla">
            <a href="#header"> <img src="img/iconos/subir.png" alt="Subir top"> </a>
        </div>
        <div class="contenedorGeneral" id="contenedorGeneral">
            <?php
            include("recursos/header.php");
            ?>
            <div class="contenedorGeneralPerfil">
                <div class="contenedorEditPerfil">
                    <div class="imagenEditPerfil">
                        <span>Actualizar datos </span>
                    </div>
                    <div class="formularioEditarPerfil">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="formularioEditarPerfil" enctype="multipart/form-data">
                            <input type="text" name="nombre" value="<?php echo $_SESSION["usuarioLogin"]; ?>">
                            <input type="text" name="correo" value="<?php echo $_SESSION["correo"]; ?>">
                            <input type="file" name="imagen" id="imagen" required>
                            <input type="submit" value="Enviar" name="btnUpdate">
                        </form>
                        <?php
                        if (isset($_SESSION["imagenFake"]) && $_SESSION["imagenFake"] == false) {
                            echo "<span style='color: red;'> Error, la imagen es fake </span> <br>";
                            unset($_SESSION["imagenFake"]);
                        } else if (isset($_SESSION["imagenFormato"]) && $_SESSION["imagenFormato"] == false) {
                            echo "<span style='color: red;'> Error, el formato de la imagen no es el correcto, solo {jpg, png, gif} </span> <br>";
                            unset($_SESSION["imagenFormato"]);
                        } else if (isset($_SESSION["imagenLongitud"]) && $_SESSION["imagenLongitud"] == false) {
                            echo "<span style='color: red;'> Error, la longitud de la imagen no es la correcta, solo {0-40} mb </span> <br>";
                            unset($_SESSION["imagenLongitud"]);
                        } else if (isset($_SESSION["imagenSubida"]) && $_SESSION["imagenSubida"] == false) {
                            echo "<span style='color: red;'> Error al subir la imagen </span> <br>";
                            unset($_SESSION["imagenSubida"]);
                        } else if (isset($_SESSION["imagenServer"])) {
                            if ($_SESSION["imagenServer"] == false) {
                                echo "<span style='color: red;'> Error al subir la imagen al servidor </span> <br>";
                                unset($_SESSION["imagenServer"]);
                            } else {
                                unset($_SESSION["imagenServer"]);
                                unset($_SESSION["imagenSubida"]);
                                unset($_SESSION["imagenLongitud"]);
                                unset($_SESSION["imagenFormato"]);
                                unset($_SESSION["imagenFake"]);
                                echo "<span style='color: green;'> La imagen se ha subido satisfactoriamente</span> <br>";
                            }
                        }
                        ?>
                    </div>
                    <div class="atras">
                        <a href="ajustes.php">Volver atrás</a>
                    </div>
                </div>
            </div>
            <section class="opcionesPagina">
                <section class="contenedorOpciones">
                    <section class="opcionesIcono">
                        <a href="cerrarSesion.php"> <img src="img/iconos/cerrar.png" alt="Cerrar sesion" id="iconoSesion"></a>
                        <img src="img/iconos/chat.png" alt="Chat" id="iconoChat">
                        <a href="cart.php"> <img src="img/iconos/carro.png" alt="Carrito"></a>
                    </section>
                    <section class="chat" id="chat" name="chat">
                        <div id="formularioChat" name="formularioChat" class="formularioChat">
                            <textarea name="contenedorChat" id="contenedorChat" readonly></textarea>
                            <input type="text" name="mensaje" id="mensajeChat" placeholder="Introduce tu mensaje">
                            <span id="spanMensajeChat" class="spanMensajeChat">Conectate para enviar un mensaje</span>
                            <button type="button" name="btnEnviar" id="btnEnviar">Enviar mensaje</button>
                        </div>
                    </section>
                </section>
            </section>
            <?php
            include("recursos/footer.php");
            ?>
        </div>
    <?php
    }
    cerrarConexion();
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/chat.js"></script>
</body>
</html>