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
        <section class="facturacion">
            <div class="datosFacturas">
                <?php
                if (obtenerFacturas($_SESSION["idUsuario"]) != false) {
                    $factura = obtenerFacturas($_SESSION["idUsuario"]);
                ?>
                    <div class="contenedorDatosFactura">
                        <table class="tablaFacturas">
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Factura</th>
                            </tr>
                            <?php
                            foreach ($factura as $key => $value) {
                                echo "<tr>";
                                echo "<td>" . $_SESSION['usuarioLogin'] . "</td>";
                                echo "<td>" . $factura[$key]->fecha_compra . "</td>";
                                echo "<td>" . $factura[$key]->hora_compra . "</td>";
                                echo "<td>
                                            <form action='descargarFactura.php' method='post' class='formularioFactura'>
                                                <input type='hidden' value='" . $factura[$key]->hora_compra . "' name='horaCompra'>
                                                <input type='submit' value='Descargar' name='btnFactura'>
                                            </form>
                                        </td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                <?php
                } else {
                ?>
                    <div class="contenedorDatosFactura morado">
                        <div class="contenedorImagenFactura">
                            <img src="img/iconos/factura.png" alt="Sin facturas">
                        </div>
                        <span>Actualmente dispones de 0 facturas para visualizar</span>
                    </div>
                <?php
                }
                ?>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/chat.js"></script>
</body>
</html>