<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['contraseña'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorios
                                </div>';
    } else {
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $pass = md5($_POST['contraseña']);
        $rol = $_POST['rol'];
        $estado = $_POST['estado'];
        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($dni) and $dni != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM cliente where dni = '$dni'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                         El dni ya existe
                    </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO cliente(dni,nombre,email,telefono,direccion, contraseña, rol, estado, usuario_id) values ('$dni', '$nombre', '$email', '$telefono', '$direccion', '$pass', '$rol', '$estado', '$usuario_id')");
            $query_insert_user = mysqli_query($conexion, "INSERT INTO usuario(nombre, correo, telefono, usuario, clave, rol, estado) VALUES('$nombre', '$email', '$telefono', '$dni', '$pass', '$rol', '$estado')");
            if ($query_insert && $query_insert_user) {
                $alert = '<div class="alert alert-primary" role="alert">
                            Cliente Registrado
                        </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                             Error al Guardar
                        </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
        <a href="lista_cliente.php" class="btn btn-primary">Regresar</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    Nuevo Cliente
                </div>
                <div class="card-body">
                    <form action="" method="post" autocomplete="off">
                        <?php echo isset($alert) ? $alert : ''; ?>
                        <div class="form-group">
                            <label for="dni">Cédula</label>
   
                            <input type="text"placeholder="Ingrese Cédula" name="dni" id="dni" class="form-control" required minlength="6" maxlength="12">
                            
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control" required>
                            <abbr title="TEXTO EMERGENTE QUE SE MOSTRARÁ AL PASAR EL CURSOR"></abbr>

                        </div>
                        <div class="form-group">
                            <label for="nombre">E-mail</label>
                            <input type="email" placeholder="Ingrese Correo Electrónico" name="email" id="email" class="form-control"required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" placeholder="Ingrese Teléfono" name="telefono" id="telefono" class="form-control" required minlength="10" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" placeholder="Ingrese Direccion" name="direccion" id="direccion" class="form-control"required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Contraseña</label>
                            <input type="password" placeholder="Ingrese Contraseña" name="contraseña" id="contraseña" class="form-control"required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="rol" id="rol" class="form-control" value="3" hidden>
                        </div>
                        <div class="form-group">
                            <input type="text" name="estado" id="estado" class="form-control" value="1" hidden>
                        </div>
                        <input type="submit" value="Guardar Cliente" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>