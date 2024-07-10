<?php
// Incluir aquí cualquier configuración o conexión a la base de datos necesaria
// Por ejemplo: require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Login - Sistema de Blog</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./public/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="./public/css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a class="">
                                <h3 class="text-primary">
                                    <i class="fa fa-blog me-2"></i>Blog System
                                </h3>
                            </a>
                            <h3>Login</h3>
                        </div>

                        <form method="post" action="./controllers/usuarios.controllers.php?op=login">
                            <?php
                            if (isset($_GET['error'])) {
                                $error = $_GET['error'];
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                            ?>

                            <div class="form-floating mb-3">
                                <input required type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su nombre de usuario" autofocus />
                                <label for="usuario">Nombre de Usuario</label>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary py-3 w-100 mb-4" type="submit">
                                    Ingresar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="./public/js/main.js"></script>
</body>

</html>