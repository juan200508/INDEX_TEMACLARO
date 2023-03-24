<?php
include "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['estado'])) {
    $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
  } else {
    $idusuario = $_GET['id'];
    $estado = $_POST['estado'];

    $sql_update = mysqli_query($conexion, "UPDATE usuario SET estado = '$estado' WHERE idusuario = $idusuario");
    $alert = '<div class="alert alert-success" role="alert">Usuario Actualizado</div>';
  }
}

// Mostrar Datos

//Validar producción
if (empty($_REQUEST['id'])) {
  header("location: lista_usuarios.php");
} else {
  $idusuario = $_REQUEST['id'];
  if (!is_numeric($idusuario)) {
    header("location: lista_usuarios.php");
  }
  $query = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol, u.estado FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE idusuario = '$idusuario'");
  $result = mysqli_num_rows($query);

  if ($result > 0) {
    $data = mysqli_fetch_assoc($query);
  } else {
    header("location: lista_usuarios.php");
  }
}

?>



<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
    <a href="lista_usuarios.php" class="btn btn-primary">Regresar</a>
  </div>

  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="card">
        <div class="card-header bg-primary">
          Modificar Usuario
        </div>
        <div class="card-body">
          <form class="" action="" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <input type="hidden" name="id" value="<?php echo $idusuario; ?>">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" placeholder="Ingrese nombre" class="form-control" name="nombre" id="nombre" value="<?php echo $data['nombre']; ?>" disabled>

            </div>
            <div class="form-group">
              <label for="correo">Correo</label>
              <input type="text" placeholder="Ingrese correo" class="form-control" name="correo" id="correo" value="<?php echo $data['correo']; ?>" disabled>

            </div>
            <div class="form-group">
              <label for="usuario">Cédula</label>
              <input type="text" placeholder="Ingrese su Cédula" class="form-control" name="usuario" id="usuario" value="<?php echo $data['usuario']; ?>" disabled>

            </div>
            <div class="form-group">
              <label for="rol">Rol</label>
              <select name="rol" id="rol" class="form-control" disabled>
                <option value="<?php echo $data['rol'] ?>"><?php echo $data['rol'] ?></option>
              </select>
              <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control" name="estado" id="estado">
                  <option value=""></option>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Editar Usuario</button>
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>