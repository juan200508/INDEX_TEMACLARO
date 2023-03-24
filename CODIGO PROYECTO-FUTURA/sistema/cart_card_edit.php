<?php
include_once 'includes/header.php';
include '../conexion.php';
include_once 'navbar_car.php';
include_once 'modal_cart.php';


?>

<div class="center mt-5">
    <div class="card pt-3">
        <h2>Mis Compras</h2>
        <div class="container-fluid">
            <table class="table" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Artículo</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        <th scope="col">Borrar</th>
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
                                                <td style="vertical-align: middle;">
                                                    <form action="cart.php" name="form1" id="form2" method="POST">
                                                        <input type="hidden" name="id" id="id" class="align-middle" value="<?php print $i; ?>">
                                                        <input type="text" name="cantidad" id="cantidad" style="width: 50px;" class="align-middle text-center" size="1" maxlength="4" value="<?php print $carrito_mio[$i]['cantidad']; ?>">
                                                        <button class="btn btn-sm btn-succeess">
                                                            <input type="submit" name="" id="" value="" class="btn btn-sm btn-succeess"><i class="fas fa-undo"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td style="vertical-align: middle;"> <?php echo $carrito_mio[$i]['precio'] ?> </td>
                                                <td style="vertical-align: middle;"> <?php echo $carrito_mio[$i]['cantidad'] * $carrito_mio[$i]['precio'] ?> </td>
                                                <td>
                                                    <form action="cart.php" id="form3" method="POST">
                                                        <input type="hidden" name="id2" id="id2" value="<?php print $i; ?>">
                                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" tittle="Remove item">
                                                            <i class='fas fa-trash-alt'></i>
                                                        </button>
                                                    </form>
                                                </td>
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
                <strong class="text-primary" style="text-align: left;">
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
                    $
                </strong>

            </li>
        </div>
    </div>
    <a type="button" class="btn btn-info my-4" href="pagar_view.php">Continuar Pedido</a>
    <a type="button" class="btn btn-danger" href="productos.php">Regresar</a>
</div>
</div>

<?php include_once 'includes/footer.php' ?>