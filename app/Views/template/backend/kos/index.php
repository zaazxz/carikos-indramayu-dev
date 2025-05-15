<div class="col-md-12">
    <div class="card card-outline card-primary">

        <!-- Car Header : Start -->
        <div class="card-header">
            <h3 class="card-title"><?php echo $title ?></h3>

            <!-- Check if session level == "Pemilik Kos" : Start -->
            <?php if (session()->get('level') == "Pemilik Kos") { ?>
                <?php if (session()->get('status') == "Verified") { ?>
                    <a class="float-right btn btn-primary btn-sm" href="/dashboard/kos/create">
                        Tambah Data
                    </a>
                <?php } ?>
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
                        <?php if (session()->get('level') == "Pemilik Kos") : ?>
                            <?php if ($value['id_user'] == session()->get('id')) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $value['name'] ?></td>
                                    <td class="text-center"><?php echo $value['available'] ?> kamar</td>
                                    <td class="text-center">Rp. <?php echo number_format($value['price'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?php echo $value['type'] ?></td>
                                    <td class="text-center"><?php echo $value['flood_info'] ?></td>
                                    <td class="text-center">
                                        <?php if ($value['status'] == "Verified") { ?>
                                            <span class="badge badge-success">Verified</span>
                                        <?php } ?>
                                        <?php if ($value['status'] == "Unverified") { ?>
                                            <?php if (session()->get('level') == "Admin") : ?>
                                                <a href="/dashboard/kos/verification/<?php echo $value['id'] ?>" class="badge badge-danger" onclick="return confirm('Yakin Verifikasi Data..?')">Unverified</a>
                                            <?php elseif (session()->get('level') == "Pemilik Kos") : ?>
                                                <span class="badge badge-danger">Unverified</span>
                                            <?php endif; ?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/kos/<?php echo $value['id'] ?>" class="btn btn-xs btn-success btn-flat">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Check if status "Pemilik" : Start  -->
                                        <?php if (session()->get('level') == "Pemilik Kos") { ?>
                                            <?php if (session()->get('status') == "Verified") { ?>
                                                <a href="/dashboard/kos/edit/<?php echo $value['id'] ?>" class="btn btn-xs btn-warning btn-flat">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                        <!-- Check if status "Pemilik" : End  -->

                                        <?php if (session()->get('status') == "Verified") : ?>
                                            <a href="/dashboard/kos/delete/<?php echo $value['id'] ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-xs btn-danger btn-flat">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php elseif (session()->get('level') == "Pencari Kos") : ?>
                            <?php if ($value['status'] == "Verified") : ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $value['name'] ?></td>
                                    <td class="text-center"><?php echo $value['available'] ?> kamar</td>
                                    <td class="text-center">Rp. <?php echo number_format($value['price'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?php echo $value['type'] ?></td>
                                    <td class="text-center"><?php echo $value['flood_info'] ?></td>
                                    <td class="text-center">
                                        <?php if ($value['status'] == "Verified") { ?>
                                            <span class="badge badge-success">Verified</span>
                                        <?php } ?>
                                        <?php if ($value['status'] == "Unverified") { ?>
                                            <?php if (session()->get('level') == "Admin") : ?>
                                                <a href="/dashboard/kos/verification/<?php echo $value['id'] ?>" class="badge badge-danger" onclick="return confirm('Yakin Verifikasi Data..?')">Unverified</a>
                                            <?php elseif (session()->get('level') == "Pemilik Kos") : ?>
                                                <span class="badge badge-danger">Unverified</span>
                                            <?php endif; ?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/kos/<?php echo $value['id'] ?>" class="btn btn-xs btn-success btn-flat">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Check if status "Pemilik" : Start  -->
                                        <?php if (session()->get('level') == "Pemilik Kos") { ?>
                                            <?php if (session()->get('status') == "Verified") { ?>
                                                <a href="/dashboard/kos/edit/<?php echo $value['id'] ?>" class="btn btn-xs btn-warning btn-flat">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                        <!-- Check if status "Pemilik" : End  -->

                                        <?php if (session()->get('status') == "Verified") : ?>
                                            <a href="/dashboard/kos/delete/<?php echo $value['id'] ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-xs btn-danger btn-flat">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php elseif (session()->get('level') == "Admin") : ?>
                            <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $value['name'] ?></td>
                                    <td class="text-center"><?php echo $value['available'] ?> kamar</td>
                                    <td class="text-center">Rp. <?php echo number_format($value['price'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?php echo $value['type'] ?></td>
                                    <td class="text-center"><?php echo $value['flood_info'] ?></td>
                                    <td class="text-center">
                                        <?php if ($value['status'] == "Verified") { ?>
                                            <span class="badge badge-success">Verified</span>
                                        <?php } ?>
                                        <?php if ($value['status'] == "Unverified") { ?>
                                            <?php if (session()->get('level') == "Admin") : ?>
                                                <a href="/dashboard/kos/verification/<?php echo $value['id'] ?>" class="badge badge-danger" onclick="return confirm('Yakin Verifikasi Data..?')">Unverified</a>
                                            <?php elseif (session()->get('level') == "Pemilik Kos") : ?>
                                                <span class="badge badge-danger">Unverified</span>
                                            <?php endif; ?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/kos/<?php echo $value['id'] ?>" class="btn btn-xs btn-success btn-flat">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Check if status "Pemilik" : Start  -->
                                        <?php if (session()->get('level') == "Pemilik Kos") { ?>
                                            <?php if (session()->get('status') == "Verified") { ?>
                                                <a href="/dashboard/kos/edit/<?php echo $value['id'] ?>" class="btn btn-xs btn-warning btn-flat">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                        <!-- Check if status "Pemilik" : End  -->

                                        <?php if (session()->get('status') == "Verified") : ?>
                                            <a href="/dashboard/kos/delete/<?php echo $value['id'] ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-xs btn-danger btn-flat">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
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