<?php
session_start();
if (empty($_SESSION['active'])) {
	header('location: ../');
}
include "includes/functions.php";
include "../conexion.php";
// datos Empresa
$dni = '';
$nombre_empresa = '';
$razonSocial = '';
$emailEmpresa = '';
$telEmpresa = '';
$dirEmpresa = '';

$query_empresa = mysqli_query($conexion, "SELECT * FROM configuracion");
$row_empresa = mysqli_num_rows($query_empresa);
if ($row_empresa > 0) {
	if ($infoEmpresa = mysqli_fetch_assoc($query_empresa)) {
		$dni = $infoEmpresa['dni'];
		$nombre_empresa = $infoEmpresa['nombre'];
		$razonSocial = $infoEmpresa['razon_social'];
		$telEmpresa = $infoEmpresa['telefono'];
		$emailEmpresa = $infoEmpresa['email'];
		$dirEmpresa = $infoEmpresa['direccion'];
	}
}
$query_data = mysqli_query($conexion, "CALL data();");
$result_data = mysqli_num_rows($query_data);
if ($result_data > 0) {
	$data = mysqli_fetch_assoc($query_data);
}
?>

<!DOCTYPE html>
<html>

<head>

	<!-- CSS BOOTSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FUTURA</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<!-- Custom Font Icons CSS-->
	<link rel="stylesheet" href="css/font.css">
	<!-- Google fonts - Muli-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
	<!-- theme stylesheet-->
	<link rel="stylesheet" href="css/style.violet.css" id="theme-stylesheet">
	<!-- Custom stylesheet - for your changes-->
	<link rel="stylesheet" href="css/custom.css">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- Tweaks for older IEs-->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
	<?php
	include "../conexion.php";
	$query_data = mysqli_query($conexion, "CALL data();");
	$result_data = mysqli_num_rows($query_data);
	if ($result_data > 0) {
		$data = mysqli_fetch_assoc($query_data);
	}

	?>
	<header class="header">
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid d-flex align-items-center justify-content-between">
				<div class="navbar-header">
					<!-- Navbar Header--><a href="index.php" class="navbar-brand">
						<div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">FUTU</strong><strong></strong>RA</div>
						<div class="brand-text brand-sm"><strong class="text-primary">P</strong><strong>V</strong></div>
					</a>
					<!-- Sidebar Toggle Btn-->
					<button class="sidebar-toggle"><i class="fas fa-bars"></i></button>
				</div>
				<h4><?php echo fechaPeru(); ?></h4>
				<div class="right-menu list-inline no-margin-bottom">
					<!-- Log out               -->
					<div class="list-inline-item logout"> <a id="logout" href="salir.php" class="nav-link"> <span class="d-none d-sm-inline">Cerrar sessión </span><i class="icon-logout"></i></a></div>
				</div>
			</div>
		</nav>
	</header>
	<div class="d-flex align-items-stretch">
		<!-- Sidebar Navigation-->
		<nav id="sidebar">
			<!-- Sidebar Header-->
			<div class="sidebar-header d-flex align-items-center">
				<div class="avatar"><img src="img/logo.png" alt="..." class="img-fluid rounded-circle"></div>
				<div class="title">
					<h1 class="h5"><?php echo $_SESSION['nombre']; ?></h1>
					<p><?php if ($_SESSION['rol'] == 1) {
							echo "Administrador";
						} else if ($_SESSION['rol'] == 2) {
							echo "Vendedor";
						} else {
							echo "Cliente";
						} ?></p>
				</div>
			</div>
			<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
				<!-- Divider -->

				<!-- Nav Item - Pages Collapse Menu -->
				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							<i class="fas fa-store"></i>
							<span>Ventas</span>
							<i class="fas fa-angle-down fa-lg float-right"></i>
						</a>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<a class="collapse-item" href="nueva_venta.php">Nueva venta</a>
								<a class="collapse-item" href="ventas.php">Ventas</a>
							</div>
						</div>
					</li>
				<?php } ?>

				<!-- Nav Item - Pages Collapse Menu -->
				<?php if ($_SESSION['rol'] == 3) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShop" aria-expanded="true" aria-controls="collapseShop">
							<i class="fas fa-cart-plus"></i>
							<span>Carrito</span>
							<i class="fas fa-angle-down fa-lg float-right"></i>
						</a>
						<div id="collapseShop" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<a class="collapse-item" href="productos.php">Compras</a>
							</div>
						</div>
					</li>
				<?php } ?>

				<!-- Nav Item - Pages Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDelivery" aria-expanded="true" aria-controls="collapseDelivery">
						<i class="fas fa-truck"></i>
						<span>Pedidos</span>
						<i class="fas fa-angle-down fa-lg float-right"></i>
					</a>
					<div id="collapseDelivery" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<?php if ($_SESSION['rol'] == 3) { ?>
								<a class="collapse-item" href="mispedidos.php">Mis pedidos</a>
							<?php } ?>
							<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
								<a class="collapse-item" href="pedidos_realizados.php">Pedidos Realizados</a>
							<?php } ?>
						</div>
					</div>
				</li>

				<!-- Nav Item - Clientes Collapse Menu -->
				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="true" aria-controls="collapseUtilities">
							<i class="fas fa-users"></i>
							<span>Clientes</span>
							<i class="fas fa-angle-down fa-lg float-right"></i>
						</a>
						<div id="collapseClientes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<a class="collapse-item" href="registro_cliente.php">Nuevo Cliente</a>
								<a class="collapse-item" href="lista_cliente.php">Clientes</a>
							</div>
						</div>
					</li>
				<?php } ?>

				<!-- Nav Item - Productos Collapse Menu -->
				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
							<i class="fas fa-fw fa-wrench"></i>
							<span>Productos</span>
							<i class="fas fa-angle-down fa-lg float-right"></i>
						</a>
						<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<?php if ($_SESSION['rol'] == 1) { ?>
									<a class="collapse-item" href="registro_producto.php">Nuevo Producto</a>
								<?php } ?>
								<a class="collapse-item" href="lista_productos.php">Productos</a>
							</div>
						</div>
					</li>
				<?php } ?>

				<!-- Nav Item - Productos Collapse Menu -->
				<?php if ($_SESSION['rol'] == 1) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduction" aria-expanded="true" aria-controls="collapseUtilities">
							<i class="fas fa-shoe-prints"></i>
							<span>Producción</span>
							<i class="fas fa-angle-down fa-lg float-right"></i>
						</a>
						<div id="collapseProduction" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<?php if ($_SESSION['rol'] == 1) { ?>
									<a class="collapse-item" href="agregar_produccion.php">Nueva producción</a>
								<?php } ?>
								<a class="collapse-item" href="lista_producciones.php">Producciones</a>
							</div>
						</div>
					</li>
				<?php } ?>

				<!-- Nav Item - Utilities Collapse Menu -->
				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProveedor" aria-expanded="true" aria-controls="collapseUtilities">
							<i class="fas fa-hospital"></i>
							<span>Proveedor</span>
							<i class="fas fa-angle-down fa-lg float-right"></i>
						</a>
						<div id="collapseProveedor" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<?php if ($_SESSION['rol'] == 1) { ?>
									<a class="collapse-item" href="registro_proveedor.php">Nuevo Proveedor</a>
								<?php } ?>
								<a class="collapse-item" href="lista_proveedor.php">Proveedores</a>
							</div>
						</div>
					</li>
				<?php } ?>

				<!-- Nav Item - Usuarios Collapse Menu -->
				<?php if ($_SESSION['rol'] == 1) { ?>
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUsuarios" aria-expanded="true">
							<i class="fas fa-user"></i>
							<span>Usuarios</span>
							<i class="fas fa-angle-down fa-lg float-right"></i>
						</a>
						<div id="collapseUsuarios" class="collapse">
							<div class="bg-white py-2 collapse-inner">
								<a class="collapse-item" href="registro_usuario.php">Nuevo Usuario</a>
								<a class="collapse-item" href="lista_usuarios.php">Usuarios</a>
							</div>
						</div>
					</li>
				<?php } ?>
				<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
					<li class="nav-item">
						<a class="nav-link" href="configuracion.php" aria-expanded="true">
							<i class="fas fa-tools"></i>
							<span>Configuración</span>
						</a>
					</li>
				<?php } ?>

			</ul>

		</nav>
		<!-- Sidebar Navigation end-->
		<div class="page-content">
			<div class="page-header">