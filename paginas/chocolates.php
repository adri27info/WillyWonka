<?php
session_start();
if (!isset($_SESSION["usuarioLogin"])) {
    header("Location: ../index.php");
}
if (isset($_SESSION["rol"]) && $_SESSION["rol"] == 1) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WillyWonka</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    include("../recursos/utilidades.php");
    ?>
    <div class="contenedorAncla">
        <a href="#header"> <img src="../img/iconos/subir.png" alt="Subir top"> </a>
    </div>
    <div class="contenedorGeneral" id="contenedorGeneral">
        <header id="header">
            <div class="contenedorHeader">
                <nav>
                    <div class="contenedorImagenHeader">
                        <a href="../main.php"> <img src="../img/logo.png" alt="Logo WillyWonka"></a>
                    </div>
                    <div class="contenedorHamburguesa">
                        <img src="../img/iconos/hamburguesa.png" alt="" id="imagenHamburguesa">
                    </div>
                    <div class="contenidoHamburguesa" id="contenidoHamburguesa">
                        <div>
                            <a href="chocolates.php"> Chocolates </a>
                        </div>
                        <div>
                            <a href="golosinas.php"> Golosinas </a>
                        </div>
                        <div>
                            <a href="caramelos.php"> Caramelos </a>
                        </div>
                        <div>
                            <a href="nubes.php"> Nubes </a>
                        </div>
                        <div>
                            <a href="regalizes.php"> Regalizes </a>
                        </div>
                        <div>
                            <a href="chicles.php"> Chicles </a>
                        </div>
                        <div>
                            <a href="aperitivos.php"> Aperitivos </a>
                        </div>
                    </div>
                    <div class="contenedorEnlaces">
                        <ul>
                            <li> <a href="chocolates.php"> Chocolates </a> </li>
                            <li> <a href="golosinas.php"> Golosinas </a> </li>
                            <li> <a href="caramelos.php"> Caramelos </a> </li>
                            <li> <a href="nubes.php"> Nubes </a> </li>
                            <li> <a href="regalizes.php"> Regalizes </a> </li>
                            <li> <a href="chicles.php"> Chicles </a> </li>
                            <li> <a href="aperitivos.php"> Aperitivos </a> </li>
                        </ul>
                    </div>
                </nav>
                <div class="contenedorPerfil">
                    <div class="contenedorImagenPerfil">
                        <?php
                        $imagenEncontrada = comprobarImagenUsuario($_SESSION["correo"]);
                        if ($imagenEncontrada != false) {
                            $conexion = $imagenEncontrada[0]->id_conexion;
                            $estadoConexion = $conexion == 1 ? "green" : "silver";
                            echo "<img src='../img/perfil/" . $imagenEncontrada[0]->imagen . "' alt='Imagen personal' style='border: 3px solid $estadoConexion' id='imagenPerfil'>";
                        }
                        ?>
                    </div>
                    <div class="opcionesPerfil">
                        <div class="contenedorAjustes">
                            <a href="../ajustes.php">Ajustes</a>
                            <img src="../img/iconos/ajustes.png" alt="Ajustes">
                        </div>
                        <div class="contenedorPuntos">
                            <a href="../puntos.php">Puntos</a>
                            <img src="../img/iconos/puntos.png" alt="Puntos">
                        </div>
                        <div class="contenedorSesion">
                            <a href="../cerrarSesion.php">Salir</a>
                            <img src="../img/iconos/cerrar.png" alt="Cerrar sesion">
                        </div>
                        <div class="contenedorEstadoPerfil">
                            <select name="selectorEstado" id="selectorEstado">
                                <?php
                                if (isset($conexion)) {
                                    $nombreEstado = comprobarConexionUsuario($conexion);
                                    if ($nombreEstado != false) {
                                        switch ($nombreEstado[0]->estado_conexion) {
                                            case "Conectado":
                                                echo "<option value='Conectado' selected>Conectado</option>";
                                                echo "<option value='Desconectado'>Desconectado</option>";
                                                break;
                                            case "Desconectado":
                                                echo "<option value='Conectado'>Conectado</option>";
                                                echo "<option value='Desconectado' selected>Desconectado</option>";
                                                break;
                                            default:
                                                break;
                                        }
                                    }
                                } else {
                                    echo "<option value='Conectado'>Conectado</option>";
                                    echo "<option value='Desconectado'>Desconectado</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="productos">
            <?php
            $productoCategoria = obtenerProductoCategoria(1);
            foreach ($productoCategoria as $key => $value) {
                $cadena = "";
                switch ($productoCategoria[$key]->id_categoria) {
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
                if ($productoCategoria[$key]->unidades_producto > 0) {
                    echo "<div class='producto'>";
                    echo "<a href='../producto.php?id=" . $productoCategoria[$key]->id_producto . "'> <img src='../img/categorias/$cadena/" . $productoCategoria[$key]->img_producto . "' alt='" . $productoCategoria[$key]->nombre_producto . "' class='imagenProducto'> </a>";
                    echo "<span>" . $productoCategoria[$key]->nombre_producto . "</span>";
                    echo "<h3> $" . $productoCategoria[$key]->precio_producto . "</h3>";
                    echo "<form action='../cart.php' method='post' class='formularioProducto'>";
                    echo "<input type='hidden' value='" . $productoCategoria[$key]->id_producto . "' name='productoId'>";
                    echo "<input type='hidden' value='img/categorias/$cadena/" . $productoCategoria[$key]->img_producto . "' name='rutaImagenProducto'>";
                    echo "<input type='submit' value='Agregar al carro' name='btnCarrito'>";
                    echo "</form>";
                    echo "</div>";
                } else {
                    echo "<div class='producto opacidad'>";
                    echo "<div class='agotado'>
                            <img src='../img/iconos/agotado.png' alt='Producto agotado' class='imagenProductoAgotado'>
                        </div>";
                    echo "<img src='../img/categorias/$cadena/" . $productoCategoria[$key]->img_producto . "' alt='" . $productoCategoria[$key]->nombre_producto . "' class='imagenProducto'>";
                    echo "<span>" . $productoCategoria[$key]->nombre_producto . "</span>";
                    echo "<h3> $" . $productoCategoria[$key]->precio_producto . "</h3>";
                    echo "<form action='../main.php' method='post' class='formularioProducto'>";
                    echo "<input type='submit' value='Agregar al carro' name='btnCarrito' disabled>";
                    echo "</form>";
                    echo "</div>";
                }
            }
            ?>
        </section>
        <section class="opcionesPagina">
            <section class="contenedorOpciones">
                <section class="opcionesIcono">
                    <a href="../cerrarSesion.php"> <img src="../img/iconos/cerrar.png" alt="Cerrar sesion"
                            id="iconoSesion"></a>
                    <img src="../img/iconos/chat.png" alt="Chat" id="iconoChat">
                    <a href="../cart.php"> <img src="../img/iconos/carro.png" alt="Carrito"></a>
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
        <footer>
            <h3>MARCAS QUE CONFIAN EN NOSOTROS</h3>
            <div class="marcas">
                <div class="marca">
                    <img src="../img/iconos/kinder.png" alt="Kinder">
                </div>
                <div class="marca">
                    <img src="../img/iconos/milka.png" alt="Milka">
                </div>
                <div class="marca">
                    <img src="../img/iconos/maltesers.png" alt="Maltesers">
                </div>
                <div class="marca">
                    <img src="../img/iconos/kitkat.png" alt="Kitkat">
                </div>
            </div>
            <p>Copyright © 2022 Willy. Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/chat.js"></script>
</body>

</html>