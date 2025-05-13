<div class="col-md-12">
    <div class="card card-outline card-primary">

        <!-- Car Header : Start -->
        <div class="card-header">
            <h3 class="card-title"><?php echo $title ?></h3>
            <a class="float-right btn btn-primary btn-sm" href="/dashboard/kos/create">
                Tambah Data
            </a>
        </div>

        <!-- Card Body : Start -->
        <div class="card-body">
            <table id="example2" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Kos</th>
                        <th>Ketersediaan kamar</th>
                        <th>Harga</th>
                        <th>Jenis Kos</th>
                        <th>Status Banjir</th>
                        <th>Status Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kos as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $value['name'] ?></td>
                            <td class="text-center"><?php echo $value['available'] ?> kamar</td>
                            <td class="text-center">Rp. <?php echo $value['price'] ?></td>
                            <td class="text-center"><?php echo $value['type'] ?></td>
                            <td class="text-center"><?php echo $value['flood_info'] ?></td>
                            <td class="text-center">
                                <?php if ($value['status'] == "Verified") { ?>
                                    <span class="badge badge-success">Verified</span>
                                <?php } ?>
                                <?php if ($value['status'] == "Unverified") { ?>
                                    <a href="/dashboard/kos/verification/<?php echo $value['id'] ?>" class="badge badge-danger" onclick="return confirm('Yakin Verifikasi Data..?')">Unverified</a>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a href="/dashboard/kos/<?php echo $value['id'] ?>" class="btn btn-xs btn-success btn-flat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/dashboard/kos/edit/<?php echo $value['id'] ?>" class="btn btn-xs btn-warning btn-flat">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?php // echo base_url('Kos/Delete/' . $value['id_kos']) 
                                            ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-xs btn-danger btn-flat">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>



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
</script>