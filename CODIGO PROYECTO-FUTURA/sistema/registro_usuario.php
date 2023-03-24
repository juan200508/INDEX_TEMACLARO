<?php
include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']) || empty($_POST['estado'])) {
        $alert = '<div class="alert alert-primary" role="alert">
                        Todo los campos son obligatorios
                    </div>';
    } else {

        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $user = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];
        $estado = $_POST['estado'];

        $query = mysqli_query($conexion, "SELECT * FROM usuario where correo = '$email'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El correo ya existe
                    </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO usuario(nombre,correo,telefono,usuario,clave,rol,estado) values ('$nombre', '$email', '$telefono', '$user', '$clave', '$rol', '$estado')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                            Usuario registrado
                        </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar
                    </div>';
            }
        }
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

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    Nuevo Usuario
                </div>
                <div class="card-body">
                    <form action="" method="post" autocomplete="off">
                        <?php echo isset($alert) ? $alert : ''; ?>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre" name="nombre" id="nombre">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" placeholder="Ingrese Correo Electrónico" name="correo" id="correo">
                        </div>
                        <div class="form-group">
                            <label for="correo">Teléfono</label>
                            <input type="number" class="form-control" placeholder="Ingrese Teléfono" name="telefono" id="telefono">
                        </div>
                        <div class="form-group">
                            <label for="usuario">Cédula</label>
                            <input type="text" class="form-control" placeholder="Ingrese su Cédula de Cuidadanía" name="usuario" id="usuario">
                        </div>
                        <div class="form-group">
                            <label for="clave">Contraseña</label>
                            <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="clave" id="clave">
                        </div>
                        <div class="form-group">
                            <label>Rol</label>
                            <select name="rol" id="rol" class="form-control">
                                <?php
                                $query_rol = mysqli_query($conexion, "select * from rol");
                                mysqli_close($conexion);
                                $resultado_rol = mysqli_num_rows($query_rol);
                                if ($resultado_rol > 0) {
                                    while ($rol = mysqli_fetch_array($query_rol)) {
                                ?>
                                        <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                                <?php

                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" name="estado" id="estado">
                                <option value=""></option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                        <input type="submit" value="Guardar Usuario" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>