<?php

include_once "includes/header.php";
include "../conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['producto']) || empty($_POST['cantidad']) || empty($_POST['fecha_inicio']) || empty($_POST['estado'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                    Todos los campos son obligatorios
                 </div>';
    } else {
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $estado = $_POST['estado'];
        $fecha_modificacion = "00/00/00";
        $usuario_id = $_SESSION['idUser'];

        $query_insert = mysqli_query($conexion, "INSERT INTO producciones(producto, cantidad, fecha_inicio, estado, fecha_modificacion, usuario_id) VALUES ('$producto', '$cantidad', '$fecha_inicio', '$estado', '$fecha_modificacion', '$usuario_id')");
        if ($query_insert) {
            $alert = '<div class="alert alert-success" role="alert">
                            Producción Registrada
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar la producción
                    </div>';
        }
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
                    Nueva producción
                </div>
                <div class="card-body">
                    <form action="" method="post" autocomplete="off">
                        <?php echo isset($alert) ? $alert : ''; ?>
                        <div class="form-group">
                            <label>Producto</label>
                            <?php
                            $query_producto = mysqli_query($conexion, "SELECT codproducto, descripcion FROM producto ORDER BY descripcion ASC");
                            $resultado_producto = mysqli_num_rows($query_producto);
                            mysqli_close($conexion);
                            ?>

                            <select id="producto" name="producto" class="form-control">
                                <option value=""></option>
                                <?php
                                if ($resultado_producto > 0) {
                                    while ($producto = mysqli_fetch_array($query_producto)) {
                                        // code...
                                ?>
                                        <option value="<?php echo $producto['codproducto']; ?>"><?php echo $producto['descripcion']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="producto">cantidad</label>
                            <input type="number" placeholder="Ingrese la cantidad" name="cantidad" id="cantidad" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="precio">Fecha Incio</label>
                            <input type="date" placeholder="Ingrese precio" class="form-control" name="fecha_inicio" id="fecha_inicio">
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Estado</label>
                            <select class="form-control" name="estado" id="estado">
                                <option value=""></option>
                                <option value="Pendiente">Pendiente</option>
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