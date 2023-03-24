<?php
session_start();

//aquí empieza el carrito

if (isset($_SESSION['carrito']) || isset($_POST['codigo'])) {
    if (isset($_SESSION['carrito'])) {
        $carrito_mio = $_SESSION['carrito'];
        if (isset($_POST['codigo'])) {
            $codigo = $_POST['codigo'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $imagen = $_POST['imagen'];
            $donde = -1; //índice para que funcione correctamente
            if ($donde != -1) {
                $cuanto = $carrito_mio[$donde]['cantidad'] + $cantidad;
                $carrito_mio[$donde] = array("codigo" => $codigo, "descripcion" => $descripcion, "precio" => $precio, "cantidad" => $cuanto, "imagen" => $imagen);
            } else {
                $carrito_mio[] = array("codigo" => $codigo, "descripcion" => $descripcion, "precio" => $precio, "cantidad" => $cantidad, "imagen" => $imagen);
            }
        }
    } else {
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $imagen = $_POST['imagen'];
        $carrito_mio[] = array("codigo" => $codigo, "descripcion" => $descripcion, "precio" => $precio, "cantidad" => $cantidad);
    }

    //Actualizar cantidad del carrito
    if (isset($_POST['cantidad'])) {
        $id = $_POST['id'];
        $cuantos = $_POST['cantidad'];
        if ($cuantos < 1) {
            $carrito_mio[$id] = NULL;
        } else {
            $carrito_mio[$id]['cantidad'] = $cuantos;
        }
    }

    //Borrar producto del carrito
    if (isset($_POST['id2'])) {
        $id = $_POST['id2'];
        $carrito_mio[$id] = NULL;
    }

    $_SESSION['carrito'] = $carrito_mio;
}

header("location: " . $_SERVER['HTTP_REFERER'] . ""); //volver a la página anterior despues de señalar añadir al carrito
