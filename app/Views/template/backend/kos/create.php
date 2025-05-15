<div class="col-md-12">
    <div class="card card-outline card-primary">

        <!-- Card Header : Start -->
        <div class="card-header">
            <h3 class="card-title">
                <?php echo $title ?>
            </h3>
        </div>
        <!-- Card Header : End -->

        <!-- Card Body : Start -->
        <div class="card-body">
            <form action="/dashboard/kos/store" method="post" enctype="multipart/form-data">

                <!-- CSRF Token : Start -->
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <!-- CSRF Token : End -->

                <!-- Validation : Start -->
                <?php
                session();
                $validation = \Config\Services::validation();
                ?>
                <!-- Validation : End -->


                <div class="row">

                    <!-- Name : Start -->
                    <div class="col-3">
                        <div class="form-group">
                            <label>Nama Kos</label>
                            <input name="name" value="<?php echo old('name') ?>" placeholder="CTH : Kos Putrajaya" class="form-control" id="name" type="text">
                            <p class="text-danger">
                                <?php echo $validation->hasError('name') ? $validation->getError('name') : '' ?>
                            </p>
                        </div>
                    </div>
                    <!-- Name : End -->

                    <!-- Price : Start -->
                    <div class="col-3">
                        <div class="form-group">
                            <label>Harga</label>
                            <input name="price" value="<?php echo old('price') ?>" placeholder="CTH: 500.000" class="form-control" id="price" type="text">
                            <p class="text-danger">
                                <?php echo $validation->hasError('price') ? $validation->getError('price') : '' ?>
                            </p>
                        </div>
                    </div>
                    <!-- Price : End -->

                    <!-- Available : Start -->
                    <div class="col-3">
                        <div class="form-group">
                            <label>Ketersediaan Kamar</label>
                            <input type="number" name="available" value="<?php echo old('available') ?>" placeholder="Hanya angka" class="form-control" id="available">
                            <p class="text-danger">
                                <?php echo $validation->hasError('available') ? $validation->getError('available') : '' ?>
                            </p>
                        </div>
                    </div>
                    <!-- Available : End -->

                    <!-- Jenis Kos : Start -->
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis kos</label>
                            <select name="id_jenis" class="form-control" id="id_jenis">
                                <option value="">--Pilih Jenis Kos--</option>
                                <?php foreach ($jenis as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>" <?php echo old('id') == $value['id'] ? 'selected' : '' ?>>
                                        <?php echo $value['type'] ?>
                                    </option>
                                <?php } ?>

                            </select>
                            <p class="text-danger">
                                <?php echo $validation->hasError('id_jenis') ? $validation->getError('id_jenis') : '' ?>
                            </p>
                        </div>
                    </div>
                    <!-- Jenis Kos : End -->

                </div>

                <!-- Coordinat : Start -->
                <div class="form-group">
                    <label>Coordinat Kos</label>
                    <div id="map" style="width: 100%; height: 500px;"></div>
                    <input name="coordinat" id="Coordinat" value="<?php echo old('coordinat') ?>" placeholder="Coordinat Kos" class="form-control" hidden>
                    <p class="text-danger">
                        <?php echo $validation->hasError('coordinat') ? $validation->getError('coordinat') : '' ?>
                    </p>
                </div>
                <!-- Coordinat : End -->

                <div class="row">

                    <!-- Bathroom : Start -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Kamar Mandi</label>
                            <select name="bathroom" class="form-control">
                                <option value="">--Pilih Kamar Mandi--</option>
                                <option value="Didalam" <?php echo (old('bathroom') == 'Didalam') ? 'selected' : '' ?>>
                                    Didalam
                                </option>
                                <option value="Diluar" <?php echo (old('bathroom') == 'Diluar') ? 'selected' : '' ?>>
                                    Diluar
                                </option>
                            </select>
                            <p class="text-danger">
                                <?php echo $validation->hasError('bathroom') ? $validation->getError('bathroom') : '' ?>
                            </p>
                        </div>
                    </div>
                    <!-- Bathroom : End -->

                    <!-- Wifi : Start -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Wifi</label>
                            <select name="wifi" class="form-control">
                                <option value="">--Pilih Wifi--</option>
                                <option value="Tersedia" <?php echo (old('wifi') == 'Tersedia') ? 'selected' : '' ?>>
                                    Tersedia
                                </option>
                                <option value="Tidak Tersedia" <?php echo (old('wifi') == 'Tidak Tersedia') ? 'selected' : '' ?>>
                                    Tidak Tersedia
                                </option>
                            </select>
                            <p class="text-danger">
                                <?php echo $validation->hasError('wifi') ? $validation->getError('wifi') : '' ?>
                            </p>
                        </div>
                    </div>
                    <!-- Wifi : End -->

                    <!-- air_conditioner : Start -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>AC</label>
                            <select name="air_conditioner" class="form-control">
                                <option value="">--Pilih air_conditioner--</option>
                                <option value="Tersedia" <?php echo (old('air_conditioner') == 'Tersedia') ? 'selected' : '' ?>>
                                    Tersedia
                                </option>
                                <option value="Tidak Tersedia" <?php echo (old('air_conditioner') == 'Tidak Tersedia') ? 'selected' : '' ?>>
                                    Tidak Tersedia
                                </option>
                            </select>
                            <p class="text-danger"><?php echo $validation->hasError('air_conditioner') ? $validation->getError('air_conditioner') : '' ?></p>
                        </div>
                    </div>
                    <!-- air_conditioner : End -->

                </div>

                <div class="row">

                    <!-- flood_info : Start -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Status Banjir</label>
                            <select name="flood_info" class="form-control">
                                <option value="">--Pilih Status Banjir--</option>
                                <option value="Aman" <?php echo (old('flood_info') == 'Aman') ? 'selected' : '' ?>>
                                    Aman
                                </option>
                                <option value="Siaga" <?php echo (old('flood_info') == 'Siaga') ? 'selected' : '' ?>>
                                    Siaga
                                </option>
                                <option value="Rawan" <?php echo (old('flood_info') == 'Rawan') ? 'selected' : '' ?>>
                                    Rawan
                                </option>
                            </select>
                            <p class="text-danger">
                                <?php echo $validation->hasError('flood_info') ? $validation->getError('flood_info') : '' ?>
                            </p>
                        </div>
                    </div>
                    <!-- flood_info : End -->

                    <!-- id_wilayah : Start -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Desa / Kelurahan</label>
                            <select name="id_wilayah" class="form-control">
                                <option value="">--Pilih Desa/Kelurahan---</option>
                                <?php foreach ($wilayah as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>" <?php echo (old('id') == $value['id']) ? 'selected' : '' ?>>
                                        <?php echo $value['name'] ?>
                                    </option>
                                <?php  } ?>
                            </select>
                            <p class="text-danger"><?php echo $validation->hasError('id_wilayah') ? $validation->getError('id_wilayah') : '' ?></p>
                        </div>
                    </div>
                    <!-- id_wilayah : End -->

                    <div class="col-4">
                        <div class="form-group">
                            <label>Foto Kos</label>
                            <input type="file" accept=".jpg, .jpeg, .png" name="photo" value="<?php echo old('photo') ?>" class="form-control" required>
                            <p class="text-danger">
                                <?php echo $validation->hasError('photo') ? $validation->getError('photo') : '' ?>
                            </p>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- address : Start -->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control" id="address" style="height: 100px; resize: none" placeholder="Alamat Kos"><?php echo old('address') ?></textarea>
                            <p class="text-danger">
                                <?php echo $validation->hasError('address') ? $validation->getError('address') : '' ?>
                            </p>
                        </div>
                    </div>
                    <!-- address : End -->

                </div>


                <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
                <a href="/dashboard/kos" class="btn btn-success btn-flat">Kembali</a>

            </form>

        </div>
        <!-- Card Body : End -->

    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2').select2();

    });
</script>

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

    <?php foreach ($wilayah as $key => $value) { ?>
        L.geoJSON(<?php echo $value['geojson'] ?>, {
                fillColor: '<?php echo $value['warna'] ?>',
                fillOpacity: 0.3,
            })
            .bindPopup("<b><?php echo $value['name'] ?></b>")
            .addTo(map);
    <?php } ?>

    var layerControl = L.control.layers(baseMaps).addTo(map);

    var coordinatInput = document.querySelector("[name=coordinat]");

    var curLocation = [<?php echo $setting[0]['coordinat'] ?>];
    map.attributionControl.setPrefix(false);
    var marker = new L.marker(curLocation, {
        draggable: 'true',
    });

    //mengambil coordinat saat marker di geser
    marker.on('dragend', function(e) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            curLocation
        }).bindPopup(position).update();
        $("#Coordinat").val(position.lat + "," + position.lng);
    });

    //mengambil coordinat saat map onclik
    map.on("click", function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            marker.setLatLng(e.latlng);
        }
        coordinatInput.value = lat + ',' + lng;
    });
    map.addLayer(marker);
</script>