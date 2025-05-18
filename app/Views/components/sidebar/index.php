<?php

$uri = service('uri');

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo : Start -->
    <a href="<?= base_url() ?>" class="brand-link ml-3">
        <i class="fa-solid fa-house-chimney-user"></i> <span class="fw-bold show-on-desktop">CARIKOS Indramayu</span>
    </a>
    <!-- Brand Logo : End -->

    <!-- Sidebar : Start -->
    <div class="sidebar">

        <!-- Sidebar Menu : Start -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>

                <!-- Form : Start -->
                <?php if ($uri->getSegment(1) != 'pemesanan') : ?>
                    <form action="/" method="get">

                        <!-- Wilayah : Start -->
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="nav-icon fas fa-map"></i>
                                <p>
                                    Wilayah
                                </p>
                            </a>

                            <!-- Select Wilayah : Start -->
                            <div class="nav-link">
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
                            </div>
                            <!-- Select Wilayah : End -->

                        </li>
                        <!-- Wilayah : End -->

                        <!-- Jenis Kos : Start -->
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="nav-icon fas fa-person"></i>
                                <p>
                                    Jenis Kos
                                </p>
                            </a>

                            <!-- Select Jenis Kos : Start -->
                            <div class="nav-link">
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
                            </div>
                            <!-- Select Jenis Kos : End -->

                        </li>
                        <!-- Jenis Kos : End -->

                        <!-- Rentang Harga : Start -->
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>
                                    Rentang Harga
                                </p>
                            </a>

                            <!-- Slider Rentang Harga : Start -->
                            <div class="nav-link">
                                <div class="input-group input-group-sm">

                                    <!-- Harga Minimum & Harga Maximum : Start -->
                                    <input type="text" class="form-control rounded" placeholder="Minimum" id="minimumPrice" value="200000" disabled>
                                    <span>-</span>
                                    <input type="text" class="form-control rounded" placeholder="Maximum" id="maximumPrice" value="200000" disabled>
                                    <!-- Harga Minimum & Harga Maximum : End -->

                                    <!-- Slider : Start -->
                                    <div class="slidecontainer">
                                        <input type="range" min="200000" max="2000000" step="100000" value="200000" class="slider" id="priceRange">
                                    </div>
                                    <!-- Slider : End -->

                                </div>
                            </div>
                            <!-- Slider Rentang Harga : End -->

                        </li>
                        <!-- Rentang Harga : End -->

                    </form>
                <?php endif ?>
                <!-- Form : End -->

            </ul>
        </nav>
        <!-- Sidebar Menu : End -->

    </div>
    <!-- Sidebar : End -->

</aside>

<script>

    // Ambil elemen
    const filterWilayah = document.getElementById('filterWilayah');
    const filterType = document.getElementById('filterType');
    const maximumPrice = document.getElementById('maximumPrice');
    const priceRange = document.getElementById('priceRange');

    // Ambil query string dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const wilayahFromUrl = urlParams.get('wilayah');
    const typeFromUrl = urlParams.get('type');
    const maxPriceFromUrl = urlParams.get('maxprice');

    // Set value dari query ke input & slider kalau ada
    if (wilayahFromUrl) filterWilayah.value = wilayahFromUrl;
    if (typeFromUrl) filterType.value = typeFromUrl;
    if (maxPriceFromUrl) {
        priceRange.value = maxPriceFromUrl;
        maximumPrice.value = maxPriceFromUrl;
    } else {
        // Kalau ga ada query, set default sama kayak value slider
        maximumPrice.value = priceRange.value;
    }

    // Event listener untuk filter wilayah & tipe
    filterWilayah.addEventListener('change', redirectWithFilters);
    filterType.addEventListener('change', redirectWithFilters);

    // Event listener slider -> input real-time & redirect
    priceRange.addEventListener('input', function() {
        maximumPrice.value = priceRange.value;
        redirectWithFilters();
    });

    // Function redirect with all filters
    function redirectWithFilters() {
        const wilayah = filterWilayah.value;
        const type = filterType.value;
        const maxPrice = priceRange.value;

        let url = "/?";
        if (wilayah) url += "wilayah=" + wilayah + "&";
        if (type) url += "type=" + type + "&";
        if (maxPrice) url += "maxprice=" + maxPrice;

        if (url.endsWith("&")) url = url.slice(0, -1);
        window.location.href = url;
    }
    
</script>