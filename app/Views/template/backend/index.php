<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Carikos-Indramayu</title>

  <!-- Google Font (Source Sans Pro) : Start -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Google Font (Source Sans Pro) : End -->

  <!-- Plugins : Start -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Plugins : End -->

  <!-- Theme style : Start -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
  <!-- Theme style : End -->

  <!-- leaflet : Start -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
  <!-- leaflet : End -->

  <!-- Javascript Plugin : Start -->
  <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/select2/js/select2.full.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Javascript Plugin : End -->

  <!-- AdminLTE App : Start -->
  <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE App : End -->

  <!-- leaflet : Start -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
  <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
  <!-- leaflet : End -->

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar : Start -->
    <?php echo view('components/navbar/main'); ?>
    <!-- Navbar : End -->

    <!-- Sidebar : Start -->
    <?php echo view('components/sidebar/main'); ?>
    <!-- Sidebar : End -->

    <!-- Content Wrapper : Start -->
    <div class="content-wrapper">

      <!-- Content Header : Start -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">
                <?php echo $title; ?>
              </h1>
            </div>
          </div>
        </div>
      </div>
      <!-- Content Header : End -->

      <!-- Main content : Start -->
      <div class="content">
        <div class="container-fluid">
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
      <!-- Main content : End -->

    </div>
    <!-- Content Wrapper : End -->



    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

</body>

</html>