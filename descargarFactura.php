<?php
session_start();
if (!isset($_SESSION["usuarioLogin"])) {
    header("Location: index.php");
}
if (isset($_SESSION["rol"]) && $_SESSION["rol"] == 1) {
    header("Location: index.php");
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WillyWonka</title>
    <style>
    /* ---------------------------------------------------- GENERALES  ---------------------------------------------------- */


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-image: linear-gradient(#5d3895, #100127);
        font-family: Arial, Helvetica, sans-serif;
        background-repeat: no-repeat;
    }

    div.contenedorGeneral {
        width: 90%;
        max-width: 1500px;
        background-color: white;
        margin: 5px auto;
        min-height: 100vh;
        min-width: 360px;
        position: relative;
        z-index: 1;
    }

    /* ---------------------------------------------------- SECCION PDF FACTURACION ---------------------------------------------------- */

    div.contenedorGeneral section.mostrarDatosFacturas {
        width: 100%;
        padding: 20px;
    }

    section.mostrarDatosFacturas div.cabeceraFacturacion {
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-between;
        align-content: center;
    }

    div.cabeceraFacturacion h3.tituloCabeceraFactura {
        text-decoration: underline;
    }

    div.cabeceraFacturacion div.imagenFacturacion {
        width: 150px;
        align-self: center;
    }

    div.imagenFacturacion img {
        width: 100%;
        vertical-align: top;
    }


    section.mostrarDatosFacturas h3 {
        display: block;
        margin: 70px 0px;
    }


    section.mostrarDatosFacturas h3.tituloFactura {
        text-decoration: underline;
    }

    section.mostrarDatosFacturas table.tablaFacturas {
        width: 100%;
        text-align: center;
    }

    table.tablaFacturas,
    tr,
    th,
    td {
        border: 3px solid black;
        border-collapse: collapse;
    }

    table.tablaFacturas td {
        width: 25%;
    }

    table.tablaFacturas td img {
        width: 50%;
        vertical-align: top;
    }
    </style>
</head>

<body>
    <?php
    include("recursos/utilidades.php");
    if (isset($_POST["btnFactura"])) {
        if (obtenerFacturas($_SESSION["idUsuario"]) != false) {
            $factura = obtenerFacturaHora($_SESSION["idUsuario"], $_POST["horaCompra"]);
            $decode = json_decode($factura[0]->json_carrito, true);
    ?>
    <div class="contenedorGeneral" id="contenedorGeneral">
        <section class="mostrarDatosFacturas">
            <div class="cabeceraFacturacion">
                <h3 class="tituloCabeceraFactura">Facturacion </h3>
            </div>
            <h3>Enviado a
                <?php echo $_SESSION["usuarioLogin"] . " en el dia " .  $decode[$_SESSION["idUsuario"]][0] . " / " . $decode[$_SESSION["idUsuario"]][1]; ?>
            </h3>
            <h3 class="tituloFactura">Detalles de la facturacion</h3>
            <table class="tablaFacturas">
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
                <?php
                        $total = 0;
                        foreach ($decode as $key => $value) {
                            foreach ($value[2] as $key2 => $value2) {
                                echo "<tr>";
                                echo "<td><img src='http://" . $_SERVER["HTTP_HOST"] . "/Cursos/apps/Willywonka/" . $value2[4] . "'></td>";
                                echo "<td>$value2[0]</td>";
                                echo "<td>$value2[1] €</td>";
                                echo "<td>$value2[3]</td>";
                                echo "</tr>";
                                $total += $value2[1] * $value2[3];
                            }
                        }
                        ?>
            </table>
            <h3>Total a pagar <?php echo $total; ?>€</h3>
        </section>
    </div>
    <?php
        } else {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }
    cerrarConexion();
    ?>
</body>

</html>
<?php
$html = ob_get_clean();
require_once("librerias/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$options = $dompdf->getOptions();
//Esta apcion es para activar imagenes
$options->set(array("isRemoteEnabled" => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper("letter");
$dompdf->render();
//Esta opcion es para ponerle nombre al pdf y segun el booleano (false => se visualizara en el navegador, true => se descargara)
$dompdf->stream("factura.pdf", array("Attachment" => true));
?>