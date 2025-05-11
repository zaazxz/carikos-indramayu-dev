<div class="col-md-12">
    <div class="card card-outline card-primary">

        <!-- Card Header : Start -->
        <div class="card-header">
            <h3 class="card-title">Pengaturan Umum</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- Card Header : End -->

        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Coordinat Wilayah</label>
                        <input name="coordinat_wilayah" value="<?php echo $setting['coordinat'] ?>" type="text" class="form-control" placeholder="Coordinat Wilayah" disabled>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Zoom View</label>
                        <input type="number" value="<?php echo $setting['zoom'] ?>" name="zoom_view" min="1" max="20" class="form-control" placeholder="Zoom View" disabled>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="col-md-12">
    <div id="map" style="width: 100%; height: 425px;"></div>
</div>


<script src="//unpkg.com/@sjaakp/leaflet-search/dist/leaflet-search.js"></script>
<script>
    var peta1 = L.tileLayer('https://{s}.google.com/vt/lyrs=s,m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var map = L.map('map', {
        center: [<?php echo $setting['coordinat'] ?>],
        zoom: <?php echo $setting['zoom'] ?>,
        layers: [peta1]
    });

    var baseMaps = {
        'Satellite': peta1,
        'OpenStreetMap': peta2,
    };

    var layerControl = L.control.layers(baseMaps).addTo(map);

    map.addControl(L.control.search());
</script>