<?php

$uri = service('uri');

?>

<style>
    .show-on-desktop {
        display: none;
    }

    @media (min-width: 768px) {
        .show-on-desktop {
            display: inline;
        }
    }
</style>

<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container-fluid">
        <?php if (session()->get('isLoggedIn') == true) : ?>
            <a href="/dashboard" class="navbar-brand fw-bold">
                <i class="fa-solid fa-house-chimney-user"></i> <span class="fw-bold show-on-desktop">CARIKOS Indramayu</span>
            </a>
        <?php else : ?>
            <a href="/" class="navbar-brand fw-bold">
                <i class="fa-solid fa-house-chimney-user"></i> <span class="fw-bold show-on-desktop">CARIKOS Indramayu</span>
            </a>
        <?php endif ?>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <?php if ($uri->getSegment(1) != 'pemesanan') : ?>
                <!-- Form Filter : Start -->
                <form class="form-inline mr-3" method="GET" action="/">
                    <div class="input-group input-group-sm">
                        <select name="wilayah" id="filterWilayah" class="form-control form-control-navbar">
                            <option value="">-- Pilih Wilayah --</option>
                            <?php foreach ($wilayah as $key => $value) : ?>
                                <option value="<?php echo $value['id'] ?>"
                                    <?php if ($request->getGet('wilayah') == $value['id']) echo 'selected'; ?>>
                                    <?php echo $value['name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="input-group input-group-sm">
                        <select name="type" id="filterType" class="form-control form-control-navbar">
                            <option value="">-- Pilih Tipe Kos --</option>
                            <?php foreach ($jenis as $key => $value) : ?>
                                <option value="<?php echo $value['id'] ?>"
                                    <?php if ($request->getGet('type') == $value['id']) echo 'selected'; ?>>
                                    <?php echo $value['type'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </form>
                <!-- Form Filter : End -->
            <?php endif; ?>

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

<script>
    // Getting all filter form
    const filterWilayah = document.getElementById('filterWilayah');
    const filterType = document.getElementById('filterType');

    // DOM on Change
    filterWilayah.addEventListener('change', function() {
        redirectWithFilters();
    })

    filterType.addEventListener('change', function() {
        redirectWithFilters();
    })

    function redirectWithFilters() {
        const wilayah = filterWilayah.value;
        const type = filterType.value;

        let url = "/?";
        if (wilayah !== "null") url += "wilayah=" + wilayah + "&";
        if (type !== "null") url += "type=" + type;

        // hapus trailing &
        if (url.endsWith("&")) url = url.slice(0, -1);

        window.location.href = url;
    }
</script>