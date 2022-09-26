<header id="header">
    <div class="contenedorHeader">
        <nav>
            <div class="contenedorImagenHeader">
                <a href="main.php"> <img src="img/logo.png" alt="Logo WillyWonka"></a>
            </div>
            <div class="contenedorHamburguesa">
                <img src="img/iconos/hamburguesa.png" alt="" id="imagenHamburguesa">
            </div>
            <div class="contenidoHamburguesa" id="contenidoHamburguesa">
                <div>
                    <a href="paginas/chocolates.php"> Chocolates </a>
                </div>
                <div>
                    <a href="paginas/golosinas.php"> Golosinas </a>
                </div>
                <div>
                    <a href="paginas/caramelos.php"> Caramelos </a>
                </div>
                <div>
                    <a href="paginas/nubes.php"> Nubes </a>
                </div>
                <div>
                    <a href="paginas/regalizes.php"> Regalizes </a>
                </div>
                <div>
                    <a href="paginas/chicles.php"> Chicles </a>
                </div>
                <div>
                    <a href="paginas/aperitivos.php"> Aperitivos </a>
                </div>
            </div>
            <div class="contenedorEnlaces">
                <ul>
                    <li> <a href="paginas/chocolates.php"> Chocolates </a> </li>
                    <li> <a href="paginas/golosinas.php"> Golosinas </a> </li>
                    <li> <a href="paginas/caramelos.php"> Caramelos </a> </li>
                    <li> <a href="paginas/nubes.php"> Nubes </a> </li>
                    <li> <a href="paginas/regalizes.php"> Regalizes </a> </li>
                    <li> <a href="paginas/chicles.php"> Chicles </a> </li>
                    <li> <a href="paginas/aperitivos.php"> Aperitivos </a> </li>
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
                    echo "<img src='img/perfil/" . $imagenEncontrada[0]->imagen . "' alt='Imagen personal' style='border: 3px solid $estadoConexion' id='imagenPerfil'>";
                }
                ?>
            </div>
            <div class="opcionesPerfil">
                <div class="contenedorAjustes">
                    <a href="ajustes.php">Ajustes</a>
                    <img src="img/iconos/ajustes.png" alt="Ajustes">
                </div>
                <div class="contenedorPuntos">
                    <a href="puntos.php">Puntos</a>
                    <img src="img/iconos/puntos.png" alt="Puntos">
                </div>
                <div class="contenedorSesion">
                    <a href="cerrarSesion.php">Salir</a>
                    <img src="img/iconos/cerrar.png" alt="Cerrar sesion">
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