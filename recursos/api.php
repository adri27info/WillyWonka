<?php
session_start();

if (!isset($_SESSION["usuarioLogin"])) {
    header("Location: index.php");
}

if (isset($_SESSION["rol"]) && $_SESSION["rol"] == 1) {
    header("Location: index.php");
}

include_once("utilidades.php");
header("Content-Type: application/json; charset=UTF-8");

if (isset($_GET["actualizar"])) {
    $data = json_decode(file_get_contents('php://input'));
    $valor = $data->valor;
    $estado = 0;
    if ($valor == "Conectado") $estado = 1;
    else if ($valor == "Desconectado") $estado = 2;
    if (actualizarEstadoUsuario($estado, $_SESSION["correo"]) != 0) {
        $estadoUsuario = verEstadoUsuario($_SESSION["correo"])[0]->id_conexion;
        if ($estadoUsuario == 1) {
            echo json_encode(array("update"=> "Conectado"));
        } else {
            echo json_encode(array("update"=> "Desconectado"));
        }
    }
}


if (isset($_GET["mensajeChatBienvenida"])) {
    $mensaje = mensajeBienvenidaChat();
    if ($mensaje != false) {
        $array = json_decode(json_encode($mensaje), true);
        $comando = $array[0]["!ayuda"];
        if ($comando != "") {
            echo json_encode(array("comandoAyuda"=> $comando));
        }else{
            echo json_encode(array("comandoAyuda"=> "Error al obtener el comando !ayuda"));
        }
    }
}


if (isset($_GET["mensajeChat"])) {
    $data = json_decode(file_get_contents('php://input'));
    $valor = $data->comando;
    $mensaje = mensajeChat($valor);
    if ($mensaje != false) {
        $array = json_decode(json_encode($mensaje), true);
        $comando = $array[0]["$valor"];
        if ($comando != "") {
            echo json_encode(array("comando"=> $comando));
        }else{
            echo json_encode(array("comando"=> "Error al obtener el comando $valor"));
        }
    }
}
