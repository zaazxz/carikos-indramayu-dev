<?php

$uri = service('uri');

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Carikos-Indramayu | <?php echo $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css">

    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>

</head>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <p><b>Register</b> <?php echo $level ?></p>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Silahkan Melakukan Register</p>

                <!-- Form : Start -->
                <form action="/register" method="post" enctype="multipart/form-data">

                    <!-- CSRF Token : Start -->
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <!-- CSRF Token : End -->

                    <!-- Name : Start -->
                    <div class="input-group mb-3">
                        <input name="name" class="form-control" placeholder="Masukkan Nama" type="text" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Name : End -->

                    <!-- Email : Start -->
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Masukkan E-mail" type="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Email : End -->

                    <!-- No Handphone : Start -->
                    <div class="input-group mb-3">
                        <input type="text" name="phone" class="form-control" placeholder="Masukkan No Handphone" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <!-- No Handphone : End -->

                    <!-- Note : Start -->
                    <div style="margin-top: -10px; margin-bottom: 5px">
                        <small class="text-muted">* Password akan di set otomatis menjadi password dibawah</small>
                    </div>
                    <!-- Note : End -->

                    <!-- Password : Start -->
                    <div class="input-group mb-3">
                        <input type="text" name="password" class="form-control" placeholder="Password"
                            <?php if ($uri->getSegment(2) == 'pemilik') : ?>
                            value="pemilik123"
                            <?php elseif ($uri->getSegment(1) == 'register') : ?>
                            value="pencari123"
                            <?php endif ?>
                            disabled>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Password : End -->

                    <!-- Hidden : Start -->
                     <?php if ($uri->getSegment(2) == 'pemilik') : ?>
                        <input type="hidden" name="level" value="Pemilik Kos">
                        <input type="hidden" name="password" value="pemilik123">
                    <?php elseif ($uri->getSegment(1) == 'register') : ?>
                        <input type="hidden" name="level" value="Pencari Kos">
                        <input type="hidden" name="password" value="pencari123">
                    <?php endif ?>

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
                <!-- Form : End -->

                <hr class="mt-3 mb-2 bg-gray light">

                <?php if ($uri->getSegment(2) == 'pemilik') : ?>
                    <div class="col-12 text-center">
                        <small class="text-center">Anda pencari kos? <a href="/register">Register</a></small>
                    </div>
                <?php elseif ($uri->getSegment(1) == 'register') : ?>
                    <div class="col-12 text-center">
                        <small class="text-center">Anda pemilik kos? <a href="/register/pemilik">Register</a></small>
                    </div>
                <?php endif ?>

                <div class="col-12 text-center">
                    <small class="text-center">Sudah Punya Akun? <a href="/login">Login</a></small>
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets') ?>/dist/js/adminlte.min.js"></script>
</body>

</html>