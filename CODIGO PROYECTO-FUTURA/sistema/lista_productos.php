<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Productos</h1>
		<a href="registro_producto.php" class="btn btn-primary">Nuevo</a>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table" id="table">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>IMAGEN</th>
							<th>PRODUCTO</th>
							<th>PRECIO</th>
							<th>STOCK</th>
							<?php if ($_SESSION['rol'] == 1) { ?>
								<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";

						$query = mysqli_query($conexion, "SELECT * FROM producto");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['codproducto']; ?></td>
									<td><img style="width: 100px;" src="data:img/jpg;base64, <?php echo base64_encode($data['imagen']) ?>" alt=""></td>
									<td><?php echo $data['descripcion']; ?></td>
									<td><?php echo $data['precio']; ?></td>
									<td><?php echo $data['existencia']; ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
										<td>
											<a href="agregar_producto.php?id=<?php echo $data['codproducto']; ?>" class="btn btn-primary btn-sm"><i class='fas fa-audio-description'></i></a>

											<a href="editar_producto.php?id=<?php echo $data['codproducto']; ?>" class="btn btn-info btn-sm"><i class='fas fa-edit'></i></a>

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