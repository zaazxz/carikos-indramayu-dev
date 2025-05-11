<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">

            <!-- Form : Start -->
            <form action="/dashboard/users/store" method="post" enctype="multipart/form-data">

                <!-- Validation : Start -->
                <?php
                session();
                $validation = \Config\Services::validation();
                ?>
                <!-- Validation : End -->

                <!-- CSRF : Start -->
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <!-- CSRF : End -->

                <div class="row">
                    <div class="col-12">

                        <!-- Name : Start -->
                        <div class="form-group">
                            <label>Nama User</label>
                            <input name="name" value="<?= old('name') ?>" placeholder="Cth: John Doe" class="form-control" type="text">
                            <p class="text-danger"><?= $validation->hasError('name') ? $validation->getError('name') : '' ?></p>
                        </div>
                        <!-- Name : End -->

                        <!-- Email : Start -->
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" value="<?= old('email') ?>" placeholder="Cth: hW9lC@example.com" class="form-control" type="email">
                            <p class="text-danger"><?= $validation->hasError('email') ? $validation->getError('email') : '' ?></p>
                        </div>
                        <!-- Email : End -->

                        <!-- Phone : Start -->
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input name="phone" value="<?= old('phone') ?>" placeholder="Cth: +628123456789" class="form-control" type="text">
                            <p class="text-danger"><?= $validation->hasError('phone') ? $validation->getError('phone') : '' ?></p>
                        </div>
                        <!-- Phone : End -->

                        <!-- Button Submit : Start -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        <!-- Button Submit : End -->

                    </div>
                </div>

            </form>
            <!-- Form : End -->

        </div>
    </div>
</div>

<!-- 

'name'              : not null, varchar(100), text
'email'             : not null, varchar(100), email
'phone'             : not null, varchar(100), numeric

-->

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
    let successMessage = "<?php echo session()->getFlashdata('error'); ?>";

    if (successMessage) {
        alert(successMessage);
    }

</script>

<!-- 

'id'                : not null, auto_increment, int
'name'              : not null, varchar(100), text
'email'             : not null, varchar(100), email
'account'           : null
'account_username'  : null
'account_id'        : null
'phone'             : null
'password'          : not null    
'level'             : null
'foto'              : null
'status'            : null
'created_at'        : not null
'updated_at'        : not null

-->