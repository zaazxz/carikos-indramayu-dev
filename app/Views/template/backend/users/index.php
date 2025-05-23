<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">

            <div class="card-tools">
                <?php if (session()->get('status') == "Verified") : ?>
                    <a href="/dashboard/users/create" class="btn btn-flat btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                <?php endif; ?>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama User</th>
                        <th>E-mail</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($users as $user => $value) { ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $value['name'] ?></td>
                            <td class="text-center"><?php echo $value['email'] ?></td>
                            <td class="text-center"><?php echo $value['level'] ?></td>
                            <td class="text-center">
                                <?php if (!$value['foto']) { ?>
                                    <img src="https://placehold.co/150x150?text=User&font=roboto" width="100px" height="100px">
                                <?php } ?>
                                <?php if ($value['foto']) { ?>
                                    <img src="<?php echo base_url('/upload/user/' . $value['foto']); ?>" width="100px" height="100px">
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if ($value['status'] == "Verified") { ?>
                                    <span class="badge badge-success">Verified</span>
                                <?php } ?>
                                <?php if ($value['status'] == "Unverified") { ?>
                                    <a href="/dashboard/users/verification/<?php echo $value['id'] ?>" class="badge badge-danger" onclick="return confirm('Yakin Verifikasi Data..?')">Unverified</a>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a href="/dashboard/users/<?php echo $value['id'] ?>" class="btn btn-xs btn-info btn-flat"><i class="fas fa-eye"></i></a>

                                <?php if (session()->get('status') == "Verified") : ?>
                                    <a href="/dashboard/users/edit/<?php echo $value['id'] ?>" class="btn btn-xs btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>

                                    <!-- Delete : Start -->
                                    <form action="/dashboard/users/delete/<?php echo $value['id'] ?>" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="display: inline-block;">

                                        <!-- CSRF : Start -->
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                        <!-- CSRF : End -->

                                        <button type="submit" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash"></i></button>

                                    </form>
                                    <!-- Delete : End -->
                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
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