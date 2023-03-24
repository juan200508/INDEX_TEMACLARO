<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Producciones</h1>
        <a href="agregar_produccion.php" class="btn btn-primary">Nuevo</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>PRODUCTO</th>
                            <th>CANTIDAD</th>
                            <th>FECHA INICIO</th>
                            <th>ESTADO</th>
                            <th>FINALIZACIÓN</th>
                            <th>ACCIONES</th>
                            <?php if ($_SESSION['rol'] == 1) { ?>

                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../conexion.php";
                        $query = mysqli_query($conexion, "SELECT p.id, pr.descripcion, p.cantidad, p.fecha_inicio, p.estado, p.fecha_modificacion FROM producciones p INNER JOIN producto pr ON p.producto = pr.codproducto");
                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['descripcion']; ?></td>
                                    <td><?php echo $data['cantidad']; ?></td>
                                    <td><?php echo $data['fecha_inicio']; ?></td>
                                    <td><?php
                                        if ($data['estado'] == 'Pendiente') {
                                            echo '<span style="color: red">' . $data['estado'] . '</span>';
                                        } else {
                                            echo '<span style="color: green">' . $data['estado'] . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $data['fecha_modificacion']; ?></td>
                                    <?php if ($_SESSION['rol'] == 1) { ?>
                                        <td>
                                            <?php if ($data['estado'] == "Pendiente") { ?>
                                                <a href="editar_estado_pro.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm"><i class='fas fa-audio-description'></i></a>
                                                <a href="editar_produccion.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-sm"><i class='fas fa-edit'></i></a>
                                                <form action="eliminar_produccion.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class='fas fa-trash-alt'></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <span style="color: red;">No hay acciones disponibles</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->


<?php include_once "includes/footer.php"; ?>