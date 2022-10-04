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
    //Si pulso cualquiera de los botones de la pagina producto o de la pagina main entrare por aqui para crear la sesion del carrito
    if (isset($_POST["btnUnidadesProducto"]) || isset($_POST["btnCarrito"])) {
        $id = $_POST["productoId"];
        $rutaImagenProducto = $_POST["rutaImagenProducto"];
        $producto = obtenerProducto($id);
        if (isset($_SESSION["carrito"][$id])) {
            $_SESSION["carrito"][$id][3] += isset($_POST["selectorUnidades"]) ? $_POST["selectorUnidades"] : 1;
        } else {
            //Nombre
            $_SESSION["carrito"][$id][0] = $producto[0]->nombre_producto;
            //Precio
            $_SESSION["carrito"][$id][1] = $producto[0]->precio_producto;
            //Puntos asignado
            $_SESSION["carrito"][$id][2] = $producto[0]->puntos_asignados;
            //Unidades que se van agregando
            $_SESSION["carrito"][$id][3] = isset($_POST["selectorUnidades"]) ? $_POST["selectorUnidades"] : 1;
            //Imagen
            $_SESSION["carrito"][$id][4] = $rutaImagenProducto;
            //Unidades maximas que tiene el producto
            $_SESSION["carrito"][$id][5] = $producto[0]->unidades_producto;
        }
    }
    //Si existe la sesion del carrito, mostramos el carrito
    if (isset($_SESSION["carrito"])) {
    ?>
    <div class="contenedorAncla">
        <a href="#header"> <img src="img/iconos/subir.png" alt="Subir top"> </a>
    </div>
    <div class="contenedorGeneral" id="contenedorGeneral">
        <?php
            include("recursos/header.php");
            ?>
        <section class="carrito">
            <span class='spanCarrito'>Carrito de la compra</span>
            <?php
                $totalPagar = 0;
                $unidadesTotales = 0;
                foreach ($_SESSION["carrito"] as $key => $value) {
                    if ($_SESSION["carrito"][$key][3] <= $_SESSION["carrito"][$key][5]) {
                        $_SESSION["carrito"][$key][3] = $value[3];
                        $unidadesTotales = $value[3];
                    } else {
                        $_SESSION["carrito"][$key][3] = $value[5];
                        $unidadesTotales = $value[5];
                    }
                    echo "<div class='comprarProductos'>
                                <div class='contenedorImagenCarritoCompra'>
                                    <img src='$value[4]'>
                                </div>
                                <div class='contenedorDatosProducto'>
                                    <span><b>Nombre:</b>  $value[0]</span>
                                    <span> <b>Precio:</b>  $value[1] € / unidad </span>
                                    <span> <b>Unidades:</b> $unidadesTotales </span>
                                </div>
                        </div>";
                    $totalPagar += $value[1] * $unidadesTotales;
                }
                ?>
            <div class="pagarProducto">
                <span>Total a pagar</span>
                <span><?php echo $totalPagar; ?>€</span>
                <form action="main.php" method="post" class="formularioPagarProducto">
                    <input type="submit" value="Realizar pago" name="btnPago">
                </form>
                <form action="main.php" method="post" class="formularioVaciarCarrito">
                    <input type="submit" value="Vaciar carro" name="btnVaciar">
                </form>
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
        //Si no existe la sesion del carrito, redirigimos
    } else {
        header("Location: index.php");
    }
    cerrarConexion();
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/chat.js"></script>
</body>

</html>