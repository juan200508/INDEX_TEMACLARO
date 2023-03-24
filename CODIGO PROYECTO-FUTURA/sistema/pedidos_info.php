<?php include_once "includes/header.php";
include '../conexion.php';

//Actualizar los datos del pedido
if (!empty($_POST)) {
    $alert = "";
    $id = $_GET['id'];
    $estado = $_POST['estado'];
    $n_guia = $_POST['n_guia'];

    $query_update = mysqli_query($conexion, "UPDATE datos_pedido SET estado = '$estado', n_guia = '$n_guia' WHERE id = '$id'");
    if ($query_update) {
        $alert = '<div class="alert alert-primary" role="alert">
                        Cambio realizado exitosamente
                    </div>';
    } else {
        $alert = '<div class="alert alert-primary" role="alert">
                         Error al Modificar
                     </div>';
    }
}

//Validar datos del pedido
if (empty($_REQUEST['id'])) {
    header("location: pedidos_realizados.php");
} else {
    $id = $_REQUEST['id'];
    if (!is_numeric($id)) {
        header("location: pedidos_realizados.php");
    }
    $query = mysqli_query($conexion, "SELECT p.id, p.ref_cliente, p.ref, c.nombre, c.correo, c.direccion, c.ciudad, p.fecha, pr.imagen, p.descripcion, p.cantidad, p.precio, p.total_precio, p.estado, p.n_guia
    from pedido_cliente c join datos_pedido p on c.ref = p.ref_cliente join producto pr on pr.descripcion = p.descripcion 
    group by p.id, c.nombre, p.fecha, pr.imagen, p.descripcion, p.cantidad, p.total_precio, p.estado
    having ref_cliente = any(select ref_cliente from datos_pedido where p.id = '$id')");

    $result = mysqli_num_rows($query);

    if ($result > 0) {
        $data = mysqli_fetch_assoc($query);
    } else {
        header("location: pedidos_realizados.php");
    }
}

?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
    <a href="pedidos_realizados.php" class="btn btn-primary">Regresar</a>
</div><br><br>

<form action="" method="POST" class="form">
    <?php echo isset($alert) ? $alert : ''; ?>
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <div class="d-flex flex-row mb-3 justify-content-center">
            <h2>PEDIDO Nº: <?php echo $data['id']; ?></h2><br>
        </div>
        <div class="d-flex flex-row mb-3 justify-content-center">
            <img src="data:img/jpg;base64, <?php echo base64_encode($data['imagen']) ?>" class="card-img-top p-2" alt="" style="width: 300px;">
        </div>
        <div class="card-body">

            <div class="d-flex flex-row mb-3 justify-content-center">
                <h2>DATOS DEL PEDIDO</h2><br>
            </div>
            <div class="d-flex flex-row mb-3 justify-content-around">
                <p style="font-size: 20px;" class="p-2"> <strong>Producto:</strong> <br> <?php echo $data['descripcion'] ?> </p>
                <p style="font-size: 20px;" class="p-2"> <strong>Cantidad:</strong> <br> <?php echo $data['cantidad'] ?> </p>
                <p style="font-size: 20px;" class="p-2"> <strong>Precio und:</strong> <br> <?php echo $data['precio'] ?> </p>
                <p style="font-size: 20px;" class="p-2"> <strong>Precio Total:</strong> <br> <?php echo $data['total_precio'] ?> </p>
            </div><br><br>
            <div class="d-flex flex-row mb-3 justify-content-around">
                <div class="p-2">
                    <?php if ($data['estado'] == "Pendiente" || $data['estado'] == "En camino") { ?>
                        <label style="font-size: 20px;" for="n_guia" class="form-label"> <strong>Estado</strong> </label><br>
                        <select class="form-select" aria-label="Default select example" name="estado">
                            <option style="color: red;" selected> <?php echo $data['estado'] ?> </option>
                            <option style="color: red;" value="Pendiente">Pendiente</option>
                            <option style="color: blue;" value="En camino">En camino</option>
                            <option style="color: green;" value="Entregado">Entregado</option>
                        </select>
                    <?php } else { ?>
                        <p style="font-size: 20px;" class="p-2"> <strong>Estado:</strong> <br> <?php echo '<span style="color: green">' . $data['estado'] . '</span>' ?> </p>
                    <?php } ?>
                </div>
                <div class="p-2">
                    <label style="font-size: 20px;" for="n_guia" class="form-label"> <strong>Nº de guía</strong> </label><br>
                    <input class="form-control" name="n_guia" id="n_guia" type="text" value="<?php echo $data['n_guia'] ?>"><br>
                </div>
                <p style="font-size: 20px;" class="p-2"> <strong>Precio und:</strong> <br> <?php echo $data['fecha'] ?> </p>
            </div><br><br>

            <div class="d-flex flex-row mb-3 justify-content-center"><br><br>
                <h2>DATOS DEL CLIENTE</h2>
            </div>
            <div class="d-flex flex-row mb-3 justify-content-around">
                <p style="font-size: 20px;" class="p-2"> <strong>Cliente:</strong> <br> <?php echo $data['nombre'] ?> </p>
                <p style="font-size: 20px;" class="p-2"> <strong>Cédula:</strong> <br> <?php echo $data['ref_cliente'] ?> </p>
                <p style="font-size: 20px;" class="p-2"> <strong>Correo:</strong> <br> <?php echo $data['correo'] ?> </p>
            </div>
            <div class="d-flex flex-row mb-3 justify-content-around">
                <p style="font-size: 20px;" class="p-2"> <strong>Dirección:</strong> <br> <?php echo $data['direccion'] ?> </p>
                <p style="font-size: 20px;" class="p-2"> <strong>Cuidad:</strong> <br> <?php echo $data['ciudad'] ?> </p>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-sm">Enviar</button>
    </div>
</form>

<?php include_once "includes/footer.php" ?>