<?php
include_once 'includes/header.php';
include '../conexion.php';
include_once 'navbar_car.php';
include_once 'modal_cart.php';


$busqueda = mysqli_query($conexion, "SELECT * FROM producto");
$numero = mysqli_num_rows($busqueda);

?>


<div class="align-items-center">
    <h1 class=" h3 mb-0 text-gray-800 card-title">Resultados (<?php echo $numero; ?>)</h1>
    <br><br>
    <div class="container_card row g-3">
        <?php while ($resultado = mysqli_fetch_assoc($busqueda)) { ?>
            <form action="cart.php" method="post" id="formulario" name="formulario" class="col-md-6">
                <div class="blog-post"><br><br>
                    <a class="btn btn-info">
                        $ <?php echo $resultado['precio'] ?>
                    </a>
                    <div class="text-content">
                        <input type="hidden" name="codigo" id="codigo" value="<?php echo $resultado['codigo'] ?>">
                        <input type="hidden" name="descripcion" id="descripcion" value="<?php echo $resultado['descripcion'] ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $resultado['precio'] ?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="1" class="pl-2">
                        <div class="card-body">
                            <h5 class="card-title">Código: <?php echo $resultado['codigo'] ?></h5>
                            <td><img style="width: 350px;" src="data:img/jpg;base64, <?php echo base64_encode($resultado['imagen']) ?>" alt=""></td><br><br>
                            <h2><?php echo $resultado['descripcion'] ?></h2>
                            <button class="btn btn-primary btn-sm" type="submit" style="width: 150px;"><i class="fas fa-shopping-cart"></i>Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </form>
            <br><br>
        <?php } ?>

    </div>
</div>

<?php include_once 'includes/footer.php' ?>