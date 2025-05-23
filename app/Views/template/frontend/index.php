<?php

// Adding Variable
$uri = service('uri');
$errors = session()->getFlashdata('errors');
$success = session()->getFlashdata('success');

?>


<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Carikos-Indramayu | <?php echo $title ?></title>

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

  <!-- leaflet Plugin : Start -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">

    <?php if (! empty($errors)) : ?>
      <div class="alert alert-danger alert-dismissible" role="alert" style="position: absolute; top: 20px; right: 20px; z-index: 99999;">

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

    <?php if (! empty($success)) : ?>
      <div class="alert alert-success alert-dismissible" role="alert" style="position: absolute; top: 20px; right: 20px; z-index: 99999;">

        <!-- Adding Icon X : Start -->
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <!-- Adding Icon X : End -->

        <!-- Adding Icon : Start -->
        <i class="icon fas fa-check-circle"></i>
        <!-- Adding Icon : End -->

        <?php echo $success ?>

      </div>
    <?php endif; ?>

    <!-- Navbar : Start -->
    <?php echo view('components/navbar/index'); ?>
    <!-- Navbar : End -->

    <!-- Sidebar : Start -->
    <?php echo view('components/sidebar/index'); ?>
    <!-- Sidebar : End -->

    <!-- Content Wrapper : Start -->
    <div class="content-wrapper">
      <div class="content">

        <div class="row">

          <!-- Your Content Here : Start -->
          <?php
          if ($page) {
            echo view($page);
          }
          ?>
          <!-- Your Content Here : End -->

        </div>

      </div>
    </div>
    <!-- Content Wrapper : End -->

  </div>

  <!-- jQuery : Start -->
  <script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery : End -->

  <!-- Bootstrap 4 : Start -->
  <script src="<?php echo base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap 4 : End -->

  <!-- assets App : Start -->
  <script src="<?php echo base_url('assets') ?>/dist/js/adminlte.min.js"></script>
  <!-- assets App : End -->

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