<?php

include '../conexion.php';

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $alert = "";
    $pass = substr(md5(microtime()), 1, 10);
    $mail = $_POST['email'];

    $query_update = mysqli_query($conexion, "UPDATE usuario SET clave = '$pass' WHERE correo = '$mail'");

    if ($query_update) {
        $alert = '<div class="alert alert-danger" role="alert">
                    Usuario modificado correctamente
                </div>';
    } else {
        $alert = '<div class="alert alert-danger" role="alert">
                    Error al modificar
                </div>';
    }

    $para = $_POST['email'];
    $from = "From: " . "Equipo FUTURA";
    $subject = "Restablecimiento de contraseña";
    $message = "El sistema asignó una nueva clave de ingreso: " . $pass;

    mail($para, $subject, $message, $from);
    $alert = '<div class="alert alert-danger" role="alert">
                Correo Enviado satisfactoriamente
            </div>';
} else {
    $alert = '<div class="alert alert-danger" role="alert">
               Campos incompletos
            </div>';
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
                                        <h1 class="h4 text-gray-900 mb-4"></h1>
                                        </h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <?php echo isset($alert) ? $alert : ""; ?>
                                        <div class="form-group">
                                            <label for="">Correo</label>
                                            <input type="email" class="form-control" placeholder="Ingrese su Correo" name="email">
                                            <br>
                                            <input type="submit" value="Enviar" class="btn btn-primary">
                                            <hr>
                                    </form>
                                    <a href="../index.php">Inicio de Sesión</a>
                                    <a href="registrarse.php">Registrarse</a>
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