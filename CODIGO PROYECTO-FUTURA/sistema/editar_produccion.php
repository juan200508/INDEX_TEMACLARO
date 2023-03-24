<?php
include_once 'includes/header.php';
include '../conexion.php';
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['producto']) || empty($_POST['cantidad']) || empty($_POST['fecha_inicio']) || empty($_POST['estado'])) {
        $alert = '<div class="alert alert-primary" role="alert">
                        Todo los campos son requeridos
                    </div>';
    } else {
        $id = $_GET['id'];
        $produto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $estado = $_POST['estado'];
        $query_update = mysqli_query($conexion, "UPDATE producciones SET producto = '$producto', cantidad = '$cantidad', fecha_inicio = '$fecha_inicio', estado = '$estado', fecha_modificacion = '$fecha_modificacion' WHERE id = $id");
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
    $query_produccion = mysqli_query($conexion, "SELECT p.id, pr.descripcion, pr.codproducto, p.cantidad, p.fecha_inicio, p.estado, p.fecha_modificacion FROM producciones p INNER JOIN producto pr ON p.producto = pr.codproducto WHERE id = $id_produccion");
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
                            <label for="producto">Producto</label>
                            <?php $query_producto = mysqli_query($conexion, "SELECT codproducto, descripcion FROM producto ORDER BY descripcion ASC");
                            $resultado_producto = mysqli_num_rows($query_produccion);
                            mysqli_close($conexion);
                            ?>
                            <select name="producto" id="producto" class="form-control">
                                <option value="<?php echo $data_produccion['codproducto']; ?>" selected><?php echo $data_produccion['descripcion']; ?></option>
                                <?php
                                if ($resultado_producto > 0) {
                                    while ($producto = mysqli_fetch_array($query_producto)) {
                                ?>
                                        <option value="<?php echo $producto['codproducto'] ?>"><?php echo $producto['descripcion'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="producto">cantidad</label>
                            <input type="number" placeholder="Ingrese la cantidad" name="cantidad" id="cantidad" class="form-control" value="<?php echo $data_produccion['cantidad']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="precio">Fecha Incio</label>
                            <input type="date" placeholder="Ingrese precio" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo $data_produccion['fecha_inicio']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" name="estado" id="estado">
                                <option value="<?php echo $data_produccion['estado'] ?>"><?php echo $data_produccion['estado'] ?></option>
                            </select>
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