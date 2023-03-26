<?php include_once "includes/header.php";
include '../conexion.php';

//Validar datos del pedido
if (empty($_REQUEST['id'])) {
    header("location: mispedidos.php");
} else {
    $id = $_REQUEST['id'];
    if (!is_numeric($id)) {
        header("location: mispedidos.php");
    }
    $query = mysqli_query($conexion, "SELECT p.id, p.ref_cliente, p.ref, c.nombre, c.correo, c.direccion, c.ciudad, p.fecha, pr.imagen, p.descripcion, p.cantidad, p.precio, p.total_precio, p.estado, p.n_guia
    from pedido_cliente c join datos_pedido p on c.ref = p.ref_cliente join producto pr on pr.descripcion = p.descripcion 
    group by p.id, c.nombre, p.fecha, pr.imagen, p.descripcion, p.cantidad, p.total_precio, p.estado
    having ref_cliente = any(select ref_cliente from datos_pedido where p.id = '$id' AND ref_cliente = " . $_SESSION['user'] . ")");

    $result = mysqli_num_rows($query);

    if ($result > 0) {
        $data = mysqli_fetch_assoc($query);
    } else {
        header("location: mispedidos.php");
    }
}

?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
    <a href="mispedidos.php" class="btn btn-primary">Regresar</a>
</div><br><br>

<div class="container card shadow p-3 mb-5 bg-body rounded bg-light" style="width: 700px;">
    <div class="d-flex flex-row mb-3 justify-content-center">
        <h2>PEDIDO Nº: <?php echo $data['id']; ?></h2><br>
    </div>
    <div class="d-flex flex-row mb-3 justify-content-center">
        <img src="data:img/jpg;base64, <?php echo base64_encode($data['imagen']) ?>" class="card-img-top p-2" alt="" style="width: 300px;">
    </div>
    <div class="card-body">
        <div class="d-flex flex-row mb-3 justify-content-around">
            <p style="font-size: 20px;" class="p-2"> <strong>Producto:</strong> <br> <?php echo $data['descripcion'] ?> </p>
            <p style="font-size: 20px;" class="p-2"> <strong>Cantidad:</strong> <br> <?php echo $data['cantidad'] ?> </p>
            <p style="font-size: 20px;" class="p-2"> <strong>Precio und:</strong> <br> <?php echo $data['precio'] ?> </p>
            <p style="font-size: 20px;" class="p-2"> <strong>Precio Total:</strong> <br> <?php echo $data['total_precio'] ?> </p>
        </div>
        <div class="d-flex flex-row mb-3 justify-content-around">
            <div class="p-2">
                <?php if ($data['estado'] == "Pendiente") { ?>
                    <p style="font-size: 20px;" class="p-2"> <strong>Estado:</strong> <br> <?php echo '<span style="color: red">' . $data['estado'] . '</span>' ?> </p>
                <?php } else if ($data['estado'] == "En camino") { ?>
                    <p style="font-size: 20px;" class="p-2"> <strong>Estado:</strong> <br> <?php echo '<span style="color: blue">' . $data['estado'] . '</span>' ?> </p>
                <?php } else { ?>
                    <p style="font-size: 20px;" class="p-2"> <strong>Estado:</strong> <br> <?php echo '<span style="color: green">' . $data['estado'] . '</span>' ?> </p>
                <?php } ?>
            </div>
            <div class="p-2">
                <?php if ($data['estado'] == "Pendiente") { ?>
                    <p style="font-size: 20px;" class="p-2"> <strong>Nº Guía:</strong> <br> <?php echo '<span style="color: red">' . "Pedido no entregado" . '</span>' ?> </p>
                <?php } else if ($data['estado'] == "En camino") { ?>
                    <p style="font-size: 20px;" class="p-2"> <strong>Nº Guía:</strong> <br> <?php echo '<span style="color: blue">' . "Pedido en camino" . '</span>' ?> </p>
                <?php } else { ?>
                    <p style="font-size: 20px;" class="p-2"> <strong>Nº Guía:</strong> <br> <?php echo '<span style="color: green">' . $data['n_guia'] . '</span>' ?> </p>
                <?php } ?>
            </div>
            <p style="font-size: 20px;" class="p-2"> <strong>Fecha:</strong> <br> <?php echo $data['fecha'] ?> </p>
        </div>
    </div>
</div>

<div class="container card shadow p-3 mb-5 bg-body rounded bg-primary" style="width: 700px;">
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

<?php include_once "includes/footer.php" ?>