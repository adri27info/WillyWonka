<?php

include_once("conexion.php");

/* SELECT */

function buscarUsuarioRegistrado($correo)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * FROM usuarios where correo = :correo");
        $query->bindParam(':correo', $correo);
        $query->execute();
        $correoEncontrado = $query->fetchAll();
        if (!$correoEncontrado) {
            return false;
        } else {
            return $correoEncontrado;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function loginUsuario($correo, $password)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * FROM usuarios where correo = :correo and password = :password");
        $query->bindParam(':correo', $correo);
        $query->bindParam(':password', $password);
        $query->execute();
        $correoEncontrado = $query->fetchAll();
        if (!$correoEncontrado) {
            return false;
        } else {
            return $correoEncontrado;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}


function buscarUsuarioCriterios($id_usuario, $nombre)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * FROM usuarios where id_usuario = :id_usuario and nombre = :nombre");
        $query->bindParam(':id_usuario', $id_usuario);
        $query->bindParam(':nombre', $nombre);
        $query->execute();
        $usuario = $query->fetchAll();
        if (!$usuario) {
            return false;
        } else {
            return $usuario;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function comprobarVisitaUsuario($correo)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT id_visitado FROM usuarios where correo = :correo");
        $query->bindParam(':correo', $correo);
        $query->execute();
        $correoEncontrado = $query->fetchAll();
        if (!$correoEncontrado) {
            return false;
        } else {
            return $correoEncontrado;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function comprobarImagenUsuario($correo)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT imagen, id_conexion FROM usuarios where correo = :correo");
        $query->bindParam(':correo', $correo);
        $query->execute();
        $imagenEncontrada = $query->fetchAll();
        if (!$imagenEncontrada) {
            return false;
        } else {
            return $imagenEncontrada;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function comprobarConexionUsuario($idConexion)
{
    try {
        $query = BD::crearConexion()->prepare("select c.estado_conexion from conexion c inner join usuarios u on c.id_conexion = :id_conexion limit 1");
        $query->bindParam(':id_conexion', $idConexion);
        $query->execute();
        $imagenEncontrada = $query->fetchAll();
        if (!$imagenEncontrada) {
            return false;
        } else {
            return $imagenEncontrada;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function verEstadoUsuario($correo)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT id_conexion from usuarios where correo = :correo");
        $query->bindParam(':correo', $correo);
        $query->execute();
        $idConexion = $query->fetchAll();
        if (!$idConexion) {
            return false;
        } else {
            return $idConexion;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}


function mensajeBienvenidaChat()
{
    try {
        $query = BD::crearConexion()->prepare("SELECT `!ayuda` from bot");
        $query->execute();
        $comando = $query->fetchAll();
        if (!$comando) {
            return false;
        } else {
            return $comando;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function mensajeChat($comando)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT `$comando` from bot");
        $query->execute();
        $comando = $query->fetchAll();
        if (!$comando) {
            return false;
        } else {
            return $comando;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}



function obtenerProductos()
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * from productos");
        $query->execute();
        $productos = $query->fetchAll();
        if (!$productos) {
            return false;
        } else {
            return $productos;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function obtenerUsuariosNoAdmins($id_rol)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * from usuarios where id_rol = :id_rol");
        $query->bindParam(':id_rol', $id_rol);
        $query->execute();
        $producto = $query->fetchAll();
        if (!$producto) {
            return false;
        } else {
            return $producto;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}


function obtenerProductosPaginacion($desde, $hasta)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * from productos limit :desde, :hasta");
        $query->bindParam(':desde', $desde, PDO::PARAM_INT);
        $query->bindParam(':hasta', $hasta, PDO::PARAM_INT);
        $query->execute();
        $productos = $query->fetchAll();
        if (!$productos) {
            return false;
        } else {
            return $productos;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function obtenerProducto($idProducto)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * from productos where id_producto = :id_producto");
        $query->bindParam(':id_producto', $idProducto);
        $query->execute();
        $producto = $query->fetchAll();
        if (!$producto) {
            return false;
        } else {
            return $producto;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function obtenerProductoCategoria($idCategoria)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * from productos where id_categoria = :id_categoria");
        $query->bindParam(':id_categoria', $idCategoria);
        $query->execute();
        $producto = $query->fetchAll();
        if (!$producto) {
            return false;
        } else {
            return $producto;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function obtenerUnidadesProducto($nombreProducto)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * from productos where nombre_producto  = :nombre_producto");
        $query->bindParam(':nombre_producto', $nombreProducto);
        $query->execute();
        $producto = $query->fetchAll();
        if (!$producto) {
            return false;
        } else {
            return $producto;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function obtenerFacturas($idUsuario)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * from facturas where id_usuario  = :id_usuario");
        $query->bindParam(':id_usuario', $idUsuario);
        $query->execute();
        $producto = $query->fetchAll();
        if (!$producto) {
            return false;
        } else {
            return $producto;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}


function obtenerFacturaHora($idUsuario, $horaCompra)
{
    try {
        $query = BD::crearConexion()->prepare("SELECT * from facturas where id_usuario = :id_usuario and hora_compra  = :hora_compra");
        $query->bindParam(':id_usuario', $idUsuario);
        $query->bindParam(':hora_compra', $horaCompra);
        $query->execute();
        $producto = $query->fetchAll();
        if (!$producto) {
            return false;
        } else {
            return $producto;
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

/* INSERT */

function registroUsuario($id_usuario, $id_rol, $id_producto, $id_conexion, $id_bot, $id_visitado, $nombre, $correo, $password, $imagen, $puntos_totales)
{
    try {
        $query = BD::crearConexion()->prepare("INSERT INTO usuarios(id_usuario, id_rol, id_producto, id_conexion, id_bot, id_visitado, nombre, correo, password, imagen, puntos_totales)
        VALUES (:id_usuario, :id_rol, :id_producto, :id_conexion, :id_bot, :id_visitado, :nombre, :correo, :password, :imagen, :puntos_totales)");
        $query->bindParam(':id_usuario', $id_usuario);
        $query->bindParam(':id_rol', $id_rol);
        $query->bindParam(':id_producto', $id_producto);
        $query->bindParam(':id_conexion', $id_conexion);
        $query->bindParam(':id_bot', $id_bot);
        $query->bindParam(':id_visitado', $id_visitado);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':correo', $correo);
        $query->bindParam(':password', $password);
        $query->bindParam(':imagen', $imagen);
        $query->bindParam(':puntos_totales', $puntos_totales);
        $query->execute();
        return BD::crearConexion()->lastInsertId();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la insercion");
    }
}

function registroFactura($id_factura, $id_usuario, $fecha_compra, $hora_compra, $json_carrito)
{
    try {
        $query = BD::crearConexion()->prepare("INSERT INTO facturas (id_factura, id_usuario, fecha_compra, hora_compra, json_carrito)
        VALUES (:id_factura, :id_usuario, :fecha_compra, :hora_compra, :json_carrito)");
        $query->bindParam(':id_factura', $id_factura);
        $query->bindParam(':id_usuario', $id_usuario);
        $query->bindParam(':fecha_compra', $fecha_compra);
        $query->bindParam(':hora_compra', $hora_compra);
        $query->bindParam(':json_carrito', $json_carrito);
        $query->execute();
        return BD::crearConexion()->lastInsertId();
        //return obtenerUltimaFactura($id_usuario)[0]->id_factura == CONEXION->lastInsertId();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la insercion");
    }
}

/* UPDATE */

function actualizarVisitaUsuario($correo)
{
    try {
        $query = BD::crearConexion()->prepare("update usuarios set id_visitado = 1 where correo = :correo");
        $query->bindParam(':correo', $correo);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function actualizarPasswordUsuario($password, $id_usuario, $nombre)
{
    try {
        $query = BD::crearConexion()->prepare("update usuarios set password = :password where id_usuario = :id_usuario and nombre = :nombre");
        $query->bindParam(':password', $password);
        $query->bindParam(':id_usuario', $id_usuario);
        $query->bindParam(':nombre', $nombre);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}


function actualizarPuntosUsuario($puntosTotales, $correo)
{
    try {
        $query = BD::crearConexion()->prepare("update usuarios set puntos_totales = puntos_totales + :puntos_totales where correo = :correo");
        $query->bindParam(':puntos_totales', $puntosTotales);
        $query->bindParam(':correo', $correo);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function restarPuntosUsuarios($puntosTotales, $correo)
{
    try {
        $query = BD::crearConexion()->prepare("update usuarios set puntos_totales = puntos_totales - :puntos_totales where correo = :correo");
        $query->bindParam(':puntos_totales', $puntosTotales);
        $query->bindParam(':correo', $correo);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function actualizarPrecioProductos($precio, $idProducto)
{
    try {
        $query = BD::crearConexion()->prepare("update productos set precio_producto = precio_producto - :precio_producto where id_producto = :id_producto");
        $query->bindParam(':precio_producto', $precio);
        $query->bindParam(':id_producto', $idProducto);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function actualizarUnidadesProducto($nombreProducto)
{
    try {
        $query = BD::crearConexion()->prepare("update productos set unidades_producto = unidades_producto-1 where nombre_producto = :nombre_producto");
        $query->bindParam(':nombre_producto', $nombreProducto);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}


function actualizarUnidadesProductoEspecificada($nombreProducto, $cantidad)
{
    try {
        $query = BD::crearConexion()->prepare("update productos set unidades_producto = unidades_producto - :cantidad where nombre_producto = :nombre_producto");
        $query->bindParam(':nombre_producto', $nombreProducto);
        $query->bindParam(':cantidad', $cantidad);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function actualizarEstadoUsuario($idConexion, $correo)
{
    try {
        $query = BD::crearConexion()->prepare("update usuarios set id_conexion = :id_conexion where correo = :correo");
        $query->bindParam(':id_conexion', $idConexion);
        $query->bindParam(':correo', $correo);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function actualizarImagenUsuario($nombre, $correoNuevo, $imagen, $correoAntiguo)
{
    try {
        $query = BD::crearConexion()->prepare("update usuarios set nombre = :nombre, correo = :correoNuevo, imagen = :imagen where correo = :correoAntiguo");
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':correoNuevo', $correoNuevo);
        $query->bindParam(':imagen', $imagen);
        $query->bindParam(':correoAntiguo', $correoAntiguo);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

/* DELETE */

function borrarUsuario($id_usuario, $nombre)
{
    try {
        $query = BD::crearConexion()->prepare("delete from usuarios where id_usuario = :id_usuario and nombre = :nombre");
        $query->bindParam(':id_usuario', $id_usuario);
        $query->bindParam(':nombre', $nombre);
        $query->execute();
        return $query->rowCount();
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        die("[-] Error, al realizar la busqueda");
    }
}

function cerrarConexion()
{
    BD::cerrarConexion(BD::crearConexion());
}