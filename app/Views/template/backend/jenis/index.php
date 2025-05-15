<div class="col-md-12">
    <div class="card card-outline card-primary">

        <!-- Card Header : Start -->
        <div class="card-header">
            <h3 class="card-title"><?php echo $title ?></h3>
        </div>
        <!-- Card Header : End -->

        <!-- Card Body : Start -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Jenis Kos</th>
                        <th>Marker</th>
                        <?php if (session()->get('status') == "Verified") : ?>
                            <th width="150px">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($jeniskos as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $value['type'] ?></td>
                            <td class="text-center"><img src="<?php echo base_url('upload/marker/' . $value['marker']) ?>" width="75px"></td>
                            <?php if (session()->get('status') == "Verified") : ?>
                                <td class="text-center">
                                    <button data-toggle="modal" data-target="#edit<?php echo $value['id'] ?>" class="btn btn-sm btn-warning btn-flat"><i class="fas fa-map-marker-alt"></i> Ganti Marker</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <!-- Card Body : End -->

    </div>
</div>


<?php foreach ($jeniskos as $key => $value) {  ?>
    <div class="modal fade" id="edit<?php echo $value['id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ganti Marker <?php echo $value['type'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Form : Start -->
                <form action="/dashboard/jeniskos/update/<?php echo $value['id'] ?>" method="post" enctype="multipart/form-data">

                    <!-- CSRF token : Start -->
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <!-- CSRF token : End -->

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Upload Marker</label>
                            <input type="file" name="marker" class="form-control" accept="image/png" required>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class=" btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

<?php } ?>

<script>
    // Catching error 
    let successMessage = "<?php echo session()->getFlashdata('success'); ?>";

    if (successMessage) {
        alert(successMessage);
    }
</script>