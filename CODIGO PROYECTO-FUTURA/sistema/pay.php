<?php session_start();

include '../conexion.php';

//Insertar los datos del cliente
//Crear referencia del cliente
// $str = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz123456789";
// $password = "";
// for ($i = 0; $i < 5; $i++) {
//     $password .= substr($str, rand(0, 64), 1);
// }
// $ref_cliente = $password;
$query = mysqli_query($conexion, "INSERT INTO pedido_cliente(ref, nombre, correo, telefono, direccion, ciudad) VALUES('" . $_POST['cedula'] . "', '" . $_POST['nombre'] . "', '" . $_POST['correo'] . "', '" . $_POST['telefono'] . "', '" . $_POST['direccion'] . "', '" . $_POST['ciudad'] . "')");


//Referencia del pedido
$str = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz123456789";
$password = "";
for ($i = 0; $i < 5; $i++) {
    $password .= substr($str, rand(0, 64), 1);
}
$ref_pedido = $password;

//Traer el carrito de compras
if (isset($_SESSION['carrito'])) {
    $carrito_mio = $_SESSION['carrito'];
}

if (isset($_SESSION['carrito'])) {
    $total = 0;
    $alert = "";
    for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
        if (isset($carrito_mio[$i])) {
            if ($carrito_mio[$i] != NULL) {
                $descripcion = $carrito_mio[$i]['descripcion'];
                $cantidad = $carrito_mio[$i]['cantidad'];
                $precio = $carrito_mio[$i]['precio'];
                $total_precio = $cantidad * $precio;
                $estado = "Pendiente";
                $query_pedido = mysqli_query($conexion, "INSERT INTO datos_pedido(ref, ref_cliente, descripcion, cantidad, precio, total_precio, estado) VALUES ('$ref_pedido', '" . $_POST['cedula'] . "', '$descripcion', '$cantidad', '$precio', '$total_precio', '$estado')");
                if ($query_pedido) {
                    $alert = '<div class="alert alert-success" role="alert">
                                Pedido Registrado
                            </div>';
                } else {
                    $alert = '<div class="alert alert-danger" role="alert">
                                 Error al registrar el pedido
                            </div>';
                }
            }
        }
    }
}


if (isset($_SESSION['carrito'])) {
    $total = 0;
    for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
        if (isset($carrito_mio[$i])) {
            if ($carrito_mio[$i] != NULL) {
                $total = $total + ($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad']);
            }
        }
    }
}
if (!isset($total)) {
    $total = '0';
} else {
    $total = $total;
}

unset($_SESSION['carrito']);

header("Location: productos.php");
