<?php
session_start();
if (!isset($_SESSION["usuarioLogin"])) {
    header("Location: ../index.php");
}
if (isset($_SESSION["rol"]) && $_SESSION["rol"] == 2) {
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
    <div class="contenedorCrud" id="contenedorCrud">
        <div class="info">
            <div class="imagen">
                <a href="admin.php">
                    <img src="../img/logo.png" alt="Logo">
                </a>
            </div>
            <a href="../cerrarSesion.php">Cerrar sesion</a>
        </div>
        <section class="crud">
            <?php
            $usuarios = obtenerUsuariosNoAdmins(2);
            if ($usuarios != false) {
            ?>
                <div style="overflow-x:auto;">
                    <table class="tablaCrud">
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Contraseña</th>
                            <th>Actualizar</th>
                            <th>Borrar</th>
                        </tr>
                        <?php
                        $usuarios = obtenerUsuariosNoAdmins(2);
                        foreach ($usuarios as $key => $value) {
                            $rol = $value->id_rol != 1 ? "Usuario" : "Administrador";
                            echo "<tr>";
                            echo "<td> $value->nombre </td>";
                            echo "<td> $value->correo </td>";
                            echo "<td> $value->password </td>";
                            echo "<td class='acciones'> <a href='crud/actualizarUsuarios.php?id=$value->id_usuario&nombre=$value->nombre'> <img src='../img/iconos/editar2.png' alt='Editar usuario'> </a> </td>";
                            echo "<td class='acciones'> <a href='crud/borrarUsuarios.php?id=$value->id_usuario&nombre=$value->nombre'> <img src='../img/iconos/borrar.png' alt='Borrar usuario'> </a> </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            <?php
            } else {
                echo "<span style='font-weight: bolder; color: red;' text-align: center; display: block;> Actualmente no hay usuarios para visualizar </span>";
            }
            ?>
        </section>
    </div>
    <?php
    cerrarConexion();
    ?>
</body>
</html>