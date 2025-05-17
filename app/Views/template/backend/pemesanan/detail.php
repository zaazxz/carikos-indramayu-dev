<?php

use CodeIgniter\I18n\Time;

$tanggal = Time::now('Asia/Jakarta')->toDateString();

?>

<div class="col-md-12">
    <div class="card card-outline card-primary">

        <!-- Card Header : Start -->
        <div class="card-header">
            <h3 class="card-title">
                <?php // echo $title 
                ?>
            </h3>
        </div>
        <!-- Card Header : End -->

        <!-- Card Body : Start -->
        <div class="card-body">
            <form action="#" method="post" enctype="multipart/form-data">

                <!-- CSRF : Start -->
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <!-- CSRF : End -->

                <div class="row mb-3">

                    <div class="col-md-6 col-12">
                        <div id="map" style="width: 100%; height: 500px; border-radius: 10px; padding: 10px"></div>
                    </div>

                    <!-- Photo : Start -->
                    <div class="col-md-6 col-12" style="width: 100%; height: 500px; border-radius: 10px; padding: 10px; background: url('<?php echo base_url('upload/photo/' . $pemesanan['photo']) ?>'); background-size: cover; background-position: center; background-repeat: no-repeat">
                    </div>
                    <!-- Photo : End -->

                </div>

                <div class="row">

                    <!-- Detail : Start -->
                    <div class="col-md-6 col-12 p-3">
                        <div class="row">

                            <!-- Name : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Kost</label>
                                    <input value="<?php echo $pemesanan['name'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Name : End -->

                            <!-- Price : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Harga Sewa</label>
                                    <input value="Rp <?php echo number_format($pemesanan['price'], 0, ',', '.') ?> / Bulan" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Price : End -->

                            <!-- Type : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jenis Kos</label>
                                    <input value="Kos <?php echo $pemesanan['type_kos'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Type : End -->

                            <!-- Flood Info : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Status Banjir</label>
                                    <input value="<?php echo $pemesanan['flood_info'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Flood Info : End -->

                            <!-- Address : Start -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="address" class="form-control" id="address" style="width: 100%; height: 100px; resize: none" placeholder="Alamat Kos" disabled><?php echo $pemesanan['address'] ?></textarea>
                                </div>
                            </div>
                            <!-- Address : End -->

                            <!-- Bathroom : Start -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kamar Mandi</label>
                                    <input value="<?php echo $pemesanan['bathroom'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Bathroom : End -->

                            <!-- AC : Start -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Air Conditioner</label>
                                    <input value="<?php echo $pemesanan['air_conditioner'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- AC : End -->

                            <!-- Wifi : Start -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Internet</label>
                                    <input value="<?php echo $pemesanan['wifi'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Wifi : End -->

                            <!-- Owner : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Owner</label>
                                    <input value="<?php echo $pemesanan['owner_name'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Owner : End -->

                            <!-- No Telepon Owner : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>No Telepon Owner</label>
                                    <input value="<?php echo $pemesanan['owner_phone'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- No Telepon Owner : End -->

                        </div>
                    </div>
                    <!-- Detail : End -->

                    <!-- Data Pemesan : Start -->
                    <div class="col-md-6 col-12 p-3">
                        <div class="row">

                            <!-- Name Reserver : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Penyewa</label>
                                    <input value="<?php echo $pemesanan['reserver_name'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Name Reserver : End -->

                            <!-- Phone Reserver : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kontak Penyewa</label>
                                    <input value="<?php echo $pemesanan['reserver_phone'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Phone Reserver : End -->

                            <!-- Bank Reserver : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Akun Bank Penyewa</label>

                                    <?php if ($pemesanan['reserver_account'] == null) : ?>
                                        <input value="Penyewa tidak memiliki rekening" class="form-control" type="text" disabled>
                                    <?php else : ?>
                                        <input value=<?php echo $pemesanan['reserver_account'] ?> class="form-control" type="text" disabled>
                                    <?php endif ?>
                                    
                                </div>
                            </div>
                            <!-- Bank Reserver : End -->

                            <!-- Bank Reserver : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Atas Nama Bank Penyewa</label>

                                    <?php if ($pemesanan['reserver_account'] == null) : ?>
                                        <input value="Penyewa tidak memiliki rekening" class="form-control" type="text" disabled>
                                    <?php else : ?>
                                        <input value=<?php echo $pemesanan['reserver_account_username'] ?> class="form-control" type="text" disabled>
                                    <?php endif ?>

                                </div>
                            </div>
                            <!-- Bank Reserver : End -->

                            <!-- Tanggal mulai sewa : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Mulai Sewa</label>
                                    <input value="<?php echo $pemesanan['start_date'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Tanggal mulai sewa : End -->

                            <!-- Tanggal mulai sewa : Start -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir Sewa</label>
                                    <input value="<?php echo $pemesanan['outstanding_balance'] ?>" class="form-control" type="text" disabled>
                                </div>
                            </div>
                            <!-- Tanggal mulai sewa : End -->

                            <!-- Tanggal mulai sewa : Start -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Bukti Pembayaran</label>
                                    <?php if ($pemesanan['proof_of_payment'] == null) : ?>
                                        <input value="Belum ada bukti pembayaran" class="form-control" type="text" disabled>
                                    <?php else : ?>
                                        <img src="<?php echo base_url('/upload/pemesanan/' . $pemesanan['proof_of_payment']) ?>" class="img-fluid" alt="Bukti Pembayaran" style="width: 100%; height: 132px; object-fit: cover">
                                    <?php endif ?>
                                </div>
                            </div>
                            <!-- Tanggal mulai sewa : End -->

                            <!-- CTA Button : Start -->
                            <?php if ($pemesanan['available'] > 0 && session()->get('level') == 'Pemilik Kos' && $pemesanan['status'] == 'Pending') : ?>
                            <div class="col-6">
                                <a href="/dashboard/pemesanan/approve/<?php echo $pemesanan['id'] ?>" class="btn btn-success btn-block">
                                    Terima Pemesanan
                                </a>
                            </div>

                            <div class="col-6">
                                <a href="/dashboard/pemesanan/reject/<?php echo $pemesanan['id'] ?>" class="btn btn-danger btn-block">
                                    Tolak Pemesanan
                                </a>
                            </div>
                            <?php endif ?>
                            <!-- CTA Button : End -->

                            <!-- CTA Button : Start -->
                            <?php if (session()->get('level') == 'Pencari Kos' || $pemesanan['status'] != 'Pending') : ?>
                            <div class="col-12">
                                <a href="/dashboard/kos" class="btn btn-danger btn-block">
                                    Kembali
                                </a>
                            </div>
                            <?php endif ?>
                            <!-- CTA Button : End -->

                        </div>
                    </div>
                    <!-- Data Pemesan : End -->
                </div>

            </form>

        </div>
        <!-- Card Body : End -->

    </div>
</div>
</div>

<script>
    var peta1 = L.tileLayer('https://{s}.google.com/vt/lyrs=s,m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var map = L.map('map', {
        center: [<?php echo $setting[0]['coordinat'] ?>],
        zoom: <?php echo $setting[0]['zoom'] ?>,
        layers: [peta1]
    });

    var baseMaps = {
        'Satellite': peta1,
        'OpenStreetMap': peta2,
    };

    var layerControl = L.control.layers(baseMaps).addTo(map);

    L.marker([<?php echo $pemesanan['coordinat'] ?>]).addTo(map)

    <?php foreach ($wilayah as $key => $value) { ?>
        L.geoJSON(<?php echo $value['geojson'] ?>, {
                fillColor: '<?php echo $value['warna'] ?>',
                fillOpacity: 0.3,
            })
            .bindPopup("<b><?php echo $value['name'] ?></b>")
            .addTo(map);
    <?php } ?>
</script>