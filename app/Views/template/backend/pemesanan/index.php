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

                                            <!-- If Pending && proof_of_payment null : Start -->
                                            <?php if ($value['proof_of_payment'] == null) { ?>
                                                <span class="badge badge-secondary">
                                                    <span class="badge badge-warning badge-pill" data-toggle="tooltip" title="Belum Upload Bukti Pembayaran">
                                                        !
                                                    </span>
                                                    Pending
                                                </span>
                                            <?php } ?>
                                            <!-- If Pending && proof_of_payment null : End -->

                                            <!-- If Pending && proof_of_payment not null : Start -->
                                            <?php if ($value['proof_of_payment'] != null) { ?>
                                                <span class="badge badge-secondary">Pending</span>
                                            <?php } ?>
                                            <!-- If Pending && proof_of_payment not null : End -->

                                        <?php } ?>
                                        <?php if ($value['status'] == "Rejected") { ?>
                                            <span class="badge badge-danger">Rejected</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/pemesanan/detail/<?php echo $value['id'] ?>" class="btn btn-xs btn-success btn-flat">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Uploading proof of payment : Start -->
                                        <?php if ($value['proof_of_payment'] == null) { ?>

                                            <!-- Opening Modal : Start -->
                                            <button class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#uploadProof<?php echo $value['id'] ?>">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                            <!-- Opening Modal : End -->

                                        <?php } ?>
                                        <!-- Uploading proof of payment : End -->

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

<!-- Modal : Start -->
<?php foreach ($pemesanan as $key => $value) : ?>
    <div class="modal fade" id="uploadProof<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/pemesanan/proof/<?php echo $value['id'] ?>" method="post" enctype="multipart/form-data">

                        <!-- CSRF token : Start -->
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <!-- CSRF token : End -->

                        <!-- Preview Image : Start -->
                        <div class="form-group">
                            <label for="">Preview Bukti Pembayaran</label>
                            <img class="img-fluid" src="https://placehold.co/150x150?text=User&font=roboto" alt="Bukti Pembayaran" style="width: 100%; height: 132px; object-fit: cover" id="preview_proof_of_payment">
                        </div>
                        <!-- Preview Image : End -->

                        <!-- File Input : Start -->
                        <div class="form-group">
                            <label for="proof_of_payment">Bukti Pembayaran</label>
                            <input type="file" class="form-control" name="proof_of_payment" id="proof_of_payment">
                        </div>
                        <!-- File Input : End -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Modal : End -->

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

<!-- Tooltip : Start -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
<!-- Tooltip : End -->

<!-- Preview Image : Start -->
<script>
    const proof_of_payment = document.getElementById('proof_of_payment');
    const preview_proof_of_payment = document.getElementById('preview_proof_of_payment');

    // Preview Image : Start
    proof_of_payment.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview_proof_of_payment.setAttribute('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
    // Preview Image : End

</script>
<!-- Preview Image : End -->