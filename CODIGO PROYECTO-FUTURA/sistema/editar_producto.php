<?php
include_once "includes/header.php";
include "../conexion.php";
error_reporting(0);
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['codigo']) || empty($_POST['producto']) || empty($_POST['precio'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {
    $codproducto = $_GET['id'];
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    $proveedor = $_POST['proveedor'];
    $codigo = $_POST['codigo'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $query_update = mysqli_query($conexion, "UPDATE producto SET imagen = '$imagen', codigo = '$codigo', descripcion = '$producto', proveedor= $proveedor,precio= $precio WHERE codproducto = $codproducto");
    if ($query_update) {
      $alert = '<div class="alert alert-primary" role="alert">
              Producto Modificado
            </div>';
    } else {
      $alert = '<div class="alert alert-primary" role="alert">
                  Error al Modificar
                </div>';
    }
  }
}

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: lista_productos.php");
} else {
  $id_producto = $_REQUEST['id'];
  if (!is_numeric($id_producto)) {
    header("Location: lista_productos.php");
  }
  $query_producto = mysqli_query($conexion, "SELECT p.codproducto, p.imagen, p.codigo, p.descripcion, p.precio, pr.codproveedor, pr.proveedor FROM producto p INNER JOIN proveedor pr ON p.proveedor = pr.codproveedor WHERE p.codproducto = $id_producto");
  $result_producto = mysqli_num_rows($query_producto);

  if ($result_producto > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
  } else {
    header("Location: lista_productos.php");
  }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
    <a href="lista_productos.php" class="btn btn-primary">Regresar</a>
  </div>

  <div class="row">
    <div class="col-lg-6 m-auto">

      <div class="card">
        <div class="card-header bg-primary text-white">
          Modificar producto
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="form-group">
              <label for="codigo">Código de Barras</label>
              <input type="text" placeholder="Ingrese código de barras" name="codigo" id="codigo" class="form-control" value="<?php echo $data_producto['codigo']; ?>">
            </div>

            <!-- imagen -->
            <td><img style="width: 100px;" src="data:image/jpg;base64, <?php echo base64_encode($data_producto['imagen']) ?>" alt=""></td>
            <div class="form-group">
              <label for="codigo">Imagen</label>
              <input type="file" name="imagen" id="imagen" class="form-control">
            </div>

            <div class="form-group">
              <label for="nombre">Proveedor</label>
              <?php $query_proveedor = mysqli_query($conexion, "SELECT * FROM proveedor ORDER BY proveedor ASC");
              $resultado_proveedor = mysqli_num_rows($query_proveedor);
              mysqli_close($conexion);
              ?>
              <select id="proveedor" name="proveedor" class="form-control">
                <option value="<?php echo $data_producto['codproveedor']; ?>" selected><?php echo $data_producto['proveedor']; ?></option>
                <?php
                if ($resultado_proveedor > 0) {
                  while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                    // code...
                ?>
                    <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
                <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="producto">Producto</label>
              <input type="text" class="form-control" placeholder="Ingrese nombre del producto" name="producto" id="producto" value="<?php echo $data_producto['descripcion']; ?>">

            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="text" placeholder="Ingrese precio" class="form-control" name="precio" id="precio" value="<?php echo $data_producto['precio']; ?>">

            </div>
            <input type="submit" value="Actualizar Producto" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>