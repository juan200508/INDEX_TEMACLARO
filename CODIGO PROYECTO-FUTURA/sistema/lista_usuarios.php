<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
		<?php if ($_SESSION['rol'] == 1) { ?>
			<a href="registro_usuario.php" class="btn btn-primary">Nuevo</a>
		<?php } ?>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table" id="table">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>NOMBRE</th>
							<th>CORREO</th>
							<th>CÉDULA</th>
							<th>DIRECCIÓN</th>
							<th>ESTADO</th>
							<?php if ($_SESSION['rol'] == 1) { ?>
								<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";

						$query = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol, u.estado FROM usuario u INNER JOIN rol r ON u.rol = r.idrol");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['idusuario']; ?></td>
									<td><?php echo $data['nombre']; ?></td>
									<td><?php echo $data['correo']; ?></td>
									<td><?php echo $data['usuario']; ?></td>
									<td><?php echo $data['rol']; ?></td>
									<td>
										<?php if ($data['estado'] == 1) { ?>
											<span class="text-success">Acitvo</span>
										<?php } else { ?>
											<span class="text-secondary">Inactivo</span>
										<?php } ?>
									</td>
									<?php if ($_SESSION['rol'] == 1) { ?>
										<td>
											<a href="editar_usuario.php?id=<?php echo $data['idusuario']; ?>" class="btn btn-info btn-sm"><i class='fas fa-edit'></i> </a>

											<?php if ($data['estado'] == 1) { ?>
												<a href="editar_estuser.php?id=<?php echo $data['idusuario']; ?>" class="btn btn-success btn-sm"><i class='fas fa-circle'></i> </a>
											<?php } else { ?>
												<a href="editar_estuser.php?id=<?php echo $data['idusuario']; ?>" class="btn btn-secondary btn-sm"><i class='far fa-circle'></i> </a>
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