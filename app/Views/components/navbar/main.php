<?php

use App\Models\KosModel;
use App\Models\UserModel;
use App\Models\PemesananModel;

$kosModel = new KosModel();
$unverifiedKos = $kosModel->where('status', 'Unverified')->countAllResults();

$userModel = new UserModel();
$unverifiedUser = $userModel->where('status', 'Unverified')->countAllResults();

$pemesananModel = new PemesananModel();
$unverifiedPemesanan = $pemesananModel->join('kos', 'kos.id = pemesanan.id_kos')
    ->where('kos.id_user', session()->get('id'))
    ->where('pemesanan.status', 'Pending')
    ->countAllResults();

$warningCount = 0;
$pemesananWarningCount = 0;

if (session()->get('password') == true) {
    $warningCount++;
}
if (session()->get('account') == null) {
    $warningCount++;
}
if (session()->get('photo') == null) {
    $warningCount++;
}

if ($unverifiedPemesanan > 0) {
    $pemesananWarningCount++;
}

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">

        <!-- Notifications : Start -->
        <?php if (session()->get('level') == "Admin" || session()->get('level') == "Pemilik Kos") : ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>

                    <?php if ($unverifiedKos + $unverifiedUser > 0 || session()->get('level') == "Admin") : ?>
                        <span class="badge badge-warning navbar-badge">
                            <?php echo ($unverifiedKos + $unverifiedUser); ?>
                        </span>
                    <?php endif; ?>

                    <?php if ($pemesananWarningCount > 0 && session()->get('level') == "Pemilik Kos") : ?>
                        <span class="badge badge-warning navbar-badge">
                            <?php echo $pemesananWarningCount; ?>
                        </span>
                    <?php endif; ?>

                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    <!-- Header : Start -->
                    <span class="dropdown-item dropdown-header">
                        <?php echo ($unverifiedKos + $unverifiedUser); ?> Notifications
                    </span>
                    <!-- Header : End -->

                    <!-- Kost : Start -->
                    <?php if (session()->get('level') == 'Admin') : ?>
                        <?php if ($unverifiedKos > 0) : ?>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-school mr-2"></i> <?php echo $unverifiedKos; ?> Kost perlu verifikasi
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- Kost : End -->

                    <!-- User : Start -->
                    <?php if (session()->get('level') == 'Admin') : ?>
                        <?php if ($unverifiedUser > 0) : ?>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> <?php echo $unverifiedUser; ?> User perlu verifikasi
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- User : End -->

                    <!-- Pembayaran : Start -->
                    <?php if (session()->get('level') == 'Pemilik Kos') : ?>
                        <div class="dropdown-divider"></div>
                        <a href="/dashboard/pemesanan" class="dropdown-item">
                            <i class="fas fa-money-check mr-2"></i> <?php echo $unverifiedPemesanan; ?> Pembayaran perlu verifikasi
                        </a>
                    <?php endif; ?>
                    <!-- Pembayaran : End -->

                </div>
            </li>
        <?php endif; ?>
        <!-- Notifications : End -->

        <!-- Profile Menu : Start -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
                <?php if ($warningCount > 0) : ?>
                    <span class="badge badge-danger navbar-badge"><?php echo ($warningCount); ?></span>
                <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div href="#" class="dropdown-item">
                    <div class="media">

                        <!-- If photo != null : Start -->
                        <?php if (session()->get('photo') != null) : ?>
                            <img src="<?php echo (base_url('/upload/user/') . session()->get('photo')); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <?php endif; ?>
                        <!-- If photo != null : End -->

                        <!-- If photo == null : Start -->
                        <?php if (session()->get('photo') == null) : ?>
                            <img src="https://placehold.co/150x150?text=User&font=roboto" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <?php endif; ?>
                        <!-- If photo == null : End -->

                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <?php echo (session()->get('name')); ?>
                            </h3>
                            <p class="text-sm">
                                Hello <?php echo (session()->get('name')); ?>, Nice to meet you!
                            </p>

                        </div>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <!-- If Password not changed : Start -->
                <?php if (session()->get('password') == true) : ?>
                    <a href="/dashboard/profile/changepassword/<?php echo (session()->get('id')); ?>" class="dropdown-item">
                        <div class="media">
                            <i class="fas fa-info-circle mr-3 text-danger" style="font-size: 50px; margin-right: 10px;"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Warning!
                                </h3>
                                <p class="text-sm">
                                    Please change your password!
                                </p>

                            </div>
                        </div>
                    </a>
                <?php endif; ?>
                <!-- If Password not changed : End -->

                <!-- If Account is null : Start -->
                <?php if (session()->get('account') == "null" || session()->get('account') == null) : ?>
                    <a href="/dashboard/profile/customize/<?php echo (session()->get('id')); ?>" class="dropdown-item">
                        <div class="media">
                            <i class="fas fa-info-circle mr-3 text-warning" style="font-size: 50px; margin-right: 10px;"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Warning!
                                </h3>
                                <p class="text-sm">
                                    Please complete your account!
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
                <!-- If Account is null : End -->

                <!-- If Foto is null : Start -->
                <?php if (session()->get('photo') == null) : ?>
                    <a href="/dashboard/profile/customize/<?php echo (session()->get('id')); ?>" class="dropdown-item">
                        <div class="media">
                            <i class="fas fa-info-circle mr-3 text-info" style="font-size: 50px; margin-right: 10px;"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Warning!
                                </h3>
                                <p class="text-sm">
                                    Please add your profile photo!
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
                <!-- If Foto is null : End -->

                <!-- If Foto is null : Start -->
                <?php if (session()->get('status') == "Unverified") : ?>
                    <div class="dropdown-item">
                        <div class="media">
                            <i class="fas fa-info-circle mr-3 text-secondary" style="font-size: 50px; margin-right: 10px;"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Warning!
                                </h3>
                                <p class="text-sm">
                                    Your account is Unverified! Please wait until your account is verified
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- If Foto is null : End -->

                <div class="dropdown-divider"></div>

                <!-- Logout Button : Start -->
                <a href="/dashboard/profile/customize/<?php echo (session()->get('id')); ?>" class="dropdown-item text-info dropdown-footer">
                    <i class="fas fa-user-edit mr-2"></i> Profile
                </a>
                <!-- Logout Button : End -->

                <div class="dropdown-divider"></div>

                <!-- Logout Button : Start -->
                <a href="/logout" class="dropdown-item text-danger dropdown-footer" onclick="return confirm('Yakin keluar?')">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <!-- Logout Button : End -->

            </div>
        </li>
        <!-- Profile Menu : End -->

    </ul>
</nav>