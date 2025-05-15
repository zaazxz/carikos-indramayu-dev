<div id="map" style="width: 100%; height: 93vh;"></div>

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

    // Event click di peta
    // map.on('click', function(e) {
    //   var lat = e.latlng.lat;
    //   var lng = e.latlng.lng;
    //   alert("Koordinatnya:\nLatitude: " + lat + "\nLongitude: " + lng);
    // });

    var baseMaps = {
        'Satellite': peta1,
        'OpenStreetMap': peta2,
    };

    var layerControl = L.control.layers(baseMaps).addTo(map);

    <?php foreach ($wilayah as $key => $value) { ?>
        L.geoJSON(<?php echo $value['geojson'] ?>, {
                fillColor: '<?php echo $value['warna'] ?>',
                fillOpacity: 0.3,
            })
            .bindPopup("<b><?php echo $value['name'] ?></b>")
            .addTo(map);
    <?php } ?>

    <?php foreach ($kos as $key => $value) { ?>
        <?php if ($value['status'] == "Verified") { ?>
            var Icon = L.icon({
                iconUrl: '<?php echo base_url('upload/marker/' . $value['marker']) ?>',
                iconSize: [20, 25], // size of the icon
            });

            L.marker([<?php echo $value['coordinat'] ?>], {
                    icon: Icon
                })
                .bindPopup("<img src='<?php echo base_url('upload/photo/' . $value['photo']) ?>' width='210px' height='150px'><br>" +
                    "<b><?php echo $value['name'] ?></b><br>" +
                    "Harga :  <?php echo $value['price'] ?><br>" +
                    "Ketersediaan kamar: <?php echo $value['available'] ?> kamar<br>" +
                    "Kontak :  <?php echo $value['phone'] ?><br>" +
                    "<b>Koordinat:</b> <?php echo $value['coordinat'] ?><br>" +
                    "Status Banjir :<?php echo $value['flood_info'] ?><br>" +
                    <?php if (session()->get('isLoggedIn') == false || session()->get('level') == "Pencari Kos") : ?> "<a href='<?php echo base_url('/pemesanan/create/' . $value['id']) ?>' class='btn btn-success btn-xs text-white' style='margin-right: 10px;'>Pesan Sekarang!</a>" +
                    <?php endif; ?> "<a href='<?php echo base_url('/dashboard/kos/' . $value['id']) ?>' class='btn btn-primary btn-xs text-white'>Detail</a>")
                .addTo(map);
        <?php } ?>
    <?php } ?>
</script>