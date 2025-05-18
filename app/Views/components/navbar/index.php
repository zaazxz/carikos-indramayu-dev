<?php

$uri = service('uri');

?>

<!-- <style>
    .show-on-desktop {
        display: none;
    }

    @media (min-width: 768px) {
        .show-on-desktop {
            display: inline;
        }
    }
</style> -->

<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <?php if (session()->get('isLoggedIn') == true) : ?>
            <a href="/dashboard" class="navbar-brand fw-bold">
                <i class="fa-solid fa-house-chimney-user"></i> <span class="fw-bold show-on-desktop">CARIKOS Indramayu</span>
            </a>
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars" style="color: black;"></i>
            </a>
        <?php else : ?>
            <a href="/" class="navbar-brand fw-bold">
                <i class="fa-solid fa-house-chimney-user"></i> <span class="fw-bold show-on-desktop">CARIKOS Indramayu</span>
            </a>
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars" style="color: black;"></i>
            </a>
        <?php endif ?>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <?php if (session()->get('isLoggedIn') != true) : ?>
                <a href="/login">
                    <button type="button" class="btn btn-primary">Login</button>
                </a>
            <?php else : ?>
                <a href="/logout">
                    <button type="button" class="btn btn-danger">Logout</button>
                </a>
            <?php endif ?>
        </ul>

    </div>
</nav>