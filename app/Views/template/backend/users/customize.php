<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">

            <!-- Form : Start -->
            <form action="/profile/update/<?php echo $user[0]['id']; ?>" method="post" enctype="multipart/form-data">

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
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label>Nama User</label>
                            <input name="name" value="<?php echo $user[0]['name']; ?>" placeholder="Cth: John Doe" class="form-control" type="text" required>
                        </div>
                    </div>
                    <!-- Name : End -->

                    <!-- Email : Start -->
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" value="<?php echo $user[0]['email']; ?>" placeholder="Cth: hW9lC@example.com" class="form-control" type="email" required>
                        </div>
                    </div>
                    <!-- Email : End -->

                    <!-- Photo : Start -->
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control" id="foto" value="<?php echo $user[0]['foto']; ?>" onchange="preview(event)">
                        </div>
                    </div>
                    <!-- Photo : End -->

                    <!-- Phone : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input name="phone" value="<?php echo $user[0]['phone']; ?>" placeholder="Cth: +628123456789" class="form-control" type="text" required>
                        </div>
                    </div>
                    <!-- Phone : End -->

                    <!-- Account : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Akun Bank</label>
                            <select name="account" id="account" class="form-control" value="<?php echo $user[0]['account']; ?>">
                                <option value="null">-- Pilih Bank --</option>
                                <option value="BCA" <?php echo ($user[0]['account'] == 'BCA') ? 'selected' : '' ?>>BCA</option>
                                <option value="BNI" <?php echo ($user[0]['account'] == 'BNI') ? 'selected' : '' ?>>BNI</option>
                                <option value="BRI" <?php echo ($user[0]['account'] == 'BRI') ? 'selected' : '' ?>>BRI</option>
                                <option value="Mandiri" <?php echo ($user[0]['account'] == 'Mandiri') ? 'selected' : '' ?>>Mandiri</option>
                                <option value="Lainnya" <?php echo ($user[0]['account'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <!-- Account : End -->

                    <!-- Account Username : End -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Pemilik Rekening</label>
                            <input name="account_username" value="<?php echo $user[0]['account_username']; ?>" placeholder="Cth: John Doe" class="form-control" type="text">
                        </div>
                    </div>
                    <!-- Account Username : End -->

                    <!-- Account ID : Start -->
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Nomor Rekening</label>
                            <input name="account_id" value="<?php echo $user[0]['account_id']; ?>" placeholder="Cth: 123456789" class="form-control" type="text">
                        </div>
                    </div>
                    <!-- Account ID : End -->

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