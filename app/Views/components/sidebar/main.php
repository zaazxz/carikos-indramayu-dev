<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="<?php echo base_url('assets') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Carikos-Indramayu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- if level == "Admin" : Start -->
                <?php if (session()->get('level') == "Admin") { ?>
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link <?php if ($title == 'Dashboard') echo 'active'; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/dashboard/wilayah" class="nav-link <?php if ($title == 'Wilayah') echo 'active'; ?>">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Wilayah
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/dashboard/jeniskos" class="nav-link <?php if ($title == 'Jenis Kos') echo 'active'; ?>">
                            <i class="nav-icon fas fa-swimming-pool"></i>
                            <p>
                                Jenis Kos
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/dashboard/users" class="nav-link <?php if ($title == 'Users') echo 'active'; ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <!-- if level == "Admin" : End -->

                <li class="nav-item">
                    <a href="/dashboard/kos" class="nav-link <?php if ($title == 'Kos') echo 'active'; ?>">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Kos
                        </p>
                    </a>
                </li>

                <!-- Check if level == "Pemilik Kos : Start-->
                <?php if (session()->get('level') == "Pemilik Kos" || session()->get('level') == "Pencari Kos") { ?>
                    <li class="nav-item">
                        <a href="/dashboard/pemesanan" class="nav-link <?php if ($title == 'Pemesanan') echo 'active'; ?>">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Pemesanan
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <!-- Check if level == "Pemilik Kos : End-->

                <!-- Check if level == "Admin" : Start -->
                <?php if (session()->get('level') == "Admin") { ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link <?php if ($title == 'Message') echo 'active'; ?>">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Message
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/dashboard/setting" class="nav-link <?php if ($title == 'Setting') echo 'active'; ?>">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Setting
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <!-- Check if level == "Admin" : End -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>