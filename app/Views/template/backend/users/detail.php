<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">

            <!-- Form : Start -->
            <form action="#" method="post" enctype="multipart/form-data">

                <!-- Photo : Start -->
                <div class="row">
                    <div class="col-md-12 col-12 d-flex justify-content-center pt-3 rounded mb-3" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://picsum.photos/seed/pemandangan/1280/720'); background-size: cover;">
                        <div class="form-group" >

                            <?php

                            if ($user[0]['foto'] == null) : ?>
                                <img src="https://placehold.co/150x150?text=User&font=roboto" alt="User Image" class="img-fluid img-bordered-sm d-block">
                            <?php else : ?>
                                <img src="<?php echo base_url('assets/images/users/' . $user[0]['foto']); ?>" alt="User Image" class="img-circle img-bordered-sm">
                            <?php endif;

                            ?>

                        </div>
                    </div>
                </div>
                <!-- Photo : End -->

                <div class="row">

                    <!-- Name : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Nama User</label>
                            <input name="name" value="<?php echo $user[0]['name']; ?>" placeholder="Cth: John Doe" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <!-- Name : End -->

                    <!-- Email : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" value="<?php echo $user[0]['email']; ?>" placeholder="Cth: hW9lC@example.com" class="form-control" type="email" disabled>
                        </div>
                    </div>
                    <!-- Email : End -->

                    <!-- Phone : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input name="phone" value="<?php echo $user[0]['phone']; ?>" placeholder="Cth: +628123456789" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <!-- Phone : End -->

                    <!-- Account : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Akun Bank</label>

                            <!-- Check Account : Start -->
                            <?php if ($user[0]['account'] == null) : ?>
                                <input name="account" value="" placeholder="Belum menambahkan Akun Rekening" class="form-control" type="text" disabled>
                            <?php else : ?>
                                <input name="account" value="<?php echo $user[0]['account']; ?>" placeholder="Cth: BCA" class="form-control" type="text" disabled>
                            <?php endif; ?>
                            <!-- Check Account : End -->

                        </div>
                    </div>
                    <!-- Account : End -->

                    <!-- Account Username : End -->
                    <?php if ($user[0]['account'] != null) : ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Pemilik Rekening</label>
                                <input name="account_username" value="<?php echo $user[0]['account_username']; ?>" placeholder="Cth: 123456789" class="form-control" type="text" disabled>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Account Username : End -->

                    <!-- Account ID : Start -->
                    <?php if ($user[0]['account'] != null) : ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Nomor Rekening</label>
                                <input name="account_id" value="<?php echo $user[0]['account_id']; ?>" placeholder="Cth: 123456789" class="form-control" type="text" disabled>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Account ID : End -->

                    <!-- Level : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Level</label>
                            <input name="level" value="<?php echo $user[0]['level']; ?>" placeholder="Cth: Admin" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <!-- Level : End -->

                    <!-- Status : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <?php if ($user[0]['status'] == 'Verified') : ?>
                                <button type="button" class="btn btn-success btn-block"><?php echo $user[0]['status']; ?></button>
                            <?php else : ?>
                                <button type="button" class="btn btn-danger btn-block"><?php echo $user[0]['status']; ?></button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Status : End -->

                </div>

            </form>
            <!-- Form : End -->

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

    // Catch Data from redirecting
    let successMessage = "<?php echo session()->getFlashdata('success'); ?>";

    if (successMessage) {
        alert(successMessage);
    }
</script>

<!-- 

'id'                : not null, auto_increment, int
'name'              : not null, varchar(100), text
'email'             : not null, varchar(100), email
'phone'             : null
'account'           : null
'account_username'  : null
'account_id'        : null
'password'          : not null    
'level'             : null
'foto'              : null
'status'            : null
'created_at'        : not null
'updated_at'        : not null

-->