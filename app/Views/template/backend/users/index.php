<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">

            <div class="card-tools">
                <a href="<?= base_url('User/Input') ?>" class="btn btn-flat btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah
                </a>
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
                                <?php if ($value['foto'] != null) { ?>
                                    <img src="#" width="100px" height="100px">
                                <?php } ?>
                                <?php if ($value['foto'] == null) { ?>
                                    <img src="#" width="100px" height="100px">
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-xs btn-info btn-flat"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-xs btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash"></i></a>
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