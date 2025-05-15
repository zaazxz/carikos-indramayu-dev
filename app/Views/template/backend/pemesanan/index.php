<div class="col-md-12">
    <div class="card card-outline card-primary">

        <!-- Car Header : Start -->
        <div class="card-header">
            <h3 class="card-title"><?php echo $title ?></h3>

            <!-- Check if session level == "Pemilik Kos" : Start -->
            <?php if (session()->get('level') == "Pemilik Kos") { ?>
                <a class="float-right btn btn-primary btn-sm" href="/dashboard/kos/create">
                    Tambah Data
                </a>
            <?php } ?>
            <!-- Check if session level == "Pemilik Kos" : End -->

        </div>

        <!-- Card Body : Start -->
        <div class="card-body">
            <table id="example2" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Kos</th>
                        <th>Nama Pemesan</th>
                        <th>Harga</th>
                        <th>Status Pemesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pemesanan as $key => $value) { ?>
                        <?php if (session()->get('level') == "Pemilik Kos") : ?>
                            <?php if ($value['owner_id'] == session()->get('id')) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $value['name'] ?></td>
                                    <td class="text-center"><?php echo $value['reserver'] ?></td>
                                    <td class="text-center">Rp. <?php echo number_format($value['price'], 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <?php if ($value['status'] == "Approved") { ?>
                                            <span class="badge badge-success">Verified</span>
                                        <?php } ?>
                                        <?php if ($value['status'] == "Pending") { ?>
                                            <span class="badge badge-secondary">Pending</span>
                                        <?php } ?>
                                        <?php if ($value['status'] == "Rejected") { ?>
                                            <span class="badge badge-danger">Rejected</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/pemesanan/detail/<?php echo $value['id'] ?>" class="btn btn-xs btn-success btn-flat">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="/dashboard/pemesanan/delete/<?php echo $value['id'] ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-xs btn-danger btn-flat">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php elseif (session()->get('level') == "Pencari Kos") :  ?>
                            <?php if ($value['reserver_id'] == session()->get('id')) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $value['name'] ?></td>
                                    <td class="text-center"><?php echo $value['reserver'] ?></td>
                                    <td class="text-center">Rp. <?php echo number_format($value['price'], 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <?php if ($value['status'] == "Approved") { ?>
                                            <span class="badge badge-success">Verified</span>
                                        <?php } ?>
                                        <?php if ($value['status'] == "Pending") { ?>
                                            <span class="badge badge-secondary">Pending</span>
                                        <?php } ?>
                                        <?php if ($value['status'] == "Rejected") { ?>
                                            <span class="badge badge-danger">Rejected</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/pemesanan/detail/<?php echo $value['id'] ?>" class="btn btn-xs btn-success btn-flat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endif; ?>
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