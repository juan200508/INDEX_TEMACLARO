<?php

//BARRA DE NAVEGACIÓN
if (isset($_SESSION['carrito'])) {
    $carrito_mio = $_SESSION['carrito'];
}

//Contar el carrito
if (isset($_SESSION['carrito'])) {
    for ($i = 0; $i <= count($carrito_mio) - 1; $i++) {
        if (isset($carrito_mio[$i])) {
            if ($carrito_mio[$i] != NULL) {
                if (!isset($carrito_mio['cantidad'])) {
                    $carrito_mio['cantidad'] = '0';
                } else {
                    $carrito_mio['cantidad'] = $carrito_mio['cantidad'];
                }
                $total_cantidad = $carrito_mio['cantidad'];
                $total_cantidad++;
                if (!isset($total_cantidad)) {
                    $total_cantidad = '0';
                } else {
                    $total_cantidad = $total_cantidad;
                }
                $total_cantidad += $total_cantidad;
            }
        }
    }
}
//Declarar variables
if (!isset($total_cantidad)) {
    $total_cantidad = '';
} else {
    $total_cantidad = $total_cantidad;
}

?>

<!-- NAV BAR -->

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Mi Tienda</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_cart" style="color: red; cursor:pointer;"><i class="fas fa-shopping-cart"></i> <?php echo $total_cantidad; ?> </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br><br>

<!-- END NAV BAR -->