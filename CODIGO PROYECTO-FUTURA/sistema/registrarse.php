<?php
include '../conexion.php';

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['dni']) || empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['clave']) || empty($_POST['rol'])) {
        $alert = '<div class="alert alert-primary" role="alert">
                    Todo los campos son obligatorios
                </div>';
    } else {

        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];
        $estado = $_POST['estado'];

        $query = mysqli_query($conexion, "SELECT * FROM cliente WHERE email = '$correo'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El correo ya existe
                    </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO cliente(dni, nombre, email, telefono, direccion, contraseña, rol, estado) VALUES('$dni', '$nombre', '$correo', '$telefono', '$direccion', '$clave', '$rol', '$estado')");
            $query_insert_user = mysqli_query($conexion, "INSERT INTO usuario(nombre, correo, telefono, usuario, clave, rol, estado) VALUES('$nombre', '$correo', '$telefono', '$dni', '$clave', '$rol', '$estado')");
            if ($query_insert && $query_insert_user) {
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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FUTURA</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Custom styles for this template-->
    <link href="css/style.violet.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="sistema/img/log.png" class="img-thumbnail">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registro de Clientes</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <?php echo isset($alert) ? $alert : ""; ?>
                                        <div class="form-group">
                                            <label for="">Cédula</label>
                                            <input type="number" class="form-control" placeholder="Ingrese su Cédula de Cuidadanía" name="dni">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" placeholder="Ingrese su Nombre" name="nombre">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Correo</label>
                                            <input type="email" class="form-control" placeholder="Ingrese su Correo" name="correo">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Teléfono</label>
                                            <input type="number" class="form-control" placeholder="Ingrese su Teléfono" name="telefono">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" class="form-control" placeholder="Ingrese su Dirección" name="direccion">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="password" class="form-control" placeholder="Contraseña" name="clave">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="rol" value="3" hidden>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="estado" value="1" hidden>
                                        </div>
                                        <input type="submit" value="Guardar Usuario" class="btn btn-primary">
                                        <hr>
                                    </form>
                                    <a href="index.php" style="padding-right: 60px;">Inicio de Sesión</a>
                                    <a href="recuperar_pass.php">¿Olvidó su contraseña?</a>
                                    <hr>
                                    <hr>
                                    <a href="../sistema/../../index.php">Regresar</a>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>


</body>

</html>