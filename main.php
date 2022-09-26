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

    //Creacion de cookies
    if (isset($_POST["btnAplicarDescuento"])) {
        if (isset($_POST["btnPorcentaje"])) {
            $puntosQuitados = $_POST["puntosQuitados"];
            restarPuntosUsuarios($puntosQuitados, $_SESSION["correo"]);
            $porcentaje = $_POST["btnPorcentaje"];
            $productos = obtenerProductos();
            for ($i = 0; $i < count($productos); $i++) {
                $num = (float)$productos[$i]->precio_producto;
                $formula = (float) number_format($num * $porcentaje / 100, 1);
                actualizarPrecioProductos($formula, $productos[$i]->id_producto);
            }
            if (!isset($_COOKIE["cookie_descuento"])) {
                setcookie(
                    "cookie_descuento",
                    "Recuerda que tienes activado en todos los productos un descuento del $porcentaje %, disfrutalo",
                    time() + (86400 * 30),
                    "/"
                ); // 86400 = 1 day
            } else {
                setcookie(
                    "cookie_descuento",
                    "Recuerda que tienes activado en todos los productos un descuento del $porcentaje %, disfrutalo",
                    time() + (86400 * 30),
                    "/"
                ); // 86400 = 1 day
            }
            header("Location: main.php");
        }
    }

    $usuario = comprobarVisitaUsuario($_SESSION["correo"]);
    if ($usuario != false && $usuario[0]->id_visitado == 0) {
        //Si es la 1 vez que visita la pagina, mostramos regalo y actualizamos la visita
        actualizarVisitaUsuario($_SESSION["correo"]);
        if (obtenerUnidadesProducto("Chips Ahoy")[0]->unidades_producto > 0) {
            actualizarPuntosUsuario(10, $_SESSION["correo"]);
            actualizarUnidadesProducto("Chips Ahoy");
    ?>
            <div class="container" id="container">
                <div class="contenedorRegalo" id="contenedorRegalo">
                    <div class="contenedorDatosRegalo">
                        <div class="imagenRegalo">
                            <img src="img/logo.png" alt="Logo WillyWonka">
                            <span>!Enhorabuena!</span>
                        </div>
                        <div class="regalo">
                            <img src="img/categorias/chocolates/chips-ahoy.jpg" alt="Chips Ahoy">
                            <span>Por ser la primera vez que entras, has ganado este producto y 10 puntos.</span><br>
                            <span>Recuerda que por cada compra, ganaras puntos mediante los cuales obtendras descuentos en los productos de la web</span>
                        </div>
                        <div class="confirmarRegalo">
                            <button type="button" id="btnConfirmar" name="btnConfirmar" class="btnConfirmar">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }

    //Si no es la 1 vez que entra en la pagina mostramos el contenido
    if (isset($_GET["pagina"])) {
        if ($_GET["pagina"] < 1 || $_GET["pagina"] > $_SESSION["totalPaginas"]) {
            header("Location: main.php");
        } else {
            if ($_GET["pagina"] == 1) {
                header("Location: main.php");
            } else {
                $pagina = $_GET["pagina"];
            }
        }
    } else {
        $pagina = 1; //Pagina en la que estamos 
    }


    $productos = obtenerProductos();
    $numFilas = count($productos); // Registros en total de la bbdd
    $registrosPagina = 50; // Registros a mostrar por pagina
    $totalPaginas = ceil($numFilas / $registrosPagina); // -> 267 / 50 = 5
    $_SESSION["totalPaginas"] = $totalPaginas;
    $empezarDesde = ($pagina - 1) * $registrosPagina; //Establecemos por donde debe empezar la sentencia del limit para mostrar los registros 
    ?>

    <div class="contenedorAncla">
        <a href="#header"> <img src="img/iconos/subir.png" alt="Subir top"> </a>
    </div>

    <div class="contenedorGeneral" id="contenedorGeneral">

        <?php
        include("recursos/header.php");
        ?>

        <?php
        if (isset($_COOKIE["cookie_descuento"])) {
            echo "<section class='cookie' id='cookie'>
                <span>" . $_COOKIE['cookie_descuento'] . "</span>
                <div class='contenedorCookie'>
                    <img src='img/iconos/cruzar.png' id='imagenCruzCookie'>
                </div>
            </section>";
        }

        if (isset($_POST["btnVaciar"])) {
            echo "<h3 class='tituloCarrito'> Carrito vaciado correctamente </h3>";
            unset($_SESSION["carrito"]);
        }

        if (isset($_POST["btnPago"])) {
            $datosSesion =
                array(
                    $_SESSION["idUsuario"] =>
                    array(
                        0 => date('d-m-Y'),
                        1 => date('H:i:s'),
                        2 => $_SESSION["carrito"]
                    )
                );
            $enconde = json_encode($datosSesion);
            $decode = json_decode($enconde, true);
            registroFactura(0, $_SESSION["idUsuario"], $decode[$_SESSION["idUsuario"]][0], $decode[$_SESSION["idUsuario"]][1], $enconde);
            $puntosTotales = 0;
            echo "<h3 class='tituloPago'> Compra realizada correctamente, gracias </h3>";
            foreach ($_SESSION["carrito"] as $key => $value) {
                actualizarUnidadesProductoEspecificada($value[0], $value[3]);
                $puntosTotales += $value[2] * $value[3];
            }
            actualizarPuntosUsuario($puntosTotales, $_SESSION["correo"]);
            unset($_SESSION["carrito"]);
        }

        ?>
        <section class="banner">
            <img src="img/iconos/banner.jpg" alt="banner" class="imagenBanner">
        </section>
        <section class="productos">
            <?php
            $productosPaginacion = obtenerProductosPaginacion($empezarDesde, $registrosPagina);
            foreach ($productosPaginacion as $key => $value) {
                $cadena = "";
                switch ($productosPaginacion[$key]->id_categoria) {
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
                if ($productosPaginacion[$key]->unidades_producto > 0) {
                    echo "<div class='producto'>";
                    echo "<a href='producto.php?id=" . $productosPaginacion[$key]->id_producto . "'> <img src='img/categorias/$cadena/" . $productosPaginacion[$key]->img_producto . "' alt='" . $productosPaginacion[$key]->nombre_producto . "' class='imagenProducto'> </a>";
                    echo "<span>" . $productosPaginacion[$key]->nombre_producto . "</span>";
                    echo "<h3> $" . $productosPaginacion[$key]->precio_producto . "</h3>";
                    echo "<form action='cart.php' method='post' class='formularioProducto'>";
                    echo "<input type='hidden' value='" . $productosPaginacion[$key]->id_producto . "' name='productoId'>";
                    echo "<input type='hidden' value='img/categorias/$cadena/" . $productosPaginacion[$key]->img_producto . "' name='rutaImagenProducto'>";
                    echo "<input type='submit' value='Agregar al carro' name='btnCarrito'>";
                    echo "</form>";
                    echo "</div>";
                } else {
                    echo "<div class='producto opacidad'>";
                    echo "<div class='agotado'>
                            <img src='img/iconos/agotado.png' alt='Producto agotado' class='imagenProductoAgotado'>
                        </div>";
                    echo "<img src='img/categorias/$cadena/" . $productosPaginacion[$key]->img_producto . "' alt='" . $productosPaginacion[$key]->nombre_producto . "' class='imagenProducto'>";
                    echo "<span>" . $productosPaginacion[$key]->nombre_producto . "</span>";
                    echo "<h3> $" . $productosPaginacion[$key]->precio_producto . "</h3>";
                    echo "<form action='main.php' method='post' class='formularioProducto'>";
                    echo "<input type='submit' value='Agregar al carro' name='btnCarrito' disabled>";
                    echo "</form>";
                    echo "</div>";
                }
            }
            ?>
        </section>
        <section class="paginacion">
            <?php
            for ($i = 0; $i < $totalPaginas; $i++) {
                if ($pagina == ($i + 1)) {
                    echo "<a href='main.php?pagina=" . ($i + 1) . "' class='activa'>" . ($i + 1) . "</a>";
                } else {
                    echo "<a href='main.php?pagina=" . ($i + 1) . "' class='no_activa'>" . ($i + 1) . "</a>";
                }
            }
            ?>
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
    cerrarConexion();
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/chat.js"></script>
    <script src="js/regalo.js"></script>
</body>
</html>