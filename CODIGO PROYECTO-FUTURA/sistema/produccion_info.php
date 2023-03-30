<?php include_once "includes/header.php";
include '../conexion.php';

//Validar producción
if (empty($_REQUEST['id'])) {
    header("location: lista_producciones.php");
} else {
    $id_produccion = $_REQUEST['id'];
    if (!is_numeric($id_produccion)) {
        header("location: lista_producciones.php");
    }
    $query_produccion = mysqli_query($conexion, "SELECT p.id, pr.imagen, pr.descripcion, pr.codproducto, p.cantidad, p.fecha_inicio, p.estado, p.fecha_modificacion, p.anotaciones, p.fecha_terminacion FROM producciones p INNER JOIN producto pr ON p.producto = pr.codproducto WHERE id = $id_produccion");
    $result_produccion = mysqli_num_rows($query_produccion);

    if ($result_produccion > 0) {
        $data = mysqli_fetch_assoc($query_produccion);
    } else {
        header("location: lista_produccion.php");
    }
}

?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
    <a href="lista_producciones.php" class="btn btn-primary">Regresar</a>
</div><br><br>

<div class="container card shadow p-3 mb-5 bg-body rounded bg-light" style="width: 700px;">
    <div class="d-flex flex-row mb-3 justify-content-center">
        <h2>PRODUCCIÓN Nº: <?php echo $data['id']; ?></h2><br>
    </div>
    <div class="d-flex flex-row mb-3 justify-content-center">
        <img src="data:img/jpg;base64, <?php echo base64_encode($data['imagen']) ?>" class="card-img-top p-2" alt="" style="width: 300px;">
    </div>
    <div class="card-body">
        <div class="d-flex flex-row mb-3 justify-content-around">
            <p style="font-size: 20px;" class="p-2"> <strong>Producto:</strong> <br> <?php echo $data['descripcion'] ?> </p>
            <p style="font-size: 20px;" class="p-2"> <strong>Cantidad:</strong> <br> <?php echo $data['cantidad'] ?> </p>
            <p style="font-size: 20px;" class="p-2"> <strong>Fecha de inicio:</strong> <br> <?php echo $data['fecha_inicio'] ?> </p>

        </div>
        <div class="d-flex flex-row mb-3 justify-content-around">
            <p style="font-size: 20px;" class="p-2"> <strong>Fecha de moficiacion:</strong> <br> <?php echo $data['fecha_modificacion'] ?> </p>
            <div class="p-2">
                <label style="font-size: 20px" for="texto"> <strong>Anotaciones:</strong> </label>
                <textarea style="font-size: 20px;" class="p-2 form-control" id="texto" rows="3" disabled>  <?php echo $data['anotaciones'] ?> </textarea>
            </div>
        </div>
        <div class="d-flex flex-row mb-3 justify-content-around">
            <div class="p-2">
                <p style="font-size: 20px;" class="p-2"> <strong>Estado:</strong> <br>
                    <?php
                    echo '<span style="color: green">' . $data['estado'] . '</span>';
                    ?>
                </p>
            </div>

            <p style="font-size: 20px;" class="p-2"> <strong>Fecha de Finalización:</strong> <br> <?php echo $data['fecha_terminacion'] ?> </p>
        </div>
    </div>
</div>


<?php include_once "includes/footer.php" ?>