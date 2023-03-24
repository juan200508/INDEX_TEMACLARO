<?php include_once "includes/header.php";
include '../conexion.php';
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mis pedidos</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>IMAGEN</th>
                            <th>PRODUCTO</th>
                            <th>PRECIO</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../conexion.php";

                        $query = mysqli_query($conexion, "SELECT p.id, p.ref_cliente, p.ref, c.nombre, p.fecha, pr.imagen, p.descripcion, p.cantidad, p.total_precio, p.estado, p.n_guia
                                                        from pedido_cliente c join datos_pedido p on c.ref = p.ref_cliente join producto pr on pr.descripcion = p.descripcion 
                                                        group by p.id, c.nombre, p.fecha, pr.imagen, p.descripcion, p.cantidad, p.total_precio, p.estado
                                                        having ref_cliente = any(select ref_cliente from datos_pedido where ref_cliente = " . $_SESSION['user'] . ")");

                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['nombre']; ?></td>
                                    <td><img style="width: 100px;" src="data:img/jpg;base64, <?php echo base64_encode($data['imagen']) ?>" alt=""></td>
                                    <td><?php echo $data['descripcion']; ?></td>
                                    <td>$<?php echo $data['total_precio']; ?></td>
                                    <td><?php
                                        if ($data['estado'] == 'Pendiente') {
                                            echo '<span style="color: red">' . $data['estado'] . '</span>';
                                        } else if ($data['estado'] == "En camino") {
                                            echo '<span style="color: blue">' . $data['estado'] . '</span>';
                                        } else {
                                            echo '<span style="color: green">' . $data['estado'] . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="mispedidos_info.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    </td>
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