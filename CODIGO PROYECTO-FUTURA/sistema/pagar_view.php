<?php
include_once 'includes/header.php';
include '../conexion.php';
include_once 'navbar_car.php';
include_once 'modal_cart.php';


?>

<div class="center mt-5">
    <div class="card pt-3">
        <h2 style="vertical-align: middle;">Mis Compras</h2><br>
        <div class="container-fluid">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Artículo</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="container_card">
                        <?php
                        if (isset($_SESSION['carrito'])) {
                            $total = 0;
                            for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
                                if (isset($carrito_mio[$i])) {
                                    if ($carrito_mio[$i] != NULL) {
                        ?>
                                        <?php if ($carrito_mio[$i]['codigo'] != 'portes') { ?>
                                            <tr>
                                                <th scope="row" style="vertical-align: middle;"> <?php echo $i; ?> </th>
                                                <td style="vertical-align: middle;"> <?php echo $carrito_mio[$i]['descripcion'] ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $carrito_mio[$i]['cantidad'] ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $carrito_mio[$i]['precio'] ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $carrito_mio[$i]['cantidad'] * $carrito_mio[$i]['precio'] ?> </td>
                                            </tr>
                                        <?php } ?>
                        <?php

                                        $total = $total + ($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad']);
                                    }
                                }
                            }
                        }
                        ?>
                </tbody>
            </table>
            <br>
            <li class="list-group-item d-flex justify-content-between bg-light">
                <span class="text-primary" style="text-align: left;"><strong>Total</strong></span>
                <strong class="text-primary" style="text-align: left;">$
                    <?php
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
                        $total = 0;
                    } else {
                        $total = $total;
                    }
                    echo number_format($total, 2, ',', '.');
                    ?>
                </strong>
            </li>

            <li class="list-group-item d-flex justify-content-between bg-light">
                <span class="text-primary" style="text-align: left;"><strong>IVA (19%)</strong></span>
                <strong class="text-primary" style="text-align: left;">$
                    <?php
                    $iva = $total * 0.19;
                    echo number_format($iva, 2, ',', '.');
                    ?>
                </strong>
            </li>

            <li class="list-group-item d-flex justify-content-between bg-light">
                <span class="text-primary" style="text-align: left;"><strong>Total Final</strong></span>
                <strong class="text-primary" style="text-align: left;">$
                    <?php
                    $totafinal = $total + $iva;
                    echo number_format($totafinal, 2, ',', '.');
                    ?>
                </strong>
            </li>
            <br>
        </div>
    </div>
    <hr>

    <!-- Formulario de datos del cliente -->

    <div class="container p-5">
        <form action="pay.php" method="POST" class="row g-3" novalidate>
            <?php echo isset($alert) ? $alert : ''; ?>
            <h3>Datos de envío</h3>
            <span style="color: red;">
                El cobro del envío se pagará de forma contraentrega. <br>
                Envíos a Bogotá : Costo de $8.000. Compañía Coordinadora <br>
                Envíos a ciudades diferentes a Bogotá : Costo de $12.000. Compañía Coordinadora
            </span>
            <input type="hidden" name="dato" value="insertar">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Ingrese su nombre completo" name="nombre" id="nombre" class="form-control" value="" required>
            </div>
            <div class="form-group col-md-6">
                <label for="nombre">Cédula</label>
                <input type="text" placeholder="Ingrese su cédula de cuidadanía" name="cedula" id="cedula" class="form-control" value="" required>
            </div>
            <div class="form-group col-md-6">
                <label for="nombre">Correo</label>
                <input type="email" placeholder="Ingrese su e-mail : example@example.com" name="correo" id="correo" class="form-control" value="" required>
            </div>
            <div class="form-group col-md-6">
                <label for="nombre">Teléfono</label>
                <input type="email" placeholder="Ingrese su teléfono : (+57) 000 000 0000" name="telefono" id="telefono" class="form-control" value="" required>
            </div>
            <div class="form-group col-md-6">
                <label for="nombre">Dirección</label>
                <input type="text" placeholder="Ingrese su direeción" name="direccion" id="direccion" class="form-control" value="" required>
            </div>
            <div class="form-group col-md-6">
                <label for="nombre">Ciudad</label>
                <input type="text" placeholder="Ingrese la ciudad en la que reside" name="ciudad" id="ciudad" class="form-control" value="" required>
            </div>
            <input type="submit" class="btn btn-info mb-4" value="Finalizar Pedido">
        </form>
    </div>
</div>
</div>


<?php include_once 'includes/footer.php' ?>