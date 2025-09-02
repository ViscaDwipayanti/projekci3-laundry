
<div class="container-fluid">

<?php
    if(!empty($this->session->flashdata('message')))
    {?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
         
    <?php }
    
?>

<div class="row">
    <div class="col-md-12">
        <a href="<?= base_url('layanan/add')?>" class="btn btn-custom">
            Tambah
        </a>
        <br><br>
    </div>
</div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-dark"><?= $title?></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Id Layanan</th>
                                        <th>Jenis Layanan</th>
                                        <th>Harga</th>
                                        <th>Waktu Pengerjaan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
 
                                <tbody>
                                <?php
                                    $no = 1;
                                    foreach($data as $row) {?>
                                        <tr>
                                            <td><?= $no++?></td>
                                            <td><?= $row->id_layanan;?></td>
                                            <td><?= $row->jenis_layanan;?></td>
                                            <td><?= "Rp. ".number_format($row->harga,0,'.','.');?></td>
                                            <td><?= $row->waktu_pengerjaan . " " . $row->satuan_waktu; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-custom btn-sm" data-toggle="modal" data-target="#EditLayananModal<?= $row->id_layanan ?>">Edit</button>
                                                <a href="<?= base_url()?>layanan/delete/<?= $row->id_layanan;?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus layanan ini?')">Delete</a>
                                            </td>
                                        </tr>
                                    
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="EditLayananModal<?= $row->id_layanan ?>" tabindex="-1" role="dialog" aria-labelledby="EditLayananModalLabel<?= $row->id_layanan ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EditLayananModalLabel">Form Edit Layanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formeditlayanan<?= $row->id_layanan ?>" name="formeditlayanan" method="POST" action="<?= base_url('layanan/edit/'.$row->id_layanan);?>">
                                                            <div class="form-group form-field">
                                                                <label for="id_layanan" class="label-custom">ID Layanan</label>
                                                                <input type="text" name="id_layanan" id="edit_id_layanan" value="<?= $row->id_layanan?>" class="form-control form-custom" readonly>                    
                                                            </div>
                                                            <div class="form-group form-field">
                                                                <label for="jenis_layanan" class="label-custom">Jenis Layanan</label>
                                                                <input type="text" name="jenis_layanan" id="edit_jenis_layanan" value="<?= $row->jenis_layanan?>" class="form-control form-custom" placeholder="Jenis Layanan" autocomplete="off" required>
                                                            </div>
                                                            <div class="form-group form-field">
                                                                <label for="harga" class="label-custom">Harga/Kg</label>
                                                                <input type="text" name="harga" id="edit_harga" value="<?= $row->harga?>" class="form-control form-custom" placeholder="Harga" autocomplete="off" required>
                                                            </div>
                                                            <div class="form-group form-field">
                                                                <label for="waktu_pengerjaan" class="label-custom">Waktu Pengerjaan</label>
                                                                <div class="input-group">
                                                                    <input type="number" name="waktu_pengerjaan" id="edit_waktu_pengerjaan" value="<?= $row->waktu_pengerjaan?>" class="form-control form-custom" placeholder="Lama Waktu" autocomplete="off" required>
                                                                    <select name="satuan_waktu" id="edit_satuan_waktu" class="form-control form-custom opsi" required>
                                                                        <option value="">Pilih Satuan Waktu</option>
                                                                        <option value="hari" <?= ($row->satuan_waktu == 'hari') ? 'selected' : ''; ?>>Hari</option>
                                                                        <option value="jam" <?= ($row->satuan_waktu == 'jam') ? 'selected' : ''; ?>>Jam</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-button">
                                                                <button type="submit" class="btn btn-custom btn-sm" onClick="validateEdit();">Edit</button>
                                                                <a href="<?= base_url()?>layanan" class="btn btn-danger btn-sm">Batal</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Edit -->
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
</div>




<!-- Validasi Edit -->
<script language="javascript">
    function validateEdit() {
    var jenis_layanan = $('#edit_jenis_layanan').val();
    if (jenis_layanan == "") {
        alert("Jenis Layanan masih kosong");
        $('#edit_jenis_layanan').focus();
        return false;
    }

    var harga = $('#edit_harga').val();
    if (harga == "") {
        alert("Harga/kg masih kosong");
        $('#edit_harga').focus();
        return false;
    }

    var waktu_pengerjaan = $('#edit_waktu_pengerjaan').val();
    if (waktu_pengerjaan == "") {
        alert("Waktu Pengerjaan masih kosong");
        $('#edit_waktu_pengerjaan').focus();
        return false;
    }

    var satuan_waktu = $('#edit_satuan_waktu').val();
    if (satuan_waktu == "") {
        alert("Satuan waktu belum dipilih");
        $('#edit_satuan_waktu').focus();
        return false;
    }

    $('#formeditlayanan').submit();
}

</script>
<!-- End Validasi Edit -->

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
