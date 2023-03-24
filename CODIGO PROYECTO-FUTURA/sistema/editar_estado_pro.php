<?php
include_once 'includes/header.php';
include '../conexion.php';
if (!empty($_POST)) {
    $alter = "";
    if (empty($_POST['estado']) || empty($_POST['fecha_modificacion'])) {
        $alert = '<div class="alert alert-primary" role="alert">
        Todo los campos son requeridos
      </div>';
    } else {
        $id = $_GET['id'];
        $estado = $_POST['estado'];
        $fecha_modificacion = $_POST['fecha_modificacion'];

        $query_update = mysqli_query($conexion, "UPDATE producciones SET estado = '$estado', fecha_modificacion = '$fecha_modificacion' WHERE id = $id");
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
}

//Validar producción
if (empty($_REQUEST['id'])) {
    header("location: lista_producciones.php");
} else {
    $id_produccion = $_REQUEST['id'];
    if (!is_numeric($id_produccion)) {
        header("location: lista_producciones.php");
    }
    $query_produccion = mysqli_query($conexion, "SELECT p.id, pr.descripcion, p.cantidad, p.fecha_inicio, p.estado, p.fecha_modificacion FROM producciones p INNER JOIN producto pr ON p.producto = pr.codproducto WHERE id = $id_produccion");
    $result_produccion = mysqli_num_rows($query_produccion);

    if ($result_produccion > 0) {
        $data_produccion = mysqli_fetch_assoc($query_produccion);
    } else {
        header("location: lista_produccion.php");
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
        <a href="lista_producciones.php" class="btn btn-primary">Regresar</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    Editar Producción
                </div>
                <div class="card-body">
                    <form action="" method="post" autocomplete="off">
                        <?php echo isset($alert) ? $alert : ''; ?>
                        <div class="form-group">
                            <label>Producto</label>
                            <input type="text" placeholder="Ingrese la cantidad" name="producto" id="producto" class="form-control" value="<?php echo $data_produccion['descripcion']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="producto">cantidad</label>
                            <input type="number" placeholder="Ingrese la cantidad" name="cantidad" id="cantidad" class="form-control" value="<?php echo $data_produccion['cantidad']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="precio">Fecha Incio</label>
                            <input type="date" placeholder="Ingrese precio" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo $data_produccion['fecha_inicio']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" name="estado" id="estado">
                                <option value="<?php echo $data_produccion['estado'] ?>" selected><?php echo $data_produccion['estado'] ?></option>
                                <option value="Terminado">Terminado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="precio">Fecha Modificación</label>
                            <input type="date" placeholder="Ingrese precio" class="form-control" name="fecha_modificacion" id="fecha_modificacion" value="<?php echo $data_produccion['fecha_modificacion']; ?>">
                        </div>
                        <input type="submit" value="Guardar Producto" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>