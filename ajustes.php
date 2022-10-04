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
<?php
include("recursos/utilidades.php");
?>
<div class="contenedorAncla">
    <a href="#header"> <img src="img/iconos/subir.png" alt="Subir top"> </a>
</div>
<div class="contenedorGeneral" id="contenedorGeneral">
    <?php
    include("recursos/header.php");
    ?>
    <section class="ajustes">
        <div class="contenedorEditarPerfil">
            <div class="perfil">
                <img src="img/iconos/editar2.png" alt="Editar perfil">
            </div>
            <a href="perfil.php">Ir al perfil de usuario</a>
        </div>
        <div class="contenedorFacturas">
            <div class="facturas">
                <img src="img/iconos/factura.png" alt="Facturas">
            </div>
            <a href="facturas.php">Checkear las facturas</a>
        </div>
    </section>
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
cerrarConexion();
?>

<body>
    <script src="js/jquery.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/chat.js"></script>
</body>

</html>