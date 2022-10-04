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
    ?>
    <div class="contenedorAncla">
        <a href="#header"> <img src="img/iconos/subir.png" alt="Subir top"> </a>
    </div>
    <div class="contenedorGeneral" id="contenedorGeneral">
        <?php
        include("recursos/header.php");
        ?>
        <section class="puntos">
            <?php
            $puntosUsuario = buscarUsuarioRegistrado($_SESSION["correo"])[0]->puntos_totales;
            ?>
            <span class="tituloPuntos">Actualmente tienes <?php echo $puntosUsuario; ?> puntos. </span>
            <span class="tituloPuntos"> Recuerda que para desbloquear descuentos tendras que llegar a los siguientes
                puntos:</span>
            <div class="contenedorPorcentaje20">
                <span>2000 puntos</span>
                <?php
                if ($puntosUsuario < 2000) {
                    echo "<form action='#' method='post'>
                            <input class='desactivar' type='submit' value='Aplicar 20% de descuento' name='btnAplicarDescuento' disabled >
                        </form>";
                } else {
                    echo "<form action='main.php' method='post'>
                            <input type='hidden' value='2000' name='puntosQuitados'>
                            <input type='hidden' value='20' name='btnPorcentaje'>
                            <input type='submit' value='Aplicar 20% de descuento' name='btnAplicarDescuento'>
                        </form>";
                }
                ?>
            </div>
            <div class="contenedorPorcentaje30">
                <span>4000 puntos</span>
                <?php
                if ($puntosUsuario < 4000) {
                    echo "<form action='#' method='post'>
                            <input class='desactivar' type='submit' value='Aplicar 30% de descuento' name='btnAplicarDescuento' disabled >
                        </form>";
                } else {
                    echo "<form action='main.php' method='post'>
                            <input type='hidden' value='4000' name='puntosQuitados'>
                            <input type='hidden' value='30' name='btnPorcentaje'>
                            <input type='submit' value='Aplicar 30% de descuento' name='btnAplicarDescuento'>
                        </form>";
                }
                ?>
            </div>
            <div class="contenedorPorcentaje40">
                <span>8000 puntos</span>
                <?php
                if ($puntosUsuario < 8000) {
                    echo "<form action='#' method='post'>
                            <input class='desactivar' type='submit' value='Aplicar 40% de descuento' name='btnAplicarDescuento' disabled >
                        </form>";
                } else {
                    echo "<form action='main.php' method='post'>
                            <input type='hidden' value='8000' name='puntosQuitados'>
                            <input type='hidden' value='40' name='btnPorcentaje'>
                            <input type='submit' value='Aplicar 40% de descuento' name='btnAplicarDescuento'>
                        </form>";
                }
                ?>
            </div>
        </section>
        <section class="opcionesPagina">
            <section class="contenedorOpciones">
                <section class="opcionesIcono">
                    <a href="cerrarSesion.php"> <img src="img/iconos/cerrar.png" alt="Cerrar sesion"
                            id="iconoSesion"></a>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/chat.js"></script>
</body>

</html>