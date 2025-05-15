<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <?php echo $title ?>
            </h3>

            <div class="card-tools">

                <!-- Check if Verified : Start -->
                <?php if (session()->get('status') == "Verified") : ?>
                    <a href="/dashboard/wilayah/add" class="btn btn-sm btn-primary btn-flat">
                        <i class="fas fa-plus"></i> Tambah Wilayah
                    </a>
                <?php endif; ?>
                <!-- Check if Verified : End -->

            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama Wilayah</th>
                        <th>Warna</th>
                        <?php if (session()->get('status') == "Verified") : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($wilayah as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td style="background-color: <?php echo $value['warna'] ?> ;"></td>
                            <?php if (session()->get('status') == "Verified") : ?>
                                <td class="text-center">
                                    <a href="/dashboard/wilayah/edit/<?php echo $value['id'] ?>" class="btn btn-sm btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="/dashboard/wilayah/delete/<?php echo $value['id'] ?>" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="display: inline-block;">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="col-md-12">
    <div id="map" style="width: 100%; height: 800px;"></div>
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

    <?php foreach ($wilayah as $key => $value) { ?>
        L.geoJSON(<?php echo $value['geojson'] ?>, {
                fillColor: '<?php echo $value['warna'] ?>',
                fillOpacity: 0.3,
            })
            .bindPopup("<b><?php echo $value['name'] ?></b>")
            .addTo(map);
    <?php } ?>
</script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    // Catch Data from redirecting
    let successMessage = "<?php echo session()->getFlashdata('success'); ?>";

    if (successMessage) {
        alert(successMessage);
    }
</script>