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
            <form action="/dashboard/wilayah/update/<?php echo $wilayah[0]['id']; ?>" method="post" enctype="multipart/form-data">

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
                            <input name="name" value="<?php echo $wilayah[0]['name']; ?>" class="form-control" id="name" required>
                            <p class="text-danger"><?php echo $validation->hasError('name') ? $validation->getError('name') : '' ?></p>
                        </div>
                    </div>
                    <!-- Nama Wilayah : End -->

                    <!-- Warna Wilayah : Start -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Warna Wilayah</label>
                            <input type="color" name="warna" value="<?php echo $wilayah[0]['warna']; ?>" class="form-control" style="height: 40px; padding: 5px;" id="warna">
                            <p class="text-danger"><?php echo $validation->hasError('warna') ? $validation->getError('warna') : '' ?></p>
                        </div>
                    </div>
                    <!-- Warna Wilayah : End -->

                    <!-- GEOJSON : Start -->
                    <div class="col-12">
                        <div class="form-group">
                            <label>Gambar Wilayah (Polygon)</label>
                            <div id="map" style="height: 400px;"></div>
                            <input type="hidden" name="geojson" id="geojson" value='<?php echo json_encode($wilayah[0]['geojson']); ?>'>
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
        console.log("Halaman dimuat, mulai inisialisasi peta...");

        // Ambil elemen form dan input
        var form = document.querySelector("form");
        var nameInput = document.getElementById("name");
        var warnaInput = document.querySelector("input[name='warna']");
        var geojsonInput = document.getElementById("geojson");

        // Variabel untuk menampung data lama
        var oldGeoJSON = geojsonInput.value;

        // Inisialisasi Peta
        var googleLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=s,m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        });

        var map = L.map('map', {
            center: [<?php echo $setting[0]['coordinat'] ?>],
            zoom: <?php echo $setting[0]['zoom'] ?>,
            layers: [googleLayer]
        });

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

        // Fungsi untuk memuat GeoJSON lama ke peta
        function loadOldGeoJSON() {
            if (geojsonInput.value) {
                try {
                    var existingGeoJSON = JSON.parse(geojsonInput.value);
                    if (existingGeoJSON.features && existingGeoJSON.features.length > 0) {
                        var existingLayer = L.geoJSON(existingGeoJSON);
                        existingLayer.eachLayer(function(layer) {
                            drawnItems.addLayer(layer);
                        });
                        console.log("GeoJSON lama dimuat ke peta.");
                    }
                } catch (error) {
                    console.error("Gagal parsing GeoJSON lama:", error);
                }
            }
        }

        // Fungsi untuk memperbarui GeoJSON di form
        function updateGeoJSON() {
            var geojsonData = drawnItems.toGeoJSON();
            if (geojsonData.features && geojsonData.features.length > 0) {
                var finalGeoJSON = addMetaDataToGeoJSON(geojsonData);
                geojsonInput.value = JSON.stringify(finalGeoJSON, null, 2);
                console.log("GeoJSON disimpan:", finalGeoJSON);
            }
        }

        // Fungsi untuk menambahkan metadata ke GeoJSON
        function addMetaDataToGeoJSON(data) {
            var nameValue = nameInput.value || ""; // Gunakan nilai name dari input
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
                features: data.features // Pastikan fitur ditambahkan dengan benar
            };
        }

        // Fungsi untuk memperbarui data form sebelum submit
        function updateFormData() {
            // Ambil nilai baru dari input
            var newName = nameInput.value;
            var newWarna = warnaInput.value;
            var newGeoJSON = geojsonInput.value;

            // Update input dengan data baru
            nameInput.value = newName;
            warnaInput.value = newWarna;
            geojsonInput.value = newGeoJSON;

            // Log untuk memastikan nilai diupdate
            console.log("Updated Name:", newName);
            console.log("Updated Warna:", newWarna);
            console.log("Updated GeoJSON:", newGeoJSON);
        }

        // Saat gambar polygon baru dibuat
        map.on(L.Draw.Event.CREATED, function(e) {
            drawnItems.addLayer(e.layer);
            updateGeoJSON(); // Perbarui GeoJSON setelah gambar dibuat
        });

        // Saat gambar polygon diedit
        map.on('draw:edited', function() {
            updateGeoJSON(); // Perbarui GeoJSON setelah gambar diedit
        });

        // Saat gambar polygon dihapus
        map.on('draw:deleted', function() {
            updateGeoJSON(); // Perbarui GeoJSON setelah gambar dihapus
        });

        // Event listener sebelum form disubmit
        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah submit default

            // Perbarui GeoJSON di form
            updateGeoJSON();

            // Perbarui data form sebelum submit
            updateFormData();

            // Lakukan submit form
            form.submit();
        });

        // Load GeoJSON lama ke peta saat halaman pertama dimuat
        loadOldGeoJSON();
    });

    // Catch Data from redirecting
    let successMessage = "<?php echo session()->getFlashdata('error'); ?>";
    if (successMessage) {
        alert(successMessage);
    }
</script>
