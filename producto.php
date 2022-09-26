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
    if (!isset($_GET["id"])) {
        header("Location: index.php");
    } else {
        $productoId = $_GET["id"];
        $numRegistros = count(obtenerProductos()); // Registros en total de la bbdd
        if ($productoId >= 1 && $productoId <= $numRegistros) {
            $producto = obtenerProducto($productoId);
            if ($producto != false && $producto[0]->unidades_producto > 0) {
    ?>
                <div class="contenedorAncla">
                    <a href="#header"> <img src="img/iconos/subir.png" alt="Subir top"> </a>
                </div>
                <div class="contenedorGeneral" id="contenedorGeneral">
                    <?php
                    include("recursos/header.php");
                    ?>
                    <section class="caracteristicasProducto">
                        <div class="centrarProducto">
                            <div class="contenedorImagenProducto">
                                <?php
                                $cadena = "";
                                switch ($producto[0]->id_categoria) {
                                    case 1:
                                        $cadena = "chocolates";
                                        break;
                                    case 2:
                                        $cadena = "golosinas";
                                        break;
                                    case 3:
                                        $cadena = "caramelos";
                                        break;
                                    case 4:
                                        $cadena = "nubes";
                                        break;
                                    case 5:
                                        $cadena = "regalizes";
                                        break;
                                    case 6:
                                        $cadena = "chicles";
                                        break;
                                    case 7:
                                        $cadena = "aperitivos";
                                        break;
                                    default:
                                        break;
                                }
                                echo "<img class='imagenCaracteristicaProducto' src='img/categorias/$cadena/" . $producto[0]->img_producto . "' alt='" . $producto[0]->nombre_producto . "'>";
                                ?>
                            </div>
                            <div class="contenedorCaracteristicasProducto">
                                <h3><?php echo $producto[0]->nombre_producto; ?></h3>
                                <span><b>Descripcion:</b> <?php echo $producto[0]->descripcion_producto; ?></span>
                                <span> <b>Precio:</b> <?php echo $producto[0]->precio_producto; ?>€ / unidad </span>
                                <span> <b> Puntos asignados: </b> <?php echo $producto[0]->puntos_asignados; ?></span>
                                <span> <b> Unidades disponibles: </b> <?php echo $producto[0]->unidades_producto; ?></span>
                                <form action="cart.php" method="post" class="formularioUnidadesProducto">
                                    <span> <b>Selecciona las unidades que quieres agregar al carrito: </b>
                                        <select name="selectorUnidades" id="selectorUnidades">
                                            <?php
                                            for ($i = 0; $i < $producto[0]->unidades_producto; $i++) {
                                                echo "<option value='" . ($i + 1) . "'>" . ($i + 1) . "</option>";
                                            }
                                            ?>
                                        </select><br>
                                        <input type='hidden' value="<?php echo $productoId; ?>" name='productoId'>
                                        <?php
                                        echo "<input type='hidden' value='img/categorias/$cadena/" . $producto[0]->img_producto . "' name='rutaImagenProducto'>";
                                        ?>
                                        <input type="submit" name="btnUnidadesProducto" value="Agregar al carrito">
                                    </span>
                                </form>
                            </div>
                        </div>
                    </section>
                    <?php
                    include("recursos/footer.php");
                    ?>
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
                </div>
    <?php
            } else {
                header("Location: index.php");
            }
        } else {
            header("Location: index.php");
        }
    }
    cerrarConexion();
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/chat.js"></script>
</body>
</html>