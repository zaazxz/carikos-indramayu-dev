<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">

            <!-- Form : Start -->
            <form action="/profile/changepassword/<?php echo $user[0]['id']; ?>" method="post" enctype="multipart/form-data">

                <!-- CSRF token : Start -->
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <!-- CSRF token : End -->

                <!-- Photo : Start -->
                <div class="row">
                    <div class="col-md-12 col-12 d-flex justify-content-center pt-3 rounded mb-3" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://picsum.photos/seed/pemandangan/1280/720'); background-size: cover;">
                        <div class="form-group">

                            <?php

                            if ($user[0]['foto'] == null) : ?>
                                <img src="https://placehold.co/150x150?text=User&font=roboto" alt="User Image" class="img-fluid img-bordered-sm d-block" id="previewImage" style="width: 150px; height: 150px; object-fit: cover">
                            <?php else : ?>
                                <img src="<?php echo base_url('/upload/user/' . $user[0]['foto']); ?>" alt="User Image" class="img-fluid img-bordered-sm d-block" id="previewImage"  style="width: 150px; height: 150px; object-fit: cover">
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
                            <label>Old Password</label>
                            <input name="oldpassword" value="" placeholder="Masukkan Password Lama" class="form-control" type="password" required>
                        </div>
                    </div>
                    <!-- Name : End -->

                    <!-- Email : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>New Password</label>
                            <input name="newpassword" value="" placeholder="Masukkan Password Baru" class="form-control" type="password" required>
                        </div>
                    </div>
                    <!-- Email : End -->

                    <!-- Submit : Start -->
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </div>
                    <!-- Submit : End -->

                    <!-- Cancel : Start -->
                    <div class="col-6">
                        <a href="/dashboard" class="btn btn-danger btn-block">Batal</a>
                    </div>
                    <!-- Cancel : End -->

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

    // Preview Image
    function preview(event) {
        event.preventDefault();

        const fileInput = document.getElementById("foto");
        const preview = document.getElementById("previewImage");

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }


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