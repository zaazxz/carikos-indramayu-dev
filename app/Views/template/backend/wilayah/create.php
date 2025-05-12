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
            <form action="/dashboard/wilayah/store" method="post" enctype="multipart/form-data">

                <!-- Validation : Start -->
                <?php
                session();
                $validation = \Config\Services::validation();
                ?>
                <!-- Validation : End -->

                <!-- CSRF : Start -->
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <!-- CSRF : End -->

                <!-- Form Input : Start -->
                <div class="row">

                    <!-- Nama Wilayah : Start -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Wilayah</label>
                            <input name="name" value="<?php echo old('name') ?>" class="form-control" id="name" required autofocus>
                            <p class="text-danger"><?php echo $validation->hasError('name') ? $validation->getError('name') : '' ?></p>
                        </div>
                    </div>
                    <!-- Nama Wilayah : End -->

                    <!-- Warna Wilayah : Start -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Warna Wilayah</label>
                            <input type="color" name="warna" value="<?php echo old('warna') ? old('warna') : '#3388ff' ?>" class="form-control" style="height: 40px; padding: 5px;">
                            <p class="text-danger"><?php echo $validation->hasError('warna') ? $validation->getError('warna') : '' ?></p>
                        </div>
                    </div>
                    <!-- Warna Wilayah : End -->

                    <!-- GEOJSON : Start -->
                    <div class="col-12">
                        <div class="form-group">
                            <label>Gambar Wilayah (Polygon)</label>
                            <div id="map" style="height: 400px;"></div>
                            <input type="hidden" name="geojson" id="geojson" value="<?php echo old('geojson') ?>">
                            <p class="text-danger"><?php echo $validation->hasError('geojson') ? $validation->getError('geojson') : '' ?></p>
                        </div>
                    </div>
                    <!-- GEOJSON : End -->

                    <!-- Submit : Start -->
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                    <!-- Submit : End -->

                </div>
                <!-- Form Input : End -->

            </form>
        </div>
        <!-- Card Body : End -->

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Halaman telah dimuat, memulai inisialisasi peta...");

        // Google Satellite layer
        var googleLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=s,m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        // OpenStreetMap layer
        var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        });

        // Inisialisasi peta
        var map = L.map('map', {
            center: [<?php echo $setting[0]['coordinat'] ?>],
            zoom: <?php echo $setting[0]['zoom'] ?>,
            layers: [googleLayer]
        });

        console.log("Peta berhasil diinisialisasi.");

        // Control base map
        var baseMaps = {
            'Google Satellite': googleLayer,
            'OpenStreetMap': osmLayer
        };
        L.control.layers(baseMaps).addTo(map);

        <?php foreach ($wilayah as $key => $value) { ?>
            L.geoJSON(<?php echo $value['geojson'] ?>, {
                    fillColor: '<?php echo $value['warna'] ?>',
                    fillOpacity: 0.3,
                })
                .bindPopup("<b><?php echo $value['name'] ?></b>")
                .addTo(map);
        <?php } ?>

        // Feature Group untuk gambar
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        // Control gambar polygon
        var drawControl = new L.Control.Draw({
            draw: {
                polygon: {
                    allowIntersection: false,
                    showArea: true,
                    drawError: {
                        color: '#e1e100',
                        message: "<strong>Error:</strong> Polygon tidak boleh saling potong!"
                    },
                    shapeOptions: {
                        color: '#3388ff'
                    }
                },
                polyline: false,
                rectangle: false,
                circle: false,
                marker: false,
                circlemarker: false
            },
            edit: {
                featureGroup: drawnItems
            }
        });
        map.addControl(drawControl);

        console.log("Draw control ditambahkan ke peta.");

        // Ambil elemen input geojson
        var geojsonInput = document.getElementById("geojson");
        if (!geojsonInput) {
            console.error("Elemen input #geojson tidak ditemukan!");
            return;
        }

        console.log("Elemen geojson ditemukan:", geojsonInput);

        // Fungsi untuk menambahkan metadata ke GeoJSON
        function addMetaDataToGeoJSON(data) {
            var nameValue = document.querySelector("input[name='name']").value || "Pekandangan";
            var crsValue = "urn:ogc:def:crs:OGC:1.3:CRS84";

            return {
                type: "FeatureCollection",
                name: nameValue,
                crs: {
                    type: "name",
                    properties: {
                        name: crsValue
                    }
                },
                features: data.features
            };
        }

        // Saat gambar polygon baru dibuat
        map.on(L.Draw.Event.CREATED, function(e) {
            console.log("Gambar polygon baru dibuat.");
            var layer = e.layer;
            drawnItems.addLayer(layer);

            var singleFeature = layer.toGeoJSON();

            // Bungkus jadi FeatureCollection
            var geojsonData = {
                type: "FeatureCollection",
                features: [singleFeature]
            };

            var finalGeoJSON = addMetaDataToGeoJSON(geojsonData);
            var prettyGeoJSON = JSON.stringify(finalGeoJSON, null, 2);

            geojsonInput.value = prettyGeoJSON;
            console.log("GeoJSON yang dihasilkan:", prettyGeoJSON);
        });

        // Saat edit selesai
        map.on('draw:edited', function(e) {
            console.log("Edit gambar polygon selesai.");
            var layers = e.layers;
            var features = [];

            layers.eachLayer(function(layer) {
                features.push(layer.toGeoJSON());
            });

            if (features.length === 0) {
                console.warn("Tidak ada fitur yang diedit!");
                return;
            }

            var geojsonData = {
                type: "FeatureCollection",
                features: features
            };

            var finalGeoJSON = addMetaDataToGeoJSON(geojsonData);
            var prettyGeoJSON = JSON.stringify(finalGeoJSON, null, 2);

            geojsonInput.value = prettyGeoJSON;
            console.log("GeoJSON hasil edit:", prettyGeoJSON);
        });

    });

    // Catch Data from redirecting
    let successMessage = "<?php echo session()->getFlashdata('error'); ?>";

    if (successMessage) {
        alert(successMessage);
    }
</script>