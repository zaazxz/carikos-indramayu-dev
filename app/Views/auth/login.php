<?php

// Adding Variable
$errors = session()->getFlashdata('errors');

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Carikos-Indramayu</title>

    <!-- Google Font (Source Sans Pro) : Start -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font (Source Sans Pro) : End -->

    <!-- Font Awesome Icons : Start -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome Icons : End -->

    <!-- Theme style : Start -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css">
    <!-- Theme style : End -->

    <!-- leaflet : Start -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    <!-- leaflet : End -->

</head>

</head>

<body class="hold-transition register-page">

    <?php if (! empty($errors)) : ?>
        <div class="alert alert-danger alert-dismissible" role="alert" style="position: absolute; top: 20px; right: 20px;">
            
            <!-- Adding Icon X : Start -->
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <!-- Adding Icon X : End -->

            <!-- Adding Icon : Start -->
            <i class="icon fas fa-exclamation-triangle"></i>
            <!-- Adding Icon : End -->

            <?php echo $errors ?>

        </div>
    <?php endif; ?>

    <!-- Form Card : Start -->
    <div class="register-box">
        <div class="register-logo">
            <p><b>Login</b></p>
        </div>

        <!-- Form Box : Start -->
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Silahkan Melakukan Login</p>


                <!-- Form : Start -->
                <form action="/login" method="post" enctype="multipart/form-data">

                    <!-- Email : Start -->
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Email : End -->

                    <!-- Password : Start -->
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Password : End -->

                    <div class="row">
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>

                </form>
                <!-- Form : End -->

                <!-- Divider : Start -->
                <hr class="my-3 bg-gray light">
                <!-- Divider : End -->

                <!-- Lupa password & Register : Start -->
                <div class="flex-col text-center">
                    <div class="mb-0">
                        <small class="mb-1">
                            Belum punya akun?<a href="/register"> Register</a>
                        </small>
                    </div>
                    <div class="mb-0">
                        <small class="mb-1">
                            <a href="/change-password">Lupa password</a>
                        </small>
                    </div>
                </div>
                <!-- Lupa password & Register : End -->

            </div>
        </div>
        <!-- Form Box : End -->

    </div>
    <!-- Form Card : End -->

    <!-- jQuery Plugin : Start -->
    <script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery Plugin : End -->

    <!-- Bootstrap 4 : Start -->
    <script src="<?php echo base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap 4 : End -->

    <!-- AdminLTE : Start -->
    <script src="<?php echo base_url('assets') ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE : End -->

    <!-- Catching Error : Start -->
    <script>
        window.setTimeout(function() {

            // Fade alert without slide
            $('.alert').fadeTo(500, 0, function() {
                $(this).remove();
            })

        }, 3000);
    </script>
    <!-- Catching Error : End -->

</body>

</html>